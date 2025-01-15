<?php

use App\Http\Controllers\AuthController;
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
    });
});
