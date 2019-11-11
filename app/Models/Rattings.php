<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Exception;

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

    public function getStatus($status_id,$user_id){
        $status =  DB::table('statuses')->where(['statuses.status_id' => $status_id])
        ->leftjoin('users',['users.user_id' => 'statuses.user_id'])
        ->leftjoin('statuslikes','statuslikes.status_id','=','statuses.status_id')
        ->leftjoin('status_shares','status_shares.status_id','=','statuses.status_id')
        ->leftjoin('status_comments','status_comments.status_id','=','statuses.status_id')
        ->select('statuslikes.user_id','users.name','users.username','users.profile_image','users.user_id','status','statuses.status_id','statuses.created_at','has_attachment','attachments', DB::raw("count(statuslikes.id) as likes_count"), DB::raw("count(status_shares.id) as shares_count"), DB::raw("count(status_comments.id) as comments_count"),
        DB::raw("IF(statuslikes.user_id = '".$user_id."',1, 0) as isLiked"))
        ->groupby('statuslikes.user_id')
        ->groupby('users.name')
        ->groupby('users.username')
        ->groupby('users.profile_image')
        ->groupby('users.user_id')
        ->groupby('status')
        ->groupby('statuses.status_id')
        ->groupby('statuses.created_at')
        ->groupby('has_attachment')
        ->groupby('attachments');
        return $status;
    }

    public static function rateStatus($status_id,$user_id,$rating,$followed_id){
        DB::beginTransaction();
        try{

            DB::insert('insert into rattings (ratted_by_user_id,status_id,ratting) values (?, ?,?)', [$user_id,$status_id,$rating]);
            DB::insert('insert into notifications (isRatting,isAction,status_id,action_by,followed_id) values (?,?,?,?,?)', [1, 1,$status_id,$user_id,$followed_id]);
            DB::commit();
            return true;

        }catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
