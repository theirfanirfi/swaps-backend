<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Like;
use App\Http\MyClasses\VerifyToken;

class LikeController extends Controller
{
    //

    public function like(Request $req){
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

            //check whether the status was already liked or not.
            $like = new Like();
            $check = $like->checkWhetherLikedOrNot($status_id,$user->user_id);
            if($check){
                //liked
                // - dislike it

                if($check->delete()){
                    //disliked

                    return response()->json([
                        'isError' => false,
                        'isAuthenticated' => true,
                        'isAction' => true,
                        'isUnliked' => true,
                        'StatusLikes' => $like->countLikes($status_id),
                        'message' => 'Status unliked'
                    ]);
                }else {
                    //error

                    return response()->json([
                        'isError' => true,
                        'isAuthenticated' => true,
                        'isAction' => false,
                        'message' => 'Error, Please try again.'
                    ]);
                }
            }else {
                //like it
                $like->status_id = $status_id;
                $like->user_id = $user->user_id;
                if($like->save()){

                    //success

                    return response()->json([
                        'isError' => false,
                        'isAuthenticated' => true,
                        'isAction' => true,
                        'isUnliked' => false,
                        'isLiked' => true,
                        'StatusLikes' => $like->countLikes($status_id),
                        'message' => 'Status Liked'
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
