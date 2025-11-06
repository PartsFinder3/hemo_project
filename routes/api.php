<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserRoleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DoctorProfileController;
use App\Http\Controllers\Api\PatientProfileController;
use App\Http\Controllers\Api\HospitalProfileController;
use App\Http\Controllers\Api\NgoProfileController;


Route::get('/test', function () {
    return response()->json([
        'message' => 'Hello, Khizar Zubair! Web routes are working correctly.',
        'status' => 'OK'
    ]);
});


// 1. REGISTRATION: Creates a new user and returns a token.
Route::post('register', [AuthController::class, 'register']);
// 2. LOGIN: Authenticates an existing user and returns a token.
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {

    // New CRUD routes (own profile only)

    Route::get('/roles', [UserRoleController::class, 'index']);
    Route::post('/roles', [UserRoleController::class, 'store']);
    Route::get('/roles/{id}', [UserRoleController::class, 'show']);
    Route::put('/roles/{id}', [UserRoleController::class, 'update']);
    Route::delete('/roles/{id}', [UserRoleController::class, 'destroy']);


    Route::post('/doctor-profile', [DoctorProfileController::class, 'store']);     // Create
    Route::get('/doctor-profile', [DoctorProfileController::class, 'show']);       // Read (own)
    Route::put('/doctor-profile', [DoctorProfileController::class, 'update']);     // Update
    Route::delete('/doctor-profile', [DoctorProfileController::class, 'destroy']);


    Route::post('/patient-profile', [PatientProfileController::class, 'store']);
    Route::get('/patient-profile', [PatientProfileController::class, 'show']);
    Route::put('/patient-profile', [PatientProfileController::class, 'update']); // or PATCH
    Route::delete('/patient-profile', [PatientProfileController::class, 'delete']);


    Route::post('/hospital-profile', [HospitalProfileController::class, 'store']);
    Route::get('/hospital-profile', [HospitalProfileController::class, 'show']);
    Route::put('/hospital-profile', [HospitalProfileController::class, 'update']);
    Route::delete('/hospital-profile', [HospitalProfileController::class, 'delete']);

    Route::post('/ngo-profile', [NgoProfileController::class, 'store']);
    Route::get('/ngo-profile', [NgoProfileController::class, 'show']);
    Route::put('/ngo-profile', [NgoProfileController::class, 'update']);
    Route::delete('/ngo-profile', [NgoProfileController::class, 'destroy']);
});
