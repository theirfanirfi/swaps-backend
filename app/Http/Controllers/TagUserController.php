<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\MyClasses\VerifyToken;
use App\User;
class TagUserController extends Controller
{
    //

    public function getUserForTaging(Request $req){
        $token = $req->input('token');
        $user_id = $req->input('td');

    	if($token == null || $user_id == null){

    		return response()->json([
    			'isError' => true,
    			'isEmpty' => true,
    			'message' => 'Argument must be provided.'
    		]);

    	}else {

    	// verifying user

    	$verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);
        //if not verified
        if(!$user){
        	    return response()->json([
    			'isError' => true,
    			'isAuthenticated' => false,
    			'message' => 'Either your credentials are incorrect or you are not loggedin to perform this action.'
    		]);
        }
        //else - if verified
        else {
            $tuser = User::getUserForTaging($user_id);
            if($tuser->count() > 0){
                $tuser = $tuser->first();

                return response()->json([
                    'isError' => false,
                    'isAuthenticated' => true,
                    'isFound' => true,
                    'user' => $tuser,
                    'message' => '...'
                ]);

            }else {
                return response()->json([
                    'isError' => true,
                    'isAuthenticated' => true,
                    'message' => 'No such user found to tag.'
                ]);
            }
        }
    }
    }
    public function getUser(Request $req){
        $token = $req->input('token');
        $user_id = $req->input('tu');

    	if($token == null || $user_id == null){

    		return response()->json([
    			'isError' => true,
    			'isEmpty' => true,
    			'message' => 'Argument must be provided.'
    		]);

    	}else {

    	// verifying user

    	$verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);
        //if not verified
        if(!$user){
        	    return response()->json([
    			'isError' => true,
    			'isAuthenticated' => false,
    			'message' => 'Either your credentials are incorrect or you are not loggedin to perform this action.'
    		]);
        }
        //else - if verified
        else {

            $tuser = User::where(['user_id' => $user_id]);
            if($tuser->count() > 0){
                return response()->json([
                    'isError' => false,
                    'isAuthenticated' => true,
                    'isFound' => true,
                    'user' => $tuser->first(),
                    'message' => 'done'
                ]);
            }else {
                return response()->json([
                    'isError' => true,
                    'isAuthenticated' => true,
                    'message' => 'Error occurred. Please try tagging users again.'
                ]);
            }
        }
    }
    }
}
