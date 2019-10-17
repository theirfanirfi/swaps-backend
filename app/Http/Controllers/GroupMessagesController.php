<?php

namespace App\Http\Controllers;

use App\Models\GroupMessages;
use Illuminate\Http\Request;
use App\Http\MyClasses\VerifyToken;
use App\Models\Messages;
use App\Models\Participants;

class GroupMessagesController extends Controller
{
    //

    public function getGroupMessages(Request $req){
        $token = $req->input('token');
        $group_id = $req->input('id');
        if($token != null && $group_id != null){
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
           $messages = GroupMessages::getGroupMessages($group_id);
        // $messages = Messages::where(['chat_id' => $group_id]);
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
                       'response_message' => 'Chat is not initiated by any user.'
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


   public function sentMessageToGroup(Request $req){
    $token = $req->input('token');
    $group_id = $req->input('id');
    $msg = $req->input('msg');


    if($token != null && $group_id != null){
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
       //check whether user is part of the group or not.
       $isPartOfTheGroup = GroupMessages::checkUserInGroupWhetherPartOrNot($user->user_id,$group_id);
       if($isPartOfTheGroup->count() > 0){
           $message = new Messages();
           $message->chat_id = $isPartOfTheGroup->first()->chat_id;
           $message->sender_id = $user->user_id;
           $message->message = $msg;

           if($message->save()){
            return response()->json([
                'isAuthenticated' => true,
                'isEmpty' => false,
                'isError' => false,
                'isSent' => true,
                'msg'=> GroupMessages::getGroupSingleMessageByMsgId($message->m_id),
                'response_message' => 'No such group exists.'
            ]);
           }else {
            return response()->json([
                'isAuthenticated' => true,
                'isEmpty' => false,
                'isError' => true,
                'response_message' => 'Error. Try again.'
            ]);
           }
       }else {
        return response()->json([
            'isAuthenticated' => true,
            'isEmpty' => false,
            'isError' => true,
            'response_message' => 'No such group exists.'
        ]);
       }
   }
}
   }



   /////////////////// forward

   public function forwardMessageFromGroup(Request $req){
    $token = $req->input('token');
     $TO_CHAT_WITH = $req->input('id');
     $m_id = $req->input('mid');

     if($token == null || $TO_CHAT_WITH == null || $m_id == null){
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
        $msg->is_forwarded = 1;

        $existingMessage = Messages::where(['m_id' => $m_id]);
        if($existingMessage->count() > 0){
            $msg->message = $existingMessage->first()->message;

        }else {
            return response()->json([
                'isAuthenticated' => true,
                'isEmpty' => false,
                'isError' => true,
                'message' => 'No such message exists to forward it.'
            ]);
            exit();
        }

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


}
