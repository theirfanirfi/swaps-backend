<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use DB;
class Followers extends Model
{
    //
    protected $table = "followers";
    protected $primarykey = "f_id";

    public function getFollowed($user_id)
    {
        $followers =  DB::table('followers')->where(['follower_user_id' => $user_id])
        ->leftjoin('users','users.user_id','=','followers.followed_user_id');
        return $followers->select('followed_user_id','name','username','profile_image');

    }

    public function getSwaps($user_id, $status_id){
        return Swaps::where(['poster_user_id' => $user_id, 'status_id' => $status_id])->select('swap_id','swaped_with_user_id','status_id');
    }
}
