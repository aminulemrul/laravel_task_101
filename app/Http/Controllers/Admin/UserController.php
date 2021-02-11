<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Work;
use App\Model\UserWork;
use App\Model\Department;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function add_user(Request $request)
    {

        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|confirmed',
                'phone' => 'required',
                'role_id' => 'required',
                'department_id' => 'required',
            ],
            [
                'role_id.required' => 'role is required',
                'department_id.required' => 'department is required',

            ]
        );

        $slug = $this->slugGenerate($request->name);



        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->department_id = $request->department_id;
        $user->slug = preg_replace('/[^a-zA-Z0-9]+/', '-', $slug);
        $user->save();
    }

    public function slugGenerate($name)
    {

        $name_list =  explode(" ", $name);
        $name_list = array_map('strtolower', $name_list);
        $user_slug = implode("-", $name_list);
        $similar_slug = DB::table('users')->where('slug', 'like', $user_slug . '%')->get();
        if (count($similar_slug) > 0) {
            return $user_slug . '-' . Str::random(20);
        } else {
            return $user_slug;
        }
    }

    public function all_user()
    {
        if (!\Request::ajax()) {
            return abort(404);
        }
        $users = User::with(['role', 'department'])->orderBy('id', 'DESC')->paginate(8);
        return response()->json(['users' => $users]);
    }

    public function delete_user($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->delete();
    }
    public function edit_user($slug)
    {
        $user = User::where('slug', $slug)->first();
        return response()->json(['user' => $user]);
    }

    public function update_user(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required|confirmed',
                'phone' => 'required',
                'role_id' => 'required',
                'department_id' => 'required',
            ],
            [
                'role_id.required' => 'role is required',
                'department_id.required' => 'department is required',

            ]
        );

        $slug = $this->slugGenerate($request->name);



        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->department_id = $request->department_id;
        $user->slug = preg_replace('/[^a-zA-Z0-9]+/', '-', $slug);
        $user->save();
    }

    public function inactive_user($id)
    {
        $user = User::find($id);
        $user->status = 0;
        $user->save();
    }

    public function active_user($id)
    {
        $user = User::find($id);
        $user->status = 1;
        $user->save();
    }

    public function get_dept_user($department_id)
    {

        $users = User::where('department_id', $department_id)->get();
        return response()->json(['users' => $users]);
    }

    public function all_users()
    {
        if (!\Request::ajax()) {
            return abort(404);
        }
        $users = User::get();
        return response()->json(['users' => $users]);
    }

    public function dashboard()
    {
        $user = User::get()->count();
        $dep = Department::get()->count();
        $work = Work::get()->count();
        $user_work = UserWork::get()->count();


        return response()->json([
            'user' => $user,
            'dep' => $dep,
            'work' => $work,
            'user_work' => $user_work,

        ]);
    }
}
