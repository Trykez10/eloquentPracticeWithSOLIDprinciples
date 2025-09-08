<?php

namespace App\Services;

use App\Interface\AuthService;
use App\Models\UserModel;
use Auth;
use AuthenticationService;
use Illuminate\Support\Facades\Hash;

class UserAccountServices implements AuthService
{
    // public function createUser(array $data)
    // {
    //     $user = UserModel::create($data);
    //     return $user;
    // }

    // public function updateUser(array $data, $id)
    // {
    //     $updateUser = UserModel::find($id);
    //     $updateUser->update($data);

    //     return $updateUser;
    // }

    public function attemplogin(array $data): ?UserModel
    {
        $userValidation = UserModel::where('email', $data['email'])->first();
        if (!$userValidation || !Hash::check($data['password'], $userValidation->password)) {
            return null;
        }

        return $userValidation;
    }

    public function logout()
    {
        $user = Auth::user();

        $user->tokens()->delete();
    }


}