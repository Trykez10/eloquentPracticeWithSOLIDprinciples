<?php

namespace App\Services;

use Auth;
use App\Models\PostModel;
use App\Models\UserModel;
use AuthenticationService;
use App\Interface\AuthService;
use App\Interface\PostService;
use Illuminate\Support\Facades\Hash;

class UserAccountServices implements AuthService, PostService
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

    public function createPost(array $data)
    {
        $user = Auth::user();

        $post = PostModel::create([
            'user_id' => $user->id,
            'title' => $data['title'],
            'body' => $data['body'],
        ]);
        return $post;
    }


}