<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class NewPasswordController extends Controller
{
    function newPassword(Request $request){
       
        $functions_controller = new functionscontroller();
        
        #change the id from front-end to jwt
        #this is just for testing

        $id = $request-> id;
        $new_password = $functions_controller->entryValidate($request->password);

        $salt = $functions_controller -> generateRandomString(4);
        $hashed_password = hash('sha256',$new_password.$salt);

        $user = User::find($id);
        $user ->salt = $salt;
        $user -> password = $hashed_password;
        $user->save();
        
        return response() -> json([
            "success"=>true
        ]);

    }
}
