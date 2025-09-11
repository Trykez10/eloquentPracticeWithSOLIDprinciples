<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\PostRequest;
use App\Http\Requests\Registration;
use App\Http\Requests\UpdateDataRequest;
use Auth;
use App\Services\AuthenticationService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    protected $services;
    public function __construct(AuthenticationService $services)
    {
        $this->services = $services;
        //Instantiates AuthenticationService class para matawag tanang methods nga gina-inherit niya
    }

    public function registerAccount(Registration $registration)
    {
        $fields = $registration->validated();
        $this->services->registerUser($fields);

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


    //POST CONTROLLER METHODS

    public function createPost(PostRequest $postRequest)
    {
        $fields = $postRequest->validated();

        if (Auth::check()) {
            return $this->services->createPost($fields);
        }

        return response()->json(["message" => "Unauthorized"], 401);

    }
}

