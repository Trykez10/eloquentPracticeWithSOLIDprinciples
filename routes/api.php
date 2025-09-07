<?php

use App\Http\Controllers\UserAccountController;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function () {
    return UserModel::all();
});


Route::post('/createuser', [UserAccountController::class, "registerAccount"]);
Route::post('/updateuser', [UserAccountController::class, "updateUser"]);
Route::post('/loginuser', [UserAccountController::class, "userLogin"]);
Route::post('/logoutuser', [UserAccountController::class, "userlogout"])->middleware('auth:sanctum');