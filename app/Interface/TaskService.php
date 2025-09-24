<?php

namespace App\Interface;

interface TaskService
{
    public function createPost(array $data);
    public function deletePost($id);
    public function updatePost(array $data, $id);
}
