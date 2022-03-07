<?php

namespace App\Http\Controllers;
use Laravel\Lumen\Http\Request;
use Dotenv\Store\File\Reader;
use App\Http\Resources\UserCollection;
use App\Services\AuthService;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->auth = new AuthService();
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users|min:3|max:21',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $payload = $this->auth->register($request);

        if($payload->status === 201){
            return response()->json([
                'user' => new UserCollection($payload->user)
            ], $payload->status);
        }
        return response()->json([
            'message' => $payload->error,
        ], $payload->status);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|min:6'
        ]);

        $payload = $this->auth->login($request);

        if($payload->status === 200){
            return response()->json([
                'user' => new UserCollection($payload->user)
            ], $payload->status);
        }
            return response()->json([
                'message' => $payload->error,
            ], $payload->status);
    }

    public function logout(Request $request)
    {

    }

}
