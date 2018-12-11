<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Swaps extends Model
{
    //

    protected $table = "swaps";
    protected $primaryKey = "swap_id";

    public function getSwapsTab($user_id){

    $swaps =  DB::table('swaps')->where(['poster_user_id' => $user_id])->orWhere(['swaped_with_user_id' => $user_id])

    ->leftjoin('users',['users.user_id' => 'swaps.poster_user_id' ])

    ->leftjoin('statuses',['statuses.status_id' => 'swaps.status_id'])

    ->leftjoin('users as swaped_with',['swaped_with.user_id' => 'swaps.swaped_with_user_id'])

    ->leftjoin('rattings',['rattings.status_id' => 'swaps.status_id'])
    
    ->select('swap_id','users.user_id as poster_user_id','swaped_with.user_id as swaped_with_user_id',

    'users.name as poster_user_name','swaped_with.name as swaped_with_user_name', 'status',

    'swaps.status_id','swaps.created_at as swap_date', 'users.profile_image as poster_profile_image', 'swaped_with.profile_image as swaped_with_profile_image',
    
    DB::raw("avg(ratting) as avg_ratting"), DB::raw("IF(swaps.poster_user_id = '".$user_id."','true', 'false') as isMe"))
   
    ->groupby('swap_id')
    ->groupby('users.user_id')
    ->groupby('swaped_with.user_id')
    ->groupby('users.name')
    ->groupby('swaped_with.name')
    ->groupby('status')
    ->groupby('swaps.created_at')
    ->groupby('users.profile_image')
    ->groupby('swaped_with.profile_image')
    ->groupby('swaps.status_id')
    ->groupby('swaps.poster_user_id');
        return $swaps;

    }
}
