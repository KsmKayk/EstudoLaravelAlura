<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewSerie;

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
Route::get('/series/create', [SeriesController::class, 'create'])->name('series_create')->middleware('auth');
//Create series/create post route with SeriesController store method
Route::post('/series/create', [SeriesController::class, 'store'])->name('series_store')->middleware('auth');
//Create series/remove/{id} delete route with SeriesController destroy method
Route::delete('/series/remove/{id}', [SeriesController::class, 'destroy'])->middleware('auth');
//Create series/{id}/editName post route with SeriesController editName method
Route::post('/series/{id}/editName', [SeriesController::class, 'editName'])->middleware('auth');
//Create series/{serieId}/seasons get route with SeasonsController index method
Route::get('/series/{id}/seasons', [SeasonsController::class, 'index']);
//Create seasons/{id}/episodes get route with EpisodesController index method
Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index']);
//Create seasons/{id}/episodes/watch post route with EpisodesController watch method
Route::post('/seasons/{season}/episodes/watch', [EpisodesController::class, 'watch'])->middleware('auth');
//Create sigin get route with AuthController showSignin method
Route::get('/signin', [AuthController::class, 'showSignin'])->name('signin');
//Create sigin post route with AuthController signin method
Route::post('/signin', [AuthController::class, 'signin']);
//Create signup get route with AuthController showSignup method
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
//Create signup post route with AuthController signup method
Route::post('/signup', [AuthController::class, 'signup']);
//Create signout get route with function signout
Route::get('/signout', function () {
    Auth::logout();
    return redirect()->route('signin');
});

Route::get('/', function () {
    return redirect()->route('series_list');
});

Route::get('/show-mail', function () {
    return new NewSerie('Arrow', 7, 20);
});

Route::get('/send-mail', function () {
    $email = new NewSerie('arrow', 1, 1);
    $user = (object)[
        'email' => 'kayk@test.com',
        'name' => 'Kayk'
    ];
    $email->subject = 'Nova Série adicionada!';
    Mail::to($user)->send($email);
    return 'Email enviado';
});
