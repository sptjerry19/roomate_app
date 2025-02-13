<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\RoomateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::group(['middleware' => 'api', 'prefix' => 'roomate'], function () {
        Route::get('/', [RoomateController::class, 'index'])->name('roomate.view');
        Route::get('/{id}', [RoomateController::class, 'show'])->name('roomate.show');
        Route::post('/', [RoomateController::class, 'store'])->name('roomate.upload');
        Route::post('/{id}', [RoomateController::class, 'update'])->name('roomate.update');
        Route::delete('/', [RoomateController::class, 'destroy'])->name('roomate.delete');
    });

    Route::group(['middleware' => 'api', 'prefix' => 'favorite'], function () {
        Route::get('/', [FavoriteController::class, 'index'])->name('favorite.view');
        Route::post('/', [FavoriteController::class, 'store'])->name('favorite.create');
        Route::put('/', [FavoriteController::class, 'remove'])->name('favorite.remove');
        Route::delete('/', [FavoriteController::class, 'destroy'])->name('favorite.delete');
    });

    Route::group(['middleware' => 'api', 'prefix' => 'review'], function () {
        Route::get('/', [RoomateController::class, 'index'])->name('review.view');
        Route::post('/', [RoomateController::class, 'store'])->name('review.create');
        Route::put('/', [RoomateController::class, 'update'])->name('review.update');
        Route::delete('/', [RoomateController::class, 'destroy'])->name('review.delete');
    });

    Route::group(['middleware' => 'api', 'prefix' => 'motor'], function () {
        Route::get('/', [MotorController::class, 'index'])->name('motor.view');
        Route::post('/', [MotorController::class, 'store'])->name('motor.create');
        Route::put('/', [MotorController::class, 'update'])->name('motor.update');
        Route::delete('/', [MotorController::class, 'destroy'])->name('motor.delete');
    });
});