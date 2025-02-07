<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ArticleFilterController;

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


// endpoints for authentication ['login', 'register', 'logout', 'refresh']
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('forgotPassword', 'forgotPassword');
    Route::post('resetPassword', 'resetPassword')->name('password.reset');
});

Route::apiResource('categories', CategoryController::class)->except('create','edit');
Route::get('/articles/filter', [ArticleFilterController::class, 'filter']);


Route::apiResource('articles', ArticleController::class)->except('create','edit');
Route::apiResource('roles', RoleController::class)->except('create','edit');


// endpoints for user ['get all users', 'get specific user', 'update information's' , 'delete account']
// second line (37) : this endpoint for update password
Route::apiResource('user', UserController::class)->except(['store']);
Route::match(['put', 'patch'],'user/pass/{user}', [UserController::class, 'update_password'])->name('user.update_pass');


// endpoints for comment ['add comment', 'get comments for specific article', 'update' , 'delete']
Route::apiResource('comment', CommentController::class)->except(['index']);
Route::apiResource('tags', TagController::class);