<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Comment;
use App\Http\MyClasses\VerifyToken;
class CommentController extends Controller
{
    //

    public function comment(Request $req){
    	$token = $req->input('token');
    	$status_id=$req->input('status_id');
    	$commentt = $req->input('comment');

    	if($token == null || $status_id == null || $commentt == null){

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
            $comment = new Comment();

            $check = $comment->checkComment($user->user_id, $commentt,$status_id);
            if($check > 0){
                //already commented with the same text on the same status by the same user.


                    return response()->json([
                        'isError' => false,
                        'isAuthenticated' => true,
                        'isCommented' => false,
                        'isAlreadyCommented' => true,
                        'message' => 'You have already commented on the status with the same text.'
                    ]);

            }else {
                //like it
                // $comment->status_id = $status_id;
                // $comment->user_id = $user->user_id;
                // $comment->comment = $commentt;

                $isCommented = Comment::commentOnStatus($status_id,$user->user_id,$commentt);

                if($isCommented){

                    //success

                    return response()->json([
                        'isError' => false,
                        'isAuthenticated' => true,
                        'isCommented' => true,
                        'isAlreadyCommented' => false,
                        'message' => 'Comment posted on the status.'
                    ]);
                }else {
                    //failure

                    return response()->json([
                        'isError' => true,
                        'isAuthenticated' => true,
                        'message' => 'Error, Please try again.'
                    ]);
                }
            }
        }

    }
    }

    public function getComments(Request $req){
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
            $comment = new Comment();
            $comments = $comment->getComments($status_id);
            if($comments->count() > 0){
                //comments found

                return response()->json([
                    'isError' => false,
                    'isAuthenticated' => true,
                    'isFound' => true,
                    'comments' => $comments->get(),
                    'message' => 'loading'
                ]);

            }else {
                //not found

                return response()->json([
                    'isError' => false,
                    'isAuthenticated' => true,
                    'isFound' => false,
                    'message' => 'The status has not been commented by any user yet.'
                ]);
            }
        }
    }
    }
}
