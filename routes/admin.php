

<?php

//roll route
Route::post('add-role', 'Admin\RoleController@add_role');
Route::get('all-role', 'Admin\RoleController@all_role');
Route::get('edit-role/{slug}', 'Admin\RoleController@edit');
Route::post('update-role', 'Admin\RoleController@update');
// Route::get('delete-role/{slug}', 'Admin\RoleController@delete_role');
Route::get('all-roles', 'Admin\RoleController@all_roles');

//permission route
Route::get('all-permission', 'Admin\PermissionController@all_permission');
Route::post('add-permission', 'Admin\PermissionController@add_permission');
Route::get('edit-permission/{id}', 'Admin\PermissionController@edit_permission');
Route::post('update-permission', 'Admin\PermissionController@update_permission');
// Route::get('delete-permission/{id}', 'Admin\PermissionController@delete_permission');

//department route
Route::post('add-department', 'Admin\DepartmentController@add_department');
Route::get('all-departments', 'Admin\DepartmentController@all_departments');
Route::get('all-department', 'Admin\DepartmentController@all_department');
Route::get('edit-department/{slug}', 'Admin\DepartmentController@edit');
Route::post('update-department', 'Admin\DepartmentController@update');
Route::get('delete-department/{slug}', 'Admin\DepartmentController@delete_department');

//work route
Route::post('add-work', 'Admin\WorkController@add_work');
Route::get('all-work', 'Admin\WorkController@all_work');
Route::get('all-works', 'Admin\WorkController@all_works');
Route::get('edit-work/{slug}', 'Admin\WorkController@edit');
Route::post('update-work', 'Admin\WorkController@update');
Route::get('delete-work/{slug}', 'Admin\WorkController@delete_work');

//user-work route
Route::post('/add-user-work', 'Admin\WorkController@add_user_work');
Route::get('all-user-work', 'Admin\WorkController@all_user_work');
Route::get('delete-user-work/{id}', 'Admin\WorkController@delete_user_work');
Route::get('edit-user-work/{id}', 'Admin\WorkController@edit_user_work');
Route::post('update-user-work', 'Admin\WorkController@update_user_work');

//user route
Route::post('add-user', 'Admin\UserController@add_user');
Route::get('all-user', 'Admin\UserController@all_user');
Route::get('all-users', 'Admin\UserController@all_users');
Route::get('edit-user/{slug}', 'Admin\UserController@edit_user');
Route::post('update-user', 'Admin\UserController@update_user');
Route::get('delete-user/{slug}', 'Admin\UserController@delete_user');
Route::get('inactive-user/{id}', 'Admin\UserController@inactive_user');
Route::get('active-user/{id}', 'Admin\UserController@active_user');
Route::get('get-department-user/{department_id}', 'Admin\UserController@get_dept_user');

Route::get('dashboard-info', 'Admin\UserController@dashboard');


Route::get('/{path}', function () {
    return view('admin.admin_layout');
});
Route::get('/{path}/{slug}', function () {
    return view('admin.admin_layout');
});
