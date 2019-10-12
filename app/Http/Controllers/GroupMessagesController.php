<?php

namespace App\Http\Controllers;

use App\Models\GroupMessages;
use Illuminate\Http\Request;
use App\Http\MyClasses\VerifyToken;

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
}
