<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\MyClasses\VerifyToken;

class UserController extends Controller
{
    //

    public function getUser()
    {
        $user = Auth::user();
        return response()->json($user);
    }

    public function updateInvitesCount(Request $req){
        $token = $req->input('token');
        // $invited_count = $req->input('invited_count');
        if($token == null){
            return response()->json([
                'isAuthenticated' => false,
                'isError' => true,
                'message' => "Arguments must be supplied."
            ]);
        }else {
            $verify = new VerifyToken();
            $user = $verify->verifyTokenInDb($token);
        if(!$user){
            return response()->json([
                'isAuthenticated' => false,
                'isError' => true,
                'message' => 'You are not loggedin.'
            ]);
        }
        else{
            $user->is_invited = 1;
            $user->invites =  $user->invites + 1;
            if($user->save()){
                return response()->json([
                    'isAuthenticated' => true,
                    'isError' => false,
                    'isUpdated' => true,
                    'message' => "Updated"
                ]);
            }else {
                return response()->json([
                    'isAuthenticated' => true,
                    'isError' => true,
                    'message' => "Error occurred in updating your record. Please try again."
                ]);
            }
        }
    }
    }
}
