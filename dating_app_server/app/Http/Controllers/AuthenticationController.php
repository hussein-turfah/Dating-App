<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\FunctionsController;
use App\Models\User;

class AuthenticationController extends Controller
{
    public function login(Request $request){

        $functionsController = new FunctionsController();

        $email = $functionsController -> entryValidate($request ->email);
        $password = $functionsController -> entryValidate($request ->password);
        
        $verified_email = User::where('email', $email)->first();
        $verified_password = User::where('password'.'salt',$password); 

        if($verified_email && $verified_password){
            $id = $verified_email -> pluck('id');
            return response() -> json([
                "user_id" => $id
            ]);
        }
    }
}

