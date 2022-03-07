<?php

namespace App\Services;


use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use StdClass;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;


class AuthService{

    public function __construct()
    {
        $this->payload = new StdClass;
        $this->user = new User;
    }

    public function register($payload)
    {
        try {
            $user = $this->user->create([
                'username' => strtolower($payload->username),
                'email' => strtolower($payload->email),
                'api_token' => Str::random(50),
                'password' => Hash::make($payload->password),
            ]);

            $this->payload->user = $this->user->find($user->id);
            $this->payload->success = "user created";
            $this->payload->status = 201;

            return $this->payload;
        } catch (Exception $e) {
            $this->payload->error = "something went wrong {$e->getMessage()}";
            $this->payload->status = 500;

            return $this->payload;
        }
    }

    public function login($payload)
    {
        try {
<<<<<<< HEAD
            $user = User::where('username', $payload->username)->firstOrFail();
            if(Hash::check($payload->password, $user->password)){
                $user->api_token = Str::random(50);
                $this->payload->user->save();
=======
            $user = $this->user->where('username', $payload->username)->firstOrFail();
            if(Hash::check($payload->password, $user->password)){
                $user->api_key = Str::random(50);
>>>>>>> cfdecdeba57830713fa3f7d63de46b450293ad2e
                $this->payload->user = $user;
                $this->payload->status = 200;

                return $this->payload;
            }
            $this->payload->error = "invalid username or password";
            $this->payload->status = 401;

            return $this->payload;
        } catch (Exception $exception) {
            if($exception instanceof ModelNotFoundException){
                $this->payload->error = "invalid username or password";
                $this->payload->status = 401;

                return $this->payload;
            }

            $this->payload->error = "something went wrong";
            $this->payload->status = 500;

            return $this->payload;
        }
    }

    public function logout($payload)
    {
        try {
            $user = $this->user->where('api_token', $payload->api_token)->first();
            $user->api_token = null;
            $user->save();
            $this->payload->status = 200;
            $this->payload->success = "Logged Out";
        } catch (Exception $exception) {
            $this->payload->error = "You are not logged in";
        }
    }






}