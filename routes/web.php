<?php

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
    Route::resource('weagons', App\Http\Controllers\WeaponController::class);

});

