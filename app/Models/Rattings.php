<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Rattings extends Model
{
    //

    protected $table = "rattings";
    protected $primaryKey = "ratting_id";

    public function getRatings($status_id){
        $rating = DB::table('rattings')->where(['rattings.status_id' => $status_id])

        //->leftjoin('statuses',['statuses.status_id' => 'rattings.status_id'])

        ->leftjoin('users',['users.user_id' => 'rattings.ratted_by_user_id'])

       // ->leftjoin('swaps',['swaps.status_id' => 'rattings.status_id'])

        ->select('users.user_id','name','username','profile_image','ratting');
       // ->groupby(['users.user_id','users.name','users.username','users.profile_image','ratting','statuses.status','statuses.created_at','statuses.status_id']);

        return $rating;
    }

    public function getAverageRating($status_id){
        return DB::table('rattings')->where(['status_id' => $status_id])
        ->select(DB::raw("avg(ratting) as avg_rating"));
    }

    public function getStatus($status_id){
        return DB::table('statuses')->where(['status_id' => $status_id])

        ->leftjoin('users',['users.user_id' => 'statuses.user_id'])
        ->select('users.name','users.username','users.profile_image','users.user_id','status','status_id','statuses.created_at','has_attachment','attachments');
    }

    //public function getSwap()
}
