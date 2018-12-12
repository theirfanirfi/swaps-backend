<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\MyClasses\VerifyToken;
use App\User;

class ProfileController extends Controller
{
    //
    public function updateImage(Request $req){

        $token = $req->input('token');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);

        if(!$user){
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'Not authenticated'
            ]);
        }
        else
        {
             
        if(!$req->hasFile('image') || $token == ""){
            return response()->json([
                'isEmpty' => true,
                'isError' => true,
                'isAuthenticated' => true,
                'message' => 'Either image or arugment is not provided.'
            ]);
            }else {
    
                $file = $req->file('image');
                $path = "./profile/";
                $file_name = $file->getClientOriginalName();
                $user_id = $user->user_id;
                if($file->move($path,$file_name)){
                    $u = User::find($user_id);
                    $u->profile_image = asset("profile/")."/".$file_name;

                    if($u->save()){

                        return response()->json([
                            'isEmpty' => false,
                            'isError' => false,
                            'isAuthenticated' => true,
                            'isMoved' => true,
                            'isSaved' => true,
                            'user' => $u,
                            'message' => 'Profile Image changed.'
                        ]);
                    } else {

                        return response()->json([
                            'isEmpty' => false,
                            'isError' => false,
                            'isAuthenticated' => true,
                            'isMoved' => true,
                            'isSaved' => false,
                            'message' => 'Error occurred in saving the image. Try again.'
                        ]);
                    }
                } else {
                    return response()->json([
                            'isEmpty' => false,
                            'isError' => true,
                            'isAuthenticated' => true,
                            'isMoved' => false,
                            'isSaved' => false,
                            'message' => 'Error occurred in saving the image. Try again.'
                    ]);
                }

            }
        }

    }
}
