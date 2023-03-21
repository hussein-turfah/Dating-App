<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\OppositeGenderController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register',[RegisterController::class, "register"]);
Route::post('/login',[LoginController::class, "login"]);
Route::post('/color', [ColorController::class, 'checkColor']);
  
// Route::group(['middleware' => ['jwt.auth']], function () {
  Route::post('/newpassword', [NewPasswordController::class, 'newPassword']);
  Route::post('/editprofileget',[EditProfileController::class,'editProfileGet']);
  Route::post('/editprofilepost',[EditProfileController::class,'editProfilePost']);
  Route::post('/gender',[OppositeGenderController::class,'getOppositeGender']);

// });


  


