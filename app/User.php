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
}
