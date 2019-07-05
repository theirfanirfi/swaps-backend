<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messages;
use App\Models\Participants;
use App\Http\MyClasses\VerifyToken;
class MessageController extends Controller
{
    //




    ///end

    public function sendMessage(Request $req){
    	$token = $req->input('token');
		 $TO_CHAT_WITH = $req->input('id');
		 $message = $req->input('msg');

		 if($token == null || $TO_CHAT_WITH == null || $message == null){
     return response()->json([
                'isAuthenticated' => false,
                'isEmpty' => true,
                'isError' => true,
                'message' => 'Arguments must be provided.'
            ]);
    }else {
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);

        if(!$user){
            return response()->json([
                'isAuthenticated' => false,
                'isEmpty' => false,
                'isError' => true,
                'message' => 'Not authenticated'
            ]);
        }
        else
        {
        //here the sending goes.
        	$msg = new Messages();
                // date_default_timezone_set("Asia/Karachi");
                $timezone = date_default_timezone_get();
                date_default_timezone_set($timezone);
        	$msg->sender_id = $user->user_id;
        	$msg->reciever_id = $TO_CHAT_WITH;
            $msg->message = $message;

        	//check if the participants table has entry for the chat or not.
        	//has the user chatted before?

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

    		if($msg->save()){
    			 return response()->json([
                'isAuthenticated' => true,
                'isEmpty' => false,
                'isError' => false,
                'isSent' => true,
                'message' => 'Message sent.'
            	]);

    		}else {

    			 return response()->json([
                'isAuthenticated' => true,
                'isEmpty' => false,
                'isError' => true,
                'isSent' => false,
                'message' => 'Error occurred in sending the message.'
            	]);
    		}

        }
    }
    }

	public function getMessages(Request $req){
		 $token = $req->input('token');
		 $TO_CHAT_WITH = $req->input('id');
		 if($token != null && $TO_CHAT_WITH != null){
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);

        if(!$user){
            return response()->json([
                'isAuthenticated' => false,
                'isEmpty' => false,
                'isError' => true,
                'response_message' => 'Not authenticated'
            ]);
        }
        else
        {
        	$m = new Messages();
        	$messages = $m->getMessages($user->user_id,$TO_CHAT_WITH);
        	if($messages->count() > 0){

        			return response()->json([
        				'isFound' => true,
        				'isError' => false,
        				'isAuthenticated' => true,
        				'response_message' => 'loading',
        				'messages' => $messages->get()
        			]);

        	}else {

					return response()->json([
        				'isFound' => false,
        				'isError' => false,
        				'isAuthenticated' => true,
        				'response_message' => 'You have not chated with the user yet.'
        			]);
        	}

        }
    }else {
    	  return response()->json([
                'isAuthenticated' => false,
                'isEmpty' => true,
                'isError' => true,
                'response_message' => 'Arguments must be provided.'
            ]);
    }
    }
    


    public function getUnReadMessageAndCount(Request $req){

        $token = $req->input('token');
$verify = new VerifyToken();
$user = $verify->verifyTokenInDb($token);
$chat_id = $req->input('chat_id');

if(!$user){
    return response()->json([
        'isAuthenticated' => false,
        'message' => 'Not authenticated'
    ]);
}
else
{
     
if($token == "" || $chat_id == ""){
    return response()->json([
        'isEmpty' => true,
        'isError' => true,
        'isAuthenticated' => false,
        'message' => 'Arugments must be provided.'
    ]);
}else {
    $m = new Messages();

    $last_message = $m->getLastMessage($chat_id);
    $count = $m->getUnReadMessagesCount($chat_id,$user->user_id);

    return response()->json([
        'isEmpty' => false,
        'isError' => false,
        'isAuthenticated' => true,
        'last_message_count' => $last_message->count(),
        'last_message' => $last_message->get()->last(),
        'count_unread_messages' => $count,
        'message' => 'loading'
    ]);
}
}
    }
}
