<?php

namespace App\Services;

use App\Interface\AuthService;
use Illuminate\Support\Facades\Auth;
class AuthenticationService
{
    protected array $validations;

                                // 0 => UserAccountServices $validation
                                // 1 = AdminAccountServices $validation
    public function __construct(array $validations)
    {
        $this->validations = $validations;
    }

    public function login(array $data)
    {
        foreach ($this->validations as $validation) {
            $account = $validation->attemplogin($data);

            if ($account) {
                $token = $account->createToken("login token")->plainTextToken;

                return response()->json([
                    "message" => "Welcome, You are now logged in!",
                    "token" => $token,// e.g. UserModel / AdminModel / MarketingModel
                    "role" => "user",
                    "user" => ["firstname" => $account->firstname, "lastname" => $account->lastname]
                ]);
            }

        }
        return response()->json(["message" => "Invalid credentials"], 401);
    }

    public function logout()
    {
        $user = Auth::user();

        $user->tokens()->delete();

        return response()->json(["message" => "Goodbye! Logging out"]);
    }
}