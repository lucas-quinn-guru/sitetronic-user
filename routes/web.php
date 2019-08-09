<?php

Route::group(['namespace' => 'LucasQuinnGuru\LaravelUser\Controllers'], function () {
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
});
