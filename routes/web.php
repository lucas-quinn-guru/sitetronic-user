<?php

Route::group(['namespace' => 'LucasQuinnGuru\SitetronicUser\Controllers'], function () {
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
});
