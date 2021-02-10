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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();
Route::group(['middleware' => 'auth:web','namespace' => 'Admin', 'prefix' => 'admin',  'as' => 'admin.'], function() {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('roles','RoleController')->except('show');
    Route::post('/users/status-change', 'UserController@changeStatus')->name('users.status-change');
    Route::get('/users/assign-work-form/{user}','UserController@assignWorkForm')->name('users.assign-work-form');
    Route::post('users/assign-work', 'UserController@assignWork')->name('users.assign-work');
    Route::resource('users','UserController');
    Route::resource('departments','DepartmentController')->except('show');
    Route::resource('works','WorkController')->except('show');
});

