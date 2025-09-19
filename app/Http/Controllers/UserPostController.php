<?php

namespace App\Http\Controllers;

use App\Events\ProcessUpdateTask;
use App\Models\PostModel;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Services\UserAccountServices;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Process;

class UserPostController extends Controller
{

    protected $services;

    public function __construct(UserAccountServices $services)
    {
        $this->services = $services;
    }

    public function createPost(PostRequest $postRequest)
    {
        $fields = $postRequest->validated();

        if (Auth::check()) {
            return $this->services->createPost($fields);
        }

        return response()->json(["message" => "Unauthorized"], 401);

    }

    public function deletePost($id)
    {
        if (Auth::check()) {
            $post = $this->services->deletePost($id);
            return response()->json(["Post deleted successfully!", "post" => $post], 200);
        }

        return response()->json(["message" => "Unauthorized"], 401);
    }

    public function updatePost(UpdatePostRequest $request, $id)
    {
        $fields = $request->validated();

        if (Auth::check()) {

            $post = PostModel::find($id);
            $this->services->updatePost($fields, $id);

            event(new ProcessUpdateTask($post, $fields));

            return response()->json(["message" => "Post updated successfully"], 200);
        }

        return response()->json(["message" => "A problem exists during compilation"], 404);
    }


    public function myPosts()
    {
        $post = $this->services->getPostLists();
        return response()->json(["Here's the lists of your posts: ", $post], 200);

    }
}