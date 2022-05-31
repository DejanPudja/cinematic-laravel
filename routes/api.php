<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProjectionController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post('/logout',[AuthController::class, 'logout']);
});

// //Movies
// Route::get('movie',[MovieController::class, 'index']);
// Route::get('coming-soon',[MovieController::class, 'comingSoon']);
// Route::get('current-movies',[MovieController::class, 'currentMovies']);
// Route::get('film/{id}',[MovieController::class, 'show']);
// Route::post('add-movie',[MovieController::class, 'store']);
// Route::delete('delete-movie/{id}',[MovieController::class, 'destroy']);
// Route::put('edit-movie',[MovieController::class, 'update']);

// //Projection
// Route::get('filmovi/{date}',[ProjectionController::class, 'show']);
// Route::get('filmovi',[ProjectionController::class, 'index']);
// Route::get('projection/{id}',[ProjectionController::class, 'getProjectionsByMovieId']);
// Route::get('get-projection/{id}',[ProjectionController::class, 'getProjectionsById']);
// Route::get('date',[ProjectionController::class, 'getAllDatesForProjection']);
// Route::post('add-projection',[ProjectionController::class, 'store']);   
// Route::delete('delete-projection/{id}',[ProjectionController::class, 'destroy']);
// Route::put('edit-projection',[ProjectionController::class, 'update']);

// //News
// Route::get('news/{paginate}',[NewsController::class, 'getNews']);
// Route::post('add-news',[NewsController::class, 'store']);
// Route::delete('delete-news/{id}',[NewsController::class, 'destroy']);
// Route::get('news/{id}',[NewsController::class, 'show']);
// Route::put('edit-news',[NewsController::class, 'update']);

// //Newsletter
// Route::post('newsletter',[NewsletterController::class, 'Newsletter']);

// //Reservations
// Route::post('add-reservation',[ReservationController::class, 'store']);
// Route::get('reservations/{id}',[ReservationController::class, 'getReservationById']);
// Route::get('user-reservations/{id}',[ReservationController::class, 'index']);
// Route::delete('delete-reservation/{id}',[ReservationController::class, 'destroy']);

// //Login and register
// Route::post('/register',[AuthController::class, 'register']);
// Route::post('/login',[AuthController::class, 'login']);
// // Route::post('/logout',[AuthController::class, 'logout']);    
// Route::get('user/{id}',[AuthController::class, 'getUserById']);
// Route::put('edit-user',[AuthController::class, 'updateUser']);

Route::group([
    'middleware' => ['cors'],
], function ($router) {

//Movies
Route::get('movie',[MovieController::class, 'index']);
Route::get('coming-soon',[MovieController::class, 'comingSoon']);
Route::get('current-movies',[MovieController::class, 'currentMovies']);
Route::get('film/{id}',[MovieController::class, 'show']);
Route::post('add-movie',[MovieController::class, 'store']);
Route::delete('delete-movie/{id}',[MovieController::class, 'destroy']);
Route::put('edit-movie',[MovieController::class, 'update']);

//Projection
Route::get('filmovi/{date}',[ProjectionController::class, 'show']);
Route::get('filmovi',[ProjectionController::class, 'index']);
Route::get('projection/{id}',[ProjectionController::class, 'getProjectionsByMovieId']);
Route::get('get-projection/{id}',[ProjectionController::class, 'getProjectionsById']);
Route::get('date',[ProjectionController::class, 'getAllDatesForProjection']);
Route::post('add-projection',[ProjectionController::class, 'store']);   
Route::delete('delete-projection/{id}',[ProjectionController::class, 'destroy']);
Route::put('edit-projection',[ProjectionController::class, 'update']);

//News
Route::get('news/{paginate}',[NewsController::class, 'getNews']);
Route::post('add-news',[NewsController::class, 'store']);
Route::delete('delete-news/{id}',[NewsController::class, 'destroy']);
Route::get('news/{id}',[NewsController::class, 'show']);
Route::put('edit-news',[NewsController::class, 'update']);

//Newsletter
Route::post('newsletter',[NewsletterController::class, 'Newsletter']);

//Reservations
Route::post('add-reservation',[ReservationController::class, 'store']);
Route::get('reservations/{id}',[ReservationController::class, 'getReservationById']);
Route::get('user-reservations/{id}',[ReservationController::class, 'index']);
Route::delete('delete-reservation/{id}',[ReservationController::class, 'destroy']);

//Login and register
Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
// Route::post('/logout',[AuthController::class, 'logout']);    
Route::get('user/{id}',[AuthController::class, 'getUserById']);
Route::put('edit-user',[AuthController::class, 'updateUser']);






});
