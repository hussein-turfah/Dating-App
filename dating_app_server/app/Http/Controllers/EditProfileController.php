<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EditProfileController extends Controller
{
    function editProfileGet(){        
        #change the id from front-end to jwt
        #this is just for testing

        $id = 9;

        $user = User::find($id);
        $bio = $user->bio;
        $image1 = $user-> picture1;
        $image2 = $user-> picture2;
        $image3 = $user-> picture3;
        $image4 = $user-> picture4;
        $user->save();
        
        return response()->json([
            'success' => true,
            'bio' => $bio,
            'image1' => base64_decode($image1),
            'image2' => base64_decode($image2),
            'image3' => base64_decode($image3),
            'image4' => base64_decode($image4),
        ]);

    }
    function editProfilePost(Request $request){
        $functions_controller = new functionscontroller();

        $id = $request->id;
        $bio = $functions_controller->entryValidate($request->bio);

        $image_encoded1 = $functions_controller->saveImage($request);
        

        // $image1 = $functions_controller->saveImage($request->image1);
        $image2 = $functions_controller->saveImageOptional($request, 'image2');
        $image3 = $functions_controller->saveImageOptional($request, 'image3');
        $image4 = $functions_controller->saveImageOptional($request, 'image4');
        
        $user = User::find($id);
        $user->bio = $bio;
        $user-> picture1 = $image_encoded1;
        $user-> picture2 = $image2;
        $user-> picture3 = $image3;
        $user-> picture4 = $image4;
        $user->save();

        return response()->json([
            "success" => true,
        ]);
    }
}
