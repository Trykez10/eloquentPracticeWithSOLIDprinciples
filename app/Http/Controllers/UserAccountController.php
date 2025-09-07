<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\Registration;
use App\Http\Requests\UpdateDataRequest;
use Auth;
use Illuminate\Http\Request;
use App\Services\UserAccountServices;

class UserAccountController extends Controller
{
    protected $services;
    public function __construct(UserAccountServices $services)
    {
        $this->services = $services;
    }

    public function registerAccount(Registration $registration)
    {
        $fields = $registration->validated();
        $this->services->createUser($fields);

        return response()->json(["message" => "You are now registered!"]);
    }

    public function updateUser(UpdateDataRequest $update)
    {
        $updateRequest = $update->validated();
                                                            //Auth::user()->id() 
        $a = $this->services->updateUser($updateRequest, 1);
        return response()->json(["message" => "Data has been updated!", "updated data" => $a]);
    }

    public function userLogin(LoginRequest $loginRequest)
    {
        $request = $loginRequest->validated();
        return $this->services->login($request);
    }

    public function userlogout()
    {
        return $this->services->logout();
    }
}

