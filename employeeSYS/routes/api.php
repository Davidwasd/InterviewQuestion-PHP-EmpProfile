<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmployeeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/employee', [EmployeeController::class, 'index']);
Route::get('/createEmployee', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employee.store');

