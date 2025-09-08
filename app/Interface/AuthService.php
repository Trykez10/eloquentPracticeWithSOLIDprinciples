<?php

namespace App\Interface;

use Illuminate\Database\Eloquent\Model;

interface AuthService
{
    public function attemplogin(array $data): ?Model;
    public function logout();
}