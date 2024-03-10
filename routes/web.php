<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\eventController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\dashboardController;
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

Route::post('/logout', [authController::class,'logout'])->name('logout');

Route::post('/forgot-password', [authController::class, 'forgot_password'])->name('forgot_password');
Route::get('/forgot-password', [authController::class, 'forgot_show']);

Route::get('/reset-password/{token}', [authController::class, 'reset'])->name('reset');
Route::post('/reset-password/{token}', [authController::class, 'post_reset'])->name('post_reset');

Route::get('/profil', [authController::class,'showProfil'])->name('profil');



/*
|--------------------------------------------------------------------------
|  displayEvent
|--------------------------------------------------------------------------
*/
Route::get('/', [eventController::class,'eventView'])->name('event.view');
Route::get('/searchs', [EventController::class, 'searchEvent'])->name('event.search');
Route::get('/filters', [EventController::class, 'filterEvent'])->name('event.filter');
Route::get('/details/{id}', [eventController::class,'getEventById'])->name('event.details');



/*
|--------------------------------------------------------------------------
|  Check if authenticated
|--------------------------------------------------------------------------
*/
Route::middleware(['auth.check'])->group(function () 
{

    Route::middleware(['admin.check'])->group(function () 
    {
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
        |  Update role
        |--------------------------------------------------------------------------
        */
        Route::put('/dashboard', [authController::class,'updateRole'])->name('role.edit');



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
        |  Dashboard admin
        |--------------------------------------------------------------------------
        */
        Route::get('/dashboard', [dashboardController::class,'dashboardView'])->name('dashboard.view');

    });

    /*
    |--------------------------------------------------------------------------
    |  addEvents
    |--------------------------------------------------------------------------
    */
    Route::get('/addEvent', [eventController::class,'addEventView'])->name('addEvent.view');
    Route::post('/addEvent', [eventController::class,'addEvent'])->name('addEvent.add');



    /*
    |--------------------------------------------------------------------------
    |  myEvents
    |--------------------------------------------------------------------------
    */
    Route::get('/myEvents', [eventController::class,'myEventView'])->name('myEvent.view');
    Route::get('/edit/{id}', [eventController::class,'editView'])->name('edit.view');
    Route::delete('/deleteEvent', [eventController::class,'deleteEvent'])->name('delete.event');
    Route::post('/edit/{id}', [eventController::class,'editEvent'])->name('event.edit');
    Route::get('/search', [EventController::class, 'searchMyEvent'])->name('myEvent.search');
    Route::get('/filter', [EventController::class, 'filterMyEvent'])->name('myEvent.filter');



    /*
    |--------------------------------------------------------------------------
    |  reserver event
    |--------------------------------------------------------------------------
    */
    Route::post('/reservation', [reservationController::class,'reserverEvent'])->name('reserver.event');



    /*
    |--------------------------------------------------------------------------
    |  approuve decline reservateur
    |--------------------------------------------------------------------------
    */
    Route::put('/reservation', [reservationController::class,'approuveReservation'])->name('approuve.reservateur');
    Route::delete('/reservation', [reservationController::class,'desapprouveReservation'])->name('desapprouve.reservateur');


    /*
    |--------------------------------------------------------------------------
    |  Show Profil
    |--------------------------------------------------------------------------
    */
    Route::get('/profil', [authController::class,'showProfil'])->name('profil');


});