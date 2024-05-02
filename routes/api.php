<?php

use App\Models\User;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServiceController;

Route::middleware('auth:api')->group(function () {

    // User
    Route::put('/user/{id}', [UserController::class, 'update']);

    // Service
    Route::get('/service', [ServiceController::class, 'index'])->can('sale', Service::class);

    Route::post('/service', [ServiceController::class, 'store'])->can('sale', Service::class);

    Route::get('/service/{id}', [ServiceController::class, 'show'])->can('sale', Service::class);

    Route::put('/service/{id}', [ServiceController::class, 'update'])->can('sale', Service::class);

    Route::put('/service/status/{id}', [ServiceController::class, 'updateStatus'])->can('sale', Service::class);

    // Bookings
    Route::get('/bookings', [BookingController::class, 'index'])->can('userPermission', Booking::class);

    Route::get('/bookings/{id}', [BookingController::class, 'show'])->can('userPermission', Booking::class);

    Route::post('/bookings', [BookingController::class, 'store'])->can('userPermission', Booking::class);

    Route::put('/bookings/{id}', [BookingController::class, 'update'])->can('userPermission', Booking::class);

    Route::delete('/bookings/cancel/{id}', [BookingController::class, 'delete'])->can('userPermission', Booking::class);

    Route::post('/logout', [AuthController::class, 'logout']);


});

Route::post('/user', [UserController::class, 'store']);

Route::post('/login', [AuthController::class, 'login']);


