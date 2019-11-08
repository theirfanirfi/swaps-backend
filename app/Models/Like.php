<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Notifications;
use DB;
use Exception;

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
    public static function likeStatus($user_id,$status_id,$followed_id){
        DB::beginTransaction();

        try{

            DB::insert('insert into statuslikes (status_id, user_id) values (?, ?)', [$status_id, $user_id]);
            DB::insert('insert into notifications (isLike, isAction,status_id,action_by,followed_id) values (?, ?,?,?,?)', [1, 1,$status_id,$user_id,$followed_id]);
            DB::commit();
            return true;
        }catch(Exception $e){
            DB::rollback();
            return false;
        }
    }

}
