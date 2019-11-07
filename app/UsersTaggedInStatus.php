<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class UsersTaggedInStatus extends Model
{
    //

    protected $table = "status_tags";


    public static function tagUserInStatus($user_id,$status_id){
        DB::beginTransaction();
        try{
            DB::insert('insert into status_tags (status_id, tagged_user_id) values (?, ?)', [$status_id, $user_id]);
            DB::insert('insert into notifications (isTag,isAction,status_id,action_by) values (?,?,?,?)', [1, 1,$status_id,$user_id]);
            DB::commit();
            return true;
        }catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
