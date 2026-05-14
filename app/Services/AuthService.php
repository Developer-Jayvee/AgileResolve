<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    CONST ACESS_TOKEN = "Access User Token";
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }

    /**
     * Login
     *
     * @param  string $username
     * @param  string $password
     * @return array
     */
    public function login(string $username , string $password) : array
    {
        try {
            $user = User::where('username',$username)->first();
            if(!$user){
                throw new \Exception("Invalid username and password", 500);
            }

            if(!Hash::check($password,$user->password)){
                throw new \Exception("Invalid username and password", 500);
            }
            $access_token = $user->createToken(self::ACESS_TOKEN)->accessToken;
            return [
                'token' => $access_token,
                'user' => $user
            ];
        } catch (\Throwable $th) {
            throw new \Exception("Failed to login. Please try again later", 500);
        }
    }
}
