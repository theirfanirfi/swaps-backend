<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Comment extends Model
{
    //
    protected $table = "status_comments";

    public function checkComment($user_id,$comment, $status_id){
        return Comment::where(['user_id' => $user_id, 'comment' => $comment, 'status_id' => $status_id])->count();
    }

    public function getComments($status_id){
        return DB::table('status_comments')->where(['status_id' => $status_id])
        ->leftjoin('users',['users.user_id' => 'status_comments.user_id' ])
        ->select('status_comments.id','comment','status_comments.created_at','users.name','status_comments.user_id','profile_image');
    }

    public static function commentOnStatus($status_id,$user_id,$comment){
        DB::beginTransaction();

        try{
            $st_user = DB::select("select user_id from statuses where status_id = '$status_id'", [1]);
            DB::insert('insert into status_comments (status_id, user_id,comment) values (?, ?,?)', [$status_id, $user_id,$comment]);
            DB::insert('insert into notifications (isComment,isAction,status_id,action_by,followed_id) values (?,?,?,?,?)', [1, 1,$status_id,$user_id,$st_user[0]->user_id]);
            DB::commit();
            return true;
        }catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
