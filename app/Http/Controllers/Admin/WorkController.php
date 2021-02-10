<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Department;
use App\Models\Work;
use App\User;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:work-list|work-create|work-edit|work-delete', ['only' => ['index']]);
        $this->middleware('permission:work-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:work-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:work-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        if (auth()->user()->type == 'Worker') {
            $works = Work::join('user_work', 'user_work.work_id', '=', 'works.id')->where('user_work.user_id', auth()->id())->paginate(10);
        } elseif (auth()->user()->type == 'Department Admin') {
            $works = Work::where('dept_id', auth()->user()->dept_id)->paginate(10);
        } else {
            $works = Work::paginate(10);
        }
        return view('admin.work.index', compact('works',));
    }

    public function create()
    {
        if(auth()->user()->type == 'Main Admin'){
            $users = User::where('type', 'Worker')->get();
        }
        else{
            $users = User::where('type', 'Worker')->where('dept_id', auth()->user()->dept_id)->get();
        }
        if (auth()->user()->type == 'Main Admin') {
            $departments = Department::all();
        } else {
            $departments = Department::where('id', auth()->user()->dept_id)->get();
        }
        return view('admin.work.create-edit', compact('users', 'departments'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'work_name' => 'required|string|max:100',
            'dept_id' => 'required|integer|exists:departments,id',
            'user_list' => 'required|array',
            'user_list.*' => 'required|integer|exists:users,id',
        ]);

        $work = Work::create($request->all());
        $work->users()->attach($request->user_list);

        $request->session()->flash('successMessage', "Work create successfully!");
        return redirect()->route('admin.works.index');
    }

    public function edit(Work $work)
    {
        if (empty($work)) {
            return redirect()->route('admin.works.index');
        }
        if(auth()->user()->type == 'Main Admin'){
            $users = User::where('type', 'Worker')->get();
        }
        else{
            $users = User::where('type', 'Worker')->where('dept_id', auth()->user()->dept_id)->get();
        }
        if (auth()->user()->type == 'Main Admin') {
            $departments = Department::all();
        } else {
            $departments = Department::where('id', auth()->user()->dept_id)->get();
        }
        return view('admin.work.create-edit', compact('work', 'users', 'departments'));
    }

    public function update(Request $request, Work $work)
    {
        request()->validate([
            'work_name' => 'required|string|max:100',
            'dept_id' => 'required|integer|exists:departments,id',
            'user_list' => 'required|array',
            'user_list.*' => 'required|integer|exists:users,id',
        ]);

        $work->update($request->all());
        $work->users()->sync($request->user_list);

        $request->session()->flash('successMessage', "Work updated!");
        return redirect()->route('admin.works.index');
    }


    public function destroy(Request $request, Work $work)
    {
        if (!empty($work)) {
            $work->delete();
            $request->session()->flash('successMessage', "Work deleted!");
        } else {
            $request->session()->flash('errorMessage', "Work not found!");
        }
        return redirect()->route('admin.works.index');
    }
}
