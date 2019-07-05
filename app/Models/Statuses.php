<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use DB;
class Statuses extends Model
{
    protected $table = "statuses";
    protected $primaryKey = "status_id";

    public function getStatuses($user_id){

        $statuses = DB::table('statuses')
        ->where(['statuses.user_id' => $user_id])
        ->leftjoin('rattings','rattings.status_id','=','statuses.status_id')
        ->leftjoin('statuslikes','statuslikes.status_id','=','statuses.status_id')
        ->leftjoin('status_shares','status_shares.status_id','=','statuses.status_id')
        ->leftjoin('status_comments','status_comments.status_id','=','statuses.status_id')
        ->select('statuslikes.user_id','statuses.has_attachment','statuses.attachments','status','statuses.user_id','statuses.status_id','statuses.created_at',DB::raw("avg(ratting) as ratting"),
        DB::raw("count(statuslikes.id) as likes_count"), DB::raw("count(status_shares.id) as shares_count"), DB::raw("count(status_comments.id) as comments_count"),
        DB::raw("IF(statuslikes.user_id = '".$user_id."','true', 'false') as isLiked"))
       // ->groupby('likes_count')
        ->groupby('status')
        ->groupby('statuslikes.user_id')
        ->groupby('statuses.has_attachment')
        ->groupby('statuses.attachments')
        ->groupby('statuses.status_id')
        ->groupby('statuses.user_id')
        ->groupby('statuses.created_at')
        ->orderBy('statuses.status_id','DESC');
        return $statuses;



// "status_id": 7,
// "user_id": 3,
// "status": "hello how are you.",
// "created_at": "2018-12-05 16:46:27",
// "updated_at": "2018-12-07 16:13:03",
// "ratting_id": 1,
// "ratted_by_user_id": 3,
// "ratting": 4,
// "name": "IrfanUllah",
// "username": "irfi",
// "email": "theirfi@gmail.com",
// "email_verified_at": null,
// "password": "$2y$10$apt794t5NK3r51bcMToB7eHcPaqDxYhvZGXzv/hRfiCmusbR378wm",
// "token": "$2y$10$R9BlVJKtmCU7BZs1eoKXhedYuPJtqGH48isHoKrqinzJucmePidOW",
// "profile_image": null,


    }

    public function getUserStatuses($user_id){

        $statuses = DB::table('statuses')
        ->where(['statuses.user_id' => $user_id])
        ->leftjoin('rattings','rattings.status_id','=','statuses.status_id')
        ->leftjoin('users',['users.user_id' => 'statuses.user_id'])
        ->select('profile_image','status','statuses.user_id','statuses.status_id','statuses.created_at',DB::raw("avg(ratting) as ratting"))
        ->groupby('status')
        ->groupby('profile_image')
        ->groupby('statuses.status_id')
        ->groupby('statuses.user_id')
        ->groupby('statuses.created_at')
        ->orderBy('statuses.status_id','DESC');
        return $statuses;

    }

    public function discoverStatuses($user_id){

        return DB::table('followers')->where(['followers.follower_user_id' => $user_id])

        ->leftjoin('statuses',['statuses.user_id' => 'followers.followed_user_id'])

        // return DB::table('statuses')->where('statuses.user_id','!=', $user_id)
        ->leftjoin('users',['users.user_id' => 'statuses.user_id'])
        ->leftjoin('rattings',['rattings.status_id' => 'statuses.status_id'])

        ->leftjoin('statuslikes','statuslikes.status_id','=','statuses.status_id')
        ->leftjoin('status_shares','status_shares.status_id','=','statuses.status_id')
        ->leftjoin('status_comments','status_comments.status_id','=','statuses.status_id')

        ->select('statuslikes.user_id','profile_image','statuses.has_attachment','statuses.attachments','status','statuses.user_id','statuses.status_id','statuses.created_at',DB::raw("avg(ratting) as ratting"),
        DB::raw("count(statuslikes.id) as likes_count"), DB::raw("count(status_shares.id) as shares_count"), DB::raw("count(status_comments.id) as comments_count"),
        DB::raw("IF(statuslikes.user_id = '".$user_id."','true', 'false') as isLiked"))
        ->groupby('profile_image')
        ->groupby('status')
        ->groupby('statuslikes.user_id')
        ->groupby('statuses.has_attachment')
        ->groupby('statuses.attachments')
        ->groupby('statuses.status_id')
        ->groupby('statuses.user_id')
        ->groupby('statuses.created_at')
        ->orderBy('statuses.status_id','DESC');
    }

    public function searchStatuses($keyword, $user_id){
        $statuses = DB::table('statuses')
        ->where('status','like','%'.$keyword.'%')->where('statuses.user_id', '!=', $user_id)
        ->leftjoin('users',['users.user_id' => 'statuses.user_id'])
        ->leftjoin('rattings','rattings.status_id','=','statuses.status_id')
        ->select('profile_image','users.name','statuses.has_attachment','statuses.attachments','status','statuses.user_id','statuses.status_id','statuses.created_at',DB::raw("avg(ratting) as ratting"))
        ->groupby('profile_image')
        ->groupby('users.name')
        ->groupby('status')
        ->groupby('statuses.has_attachment')
        ->groupby('statuses.attachments')
        ->groupby('statuses.status_id')
        ->groupby('statuses.user_id')
        ->groupby('statuses.created_at')
        ->orderBy('statuses.status_id','DESC');
        return $statuses;
    }
}
