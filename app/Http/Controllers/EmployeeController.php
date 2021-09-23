<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

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

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function ssd()
    {
        $employees = User::with('department');
        return Datatables::of($employees)
            ->addColumn('department_name', function($each) {
                return $each->department ? $each->department->title : '-';
            })
            ->editColumn('is_present', function($each) {
                if($each->is_present == 1) {
                    return '<span class="badge badge-pill badge-success">Present</span>';
                }

                return '<span class="badge badge-pill badge-danger">Leave</span>';
            })
            ->rawColumns(['is_present'])    
            ->make(true);
    }
}
