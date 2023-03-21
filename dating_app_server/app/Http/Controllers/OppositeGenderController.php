<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OppositeGenderController extends Controller
{
    function getOppositeGender(){
        #change the id from front-end to jwt
        #this is just for testing

        $id = 9;

        $user = User::find($id);
        $gender = $user->gender;
        if ($gender == 'Male'){
            $opposite = 'Female';
        }else{
            $opposite = 'Male';
        }

        if ($opposite == 'Female'){
            $user = user::get(['Picture1', 'first_name', 'last_name', 'age', 'gender'])->where('gender', $opposite);
            return response()->json([
                $user,
            ]);
        }else{
            $user = user::get(['Picture1', 'first_name', 'last_name', 'age', 'gender'])->where('gender', $opposite);
            return response()->json([
                $user,
            ]);
        }
    }
}
