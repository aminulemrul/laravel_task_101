<?php

namespace App\Http\Controllers\Admin;

use App\Model\Role;
use App\Model\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function add_role(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|unique:roles'
        ]);

        $name_list =  explode(" ", $request->name);
        $name_list = array_map('strtolower', $name_list);
        $role_slug = implode("-", $name_list);
        $similar_slug = DB::table('roles')->where('slug', 'like', $role_slug . '%')->get();
        if (count($similar_slug) > 0) {
            $slug = $role_slug . '-' . Str::random(20);
        } else {
            $slug = $role_slug;
        }

        $role = new Role();
        $role->name = $request->name;
        $role->slug = preg_replace('/[^a-zA-Z0-9]+/', '-', $slug);
        $role->save();
    }

    public function all_role()
    {
        if (!\Request::ajax()) {
            return abort(404);
        }
        $roles = Role::orderBy('id', 'DESC')->paginate(8);
        return response()->json(['roles' => $roles]);
    }


    public function edit($slug)
    {

        $role = Role::where('slug', $slug)->first();
        return response()->json(['role' => $role]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles'
        ]);

        $name_list =  explode(" ", $request->name);
        $name_list = array_map('strtolower', $name_list);
        $role_slug = implode("-", $name_list);
        $similar_slug = DB::table('roles')->where('slug', 'like', $role_slug . '%')->get();
        if (count($similar_slug) > 0) {
            $slug = $role_slug . '-' . Str::random(20);
        } else {
            $slug = $role_slug;
        }

        $role = Role::where('id', $request->id)->first();
        $role->name = $request->name;
        $role->slug = preg_replace('/[^a-zA-Z0-9]+/', '-', $slug);
        $role->save();
    }

    public function delete_role($slug)
    {

        $role = Role::where('slug', $slug)->first();
        $role->delete();

        $permission = Permission::where('role_id', $role->id)->first();
        if (isset($permission)) {
            $permission->delete();
        }
    }

    public function all_roles()
    {
        if (!\Request::ajax()) {
            return abort(404);
        }
        $roles = Role::orderBy('id', 'DESC')->get();
        return response()->json(['roles' => $roles]);
    }
}
