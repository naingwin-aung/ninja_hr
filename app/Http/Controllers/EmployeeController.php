<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee.index');
    }

    public function create()
    {
        $departments = Department::orderBy('title')->get();
        return view('employee.create', compact('departments'));
    }

    public function store(StoreEmployeeRequest $request)
    {
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
        User::create($request->only('employee_id', 'name', 'phone', 'email', 'nrc_number', 'gender', 'birthday', 'address', 'department_id', 'date_of_join', 'is_present', 'password') + ['profile_img' => $profile_img_name]);

        return redirect()->route('employee.index')->with('create', 'Employee is Successfully Create');
    }

    public function edit(User $employee)
    {
        $departments = Department::orderBy('title')->get();
        return view('employee.edit', compact('employee', 'departments'));
    }

    public function update($id, UpdateEmployeeRequest $request) {
        $employee = User::findOrFail($id);
        $employee->update($request->only('employee_id', 'name', 'phone', 'email', 'nrc_number', 'gender', 'birthday', 'address', 'department_id', 'date_of_join', 'is_present'));

        if($request->filled('password')) {
            $employee->update($request->only('password'));
        }

        return redirect()->route('employee.index')->with('update', 'Employee is Successfully Update');
    }

    public function show(User $employee)
    {   
        return view('employee.show', compact('employee'));
    }

    public function ssd()
    {
        $employees = User::with('department');
        return datatables($employees)
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
            ->addColumn('action', function($each) {
                $edit_icon = '<a href="'.route('employee.edit', $each->id).'" class="text-warning"><i class="fas fa-user-edit"></i></a>';
                $info_icon = '<a href="'.route('employee.show', $each->id).'" class="text-primary"><i class="fas fa-info-circle"></i></a>';
                return '<div class="action_icon">'. $edit_icon . $info_icon .'</div>';
            })
            ->rawColumns(['is_present', 'action'])    
            ->toJson();
    }
}
