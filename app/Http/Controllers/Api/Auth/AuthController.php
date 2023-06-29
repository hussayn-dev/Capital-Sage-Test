<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\User_Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use User_Auth;

    public function login(Request $request): JsonResponse
    {
        $validation = Validator::make(
            $request->all(),
            $this->login_rules(),
            $this->login_messages()
        );

        if ($validation->fails()) {
            return failed('Failed', $validation->errors(), 400);
        }

        $credentials = $validation->validated();

        if (! Auth::attempt($credentials)) {
            return failed('Invalid email or password');
        }

        $token = auth()->user()->createToken('authToken')->plainTextToken;

        return success('Success logging in', ['token' => $token]);
    }

    public function register(Request $request): JsonResponse
    {
        $validation = Validator::make(
            $request->all(),
            $this->register_rules(),
            $this->register_messages()
        );

        if ($validation->fails()) {
            return failed('Failed', $validation->errors(), 400);
        }

        $credentials = $validation->validated();
        $user = $this->create_user($credentials);
        //Email Verification...
        $token = $user->createToken('authToken')->plainTextToken;

        return success('Success, User created and logged in', ['user' => $user,
            'token' => $token
        ], 201);
    }
}
