<?php

namespace App\Http\Controllers;
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

Route::resource('/datauser',UserController::class)->middleware('auth:api');
// Route::resource('/todo',TodoController::class);
Route::get('todo/index/{id}',[TodoController::class, 'index']);
Route::get('todo/create/{id}',[TodoController::class, 'create']);
Route::post('todo/store',[TodoController::class, 'store']);
Route::get('todo/edit/{id_todos}',[TodoController::class, 'edit']);
Route::put('todo/update/{id_todos}',[TodoController::class, 'update']);
// Route::resource('/post', PostController::class);

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:api');
