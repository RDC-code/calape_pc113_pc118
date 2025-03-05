<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



//Student
Route::get('/student', [StudentController::class, 'student']);
Route::put('/student/{id}', [StudentController::class, 'update']);
Route::get('/student/{id}', [StudentController::class, 'show']);
Route::delete('/student/{id}', [StudentController::class, 'delete']);
Route::post('/student', [StudentController::class, 'store']);       


//employee
Route::get('/employee', [EmployeeController::class, 'employee']);
Route::put('/employee/{id}', [EmployeeController::class, 'update']);
Route::get('/employee/{id}', [EmployeeController::class, 'show']);
Route::delete('/employee/{id}', [EmployeeController::class, 'delete']);
Route::post('/employee', [EmployeeController::class, 'store']);     



//Search
Route::get('/employee/search', [EmployeeController::class, 'search']);
Route::get('/student/search', [StudentController::class, 'search']);


//Login with token
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum', 'role:0'])->get('/users', [AuthController::class, 'index']);
Route::middleware(['auth:sanctum', 'role:1'])->get('/dashboard', [DashboardController::class, 'index']);
;