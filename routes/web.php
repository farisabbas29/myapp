<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

// Registration
Route::get('/admin/register',[AdminController::class,'register'])
    ->name('admin.register');

Route::post('/admin/register',[AdminController::class,'store'])
    ->name('admin.store');


// Login
Route::get('/admin/login',[AdminController::class,'login'])
    ->name('admin.login');

Route::post('/admin/login',[AdminController::class,'authenticate'])
    ->name('admin.authenticate');


// Dashboard
Route::get('/dashboard',[AdminController::class,'dashboard'])
    ->name('dashboard');


// Logout
Route::get('/logout',[AdminController::class,'logout'])
    ->name('logout');

// Forgot Password

Route::get('/forgot-password',[AdminController::class,'forgotPassword'])
    ->name('forgot.password');

Route::post('/forgot-password',[AdminController::class,'sendResetLink'])
    ->name('forgot.password.send');

    
// Reset Password

Route::get('/reset-password/{token}',[AdminController::class,'resetPassword'])
    ->name('reset.password');

Route::post('/reset-password/{token}',[AdminController::class,'updatePassword'])
    ->name('reset.password.update');