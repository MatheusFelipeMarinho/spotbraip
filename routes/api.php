<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\Auth\Api\LoginController;
use App\Http\Controllers\Auth\Api\RegisterController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $user = $request->user();

    $user->removeRole('admin');
    $user->assignRole('singer');

    return response()->json(["data"=>$user]);
});

Route::prefix('auth')->group(function(){
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('/register/singer', [RegisterController::class, 'singer']);
    Route::post('/register/user', [RegisterController::class, 'user']);
    Route::post('/register/admin', [RegisterController::class, 'user'])->middleware('auth:sanctum', 'role:admin');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('/genre', GenreController::class);
    Route::resource('/album', AlbumController::class);
    Route::resource('/music', MusicController::class);
    Route::resource('/playlist', PlaylistController::class);
});


Route::get('/play', 'App\Http\Controllers\PlayerController@play')->middleware('auth:sanctum');

