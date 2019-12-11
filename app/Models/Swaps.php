<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use DB;
class Swaps extends Model
{
    //

    protected $table = "swaps";
    protected $primaryKey = "swap_id";

    public function getSwapsTab($user_id){
    //$user_id = 3;
    $time = new DateTime("now");
    $swaps =  DB::table('swaps')->where(['poster_user_id' => $user_id])->orWhere(function($query) use ($user_id) {
      return  $query->orWhere(['swaped_with_user_id' => $user_id]);
    })->Where(['is_accepted' => 1])
    //->where("time_to_sec(timediff($time,'swaps.time_of_swap' ))/60",'>',30)

    ->leftjoin('users',['users.user_id' => 'swaps.poster_user_id' ])

    ->leftjoin('statuses',['statuses.status_id' => 'swaps.status_id'])

    ->leftjoin('users as swaped_with',['swaped_with.user_id' => 'swaps.swaped_with_user_id'])

    ->leftjoin('rattings',['rattings.status_id' => 'swaps.status_id'])
    ->leftjoin('statuslikes','statuslikes.status_id','=','swaps.status_id')
    ->leftjoin('status_shares','status_shares.status_id','=','swaps.status_id')
    ->leftjoin('status_comments','status_comments.status_id','=','swaps.status_id')
    ->select('statuslikes.user_id','swap_id','swaps.is_accepted','users.user_id as poster_user_id','swaped_with.user_id as swaped_with_user_id',

    'users.name as poster_user_name','swaped_with.name as swaped_with_user_name', 'status','has_attachment','attachments',

    'swaps.status_id','swaps.created_at as swap_date', 'users.profile_image as poster_profile_image', 'swaped_with.profile_image as swaped_with_profile_image',

    DB::raw("avg(ratting) as avg_ratting"), DB::raw("IF(swaps.poster_user_id = '".$user_id."','true', 'false') as isMe"), DB::raw("count(statuslikes.id) as likes_count"), DB::raw("count(status_shares.id) as shares_count"), DB::raw("count(status_comments.id) as comments_count"),
    DB::raw("IF(statuslikes.user_id = '".$user_id."','true', 'false') as isLiked"))

    ->groupby('statuslikes.user_id')
    ->groupby('swap_id')
    ->groupby('swaps.is_accepted')
    ->groupby('users.user_id')
    ->groupby('swaped_with.user_id')
    ->groupby('users.name')
    ->groupby('swaped_with.name')
    ->groupby('status')
    ->groupby('has_attachment')
    ->groupby('attachments')
    ->groupby('swaps.created_at')
    ->groupby('users.profile_image')
    ->groupby('swaped_with.profile_image')
    ->groupby('swaps.status_id')
    ->groupby('swaps.poster_user_id')
    ->orderby('swap_id','DESC');
        return $swaps;

    }
}
