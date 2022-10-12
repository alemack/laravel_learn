<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\Post\AdminController;
use App\Http\Controllers\Post\IndexController;
use App\Http\Controllers\Post\CreateController;
use App\Http\Controllers\Post\DestroyController;
use App\Http\Controllers\Post\EditController;
use App\Http\Controllers\Post\ShowController;
use App\Http\Controllers\Post\StoreController;
use App\Http\Controllers\Post\UpdateController;

use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;
use SebastianBergmann\Environment\Runtime;

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

Route::get('/', function () {
    return view('welcome');
});

// сгруппировали роуты под одним namespace
Route::group(['namespace' => 'Post'], function() {
Route::get('/posts', [IndexController::class, '__invoke'])->name('post.index');

Route::get('/posts/create', [CreateController::class, '__invoke'])->name('post.create');
Route::post('/posts', [StoreController::class, '__invoke'])->name('post.store');

Route::get('/posts/{post}', [ShowController::class, '__invoke'])->name('post.show');

Route::get('/posts/{post}/edit', [EditController::class, '__invoke'])->name('post.edit');
Route::patch('/posts/{post}', [UpdateController::class, '__invoke'])->name('post.update');

Route::delete('/posts/{post}', [DestroyController::class, '__invoke'])->name('post.delete');

});

Route::group(['namespace' => 'Admin', 'prefix'=>'admin'], function() {
    Route::group(['namespace' => 'Post'], function () {
        Route::get('/post', [AdminController::class, '__invoke'])->name('admin.post.index');
    });
});




Route::get('posts/update', [PostController::class, 'update']);
Route::get('posts/delete', [PostController::class, 'delete']);
Route::get('posts/first_or_create', [PostController::class, 'firstOrCreate']);
Route::get('posts/update_or_create', [PostController::class, 'updateOrCreate']);

Route::get('/main', [MainController::class, 'index'])->name('main.index');
Route::get('/contacts', [ContactController::class, 'index'])->name('contact.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
