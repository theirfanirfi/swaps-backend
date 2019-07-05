<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //

    protected $table = "statuslikes";

    public function checkWhetherLikedOrNot($status_id,$user_id){
        $like = Like::where(['status_id' => $status_id, 'user_id' => $user_id]);
            return $like->count() > 0 ? $like->first() : false;
    }

    public function countLikes($status_id){
       return $likes = Like::where(['status_id' => $status_id])->count();
    }

}
