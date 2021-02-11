<?php

namespace App\Http\Controllers\Admin;

use App\Model\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function add_department(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|unique:departments'
        ]);

        $name_list =  explode(" ", $request->name);
        $name_list = array_map('strtolower', $name_list);
        $department_slug = implode("-", $name_list);
        $similar_slug = DB::table('departments')->where('slug', 'like', $department_slug . '%')->get();
        if (count($similar_slug) > 0) {
            $slug = $department_slug . '-' . Str::random(20);
        } else {
            $slug = $department_slug;
        }

        $department = new Department();
        $department->name = $request->name;
        $department->slug = preg_replace('/[^a-zA-Z0-9]+/', '-', $slug);
        $department->save();
    }

    public function all_department()
    {
        if (!\Request::ajax()) {
            return abort(404);
        }
        $departments = Department::orderBy('id', 'DESC')->paginate(8);
        return response()->json(['departments' => $departments]);
    }


    public function edit($slug)
    {

        $department = Department::where('slug', $slug)->first();
        return response()->json(['department' => $department]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:departments'
        ]);

        $name_list =  explode(" ", $request->name);
        $name_list = array_map('strtolower', $name_list);
        $department_slug = implode("-", $name_list);
        $similar_slug = DB::table('departments')->where('slug', 'like', $department_slug . '%')->get();
        if (count($similar_slug) > 0) {
            $slug = $department_slug . '-' . Str::random(20);
        } else {
            $slug = $department_slug;
        }

        $department = Department::where('id', $request->id)->first();
        $department->name = $request->name;
        $department->slug = preg_replace('/[^a-zA-Z0-9]+/', '-', $slug);
        $department->save();
    }

    public function delete_department($slug)
    {

        $department = Department::where('slug', $slug)->first();
        $department->delete();
    }

    public function all_departments()
    {
        if (!\Request::ajax()) {
            return abort(404);
        }
        $departments = Department::orderBy('id', 'DESC')->get();
        return response()->json(['departments' => $departments]);
    }
}
