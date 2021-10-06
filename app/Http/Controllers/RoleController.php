<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Department;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreRoleRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;

class RoleController extends Controller
{
    public function index()
    {
        if(!Auth::user()->can('view_role')) {
            abort(403, 'Unauthorized Action');
        }

        return view('role.index');
    }

    public function create()
    {
        if(!Auth::user()->can('create_role')) {
            abort(403, 'Unauthorized Action');
        }

        $permissions = Permission::get();
        return view('role.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        if(!Auth::user()->can('create_role')) {
            abort(403, 'Unauthorized Action');
        }

        $role = Role::create($request->only('name'));
        $role->givePermissionTo($request->permissions);

        return redirect()->route('role.index')->with('create', 'Role is Successfully Create');
    }

    public function edit(Role $role)
    {
        if(!Auth::user()->can('edit_role')) {
            abort(403, 'Unauthorized Action');
        }

        $permissions = Permission::get();
        $old_permission = $role->permissions->pluck('id')->toArray();
        return view('role.edit', compact('role', 'permissions', 'old_permission'));
    }

    public function update($id, UpdateRoleRequest $request) {
        if(!Auth::user()->can('edit_role')) {
            abort(403, 'Unauthorized Action');
        }

        $role = Role::findOrFail($id);
        $old_permission = $role->permissions->pluck('name')->toArray();
        $role->revokePermissionTo($old_permission);

        $role->update($request->only('name'));
        $role->givePermissionTo($request->permissions);

        return redirect()->route('role.index')->with('update', 'Role is Successfully Update');
    }

    public function destroy(Role $role) 
    {
        if(!Auth::user()->can('delete_role')) {
            abort(403, 'Unauthorized Action');
        }

        $role->delete();
        return 'success';
    }

    public function ssd()
    {
        if(!Auth::user()->can('view_role')) {
            abort(403, 'Unauthorized Action');
        }

        $roles = Role::query();
        return datatables($roles)
            ->addColumn('plus-icon', function($each) {
                return null;
            })
            ->addColumn('permissions', function($each) {
                $output = '';
                foreach($each->permissions as $permission) {
                    $output .= '<span class="badge badge-pill badge-primary m-1">'.$permission->name.'</span>';
                }
                return $output;
            })
            ->editColumn('updated_at', function($each) {
                return Carbon::parse($each->updated_at)->diffForHumans() . ' - ' .
                    Carbon::parse($each->updated_at)->toFormattedDateString() . ' - ' .
                    Carbon::parse($each->updated_at)->format('H:i:s A');
            })
            ->addColumn('action', function($each) {
                $edit_icon = '';
                $delete_icon = '';

                if(Auth::user()->can('edit_role')) {
                    $edit_icon = '<a href="'.route('role.edit', $each->id).'" class="text-warning"><i class="fas fa-user-edit"></i></a>';
                }

                if(Auth::user()->can('delete_role')) {
                    $delete_icon = '<a href="#" class="text-danger delete_btn" data-id="'.$each->id.'"><i class="fas fa-trash"></i></a>';
                }
                
                return '<div class="action_icon">'. $edit_icon . $delete_icon .'</div>';
            })
            ->rawColumns(['action', 'permissions'])    
            ->toJson();
    }
}
