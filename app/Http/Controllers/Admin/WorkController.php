<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Work;
use App\Model\UserWork;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class WorkController extends Controller
{
    public function add_work(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|unique:works'
        ]);

        $name_list =  explode(" ", $request->name);
        $name_list = array_map('strtolower', $name_list);
        $work_slug = implode("-", $name_list);
        $similar_slug = DB::table('works')->where('slug', 'like', $work_slug . '%')->get();
        if (count($similar_slug) > 0) {
            $slug = $work_slug . '-' . Str::random(20);
        } else {
            $slug = $work_slug;
        }

        $work = new Work();
        $work->name = $request->name;
        $work->slug = preg_replace('/[^a-zA-Z0-9]+/', '-', $slug);
        $work->save();
    }

    public function all_work()
    {
        if (!\Request::ajax()) {
            return abort(404);
        }
        $works = Work::orderBy('id', 'DESC')->paginate(8);
        return response()->json(['works' => $works]);
    }


    public function edit($slug)
    {

        $work = Work::where('slug', $slug)->first();
        return response()->json(['work' => $work]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:works'
        ]);

        $name_list =  explode(" ", $request->name);
        $name_list = array_map('strtolower', $name_list);
        $work_slug = implode("-", $name_list);
        $similar_slug = DB::table('works')->where('slug', 'like', $work_slug . '%')->get();
        if (count($similar_slug) > 0) {
            $slug = $work_slug . '-' . Str::random(20);
        } else {
            $slug = $work_slug;
        }

        $work = Work::where('id', $request->id)->first();
        $work->name = $request->name;
        $work->slug = preg_replace('/[^a-zA-Z0-9]+/', '-', $slug);
        $work->save();
    }

    public function delete_work($slug)
    {

        $work = Work::where('slug', $slug)->first();
        $work->delete();

        $user_work = UserWork::where('work_id', $work->id)->first();
        if (isset($user_work)) {
            $user_work->delete();
        }
    }

    public function all_works()
    {
        if (!\Request::ajax()) {
            return abort(404);
        }
        $works = Work::orderBy('name', 'ASC')->get();
        return response()->json(['works' => $works]);
    }

    public function add_user_work(Request $request)
    {


        $work_type = $request->work_id;
        $work_id = '';
        if ($work_type == "new_work") {

            $this->validate($request, [
                'name' => 'required',
                'department_id' => 'required',
                'user_id' => 'required',
            ]);

            $name_list =  explode(" ", $request->name);
            $name_list = array_map('strtolower', $name_list);
            $work_slug = implode("-", $name_list);
            $similar_slug = DB::table('works')->where('slug', 'like', $work_slug . '%')->get();
            if (count($similar_slug) > 0) {
                $slug = $work_slug . '-' . Str::random(20);
            } else {
                $slug = $work_slug;
            }

            $work = new Work();
            $work->name = $request->name;
            $work->slug = preg_replace('/[^a-zA-Z0-9]+/', '-', $slug);
            $work->save();

            $work_id = $work->id;
        } else {

            $this->validate($request, [
                'work_id' => 'required',
                'department_id' => 'required',
                'user_id' => 'required',
            ]);

            $work_id = $request->work_id;
        }

        $work_assign = UserWork::where('user_id', $request->user_id)->where('work_id', $work_id)->first();
        if (isset($work_assign)) {
            return response()->json('error');
        } else {
            $user_work = new UserWork();
            $user_work->work_id = $work_id;
            $user_work->department_id = $request->department_id;
            $user_work->user_id = $request->user_id;
            $user_work->save();
        }
    }

    public function all_user_work()
    {


        $user_role_id = auth()->user()->role_id;

        if ($user_role_id == 1) {
            $user_works = UserWork::with(['user', 'work', 'department'])->orderBy('id', 'DESC')->get();
        } elseif ($user_role_id == 2) {
            $department_id = auth()->user()->department_id;
            $user_works = UserWork::with(['user', 'work', 'department'])->orderBy('id', 'DESC')->where('department_id', $department_id)->get();
        } else {

            $user_works = UserWork::with(['user', 'work', 'department'])->orderBy('id', 'DESC')->where('user_id', auth()->user()->id)->get();
        }


        return response()->json(['user_works' => $user_works]);
    }

    public function edit_user_work($id)
    {
        $user_work = UserWork::where('id', $id)->first();
        return response()->json(['user_work' => $user_work]);
    }

    public function update_user_work(Request $request)
    {
        $this->validate($request, [
            'work_id' => 'required',
            'department_id' => 'required',
            'user_id' => 'required',
        ]);

        $user_work = UserWork::where('id', $request->id)->first();
        $user_work->work_id = $request->work_id;
        $user_work->department_id = $request->department_id;
        $user_work->user_id = $request->user_id;
        $user_work->save();
    }

    public function delete_user_work($id)
    {
        $user_work = UserWork::where('id', $id)->first();
        $user_work->delete();
    }
}
