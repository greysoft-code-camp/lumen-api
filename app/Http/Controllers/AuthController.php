<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
<<<<<<< HEAD
=======
use Dotenv\Store\File\Reader;
>>>>>>> cfdecdeba57830713fa3f7d63de46b450293ad2e
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
<<<<<<< HEAD
        $this->validate($request, [
            'username' => 'required|string|unique:users|min:3|max:21',
=======
        $this->validate($request,[
            'username' => 'required|string|unique:users|min:3',
>>>>>>> cfdecdeba57830713fa3f7d63de46b450293ad2e
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $payload = $this->auth->register($request);

        if($payload->status === 201){
            return response()->json([
                'token' => $payload->user->api_token,
                'user' => new UserCollection($payload->user)
            ], $payload->status);
        }
        return response()->json([
            'message' => $payload->error,
        ], $payload->status);
    }

    public function login(Request $request)
    {
<<<<<<< HEAD
        $this->validate($request, [
=======
        $this->validate($request,[
>>>>>>> cfdecdeba57830713fa3f7d63de46b450293ad2e
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $payload = $this->auth->login($request);

        if($payload->status === 200){
            return response()->json([
<<<<<<< HEAD
                'token' => $payload->user->api_token,
=======
                'message' => 'success',
>>>>>>> cfdecdeba57830713fa3f7d63de46b450293ad2e
                'user' => new UserCollection($payload->user)
            ], $payload->status);
        }
            return response()->json([
                'message' => $payload->error,
            ], $payload->status);
    }

    public function logout(Request $request)
    {
        $payload = $this->auth->logout($request);

        if($payload->status === 200){
            return response()->json([
                'message' => $payload->success,
            ], $payload->status);
        }

        return response()->json([
            'message' => $payload->error,
        ], $payload->status);
    }

}
