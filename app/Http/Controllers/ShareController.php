<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Share;
use App\Http\MyClasses\VerifyToken;
class ShareController extends Controller
{
    //

    public function share(Request $req){
    	$token = $req->input('token');
    	$status_id=$req->input('status_id');

    	if($token == null || $status_id == null){

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

            //check whether the status was already shared or not.
            $share = new Share();
            if($share->checkWhetherSharedOrNot($status_id,$user->user_id)){
                //shared


                    return response()->json([
                        'isError' => false,
                        'isAuthenticated' => true,
                        'message' => 'You have already shared the status.'
                    ]);
            }else {
                //like it
                $share->status_id = $status_id;
                $share->user_id = $user->user_id;
                if($share->save()){

                    //success

                    return response()->json([
                        'isError' => false,
                        'isAuthenticated' => true,
                        'isAction' => true,
                        'message' => 'Status Shared'
                    ]);
                }else {
                    //failure

                    return response()->json([
                        'isError' => true,
                        'isAuthenticated' => true,
                        'isAction' => false,
                        'message' => 'Error, Please try again.'
                    ]);
                }
            }
        }

    }
    }
}
