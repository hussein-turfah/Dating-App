<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    function checkColor(Request $request){
        $functions_controller = new functionscontroller();

        $email = $functions_controller -> entryValidate($request ->email);
        $color = $functions_controller -> entryValidate($request->favorite_color);
        
        $verified_email = User::where('email', $email)->count();
        
        if($verified_email){

            $user = User::where('email', $email)->first();


            $user_color = $user->favorite_color;
            
            if($user_color == $color){
                $id = $user->id;
                return response() -> json([
                    "user_id" => $id
                ]);
            }
        }
        
    }
}
