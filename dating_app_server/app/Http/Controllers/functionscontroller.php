<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class functionscontroller extends Controller
{
    public function entryValidate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function hello($var1){
        return response()->json(["result"=>"Hello $var1"]);
    }

}
