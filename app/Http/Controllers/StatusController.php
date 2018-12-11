<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Auth;
use App\Models\Statuses;
use App\Models\Rattings;
use App\Http\MyClasses\VerifyToken;

class StatusController extends Controller
{
    //

    public function composeStatusPost(Request $req)
    {
        $token = $req->input('token');
        $post = $req->input('status');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);

        if(!$user){
            return response()->json([
                'isAuthenticated' => false
            ]);
        }
        else
        {
            if($post == "")
            {
                return response()->json([
                    'isAuthenticated' => true,
                    'isEmpty' => true,
                    'message' => "Post cannot be empty."
                ]);
            }
            else
            {
                    $status = new Statuses();
                    $status->user_id = $user->user_id;
                    $status->status = $post;
    date_default_timezone_set("Asia/Karachi");
                    $status->posting_time = time();


                    if($status->save())
                    {
                        return response()->json([
                            'isAuthenticated' => true,
                            'isEmpty' => false,
                            'isPosted' => true,
                            'message' => "Status Posted."
                        ]);
                    }
                    else
                    {
                        return response()->json([
                            'isAuthenticated' => true,
                            'isEmpty' => false,
                            'isPosted' => false,
                            'message' => "Error occurred in posting the status, try again."
                        ]);
                    }
            }
        }
    }

    
public function getStatuses(Request $req)
{
        $token = $req->input('token');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);

        if(!$user){
            return response()->json([
                'isAuthenticated' => false
            ]);
        }
        else
        {
            $statuses = new Statuses();
            $st =  $statuses->getStatuses($user->user_id);
            if($st->count() > 0)
            {
                $st = $st->get();
               return response()->json([
                    'isAuthenticated' => true,
                    'isFound' => true,
                     'statuses' => $st,
                    'message' => 'loading....'
                ]);
            }
            else
            {
               return response()->json([
                    'isAuthenticated' => true,
                    'isFound' => false,
                    'message' => 'You have not posted any status yet.'
                ]); 
            }

        }
}

public function rateStatus(Request $req){
    $token = $req->input('token');
    $verify = new VerifyToken();
    $user = $verify->verifyTokenInDb($token);
    $status_id = $req->input('status_id');
    $ratingV = $req->input('rating');

    if(!$user){
        return response()->json([
            'isAuthenticated' => false
        ]);
    }
    else
    {
        if($token == "" || $status_id == "" || $ratingV == ""){
            return response()->json([
                'isAuthenticated' => true,
                'isEmpty' => true,
                'message' => "Arguments required."
            ]);
        } else {
            
          $rating = Rattings::where(['status_id' => $status_id,'ratted_by_user_id'=> $user->user_id]);

          if($rating->count() > 0){

              $rating = $rating->first();
              $rating->ratting = $ratingV;

              if($rating->save()){
                return response()->json([
                    'isAuthenticated' => true,
                    'isEmpty' => false,
                    'isRated' => false,
                    'isAlreadyRated' => true,
                    'message' => "Status rating updated with ".$ratingV. " stars"
                ]);
              } else {

                return response()->json([
                    'isAuthenticated' => true,
                    'isEmpty' => false,
                    'isRated' => false,
                    'isAlreadyRated' => true,
                    'message' => "Error occurred in updating the status rating."
                ]);
              }

          } else {

                $rating = new Rattings();
                $rating->ratted_by_user_id = $user->user_id;
                $rating->status_id = $status_id;
                $rating->ratting = $ratingV;

                if($rating->save()){
                    return response()->json([
                        'isAuthenticated' => true,
                        'isEmpty' => false,
                        'isRated' => true,
                        'isAlreadyRated' => false,
                        'message' => "Status rated with ".$ratingV. " stars"
                    ]);
                } else {
                    return response()->json([
                        'isAuthenticated' => true,
                        'isEmpty' => false,
                        'isRated' => false,
                        'isAlreadyRated' => false,
                        'message' => "Error occurred in rating the status."
                    ]);
                }

          }
        }
    }
}

//time difference
public function check()
{
$date2=date_create("2018-12-08 17:05:08");
$date1=date_create("2018-12-08 22:23:25");
$diff=date_diff($date1,$date2);
echo $diff->format("%y - %m - %d %h %i %s");
}

}
