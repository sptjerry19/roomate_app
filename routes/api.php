<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\NotificationController;
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
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/update', [AuthController::class, 'update']);
    Route::put('/update-avatar', [AuthController::class, 'updateAvatar'])->name('updateAvatar');;

    Route::group(['middleware' => 'api', 'prefix' => 'roomate'], function () {
        Route::get('/', [RoomateController::class, 'index'])->name('roomate.view');
        Route::get('/manage', [RoomateController::class, 'indexManage'])->name('roomate.indexManage');
        Route::post('/', [RoomateController::class, 'store'])->name('roomate.upload');
        Route::post('/advertiserment', [RoomateController::class, 'registerAdvertiserment'])->name('roomate.registerAdvertiserment');
        Route::get('/{id}', [RoomateController::class, 'show'])->name('roomate.show');
        Route::put('/manage/{id}', [RoomateController::class, 'update'])->name('roomate.update');
        Route::delete('/manage/{id}', [RoomateController::class, 'destroy'])->name('roomate.delete');
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

    Route::group(['middleware' => 'auth:api', 'prefix' => 'notifications'], function () {
        Route::get('/', [NotificationController::class, 'index']);
        Route::patch('/{notification}/read', [NotificationController::class, 'markAsRead']);
    });

    Route::group(['middleware' => 'api', 'prefix' => 'comments'], function () {
        Route::get('/', [CommentController::class, 'listCommentByPost'])->name('comment.list');
        Route::middleware('auth:api')->post('/', [CommentController::class, 'createComment'])->name('comment.createComment');
        Route::middleware('auth:api')->put('/{id}', [CommentController::class, 'updateComment'])->name('comment.updateComment');
        Route::middleware('auth:api')->delete('/{id}', [CommentController::class, 'deleteComment'])->name('comment.deleteComment');
    });
});