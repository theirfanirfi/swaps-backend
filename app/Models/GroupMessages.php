<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMessages extends Model
{
    //

    protected $table = "group_messages";


    public static function getGroupMessages($group_id){
        return GroupMessages::where(['group_id' => $group_id])
        ->leftjoin('users',['users.user_id' => 'group_messages.sender_id'])
        ->select('group_messages.*','users.username','users.profile_image');
        ;
    }
}
