<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('author')->group(function () {
    Route::post('/register', [AuthController::class,'register']);
    Route::post('/login', [AuthController::class,'login']);
});

Route::prefix('posts')->group(function () {
    Route::get('/all', [PostController::class,'index']);
    Route::get('/{post}', [PostController::class,'show']);
    Route::get('/{post}/comments', [CommentController::class,'index']);
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/logout', [AuthController::class,'logout']);
    Route::get('/me', [AuthController::class,'me']);
    Route::post('/post', [PostController::class,'store']);
    Route::post('/posts/{post}/comment', [CommentController::class,'store']);
    Route::get('/authors', [AuthorController::class,'index']);
});


