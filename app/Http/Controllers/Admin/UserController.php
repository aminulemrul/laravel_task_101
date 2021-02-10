<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Work;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Hash;
use DB;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        if (auth()->user()->type == 'Main Admin') {
            $users = User::orderBy('id', 'DESC')->where('type', '!=', 'Main Admin')->paginate(10);
        } else {
            $users = User::orderBy('id', 'DESC')->where('type', '!=', 'Department Admin')->where('status', 'active')->where('dept_id', auth()->user()->dept_id)->paginate(10);
        }
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $departments = Department::all();
        return view('admin.users.create-edit', compact('roles', 'departments'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'nullable|string|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:8|max:20|confirmed',
            'fullName' => 'required|string|max:100',
            'phone' => 'required|string||max:11|min:11',
            'dept_id' => 'required|integer|exists:departments,id',
            'status' => 'required|in:Active,Inactive',
            'type' => 'required|in:Main Admin,Department Admin,Worker',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        $request->session()->flash('successMessage', "User create successfully!");
        return redirect()->route('admin.users.index');
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();
        if (empty($user)) {
            return redirect()->route('admin.users.index');
        }
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        if (empty($user)) {
            return redirect()->route('admin.users.index');
        }
        $roles = Role::pluck('name', 'name')->all();
        $departments = Department::all();
        $userRole = $user->roles->pluck('name', 'name')->first();
        return view('admin.users.create-edit', compact('user', 'roles', 'userRole', 'departments'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'fullName' => 'required|string|max:100',
            'phone' => 'required|string||max:11|min:11',
            'dept_id' => 'nullable|integer|exists:departments,id',
            'status' => 'required|in:Active,Inactive',
            'type' => 'required|in:Main Admin,Department Admin, Worker',
            'roles' => 'required'
        ]);

        $user = User::where('id', $id)->first();
        if (empty($user)) {
            return redirect()->route('admin.users.index');
        }

        $input = $request->all();
        if ($request->password) {
            $input['password'] = bcrypt($request->password);
        } else {
            unset($input['password']);
        }
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));

        $request->session()->flash('successMessage', "User Updated!");
        return redirect()->route('admin.users.index');
    }

    public function destroy(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        if (!empty($user)) {
            $user->delete();
            $request->session()->flash('successMessage', "User deleted!");
        } else {
            $request->session()->flash('errorMessage', "User not found!");
        }
        return redirect()->route('admin.users.index');
    }

    public function changeStatus(Request $request)
    {
        if ($request->id > 0) {
            $data = User::where('id', $request->id)->first();
            $data->update(['status' => $request->status]);
            return response()->json(['status' => true, 'message' => 'Status updated!']);
        } else {
            return response()->json(['status' => false, 'message' => 'Status updated failed!']);
        }
    }

    public function assignWorkForm($id)
    {
        $user = User::where('id', $id)->first();
        $works = Work::where('dept_id', auth()->user()->dept_id)->get();
        return view('admin.users.assign-work', compact('works', 'user'));
    }

    public function assignWork(Request $request)
    {
        request()->validate([
            'user_id' => 'required',
            'work_list' => 'required|array',
            'work_list.*' => 'required',

        ]);

        if ($request->work_list) {
            $works = [];

            foreach ($request->work_list as $item) {
                $work = Work::find($item);

                if (!$work) {
                    $work = Work::create(['work_name' => $item, 'dept_id' => auth()->user()->dept_id]);
                }
                $works[] = $work->id;
            }
            $user = User::where('id', $request->user_id)->first();
            $user->works()->attach($works);
        }

        $request->session()->flash('successMessage', "Work created successfully!");
        return redirect()->route('admin.works.index');
    }
}
