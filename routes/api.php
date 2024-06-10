<?php

use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
  return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
  Route::delete('logout', [LoginUserController::class, 'destroy']);
});

Route::middleware(['guest'])->group(function () {
  Route::post('login', [LoginUserController::class, 'store']);
  Route::post('register', [RegisteredUserController::class, 'store']);
});

Route::resource('post', PostController::class);
Route::resource('comment', CommentController::class);
