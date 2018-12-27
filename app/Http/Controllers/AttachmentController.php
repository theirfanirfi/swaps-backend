<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\MyClasses\VerifyToken;
use App\Models\Attachments;

class AttachmentController extends Controller
{
    //

    public function send(Request $req){

    	$token = $req->input('token');
    	$type = $req->input('attachment_type');
    	$status_id=$req->input('status_id');

    	if($token == null || $type == null || $status_id == null){

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

        	//check - does the status belong to the user trying to upload attachments or not.

        	if(!$verify->BelongToUserOrNot($status_id,$user->user_id))
        	{

        		//status does not belong to the loggedin user
        	return response()->json([
    			'isError' => true,
    			'isAuthenticated' => true,
    			'message' => 'Status does not belong to you.'
    		]);

        	}else {

    	//type == 1 : image
    	if($type == 1){
    		if($req->hasFile('image')){
    		//upload image
			   	$file = $req->file('image');
                $path = "./statuses/images/";
                $file_name = $user->name.$user->user_id.time();

                if($file->move($path,$file_name)){
                	//file uploaded; save the details to the db
                	$media = new Attachments();
                	$media->user_id = $user->user_id;
                	$media->status_id = $status_id;
                	$media->attachment_type = 1; // 1 is image
                	$media->attachment_url = asset("statuses/images/")."/".$file_name;
                	if($media->save()){

			          	return response()->json([
			    			'isError' => true,
			    			'isAuthenticated' => true,
			    			'isSaved' => true,
			    			'message' => 'uploaded'
			    		]);

                	}else {
			              return response()->json([
			    			'isError' => true,
			    			'isAuthenticated' => true,
			    			'message' => 'Error occurred in uploading the attachment.'
			    		]);
                	}

                }else {
                	//file not uploaded.
              return response()->json([
    			'isError' => true,
    			'isAuthenticated' => true,
    			'message' => 'Error occurred in uploading the attachment.'
    		]);
                }

            }else {
            	//file is not provided
            	   		     return response()->json([
    			'isError' => true,
    			'isAuthenticated' => true,
    			'message' => 'Incomplete Arguments supplied'
    		]);
            }
    	}
    	else if($type == 2){
    		//upload video

    		    		if($req->hasFile('video')){
    		//upload image
			   	$file = $req->file('video');
                $path = "./statuses/videos/";
                $file_name = $user->name.$user->user_id.time();

                if($file->move($path,$file_name)){
                	//file uploaded; save the details to the db
                	$media = new Attachments();
                	$media->user_id = $user->user_id;
                	$media->status_id = $status_id;
                	$media->attachment_type = 2; //2 is video
                	$media->attachment_url = asset("statuses/videos/")."/".$file_name;
                	if($media->save()){

			          	return response()->json([
			    			'isError' => true,
			    			'isAuthenticated' => true,
			    			'isSaved' => true,
			    			'message' => 'uploaded'
			    		]);

                	}else {
			              return response()->json([
			    			'isError' => true,
			    			'isAuthenticated' => true,
			    			'message' => 'Error occurred in uploading the attachment.'
			    		]);
                	}

                }else {
                	//file not uploaded.
              return response()->json([
    			'isError' => true,
    			'isAuthenticated' => true,
    			'message' => 'Error occurred in uploading the attachment.'
    		]);
                }

            }else {
            	//file is not provided
            	   		     return response()->json([
    			'isError' => true,
    			'isAuthenticated' => true,
    			'message' => 'Incomplete Arguments supplied'
    		]);
            }
    	}
    	else {
    		     return response()->json([
    			'isError' => true,
    			'isAuthenticated' => true,
    			'message' => 'Invalid Arguments supplied'
    		]);
    	}

    }// status does belong to the user, logged in
    }//verfied user else

    }// outer else - not null
    
    }
}
