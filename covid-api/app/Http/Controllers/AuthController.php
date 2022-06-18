<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{

    // Create function register User
    public function register(Request $request) {

        $validateRequest = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $validateRequest['name'],
            'email' => $validateRequest['email'],
            'password' => bcrypt($validateRequest['password'])
        ]);

        $token = $user -> createToken('usertoken')->plainTextToken;

        $response = [
            'message' => 'User Is Created Successfully',
            'user' => $user,
            'token' => $token
        ];

        return response() -> json($response, 201);

        $error = [
            'message' => 'Create User Failed'
        ];

        return response() -> json($error, 204);

    }

    // Create function logout User
    public function logout(Request $request) {
        
        auth()->user()->tokens()->delete();

        $response = [
            'message' => 'Logout Success',
        ];

        return response() -> json($response, 201);
    }

    // Create function Login User
    public function login(Request $request){

        $validateRequest = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);


        $user = User::where('email', $validateRequest['email'])->first();

        if (!$user || !Hash::check($validateRequest['password'], $user->password)) {

            $response = [
                'message' => 'Login Failed',
            ];

            return response() -> json($response, 401);
        }

        $token = $user -> createToken('usertoken')->plainTextToken;

        $response = [
            'message' => 'User Is Login Successfully',
            'user' => $user,
            'token' => $token
        ];

        return response() -> json($response, 201);

        $error = [
            'message' => 'Create User Failed'
        ];

        return response() -> json($error, 204);
        
    }
}
