<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;

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



//Create series get route with SeriesController index method
Route::get('/series', [SeriesController::class, 'index'])->name('series_list');
//Create series/create get route with SeriesController create method
Route::get('/series/create', [SeriesController::class, 'create'])->name('series_create');
//Create series/create post route with SeriesController store method
Route::post('/series/create', [SeriesController::class, 'store'])->name('series_store');
//Create series/remove/{id} delete route with SeriesController destroy method
Route::delete('/series/remove/{id}', [SeriesController::class, 'destroy'])->name('series_destroy');
