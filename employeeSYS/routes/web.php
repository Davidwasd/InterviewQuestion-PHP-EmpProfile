<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Api\EmployeeController as ApiEmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ApiEmployeeController::class, 'index'])->name('home');

Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
