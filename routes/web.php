<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
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

//Route::get('/', function () {
//    return view('layouts.main');
//});

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth:sanctum', 'verified']], function (){

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Route Users
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::patch('/users/{user}/suspend', [UserController::class, 'suspend'])->name('users.suspend');
    Route::patch('/users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');
    Route::get('/search', [UserController::class, 'search'])->name('users.search');


    //Route Gardes
    Route::resource('guards', App\Http\Controllers\GuardController::class);
    Route::get('/search-guard', [\App\Http\Controllers\GuardController::class, 'search'])->name('guard.search');

    //Route Categorie
    Route::resource('categories', App\Http\Controllers\CategorieUserController::class);

    //Route Armes
    Route::resource('weapons', App\Http\Controllers\WeaponController::class);
    Route::get('/search-weapons', [\App\Http\Controllers\WeaponController::class, 'search'])->name('weapons.search');
    Route::put('/weapons/{weapon}/disarm', [\App\Http\Controllers\WeaponController::class, 'disarm'])->name('weapons.disarm');
    Route::put('/weapons/{weapon}/arm', [\App\Http\Controllers\WeaponController::class, 'arm'])->name('weapons.arm');

    //Route Clients
    Route::resource('customers', App\Http\Controllers\CustomerController::class);
    Route::get('/search-customers', [\App\Http\Controllers\CustomerController::class, 'search'])->name('customers.search');
    Route::get('/export-customers', [\App\Http\Controllers\CustomerController::class, 'exportCustomers'])->name('customers.export');


    //Route Message
    Route::middleware(['auth'])->group(function () {
        // Routes pour les messages
        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{userId}', [MessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/send', [MessageController::class, 'sendMessage'])->name('messages.send');
    });

});

