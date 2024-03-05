<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\categoryController;


/*
|--------------------------------------------------------------------------
|  Authentification
|--------------------------------------------------------------------------
*/

Route::get('/register', [authController::class,'registerView'])->name('register.show');
Route::post('/register', [authController::class,'register'])->name('register');

Route::get('/login', [authController::class,'loginView'])->name('login.show');
Route::post('/login', [authController::class,'login'])->name('login');

Route::post('/log', [authController::class,'logout'])->name('logout');

Route::post('/forgot-password', [authController::class, 'forgot_password'])->name('forgot_password');
Route::get('/forgot-password', [authController::class, 'forgot_show']);

Route::get('/reset-password/{token}', [authController::class, 'reset'])->name('reset');
Route::post('/reset-password/{token}', [authController::class, 'post_reset'])->name('post_reset');

Route::get('/profil', [authController::class,'showProfil'])->name('profil');


Route::get('/dashboard', [dashboardController::class,'dashboardView'])->name('dashboard.view');

Route::get('/category', [categoryController::class,'categoryView'])->name('category.view');
