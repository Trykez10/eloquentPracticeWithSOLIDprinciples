<?php

use App\Http\Controllers\AccountController;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function () {
    return UserModel::all();
});


Route::post('/createuser', [AccountController::class, "registerAccount"]);
Route::post('/updateuser', [AccountController::class, "updateUser"]);
Route::post('/loginuser', [AccountController::class, "userLogin"]);
Route::post('/logoutuser', [AccountController::class, "userlogout"])->middleware('auth:sanctum');

Route::post('/post', [AccountController::class, "createPost"])->middleware('auth:sanctum');