<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\MyClasses\VerifyToken;
use App\Models\Attachments;
use App\Models\Messages;

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
        $status = $verify->BelongToUserOrNotStatusReturn($status_id,$user->user_id);
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

        	if(!$status)
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
                $file_name = $user->username.$user->user_id.time().".png";

                if($file->move($path,$file_name)){
                	//file uploaded; save the details to the db

                     if($status->has_attachment == 1){
                        $att = $status->attachments;
                        $json = json_decode($att);
                        $arr['attachment_url'] = asset("statuses/images/")."/".$file_name;
                        $arr['attachment_type'] = 1;
                        $json[] = $arr;
                        $status->attachments = json_encode($json);
                     } else {
                        $status->has_attachment = 1;
                        $arr['attachment_url'] = asset("statuses/images/")."/".$file_name;
                        $arr['attachment_type'] = 1;
                        $json[] = $arr;
                        $status->attachments = json_encode($json);
                     }

                     if($status->save()){
                         return response()->json([
                         'isError' => false,
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
                $path = "./videos/";
                $file_name = $user->username.$user->user_id.time().".mp4";
               // $file_name = $user->name.$user->user_id.time();

                if($file->move($path,$file_name)){
                	//file uploaded; save the details to the db

                     if($status->has_attachment == 1){
                        $att = $status->attachments;
                        $json = json_decode($att);
                        $arr['attachment_url'] = asset("statuses/videos/")."/".$file_name;
                        $arr['attachment_type'] = 2;
                        $json[] = $arr;
                        $status->attachments = json_encode($json);
                     } else {
                        $status->has_attachment = 1;
                        $arr['attachment_url'] = asset("statuses/videos/")."/".$file_name;
                        $arr['attachment_type'] = 2;
                        $json[] = $arr;
                        $status->attachments = json_encode($json);
                     }

                     if($status->save()){
                         return response()->json([
                         'isError' => false,
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

















    public function sendAudio(Request $req){

        $token = $req->input('token');
        $TO_CHAT_WITH = $req->input('id');

    	if($token == null){

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

    		if($req->hasFile('audio')){
    		//upload image
			   	$file = $req->file('audio');
                $path = "./statuses/audiomessages/";
                $file_name = $user->username.$user->user_id.time().".3gp";

                if($file->move($path,$file_name)){
                    //file uploaded; save the details to the db
                    $msg = new Messages();
                    $msg->sender_id = $user->user_id;
                    $msg->reciever_id = $TO_CHAT_WITH;
                    $msg->is_audio = 1;
                    $msg->audio_attachment = $file_name;

                    if($msg->checkParticipants($user->user_id,$TO_CHAT_WITH)){
                        $msg->chat_id = $msg->checkParticipants($user->user_id,$TO_CHAT_WITH)->chat_id;
                }else {
                    $p = new Participants();
                    $p->user_one = $user->user_id;
                    $p->user_two = $TO_CHAT_WITH;

                    if($p->save()){
                        $msg->chat_id = $p->chat_id;
                    }
                }
                   // $msn->
                     if($msg->save()){
                         return response()->json([
                         'isError' => false,
                         'isAuthenticated' => true,
                         'isSent' => true,
                         'message' => 'uploaded',
                         'msg' => $msg
                        ]);
                     }else {
                        return response()->json([
                         'isError' => true,
                          'isSent' => false,

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

    }
}
        }
    }
}
