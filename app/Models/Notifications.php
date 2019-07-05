<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Notifications extends Model
{
    //
    protected $table = "notifications";
    protected $primaryKey = "notification_id";

    public function getNotifications($user_id){
     $followed = DB::table('notifications')->where(['followed_id' => $user_id])
     ->leftjoin('users',['users.user_id' => 'notifications.follower_id'])
     ->select('status_id','isAccepted','swap_id','swaper_id','name','profile_image','isStatus','isFollow','notification_id','notifications.created_at','follower_id')
     ->orderby('notification_id','DESC');

     $swaps = DB::table('notifications')->where(['swaped_with_id' => $user_id])
     ->leftjoin('users',['users.user_id' => 'notifications.swaper_id'])
     ->select('status_id','isAccepted','swap_id','swaper_id','name','profile_image','isStatus','isFollow','notification_id','notifications.created_at','follower_id')
     ->orderby('notification_id','DESC');
// $rejected =  $swaps = DB::table('notifications')->where(['swaper_id' => $user_id,'isAccepted' => 2])
// ->leftjoin('users',['users.user_id' => 'notifications.swaper_id'])->select('status_id','isAccepted','swap_id','swaper_id','name','profile_image','isStatus','isFollow','notification_id','notifications.created_at');

     return $notifications =  $followed->union($swaps)->orderby('notification_id','DESC');
     //return $notifications->union($rejected);
     
    }


    public function getSwapRequests($user_id){   
        $swaps = DB::table('notifications')->where(['swaped_with_id' => $user_id, 'isAccepted' => 0, 'isDeclined' => 0])
        ->leftjoin('users',['users.user_id' => 'notifications.swaper_id'])
        ->select('status_id','isAccepted','swap_id','swaper_id','name','profile_image','isStatus','isFollow','notification_id','notifications.created_at','follower_id')
        ->orderby('notification_id','DESC');
   // $rejected =  $swaps = DB::table('notifications')->where(['swaper_id' => $user_id,'isAccepted' => 2])
   // ->leftjoin('users',['users.user_id' => 'notifications.swaper_id'])->select('status_id','isAccepted','swap_id','swaper_id','name','profile_image','isStatus','isFollow','notification_id','notifications.created_at');
   
        return $swaps->orderby('notification_id','DESC');
        //return $notifications->union($rejected);
        
       }
}
