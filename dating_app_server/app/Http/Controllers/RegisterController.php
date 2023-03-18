<?php

namespace App\Http\Controllers;
use Illuminate\Http\UploadedFile;

use App\Models\User;
use App\Http\Controllers\FunctionsController;
use Illuminate\Http\Request;
use Carbon\Carbon;
class RegisterController extends Controller
{
    function register(Request $request){
        $functions_controller = new FunctionsController();

        $email = $functions_controller -> entryValidate($request ->email);
        $password = $functions_controller -> entryValidate($request ->password);
        $favorite_color = $functions_controller -> entryValidate($request -> favorite_color);

        $first_name = $functions_controller -> entryValidate($request ->first_name);
        $last_name = $functions_controller -> entryValidate($request ->last_name);

        $birth = carbon::parse($functions_controller -> entryValidate($request ->birth));
        $gender = $functions_controller -> entryValidate($request ->gender);
        $location = $functions_controller -> entryValidate($request -> location);

        $salt = $functions_controller -> generateRandomString(4);
        $hashed_password = hash('sha256',$password.$salt);

        $gender = ucfirst(strtolower($gender));
        $location = ucfirst(strtolower($location));
        $favorite_color = ucfirst(strtolower($favorite_color));

        $age = $birth->diffInYears(Carbon::now());
        $date = now()->format('d-m-y');
        

        $verified_email = User::where('email', $email)->first();

        if(!$verified_email){
            
            $user = new User;
            $user->email = $email;
            $user->password = $hashed_password;
            $user->salt = $salt;
            $user->favorite_color = $favorite_color;
            
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            
            $user->location = $location;
            $user->dob = $birth;
            $user->age = $age;
            $user->gender = $gender;
            $image_encoded = $functions_controller->saveImage($request);
            $user->picture1 = $image_encoded;
            $user->created_at = $date;
    
            $user->save();
            
            return response() -> json([
                "success"=>true
            ]);

        }else{
            return response() -> json([
                "error"=>"Email already exists!"
            ]);
        }
    }
}