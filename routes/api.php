<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ActionLogController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/login', [AuthController::class, 'login']);
Route::post('user/register', [AuthController::class, 'register']);

//category
Route::get('category', [AuthController::class, 'categoryList'])->middleware('auth:sanctum');

//post list
Route::get('allPostList', [PostController::class, 'allPostList']);
Route::post('post/search', [PostController::class, 'searchPost']);
Route::post('post/details', [PostController::class, 'detailsPost']);

//category list
Route::get('allCategory', [CategoryController::class, 'getAllCategory']);
Route::post('category/search', [CategoryController::class, 'searchCategory']);

//action log
Route::post('post/actionLog', [ActionLogController::class, 'setActionLog']);
