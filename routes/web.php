<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee');
Route::post('/employee/add', [App\Http\Controllers\EmployeeController::class, 'add'])->name('employee-add');
Route::get('/employee/detail/{id}', [App\Http\Controllers\EmployeeController::class, 'detail'])->name('employee-detail');
Route::delete('/employee/destroy/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employee-destroy');

Route::get('/country', [App\Http\Controllers\EmployeeController::class, 'countries'])->name('country-all');
Route::get('/states/{id?}', [App\Http\Controllers\EmployeeController::class, 'states'])->name('states-country-all');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
