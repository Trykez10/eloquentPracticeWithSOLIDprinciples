<?php

namespace App\Services;

use App\Models\UserModel;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserAccountServices
{
    public function createUser(array $data)
    {
        $user = UserModel::create($data);
        return $user;
    }

    public function updateUser(array $data, $id)
    {
        $updateUser = UserModel::find($id);
        $updateUser->update($data);

        return $updateUser;
    }

    public function login(array $data)
    {
        $userValidation = UserModel::where('email', $data['email'])->first();
        if (!$userValidation || !Hash::check($data['password'], $userValidation->password)) {
            return response()->json(["message" => "The user details are invalid, Try again."]);
        }
        $userToken = $userValidation->createToken($userValidation->firstname . " 's token")->plainTextToken;

        return response()->json([
            "message" => "Welcome, You are now logged in!",
            "token" => $userToken
        ]);
    }

    public function logout()
    {
        $user = Auth::user();

        $user->tokens()->delete();
        return response()->json(["message" => "Goodbye, logging out..."]);
    }

}