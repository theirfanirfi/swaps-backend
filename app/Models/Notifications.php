<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Notifications extends Model
{
    //
    protected $table = "notifications";
    protected $primaryKey = "notification_id";

    public function getNotifications($user_id)
    {
        $followed = DB::table('notifications')->where(['followed_id' => $user_id, 'isAction' => 1])->where('action_by', '!=', $user_id)
            ->leftjoin('users', ['users.user_id' => 'notifications.action_by'])
            ->leftjoin('statuses', ['statuses.status_id' => 'notifications.status_id'])
            ->select(
                'notifications.status_id',
                'isAccepted',
                'swap_id',
                'swaper_id',
                'name',
                'profile_image',
                'isStatus',
                'isFollow',
                'notification_id',
                'notifications.created_at',
                'follower_id',
                'isLike',
                'isComment',
                'isShare',
                'isTag',
                'isRatting',
                'isAction',
                'action_by',
                'status'
            )
            ->orderby('notification_id', 'DESC');

        //  $swaps = DB::table('notifications')->where(['swaped_with_id' => $user_id])
        //  ->leftjoin('users',['users.user_id' => 'notifications.swaper_id'])
        //  ->select('status_id','isAccepted','swap_id','swaper_id','name','profile_image','isStatus','isFollow','notification_id','notifications.created_at','follower_id')
        //  ->orderby('notification_id','DESC');
        // $rejected =  $swaps = DB::table('notifications')->where(['swaper_id' => $user_id,'isAccepted' => 2])
        // ->leftjoin('users',['users.user_id' => 'notifications.swaper_id'])->select('status_id','isAccepted','swap_id','swaper_id','name','profile_image','isStatus','isFollow','notification_id','notifications.created_at');

        return $notifications =  $followed;
        //return $notifications->union($rejected);

    }

    public function getNotificationsForReactWeb($user_id)
    {
        $actionNotifications = DB::select("

        SELECT users.name, users.profile_image, statuses.`status`,statuses.has_attachment,statuses.attachments,
        statuses.user_id,statuses.status_id,notifications.created_at as notification_created_at,statuses.created_at as status_created_at, is_users_tagged,notification_id,
        isAccepted,swap_id,swaper_id,isStatus,isFollow,follower_id,
        isLike,isComment,isShare,isTag,isRatting,isAction,action_by,
(select count(*) from status_tags WHERE status_tags.status_id = statuses.`status_id`) as tag_count,
(select users.name from status_tags LEFT JOIN users on users.user_id = status_tags.`tagged_user_id` WHERE status_tags.status_id = statuses.`status_id` LIMIT 1) as first_tag,
(select avg(rattings.ratting) from rattings WHERE rattings.status_id = statuses.status_id) as ratting,
(select count(*) from statuslikes WHERE statuslikes.`status_id` = statuses.`status_id`) as likes_count,
(select count(*) from statuslikes WHERE statuslikes.`status_id` = statuses.`status_id` AND statuslikes.`user_id` = $user_id) as isLiked,

(select count(*) from status_shares WHERE status_shares.`status_id` = statuses.`status_id`) as shares_count,
(select count(*) from status_comments WHERE status_comments.`status_id` = statuses.`status_id`) as comments_count

FROM notifications
LEFT JOIN users on users.user_id = notifications.action_by
LEFT JOIN statuses on statuses.status_id = notifications.status_id
LEFT JOIN swaps on swaps.swap_id = notifications.swap_id
WHERE followed_id = $user_id AND isAction = 1 AND action_by != $user_id

        ", [1]);

        return $actionNotifications;
    }


    public function getSwapRequests($user_id)
    {
        $swaps = DB::table('notifications')->where(['swaped_with_id' => $user_id, 'isAccepted' => 0, 'isDeclined' => 0, 'isAction' => 0])
            ->leftjoin('users', ['users.user_id' => 'notifications.swaper_id'])
            ->leftjoin('statuses', ['statuses.status_id' => 'notifications.status_id'])
            ->select(
                'notifications.status_id as n_status_id',
                'statuses.status_id',
                'isAccepted',
                'swap_id',
                'swaper_id',
                'name',
                'profile_image',
                'isStatus',
                'isFollow',
                'notification_id',
                'notifications.created_at',
                'follower_id',
                'status'
            )
            ->orderby('notification_id', 'DESC');
        // $rejected =  $swaps = DB::table('notifications')->where(['swaper_id' => $user_id,'isAccepted' => 2])
        // ->leftjoin('users',['users.user_id' => 'notifications.swaper_id'])->select('status_id','isAccepted','swap_id','swaper_id','name','profile_image','isStatus','isFollow','notification_id','notifications.created_at');

        return $swaps;
        //return $notifications->union($rejected);

    }

    public function getSwapRequestsForReactWeb($user_id)
    {
        //         $requests = DB::select("

        //         SELECT users.name, users.profile_image, statuses.`status`,statuses.has_attachment,statuses.attachments,
        //         statuses.user_id,statuses.status_id,notifications.created_at as notification_created_at,statuses.created_at as status_created_at, is_users_tagged,notification_id,
        //         isAccepted,swap_id,swaper_id,isStatus,isFollow,follower_id,
        // (select count(*) from status_tags WHERE status_tags.status_id = statuses.`status_id`) as tag_count,
        // (select users.name from status_tags LEFT JOIN users on users.user_id = status_tags.`tagged_user_id` WHERE status_tags.status_id = statuses.`status_id` LIMIT 1) as first_tag,
        // (select avg(rattings.ratting) from rattings WHERE rattings.status_id = statuses.status_id) as ratting,
        // (select count(*) from statuslikes WHERE statuslikes.`status_id` = statuses.`status_id`) as likes_count,
        // (select count(*) from statuslikes WHERE statuslikes.`status_id` = statuses.`status_id` AND statuslikes.`user_id` = $user_id) as isLiked,

        // (select count(*) from status_shares WHERE status_shares.`status_id` = statuses.`status_id`) as shares_count,
        // (select count(*) from status_comments WHERE status_comments.`status_id` = statuses.`status_id`) as comments_count

        // FROM notifications
        // LEFT JOIN users on users.user_id = notifications.swaper_id
        // LEFT JOIN statuses on statuses.status_id = notifications.status_id
        // WHERE swaped_with_id = $user_id AND isAccepted = 0 AND isDeclined = 0 AND isAction = 0
        //         ", [1]);

        $requests = DB::select("
        SELECT *, swaper.name as swaper_name, swaper.user_id as swaper_user_id, swaper.profile_image as swaper_profile_image,
(select count(*) from status_tags WHERE status_tags.status_id = statuses.`status_id`) as tag_count,
(select users.name from status_tags LEFT JOIN users on users.user_id = status_tags.`tagged_user_id` WHERE status_tags.status_id = statuses.`status_id` LIMIT 1) as first_tag,
(select avg(rattings.ratting) from rattings WHERE rattings.status_id = statuses.status_id) as ratting,
(select count(*) from statuslikes WHERE statuslikes.`status_id` = statuses.`status_id`) as likes_count,
(select count(*) from statuslikes WHERE statuslikes.`status_id` = statuses.`status_id` AND statuslikes.`user_id` = $user_id) as isLiked,

(select count(*) from status_shares WHERE status_shares.`status_id` = statuses.`status_id`) as shares_count,
(select count(*) from status_comments WHERE status_comments.`status_id` = statuses.`status_id`) as comments_count
 FROM swaps
LEFT JOIN users as poster on poster.user_id = swaps.poster_user_id
LEFT JOIN statuses on statuses.status_id = swaps.status_id
LEFT JOIN users as swaper on swaper.user_id = swaps.swaper_id
where swaped_with_user_id = $user_id and (is_accepted = 0 and is_rejected = 0)

        ", [1]);
        return $requests;
    }

    public function getSwapRequestsNotificationBar($user_id)
    {
        $swaps = DB::table('notifications')->where(['swaped_with_id' => $user_id, 'isAccepted' => 0, 'isDeclined' => 0, 'isAction' => 0, 'isNotificationClicked' => 0])
            ->leftjoin('users', ['users.user_id' => 'notifications.swaper_id'])
            ->select('status_id', 'isAccepted', 'swap_id', 'swaper_id', 'name', 'profile_image', 'isStatus', 'isFollow', 'notification_id', 'notifications.created_at', 'follower_id')
            ->orderby('notification_id', 'DESC');
        // $rejected =  $swaps = DB::table('notifications')->where(['swaper_id' => $user_id,'isAccepted' => 2])
        // ->leftjoin('users',['users.user_id' => 'notifications.swaper_id'])->select('status_id','isAccepted','swap_id','swaper_id','name','profile_image','isStatus','isFollow','notification_id','notifications.created_at');

        return $swaps->orderby('notification_id', 'DESC');
        //return $notifications->union($rejected);

    }
}
