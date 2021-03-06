<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        if(!Auth::user()->can('view_employee')) {
            abort(403, 'Unauthorized Action');
        }

        return view('employee.index');
    }

    public function create()
    {
        if(!Auth::user()->can('create_employee')) {
            abort(403, 'Unauthorized Action');
        }

        $roles = Role::get();
        $departments = Department::orderBy('title')->get();
        return view('employee.create', compact('departments', 'roles'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        if(!Auth::user()->can('create_employee')) {
            abort(403, 'Unauthorized Action');
        }

        $profile_img_name = null;

        if($request->hasFile('profile_img')) {
            $profile_img_file = $request->file('profile_img');
            $profile_img_name = uniqid(). '_'. time() . '.' . $profile_img_file->getClientOriginalExtension();
            Storage::disk('public')->put('employee/' . $profile_img_name, file_get_contents($profile_img_file));
        }

        // $employee = new User();
        // $employee->employee_id = $request->employee_id;
        // $employee->name = $request->name;
        // $employee->phone = $request->phone;
        // $employee->email = $request->email;
        // $employee->nrc_number = $request->nrc_number;
        // $employee->gender = $request->gender;
        // $employee->birthday = $request->birthday;
        // $employee->address = $request->address;
        // $employee->department_id = $request->department_id;
        // $employee->date_of_join = $request->date_of_join;
        // $employee->is_present = $request->is_present;
        // $employee->password = $request->password;
        // $employee->profile_img = $profile_img_name;
        // $employee->save();

        //use Mutator
        $employee = User::create($request->only('employee_id', 'name', 'phone', 'email', 'nrc_number', 'gender', 'birthday', 'address', 'department_id', 'date_of_join', 'is_present', 'password') + ['profile_img' => $profile_img_name]);

        $employee->syncRoles($request->roles);

        return redirect()->route('employee.index')->with('create', 'Employee is Successfully Create');
    }

    public function edit(User $employee)
    {
        if(!Auth::user()->can('edit_employee')) {
            abort(403, 'Unauthorized Action');
        }

        $departments = Department::orderBy('title')->get();
        $roles = Role::get();
        $old_roles = $employee->roles->pluck('id')->toArray();
        return view('employee.edit', compact('employee', 'departments', 'roles', 'old_roles'));
    }

    public function update($id, UpdateEmployeeRequest $request) {
        if(!Auth::user()->can('edit_employee')) {
            abort(403, 'Unauthorized Action');
        }

        $employee = User::findOrFail($id);

        $profile_img_name = $employee->profile_img;

        if($request->hasFile('profile_img')) {
            Storage::disk('public')->delete('employee/'. $employee->profile_img);

            $profile_img_file = $request->file('profile_img');
            $profile_img_name = uniqid(). '_'. time() . '.' . $profile_img_file->getClientOriginalExtension();
            Storage::disk('public')->put('employee/' . $profile_img_name, file_get_contents($profile_img_file));
        }

        $employee->update($request->only('employee_id', 'name', 'phone', 'email', 'nrc_number', 'gender', 'birthday', 'address', 'department_id', 'date_of_join', 'is_present') + ['profile_img' => $profile_img_name]);

        $employee->syncRoles($request>ro);

        if($request->filled('password')) {
            $employee->update($request->only('password'));
        }

        return redirect()->route('employee.index')->with('update', 'Employee is Successfully Update');
    }

    public function show(User $employee)
    {   
        if(!Auth::user()->can('view_employee')) {
            abort(403, 'Unauthorized Action');
        }

        return view('employee.show', compact('employee'));
    }

    public function destroy(User $employee) 
    {
        if(!Auth::user()->can('delete_employee')) {
            abort(403, 'Unauthorized Action');
        }

        $employee->delete();
        return 'success';
    }

    public function ssd()
    {
        if(!Auth::user()->can('view_employee')) {
            abort(403, 'Unauthorized Action');
        }

        $employees = User::with('department');
        return datatables($employees)
            ->filterColumn('department_name', function($query, $keyword) {
                $query->whereHas('department', function($q1) use($keyword) {
                    $q1->where('title', 'like', '%'.$keyword.'%');
                });
            })
            ->addColumn('role_name', function($each) {
                $output = '';
                foreach($each->roles as $role) {
                    $output .=  '<span class="badge badge-pill badge-primary m-1">'.$role->name.'</span>';
                }

                return $output;
            })
            ->addColumn('department_name', function($each) {
                return $each->department ? $each->department->title : '-';
            })
            ->editColumn('is_present', function($each) {
                if($each->is_present == 1) {
                    return '<span class="badge badge-pill badge-success">Present</span>';
                }
                return '<span class="badge badge-pill badge-danger">Leave</span>';
            })
            ->addColumn('plus-icon', function($each) {
                return null;
            })
            ->editColumn('updated_at', function($each) {
                return Carbon::parse($each->updated_at)->diffForHumans() . ' - ' .
                    Carbon::parse($each->updated_at)->toFormattedDateString() . ' - ' .
                    Carbon::parse($each->updated_at)->format('H:i:s A');
            })
            ->addColumn('profile_img', function($each) {
                return '<img src="'.$each->profile_img_path().'" class="profile_thumbnail" /><p class="my-1">'.$each->name.'</p>';
            })
            ->addColumn('action', function($each) {
                $edit_icon = '';
                $info_icon = '';
                $delete_icon = '';

                if(Auth::user()->can('edit_employee')) {
                    $edit_icon = '<a href="'.route('employee.edit', $each->id).'" class="text-warning"><i class="fas fa-user-edit"></i></a>';
                }

                if(Auth::user()->can('view_employee')) { 
                    $info_icon = '<a href="'.route('employee.show', $each->id).'" class="text-primary"><i class="fas fa-info-circle"></i></a>';
                }

                if(Auth::user()->can('delete_employee')) {
                    $delete_icon = '<a href="#" class="text-danger delete_btn" data-id="'.$each->id.'"><i class="fas fa-trash"></i></a>';
                }

                if($each->id !== Auth::user()->id) {
                    return '<div class="action_icon">'. $edit_icon . $info_icon . $delete_icon .'</div>';
                }

                return '<div class="action_icon">'. $edit_icon . $info_icon .'</div>';
            })
            ->rawColumns(['is_present', 'action', 'profile_img', 'role_name'])    
            ->toJson();
    }
}
