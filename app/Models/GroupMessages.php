<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Messages;
use App\Models\Participants;
class GroupMessages extends Model
{
    //

    protected $table = "group_messages";


    public static function getGroupMessages($group_id){
        return Participants::where(['group_id' => $group_id])
        ->leftjoin('messages',['messages.chat_id' => 'participants.chat_id'])
        ->leftjoin('users',['users.user_id' => 'sender_id'])
        ->select('messages.*','users.username','users.profile_image');
        ;
    }

    public static function checkUserInGroupWhetherPartOrNot($user_id,$group_id){
        return Participants::where(['user_one' => $user_id,'group_id' => $group_id,'user_two' => $user_id]);
        // ->orWhere(['user_two' => $user_id,'group_id' => $group_id]);
    }

    public static function getGroupSingleMessageByMsgId($msg_id){
        return Messages::where(['m_id' => $msg_id])
        ->leftjoin('users',['user_id' => 'messages.sender_id'])->first();
    }
}
