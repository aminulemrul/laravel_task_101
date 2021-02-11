<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(base_path('routes/admin.php'));

Route::get('/', function () {
    return view('admin.admin_layout');
});
Route::get('/{path}', function () {
    return view('admin.admin_layout');
});
