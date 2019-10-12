<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Participants extends Model
{
    //
    protected $table = "participants";
    protected $primaryKey = "chat_id";

    public function getParticipants($user_id){

    	$user_one = DB::table('participants')->where(['user_one' => $user_id])->orWhere(['user_two' => $user_id])

    	->leftjoin('users',['users.user_id' => 'participants.user_one'])

    	->leftjoin('users as userTwo',['userTwo.user_id' => 'participants.user_two'])

        //->leftjoin('messages',['messages.chat_id' => 'participants.chat_id'])
        
        ->select('users.user_id as user_one_id','chat_id','users.name as user_one_name','users.profile_image as user_one_profile_image','user_one','user_two','userTwo.user_id as user_two_id','userTwo.name as user_two_name','userTwo.profile_image as user_two_profile_image',DB::raw("IF(users.user_id = '".$user_id."',true,false) as amIuserOne"));
        
        return $user_one;

    }

    public function getLastUnReadMessage($chat_id){
        $chats = Participants::where(['chat_id' => $chat_id])->last();
        return $chats;
    }

    public function getUnReadMessagesCount($chat_id){
        $chats = Participants::where(['chat_id' => $chat_id, 'isRead' => '0'])->count();
        return $chats;
    }

    public function getParticipantsAndGroups($user_id){
        $participants = DB::select(
            "SELECT participants.*,  

            userone.user_id as user_one_id,chat_id,userone.username as user_one_name,userone.profile_image as user_one_profile_image,user_one,user_two,usertwo.user_id as user_two_id,usertwo.name as user_two_name,usertwo.profile_image as user_two_profile_image,is_group,group_name,group_id,


(SELECT message FROM messages WHERE messages.chat_id = participants.`chat_id` ORDER BY m_id DESC LIMIT 1) AS last_msg, 
(SELECT COUNT(*) FROM messages WHERE messages.chat_id = participants.`chat_id` AND is_read = 0 ) AS unread_count,
IF(userone.user_id = '$user_id',true,false) as amIuserOne 
FROM participants 
LEFT JOIN chat_groups on chat_groups.id = participants.group_id 
LEFT JOIN users as userone ON userone.`user_id` = participants.`user_one` 
LEFT JOIN users as usertwo ON usertwo.`user_id` = participants.`user_two`
WHERE user_one = '$user_id' or user_two = '$user_id' ORDER BY unread_count DESC"
        );

        return $participants;
    }
}
