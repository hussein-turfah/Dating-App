<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class functionscontroller extends Controller
{
    public function entryValidate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function generateRandomString($length){
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $characters_length = strlen($characters);
        $random_string = "";
        for($i = 0; $i < $length; $i++){
            $random_string .= $characters[rand(0,$characters_length-1)];
        }
        return $random_string;
    }

    public function saveImage(Request $request){
        if ($request->file('image')){
            $image = $request->file('image');
            $image_name = uniqid();
            $image_path = $image->storeAs('public/images', $image_name .'.jpg');
            $image_encoded = base64_encode(asset($image_path));
            return $image_encoded;
        }
    }

    public function saveImageOptional(Request $request, $file_name){
        if ($request->file($file_name)){
            $image = $request->file($file_name);
            $image_name = uniqid();
            $image_path = $image->storeAs('public/images', $image_name .'.jpg');
            $image_encoded = base64_encode(asset($image_path));
            return $image_encoded;
        }
    }


}
