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

    	->select('users.user_id as user_one_id','users.name as user_one_name','users.profile_image as user_one_profile_image','user_one','user_two','userTwo.user_id as user_two_id','userTwo.name as user_two_name','userTwo.profile_image as user_two_profile_image',DB::raw("IF(users.user_id = '".$user_id."',true,false) as amIuserOne"));
    	return $user_one;

    }
}
