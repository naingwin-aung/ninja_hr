<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('department.index');
    }

    public function create()
    {
        return view('department.create');
    }

    public function store(StoreDepartmentRequest $request)
    {
        Department::create($request->only('title'));

        return redirect()->route('department.index')->with('create', 'Department is Successfully Create');
    }

    public function edit(Department $department)
    {
        return view('department.edit', compact('department'));
    }

    public function update($id, UpdateDepartmentRequest $request) {
        $department = Department::findOrFail($id);

        $department->update($request->only('title'));

        if($request->filled('password')) {
            $department->update($request->only('password'));
        }

        return redirect()->route('department.index')->with('update', 'Department is Successfully Update');
    }

    public function destroy(Department $department) 
    {
        $department->delete();
        return 'success';
    }

    public function ssd()
    {
        $departments = Department::query();
        return datatables($departments)
            ->addColumn('plus-icon', function($each) {
                return null;
            })
            ->editColumn('updated_at', function($each) {
                return Carbon::parse($each->updated_at)->diffForHumans() . ' - ' .
                    Carbon::parse($each->updated_at)->toFormattedDateString() . ' - ' .
                    Carbon::parse($each->updated_at)->format('H:i:s A');
            })
            ->addColumn('action', function($each) {
                $edit_icon = '<a href="'.route('department.edit', $each->id).'" class="text-warning"><i class="fas fa-user-edit"></i></a>';
                $delete_icon = '<a href="#" class="text-danger delete_btn" data-id="'.$each->id.'"><i class="fas fa-trash"></i></a>';
                return '<div class="action_icon">'. $edit_icon . $delete_icon .'</div>';
            })
            ->rawColumns(['action'])    
            ->toJson();
    }
}
