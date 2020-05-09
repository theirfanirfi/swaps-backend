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
            ->leftjoin('users', 'users.user_id', '=', 'followers.followed_user_id');
        return $followers->select('followed_user_id', 'name', 'username', 'profile_image');
    }

    public static function getFollowedUserForReact($user_id)
    {
        $followers =  DB::table('followers')->where(['follower_user_id' => $user_id])
            ->leftjoin('users', 'users.user_id', '=', 'followers.followed_user_id');
        return $followers->select('followed_user_id', 'user_id', 'name', 'username', 'profile_image');
    }

    public function getSwaps($user_id, $status_id)
    {
        return Swaps::where(['poster_user_id' => $user_id, 'status_id' => $status_id])->select('swap_id', 'swaped_with_user_id', 'status_id');
    }

    public function getUsers($user_id)
    {
        $one =  DB::table('users')->where('user_id', '!=', $user_id)->select('users.user_id', 'name', 'profile_image')
            ->leftjoin('followers', ['follower_user_id' => 'users.user_id'])
            ->select('users.user_id', 'name', 'profile_image', 'f_id', 'follower_user_id', 'followed_user_id', DB::raw("IF(follower_user_id ='" . $user_id . "',true,false) as haveIFollowed"));
        // ->leftjoin('followers','follower_user_id','=','users.user_id')
        // ->select('users.user_id','name','profile_image','f_id','follower_user_id','followed_user_id',DB::raw("IF(follower_user_id ='".$user_id."',true,false) as haveIFollowed"));
        return $one;
    }

    public function union($user_id)
    {
        $one =  DB::table('users')->where('user_id', '!=', $user_id)->select('users.user_id', 'name', 'profile_image');
        $two =  DB::table('followers as follow')->select('follow.f_id as f_id', 'follow.follower_user_id as fid', ' follow.followed_user_id as fdd');
        return $one->union($two);
    }

    public function getUsersForAtStartUp($user_id)
    {
        $users = DB::table('users')
            ->where('users.user_id', '!=', $user_id);
        return $users;
    }

    public function getUserFollowers($user_id, $profile_id)
    {
        $followers = Followers::where(['followed_user_id' => $profile_id])
            ->leftjoin('users', ['users.user_id' => 'followers.follower_user_id'])
            ->select('user_id', 'f_id', 'name', 'profile_image');
        //    ;
        //     $have = DB::table('followers')
        //     ->joinSub($followers,'fone',function($join) use($profile_id, $user_id) {
        //         $join->on(['fone.followed_user_id' => $profile_id, 'followers.follower_user_id' => $user_id]);
        //     })

        //    ;

        return $followers;
    }
}
