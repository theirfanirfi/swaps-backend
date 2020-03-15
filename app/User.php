<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = "user_id";
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function searchUsers($keyword, $user_id){

    //     $users = User::where('name','like','%'.$keyword.'%')->where('user_id', '!=', $user_id)
    //     ->leftjoin('followers', function($join) use ($user_id) {

    //     })
    //    // ->leftjoin('followers', ['followed_user_id' => 'users.user_id'])->where(['follower_user_id' => $user_id])
    //     ->select('f_id','follower_user_id','users.user_id','name','username','profile_image')
    //     //
    //     ;

    $users = User::where('name','like','%'.$keyword.'%')->where('user_id', '!=', $user_id);

    $followers = DB::table('followers')->rightJoinSub($users,'fali',function($join) use ($user_id) {
        $join->on('fali.user_id','=','followers.followed_user_id')
        ->where(['follower_user_id' => $user_id])
        ;
    })
    ->select('f_id','fali.user_id','name','username','profile_image')
    ;

        return $followers;
    }

    public static function getUserForTaging($user_id){
        return User::where(['user_id' => $user_id])
        ->select('user_id','name','profile_image');
    }

    public static function getUserAndStatsForProfile($user_id){
        return $profile = DB::select("

        SELECT avg(review_rating) as avg_ratting, count(*) as reviews_count,
        (select count(*) from swaps WHERE poster_user_id='$user_id') as swaps,
        (select count(*) from statuses WHERE statuses.user_id = '$user_id') as statuses,
        (select count(*) from followers WHERE followed_user_id = '$user_id') as followers
        FROM `swaps` WHERE `swaped_with_user_id` = '$user_id' and is_expired = '1' and is_reviewed = '1'

        ", [1]);
    }

    public static function getUserDetailsForProfile($user_id){
        return User::where(['user_id' => $user_id])
        ->select('user_id','name','profile_image','profile_description');
    }
}
