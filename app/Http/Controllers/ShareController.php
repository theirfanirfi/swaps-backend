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
            $sharecount = $share->checkWhetherSharedOrNot($status_id,$user->user_id);
            if($sharecount->count() > 0){
                //shared


                    return response()->json([
                        'isError' => false,
                        'isAuthenticated' => true,
                        'sharecount' => $sharecount->count(),
                        'isAlreadyShared' => true,
                        'message' => 'You have already shared the status.'
                    ]);
            }else {
                //share it
                // $share->status_id = $status_id;
                // $share->user_id = $user->user_id;

                $isShared = Share::shareStatus($user->user_id,$status_id);
                if($isShared){

                    //success

                    return response()->json([
                        'isError' => false,
                        'isAuthenticated' => true,
                        'isAction' => true,
                        'isShared' => true,
                        'sharecount' => $isShared,
                        'message' => 'Status Shared'
                    ]);
                }else {
                    //failure

                    return response()->json([
                        'isError' => true,
                        'isAuthenticated' => true,
                        'isAction' => false,
                        'isShared' => false,

                        'message' => 'Error, Please try again.'
                    ]);
                }
            }
        }

    }
    }










    public function unshare(Request $req){
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
            $sharecount = $share->checkWhetherSharedOrNot($status_id,$user->user_id);
            if($sharecount->count() > 0){
                //shared

                $unshare = $sharecount->first();

                if($unshare->delete()){

                    //success

                    return response()->json([
                        'isError' => false,
                        'isAuthenticated' => true,
                        'isAction' => true,
                        'isUnShared' => true,
                        'message' => 'Status UnShared'
                    ]);
                }else {
                    //failure

                    return response()->json([
                        'isError' => true,
                        'isAuthenticated' => true,
                        'isAction' => false,
                        'isUnShared' => false,

                        'message' => 'Error, Please try again.'
                    ]);
                }

            }else {
                return response()->json([
                    'isError' => false,
                    'isAuthenticated' => true,
                    'wasStatusShare' => false,
                    'message' => "You haven't shared the status to undo it."
                ]);
            }
        }

    }
    }
}
