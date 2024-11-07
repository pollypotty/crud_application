<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// home page route
Route::view('/', 'home')->name('home');

// auth routes for login, registration and logout
Auth::routes([
    'register' => true,
    'reset' => false,
    'verify' => false,
    'confirm' => false,
]);

// get request for picking the language of the application
Route::get('language/{locale}', [LanguageController::class, 'switchLanguage'])->name('language.switch');

// resource routes for CompanyController and EmployeeController classes except for show method
// protected by auth middleware
Route::middleware(['auth'])->group(function () {
    Route::resource('companies', CompanyController::class)->except('show')->names('companies');
    Route::resource('employees', EmployeeController::class)->except('show')->names('employees');
});
