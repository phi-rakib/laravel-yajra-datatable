<?php

use App\Http\Controllers\UserController;
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

Route::controller(UserController::class)->group(function() {
    Route::get('users', 'index')->name('users.index');
    Route::get('users/{user}', 'show')->name('users.show');
    Route::delete('users/{user}', 'destroy')->name('users.delete');
    Route::get('users/edit/{user}', 'edit')->name('users.edit');
    Route::post('users', 'store')->name('users.store');
    Route::put('users/{user}', 'update')->name('users.update');
});

