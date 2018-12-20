<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Participants;
class Messages extends Model
{
    //
    protected $table = "messages";
    protected $primaryKey = "m_id";

    public function getMessages($LOGGED_USER_ID,$TO_CHAT_WITH_ID){
    	$user_one = Messages::where(['sender_id' => $LOGGED_USER_ID, 'reciever_id' => $TO_CHAT_WITH_ID]);
    	$user_two = Messages::where(['reciever_id' => $LOGGED_USER_ID, 'sender_id' => $TO_CHAT_WITH_ID]);

    	return $user_one->union($user_two)->orderby('m_id','ASC');
    }

    public function checkParticipants($LOGGED_USER_ID,$TO_CHAT_WITH_USER_ID){
    	$user_one = Participants::where(['user_one' => $LOGGED_USER_ID,'user_two' => $TO_CHAT_WITH_USER_ID]);
    	$user_two = Participants::where(['user_two' => $LOGGED_USER_ID,'user_one' => $TO_CHAT_WITH_USER_ID]);
    	$union = $user_one->union($user_two);
    	if($union->count() > 0){
    		return $union->first();
    	}else {
    		return false;
    	}
    }
}
