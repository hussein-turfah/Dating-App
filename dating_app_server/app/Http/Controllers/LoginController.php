<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\FunctionsController;
use App\Models\User;

use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function login(Request $request){

        $functions_controller = new FunctionsController();
        $email = $functions_controller -> entryValidate($request ->email);
        $password = $functions_controller -> entryValidate($request ->password);
        
        $verified_email = User::where('email', $email)->count();
        if($verified_email){
            $user = User::where('email', $email)->first();

            $salt = $user->salt;
            $hashed_password = $user->password;
            $salt_password = $password.$salt;
            $hashed_salt_password = hash('sha256',$salt_password);

            if($hashed_password == $hashed_salt_password){
                $id = $user->id;
                $jwt_token = JWTAuth::fromUser($user);

                return response() -> json([
                    "user_id" => $id,
                    "token" => $jwt_token
                ]);
            }
        }
    }
}

