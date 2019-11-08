<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Share extends Model
{
    //

    protected $table = "status_shares";

    public function checkWhetherSharedOrNot($status_id,$user_id){
        $like = Share::where(['status_id' => $status_id, 'user_id' => $user_id]);
        return $like->count() > 0 ? true : false;
    }

    public static function shareStatus($user_id,$status_id){
        DB::beginTransaction();
        try{
            $st_user = DB::select("select user_id from statuses where status_id = '$status_id'", [1]);
            DB::insert('insert into status_shares (status_id, user_id) values (?, ?)', [$status_id, $user_id]);
            DB::insert('insert into notifications (isShare,isAction,status_id,action_by,followed_id) values (?,?,?,?,?)', [1, 1,$status_id,$user_id,$st_user[0]->user_id]);
            DB::commit();
            return true;

        }catch(Exception $e){
            DB::rollback();
            return false;
        }
    }

}
