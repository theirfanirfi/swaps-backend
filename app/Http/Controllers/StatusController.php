<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Auth;
use App\Models\Statuses;
use App\Models\Rattings;
use App\Models\Swaps;
use App\Models\Attachments;
use App\Http\MyClasses\VerifyToken;
use App\User;
use App\UsersTaggedInStatus;

class StatusController extends Controller
{
    //

    public function getStatus(Request $req){
        $token = $req->input('token');
        $status_id = $req->input('status_id');
        //echo $token;
        if($token == null || $status_id == null){
            return response()->json([
                'isAuthenticated' => false,
                'isError' => true,
                'isEmpty' => true,
                'message' => "Arguments must be provided."
            ]);
        }else {
            $verify = new VerifyToken();
            $user = $verify->verifyTokenInDb($token);
            if(!$user){
                return response()->json([
                    'isAuthenticated' => false,
                    'message' => "You are not loggedin. Please login and try again."
                ]);
            }else {
                $status = Statuses::where(['status_id' => $status_id]);
                if($status->count() > 0){
                    return response()->json([
                        'isAuthenticated' => true,
                        'isError' => false,
                        'isEmpty' => false,
                        'isFound' => true,
                        'obj_status'  => $status->first(),
                        'message' => "loading..."
                    ]);
                }else {
                    return response()->json([
                        'isAuthenticated' => true,
                        'isError' => true,
                        'isEmpty' => false,
                        'message' => "No status found."
                    ]);

                }

            }
        }


    }

    public function composeStatusPost(Request $req)
    {
        $token = $req->input('token');
        $statuss = $req->input('status');

        if($token == null || $statuss == null){
            return response()->json([
                'isAuthenticated' => false,
                'isEmpty' => true,
                'message' => "Arguments must be supplied."
            ]);
        }else {

            $verify = new VerifyToken();
            $user = $verify->verifyTokenInDb($token);
        if(!$user){
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'You are not loggedin.'
            ]);
        }
        else
        {
                    $status = new Statuses();
                    $status->user_id = $user->user_id;
                    $status->status = $statuss;
                    date_default_timezone_set("Asia/Karachi");
                    $status->posting_time = time();


                    if($status->save()){
                        return response()->json([
                            'isAuthenticated' => true,
                            'isEmpty' => false,
                            'isPosted' => true,
                            'obj_status' => $status,
                            'message' => "Status Posted."
                        ]);
                    }
                    else {
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
            if(sizeof($st) > 0)
            {
                //$st = $st->get();
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
                    'message' => 'You have not posted any status yet. '.$user->user_id
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


public function deleteStatus(Request $req){
    $token = $req->input('token');
    $verify = new VerifyToken();
    $user = $verify->verifyTokenInDb($token);
    $status_id = $req->input('status_id');

    if(!$user){
        return response()->json([
            'isAuthenticated' => false
        ]);
    }
    else {
        if($token == "" || $status_id == ""){
            return response()->json([
                'isAuthenticated' => true,
                'isEmpty' => true,
                'message' => "Arguments required."
            ]);
        } else {
            $status = Statuses::where(['status_id' => $status_id]);
            if($status->count() > 0){

                $swaps = Swaps::where(['status_id' => $status_id]);
                $ratings = Rattings::where(['status_id' => $status_id]);

                if($swaps->count() > 0){
                    $swaps->delete();
                }

                if($ratings->count() > 0){
                    $ratings->delete();
                }

                $status = $status->first();
                if($status->delete()){
                    return response()->json([
                        'isAuthenticated' => true,
                        'isEmpty' => false,
                        'isFound' => true,
                        'isDeleted' => true,
                        'message' => "Status deleted."
                    ]);
                } else {
                    return response()->json([
                        'isAuthenticated' => true,
                        'isEmpty' => false,
                        'isFound' => true,
                        'isDeleted' => false,
                        'message' => "Error occurred in deleting the status."
                    ]);
                }
            }
            else {

            return response()->json([
                'isAuthenticated' => true,
                'isEmpty' => false,
                'isFound' => false,
                'isDeleted' => false,
                'message' => "Status does not exist."
            ]);

            }
        }
    }
}


public function getUserStatuses(Request $req)
{
        $user_id = $req->input('id');

            $statuses = new Statuses();
            $st =  $statuses->getUserStatuses($user_id);
            if($st->count() > 0){
                $st = $st->get();
               return response()->json([
                     'isAuthenticated' => true,
                     'isFound' => true,
                     'statuses' => $st,
                     'message' => 'loading....'
                ]);
            }
            else{
               return response()->json([
                    'isAuthenticated' => true,
                    'isFound' => false,
                    'message' => 'The User has not posted any status yet.'
                ]);
            }

}


public function getStatusAttachments(Request $req){
    $token = $req->input('token');
    $verify = new VerifyToken();
    $user = $verify->verifyTokenInDb($token);
    $status_id = $req->input('status_id');

    if($token == null || $status_id == null){
        return response()->json([
            'isError' => true,
            'isEmtpy' => true,
            'message' => 'Arguments must be provided.'
        ]);
    }
    else {
    if(!$user){
        return response()->json([
            'isAuthenticated' => false,
            'isError' => true,
            'message' => 'You are not loggedin. Please login and try again.'
        ]);
    }
    else if(!$verify->BelongToUserOrNot($status_id,$user->user_id)){
            return response()->json([
            'isAuthenticated' => true,
            'isError' => true,
            'message' => 'The status does not belong to you.'
        ]);
    }
    else {
        $attachments = Attachments::where(['status_id' => $status_id]);

        if($attachments->count() > 0){
            $att = $attachments->get();
            return response()->json([
            'isAuthenticated' => true,
            'isError' => false,
            'isFound' => true,
            'attachments' => $att,
            'message' => 'The attachments are being loaded..'
        ]);
        }else {
            return response()->json([
            'isAuthenticated' => true,
            'isError' => false,
            'isFound' => false,
            'message' => 'The status has no attachments'
        ]);
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

public function discoverStatuses(Request $req)
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
            $st =  $statuses->discoverStatuses($user->user_id);
            if($st->count() > 0)
            {
                $st = $st->limit(50)->get();
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


/////////// tag

public function composeStatusTagPost(Request $req)
{
    $token = $req->input('token');
    $statuss = $req->input('status');
    $tags = $req->input('tags');
    $tags = json_decode($tags);


    if($token == null || $statuss == null){
        return response()->json([
            'isAuthenticated' => false,
            'isEmpty' => true,
            'message' => "Arguments must be supplied."
        ]);
    }else {

        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);
    if(!$user){
        return response()->json([
            'isAuthenticated' => false,
            'message' => 'You are not loggedin.'
        ]);
    }
    else
    {
                $status = new Statuses();
                $status->user_id = $user->user_id;
                $status->status = $statuss;
                date_default_timezone_set("Asia/Karachi");
                $status->posting_time = time();
                $status->is_users_tagged = 1;


                if($status->save()){


                    if(sizeof($tags) > 0){

                        foreach($tags as $a){
                            $t = new UsersTaggedInStatus();
                            $t->status_id = $status->status_id;
                            $t->tagged_user_id = $a;
                            $t->save();
                        }

                    }


                    return response()->json([
                        'isAuthenticated' => true,
                        'isEmpty' => false,
                        'isPosted' => true,
                        'obj_status' => $status,
                        'message' => "Status Posted."
                    ]);
                }
                else {
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

}
