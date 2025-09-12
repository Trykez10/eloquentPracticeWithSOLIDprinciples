<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\UserPostController;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function () {
    return UserModel::all();
});


Route::post('/createuser', [AccountController::class, "registerAccount"]);
Route::put('/updateuser', [AccountController::class, "updateUser"]);
Route::post('/loginuser', [AccountController::class, "userLogin"]);
Route::post('/logoutuser', [AccountController::class, "userlogout"])->middleware('auth:sanctum');

Route::post('/createpost', [UserPostController::class, "createPost"])->middleware('auth:sanctum');
Route::put('/updatepost/{id}', [UserPostController::class, "updatePost"])->middleware('auth:sanctum');
Route::delete('/post/{id}', [UserPostController::class, "deletePost"])->middleware('auth:sanctum');
Route::get('/myposts', [UserPostController::class, "myPosts"])->middleware('auth:sanctum');