<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {

    Route::post('/permission', [AdminController::class, 'permission'])->can('permission', User::class);

    Route::get('/user', [UserController::class, 'index'])->can('permission', User::class);

    Route::get('/user/{id}', [UserController::class, 'show'])->can('permission', User::class);

});
