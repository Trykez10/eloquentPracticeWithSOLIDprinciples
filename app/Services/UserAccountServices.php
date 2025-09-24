<?php

namespace App\Services;

use App\Interface\TaskService;
use App\Models\TaskModel;
use Auth;
use App\Models\PostModel;
use App\Models\UserModel;
use AuthenticationService;
use App\Interface\AuthService;
use Illuminate\Support\Facades\Hash;

class UserAccountServices implements AuthService, TaskService
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

    //POSTS
    public function createPost(array $data)
    {
        $user = Auth::user();

        $post = TaskModel::create([
            'user_id' => $user->id,
            'task_title' => $data['task_title'],
            'task_content' => $data['task_content'],
        ]);
        return $post;
    }

    public function deletePost($id)
    {
        $post = TaskModel::findOrFail($id);
        $post->delete();
        return $post;
    }

    public function updatePost(array $data, $id)
    {
        $post = TaskModel::findOrFail($id);
        $post->update($data);
        return $post;

    }

    public function getPostLists()
    {
        $user = Auth::user();

        $post = TaskModel::with('user')->where('user_id', $user->id)->get();

        if ($post->isEmpty()) {
            return response()->json(["message" => "You have no task like that."], 200);
        }
        return $post;
    }


}