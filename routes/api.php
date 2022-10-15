<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Post\EditController;
use App\Http\Controllers\Post\ShowController;
use App\Http\Controllers\Post\IndexController;
use App\Http\Controllers\Post\StoreController;

use App\Http\Controllers\Post\CreateController;
use App\Http\Controllers\Post\UpdateController;
use App\Http\Controllers\Post\DestroyController;

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



Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('me', 'me');

});

Route::group(['namespace' => 'Post', 'middleware' => 'jwt.auth'], function() {
    Route::get('/posts', [IndexController::class, '__invoke']);
    Route::get('/posts/create', [CreateController::class, '__invoke']);
    Route::post('/posts', [StoreController::class, '__invoke']);
    Route::get('/posts{post}', [ShowController::class, '__invoke']);
    Route::get('/posts/{post}/edit', [EditController::class, '__invoke']);
    Route::patch('/posts/{post}', [UpdateController::class, '__invoke']);
    Route::delete('/posts/{post}', [DestroyController::class, '__invoke']);


    });

// Route::controller(IndexController::class)->group(['middleware'=>'jwt.auth'], function () {
//     Route::get('posts', '__invoke');

// });

// Route::group(['namespace'=>'Post', 'middleware'=>'jwt.auth'], function() {
//     Route::get('/posts', 'IndexController');
// });
