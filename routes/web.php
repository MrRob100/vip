<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', 'MapController@index')->name('index');

Route::get('/', [App\Http\Controllers\MapController::class, 'index'])->name('index');

// Route::get('/lookup', 'MapController@lookup')->name('lookup');
Route::get('/lookup', [App\Http\Controllers\MapController::class, 'lookup'])->name('lookup');

// Route::get('/points', 'MapController@points')->name('points');
Route::get('/points', [App\Http\Controllers\MapController::class, 'points'])->name('points');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
