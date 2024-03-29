<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/posts', [PostController::class, 'index']);  
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

//Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function(){
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/getuser', [AuthController::class, 'getUser']);
        Route::post('/getallusers', [AuthController::class, 'getAllUsers']);
        Route::resource('/posts', PostController::class)->except(['show', 'index']);  
        Route::get('/myposts', [PostController::class, 'myPosts']);  
    });