<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:department-list|department-create|department-edit|department-delete', ['only' => ['index']]);
        $this->middleware('permission:department-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:department-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:department-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $departments = Department::latest()->paginate(10);
        return view('admin.department.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.department.create-edit');
    }

    public function store(Request $request)
    {
        request()->validate([
            'dept_name' => 'required|string|max:100',
        ]);

        Department::create($request->all());

        $request->session()->flash('successMessage', "Department create successfully!");
        return redirect()->route('admin.departments.index');
    }

    public function edit(Department $department)
    {
        if (empty($department)) {
            return redirect()->route('admin.departments.index');
        }
        return view('admin.department.create-edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        request()->validate([
            'dept_name' => 'required|string|max:100',
        ]);

        $department->update($request->all());

        $request->session()->flash('successMessage', "Department updated!");
        return redirect()->route('admin.departments.index');
    }

    public function destroy(Request $request, Department $department)
    {
        if (!empty($department)) {
            $department->delete();
            $request->session()->flash('successMessage', "Department deleted!");
        } else {
            $request->session()->flash('errorMessage', "Department not found!");
        }
        return redirect()->route('admin.departments.index');

    }
}
