<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Work;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalWorker = User::where('type', 'Worker')->where('status', 'Active')->count();
        $totalDept = Department::count();
        $totalWork = Work::count();
        return view('admin.dashboard', compact('totalWorker', 'totalDept', 'totalWork'));
    }
}
