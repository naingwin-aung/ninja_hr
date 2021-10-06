<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Requests\UpdatePermissionRequest;

class PermissionController extends Controller
{
    public function index()
    {
        if(!Auth::user()->can('view_permission')) {
            abort(403, 'Unauthorized Action');
        }

        return view('permission.index');
    }

    public function create()
    {
        if(!Auth::user()->can('create_permission')) {
            abort(403, 'Unauthorized Action');
        }

        return view('permission.create');
    }

    public function store(StorePermissionRequest $request)
    {
        if(!Auth::user()->can('create_permission')) {
            abort(403, 'Unauthorized Action');
        }

        Permission::create($request->only('name'));

        return redirect()->route('permission.index')->with('create', 'Permission is Successfully Create');
    }

    public function edit(Permission $permission)
    {
        if(!Auth::user()->can('edit_permission')) {
            abort(403, 'Unauthorized Action');
        }

        return view('permission.edit', compact('permission'));
    }

    public function update($id, UpdatePermissionRequest $request) {
        if(!Auth::user()->can('edit_permission')) {
            abort(403, 'Unauthorized Action');
        }

        $permission = Permission::findOrFail($id);
        $permission->update($request->only('name'));

        return redirect()->route('permission.index')->with('update', 'Permission is Successfully Update');
    }

    public function destroy(Permission $permission) 
    {
        if(!Auth::user()->can('delete_permission')) {
            abort(403, 'Unauthorized Action');
        }

        $permission->delete();
        return 'success';
    }

    public function ssd()
    {
        if(!Auth::user()->can('view_permission')) {
            abort(403, 'Unauthorized Action');
        }

        $permissions = Permission::query();
        return datatables($permissions)
            ->addColumn('plus-icon', function($each) {
                return null;
            })
            ->editColumn('updated_at', function($each) {
                return Carbon::parse($each->updated_at)->diffForHumans() . ' - ' .
                    Carbon::parse($each->updated_at)->toFormattedDateString() . ' - ' .
                    Carbon::parse($each->updated_at)->format('H:i:s A');
            })
            ->addColumn('action', function($each) {
                $edit_icon = '';
                $delete_icon = '';

                if(Auth::user()->can('edit_permission')) {
                    $edit_icon = '<a href="'.route('permission.edit', $each->id).'" class="text-warning"><i class="fas fa-user-edit"></i></a>';
                }

                if(Auth::user()->can('delete_permission')) {
                    $delete_icon = '<a href="#" class="text-danger delete_btn" data-id="'.$each->id.'"><i class="fas fa-trash"></i></a>';
                }

                return '<div class="action_icon">'. $edit_icon . $delete_icon .'</div>';
            })
            ->rawColumns(['action'])    
            ->toJson();
    }
}
