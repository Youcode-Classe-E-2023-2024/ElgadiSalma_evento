<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\eventController;
use App\Http\Controllers\reservationController;


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

/*
|--------------------------------------------------------------------------
|  Dashboard admin
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [dashboardController::class,'dashboardView'])->name('dashboard.view');


/*
|--------------------------------------------------------------------------
|  Categories
|--------------------------------------------------------------------------
*/
Route::get('/category', [categoryController::class,'categoryView'])->name('category.view');
Route::post('/category', [categoryController::class,'addCategory'])->name('category.add');
Route::put('/category', [categoryController::class,'editCategory'])->name('category.edit');
Route::delete('/category', [categoryController::class,'deleteCategory'])->name('category.delete');


/*
|--------------------------------------------------------------------------
|  addEvents
|--------------------------------------------------------------------------
*/
Route::get('/addEvent', [eventController::class,'addEventView'])->name('addEvent.view');
Route::post('/addEvent', [eventController::class,'addEvent'])->name('addEvent.add');

/*
|--------------------------------------------------------------------------
|  displayEvent
|--------------------------------------------------------------------------
*/
Route::get('/events', [eventController::class,'eventView'])->name('event.view');
Route::get('/details/{id}', [eventController::class,'getEventById'])->name('event.details');


/*
|--------------------------------------------------------------------------
|  Approuve Event cote admin
|--------------------------------------------------------------------------
*/
Route::get('/event', [eventController::class,'adminEventView'])->name('adminEvent.view');
Route::post('/event/{id}', [eventController::class,'approuveEvent'])->name('approuve.events');
Route::delete('/event/{id}', [eventController::class,'desapprouveEvent'])->name('desapprouve.events');


/*
|--------------------------------------------------------------------------
|  reserver event
|--------------------------------------------------------------------------
*/
Route::post('/reservation', [reservationController::class,'reserverEvent'])->name('reserver.event');


/*
|--------------------------------------------------------------------------
|  Update role
|--------------------------------------------------------------------------
*/
Route::put('/dashboard', [authController::class,'updateRole'])->name('role.edit');
