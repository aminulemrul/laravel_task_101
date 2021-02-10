<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permission = Permission::get();
        return view('admin.roles.create-edit', compact('permission'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        $request->session()->flash('successMessage', "Role create successfully!");
        return redirect()->route('admin.roles.index');
    }

    public function edit($id)
    {
        $role = Role::where('id', $id)->first();
        if (empty($role)) {
            return redirect()->route('admin.roles.index');
        }
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.roles.create-edit', compact('role', 'permission', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::where('id', $id)->first();
        if (empty($role)) {
            return redirect()->route('admin.roles.index');
        }
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));

        $request->session()->flash('successMessage', "Role updated!");
        return redirect()->route('admin.roles.index');
    }

    public function destroy(Request $request, $id)
    {
        $role = Role::where('id', $id)->first();
        if (!empty($role)) {
            $role->delete();
            $request->session()->flash('successMessage', "Role deleted!");
        } else {
            $request->session()->flash('errorMessage', "Role not found!");
        }
        return redirect()->route('admin.roles.index');
    }
}
