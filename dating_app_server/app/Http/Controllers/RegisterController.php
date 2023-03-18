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
        $functionsController = new FunctionsController();

        $email = $functionsController -> entryValidate($request ->email);
        $password = $functionsController -> entryValidate($request ->password);
        $favorite_color = $functionsController -> entryValidate($request -> favorite_color);

        $first_name = $functionsController -> entryValidate($request ->first_name);
        $last_name = $functionsController -> entryValidate($request ->last_name);

        $birth = carbon::parse($functionsController -> entryValidate($request ->birth));
        $gender = $functionsController -> entryValidate($request ->gender);
        $location = $functionsController -> entryValidate($request -> location);

        $salt = $functionsController -> generateRandomString(4);
        $hashed_password = hash('sha256',$password.$salt);

        $gender = ucfirst(strtolower($gender));
        $location = ucfirst(strtolower($location));
        $favorite_color = ucfirst(strtolower($favorite_color));

        $age = $birth->diffInYears(Carbon::now());
        $date = now()->format('d-m-y');
        

        
        
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $image_name = uniqid();
        //     $image_path = $image->storeAs('public/images', $image_name . '.jpg');
        //     $image_encoded = base64_encode(asset($image_path));
        // }

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
            $image_encoded = $functionsController->saveImage($request);
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