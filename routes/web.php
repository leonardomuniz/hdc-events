<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;   
use App\Http\Controllers\EventController; 
use App\Http\Controllers\ProductController;

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

//principal
Route::get('/',[EventController::class, 'index'] );

//eventos
Route::get('/eventos/criar', [EventController::class, 'create'])->middleware('auth');
Route::get('/eventos/{id}', [EventController::class, 'show']);
Route::get('/eventos/edit/{id}', [EventController::class, 'edit'])->middleware('auth');
Route::put('/eventos/update/{id}', [EventController::class, 'update'])->middleware('auth');
Route::post('/eventos', [EventController::class, 'store'])->middleware('auth');
Route::post('/eventos/join/{id}', [EventController::class, 'joinEvent'])->middleware('auth');
Route::delete('/eventos/leave/{id}', [EventController::class, 'leaveEvent'])->middleware('auth');
Route::delete('/eventos/{id}', [EventController::class, 'destroy'])->middleware('auth');

//dashboard
Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');
