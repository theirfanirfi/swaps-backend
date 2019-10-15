<?php

namespace App\Http\Controllers;

use App\Models\GroupMessages;
use Illuminate\Http\Request;
use App\Http\MyClasses\VerifyToken;
use App\Models\Messages;

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
}
