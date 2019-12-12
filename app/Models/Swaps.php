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
    date_default_timezone_set('Asia/Karachi');
    $time = new DateTime("now");

        $time = $time->format("Y-m-d H:i:s a");


    // $swaps =  DB::table('swaps')->where(['poster_user_id' => $user_id])->orWhere(function($query) use ($user_id) {
    //   return  $query->orWhere(['swaped_with_user_id' => $user_id]);
    // })->Where(['is_accepted' => 1])
    // //->where("time_to_sec(timediff($time,'swaps.time_of_swap' ))/60",'>',30)

    // ->leftjoin('users',['users.user_id' => 'swaps.poster_user_id' ])

    // ->leftjoin('statuses',['statuses.status_id' => 'swaps.status_id'])

    // ->leftjoin('users as swaped_with',['swaped_with.user_id' => 'swaps.swaped_with_user_id'])

    // ->leftjoin('rattings',['rattings.status_id' => 'swaps.status_id'])
    // ->leftjoin('statuslikes','statuslikes.status_id','=','swaps.status_id')
    // ->leftjoin('status_shares','status_shares.status_id','=','swaps.status_id')
    // ->leftjoin('status_comments','status_comments.status_id','=','swaps.status_id')
    // ->select('statuslikes.user_id','swap_id','swaps.is_accepted','users.user_id as poster_user_id','swaped_with.user_id as swaped_with_user_id',

    // 'users.name as poster_user_name','swaped_with.name as swaped_with_user_name', 'status','has_attachment','attachments',

    // 'swaps.status_id','swaps.created_at as swap_date', 'users.profile_image as poster_profile_image', 'swaped_with.profile_image as swaped_with_profile_image',

    // DB::raw("avg(ratting) as avg_ratting"), DB::raw("IF(swaps.poster_user_id = '".$user_id."','true', 'false') as isMe"), DB::raw("count(statuslikes.id) as likes_count"), DB::raw("count(status_shares.id) as shares_count"), DB::raw("count(status_comments.id) as comments_count"),
    // DB::raw("IF(statuslikes.user_id = '".$user_id."','true', 'false') as isLiked"))

    // ->groupby('statuslikes.user_id')
    // ->groupby('swap_id')
    // ->groupby('swaps.is_accepted')
    // ->groupby('users.user_id')
    // ->groupby('swaped_with.user_id')
    // ->groupby('users.name')
    // ->groupby('swaped_with.name')
    // ->groupby('status')
    // ->groupby('has_attachment')
    // ->groupby('attachments')
    // ->groupby('swaps.created_at')
    // ->groupby('users.profile_image')
    // ->groupby('swaped_with.profile_image')
    // ->groupby('swaps.status_id')
    // ->groupby('swaps.poster_user_id')
    // ->orderby('swap_id','DESC');

        $swaps = DB::select("



        SELECT time_to_sec(timediff('$time',time_of_swap))/60 as timer,
IF(swaps.poster_user_id = '$user_id','true','false') as isMe,
statuslikes.user_id,swap_id,swaps.is_accepted,users.user_id as poster_user_id,swaped_with.user_id as swaped_with_user_id,users.name as poster_user_name,swaped_with.name as swaped_with_user_name,status,has_attachment,
attachments,swaps.status_id,swaps.created_at as swap_date,users.profile_image as poster_profile_image,
swaped_with.profile_image as swaped_with_profile_image,



(select count(*) from status_tags WHERE status_tags.status_id = statuses.`status_id`) as tag_count,
(select users.name from status_tags LEFT JOIN users on users.user_id = status_tags.`tagged_user_id` WHERE status_tags.status_id = statuses.`status_id` LIMIT 1) as first_tag,
(select avg(rattings.ratting) from rattings WHERE rattings.status_id = statuses.status_id) as avg_ratting,
(select count(*) from statuslikes WHERE statuslikes.`status_id` = statuses.`status_id`) as likes_count,
(select count(*) from statuslikes WHERE statuslikes.`status_id` = statuses.`status_id` AND statuslikes.`user_id` = '$user_id') as isLiked,

(select count(*) from status_shares WHERE status_shares.`status_id` = statuses.`status_id`) as shares_count,
(select count(*) from status_comments WHERE status_comments.`status_id` = statuses.`status_id`) as comments_count

FROM swaps
LEFT JOIN users on users.user_id = `poster_user_id`
LEFT JOIN statuses on statuses.`status_id` = swaps.`status_id`
LEFT JOIN users as swaped_with on swaped_with.`user_id` = swaps.`swaped_with_user_id`
LEFT JOIN statuslikes on statuslikes.`status_id` = swaps.`status_id`


where (poster_user_id = '$user_id' and time_to_sec(timediff('$time',time_of_swap))/60 < 1440 and is_accepted = 1) or (swaped_with_user_id = '$user_id' and time_to_sec(timediff('$time',time_of_swap))/60 < 1440 and is_accepted = 1);







        ", [1]);



#LEFT JOIN rattings on rattings.`status_id` = swaps.`status_id`
/* LEFT JOIN statuslikes on statuslikes.`status_id` = swaps.`status_id`
LEFT JOIN status_shares on status_shares.`status_id` = swaps.`status_id`
LEFT JOIN status_comments on status_comments.`status_id` = swaps.`status_id` */


        return $swaps;

    }
}
