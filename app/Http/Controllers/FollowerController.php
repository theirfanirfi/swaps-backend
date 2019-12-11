<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\MyClasses\VerifyToken;
use App\Models\Followers;
use App\Models\Swaps;
use App\Models\Notifications;
use App\User;
use DateTime;

class FollowerController extends Controller
{
    //

    public function getFollowers(Request $req)
    {
        $token = $req->input('token');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);
        $status_id = $req->input('status_id');

        if(!$user){
            return response()->json([
                'isAuthenticated' => false
            ]);
        }
        else
        {
            if($status_id == "")
            {
                return response()->json([
                    'isAuthenticated' => true,
                    'isEmpty' => true,
                    'message' => "Status must be provided."
                ]);
            }
            else {
                $followers = new Followers();
                $f = $followers->getFollowed($user->user_id,$status_id);
                $swaps = $followers->getSwaps($user->user_id,$status_id);

                if($f->count() > 0)
                {
                    if($swaps->count() > 0)
                    {
                        $fl = $f->get();
                        $sw = $swaps->get();
                        return response()->json([
                             'isAuthenticated' => true,
                              'isFound' => true,
                             'isFollowersFound' => true,
                              'isSwapsFound' => true,
                              'followers' => $fl,
                              'isSwaps' => true,
                              'swaps' => $sw,
                              'status_id' => $status_id,
                             'message' => 'loading....'
                         ]);
                    }
                    else
                    {
                        $fl = $f->get();
                        $sw = $swaps->get();
                        return response()->json([
                             'isAuthenticated' => true,
                             'isFound' => true,
                             'isSwapsFound' => false,
                             'isFollowersFound' => true,
                              'followers' => $fl,
                              'isSwaps' => false,
                              'swaps' => $sw,
                              'status_id' => $status_id,
                             'message' => 'loading....'
                         ]);
                    }


                }
                else
                {
               return response()->json([
                    'isAuthenticated' => true,
                    'isFound' => false,
                    'status_id' => $status_id,
                    'isFollowersFound' => false,
                    'message' => 'You have not followed any user yet.'
                ]);
                }
            }
        }

    }


    public function swapStatus(Request $req){
        $token = $req->input('token');
        $swaped_with_user_id = $req->input('swaped_with');
        $status_id = $req->input('status_id');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);

        if(!$user){
            return response()->json([
                'isAuthenticated' => false
            ]);
        }
        else if($token == "" || $swaped_with_user_id == "" || $status_id == ""){
            return response()->json([
                'isAuthenticated' => true,
                'isSwaped' => false,
                'isAlready' => false,
                'isError' => false,
                'isEmpty' => true,
                'message' => 'None of the argument can be missing.'
            ]);
        }
        else {
            $swap = Swaps::where(['swaped_with_user_id' => $swaped_with_user_id,'status_id' => $status_id]);
            if($swap->count() > 0) {
                return response()->json([
                    'isAuthenticated' => true,
                    'isSwaped' => false,
                    'isAlready' => true,
                    'isError' => false,
                    'message' => 'Status is already swaped.'
                ]);
            }
            else {

                $sw = new Swaps();
                $sw->poster_user_id = $user->user_id;
                $sw->swaped_with_user_id = $swaped_with_user_id;
                $sw->status_id = $status_id;
                date_default_timezone_set('Asia/Karachi');
                $sw->time_of_swap = new DateTime("now") ;

                if($sw->save())
                {
                $noti = new Notifications();
                $noti->isStatus = 1;
                $noti->status_id = $status_id;
                $noti->swaper_id = $user->user_id;
                $noti->swaped_with_id = $swaped_with_user_id;
                $noti->swap_id = $sw->swap_id;
                $noti->is_accepted = 0;
                $noti->save();

                    return response()->json([
                        'isAuthenticated' => true,
                        'isSwaped' => true,
                        'isAlready' => false,
                        'isError' => false,
                        'message' => 'Status swap request is sent.'
                    ]);
                }
                else
                {
                    return response()->json([
                    'isAuthenticated' => true,
                    'isSwaped' => false,
                    'isAlready' => false,
                    'isError' => true,
                    'message' => 'Error Occurred in swapping the status. Please try again.'
                    ]);
                }
            }
        }
    }



    public function deSwapStatus(Request $req){
        $token = $req->input('token');
        $swaped_with_user_id = $req->input('swaped_with');
        $status_id = $req->input('status_id');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);

        if(!$user){
            return response()->json([
                'isAuthenticated' => false
            ]);
        }
        else if($token == "" || $swaped_with_user_id == "" || $status_id == ""){
            return response()->json([
                'isAuthenticated' => true,
                'isDeSwaped' => false,
                'isError' => false,
                'isEmpty' => true,
                'message' => 'None of the argument can be missing.'
            ]);
        }
        else {
            $swap = Swaps::where(['swaped_with_user_id' => $swaped_with_user_id,'status_id' => $status_id]);
            if($swap->count() > 0) {

                if($swap->delete()){
                    return response()->json([
                        'isAuthenticated' => true,
                        'isDeSwaped' => true,
                        'isError' => false,
                        'isExist' => true,
                        'message' => 'Status is unswaped.'
                    ]);
                }
                else {
                    return response()->json([
                        'isAuthenticated' => true,
                        'isDeSwaped' => false,
                        'isError' => true,
                        'isExist' => true,
                        'message' => "Error occurred in unswaping. Please try again."
                    ]);
                }

            }
            else {
                return response()->json([
                    'isAuthenticated' => true,
                    'isDeSwaped' => false,
                    'isError' => true,
                    'isExist' => false,
                    'message' => "Status does not exist."
                ]);

            }
        }
    }


    public function isfollow(Request $req){
        $token = $req->input('token');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);
        $profile_id = $req->input('id');

        if(!$user){
            return response()->json([
                'isAuthenticated' => false
            ]);
        }
        else
        {
            if($profile_id == "" || $token == "")
            {
                return response()->json([
                    'isAuthenticated' => false,
                    'isEmpty' => true,
                    'message' => "Arguments must be provided."
                ]);
            }
            else {
                $follower = Followers::where(['followed_user_id' => $profile_id, 'follower_user_id' => $user->user_id]);
                if($follower->count() > 0){

                    return response()->json([
                    'isAuthenticated' => true,
                    'isEmpty' => false,
                    'isFollowed' => true,
                    'message' => "Already followed"
                ]);

                }
                else {
              return response()->json([
                                'isAuthenticated' => true,
                                'isEmpty' => false,
                                'isFollowed' => false,
                                'message' => "You have not followed."
                            ]);
                }
            }
        }
    }

    public function follow(Request $req){
          $token = $req->input('token');
        $to_be_followed = $req->input('id');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);

        if(!$user){
            return response()->json([
                'isAuthenticated' => false
            ]);
        }
        else if($token == "" || $to_be_followed == ""){
            return response()->json([
                'isAuthenticated' => true,
                'isError' => true,
                'isEmpty' => true,
                'message' => 'None of the argument can be empty.'
            ]);
        }else {
            $follow = Followers::where(['followed_user_id' => $to_be_followed,'follower_user_id' => $user->user_id]);
            $userr = User::where(['user_id' => $to_be_followed]);
            if($follow->count() > 0){
            return response()->json([
                'isAuthenticated' => true,
                'isError' => true,
                'isEmpty' => false,
                'isAlreadyFollowed' => true,
                'isFollowed' => false,
                'message' => 'You have already followed.'
            ]);
        }
            else if($userr->count() <= 0){
            return response()->json([
                'isAuthenticated' => true,
                'isError' => true,
                'isEmpty' => false,
                'isAlreadyFollowed' => true,
                'isFollowed' => false,
                'message' => 'The user does not exist.'
            ]);
            }else {
                $f = new Followers();
                $f->followed_user_id = $to_be_followed;
                $f->follower_user_id = $user->user_id;
                $user->is_followed = 1;
                $user->followed = $user->followed + 1;
                $user->save();
                if($f->save()){
            return response()->json([
                'isAuthenticated' => true,
                'isError' => false,
                'isEmpty' => false,
                'isAlreadyFollowed' => false,
                'isFollowed' => true,
                'message' => 'You are now following the user.'
            ]);
                }else {
            return response()->json([
                'isAuthenticated' => true,
                'isError' => true,
                'isEmpty' => false,
                'isAlreadyFollowed' => false,
                'isFollowed' => false,
                'message' => 'Error occurred in following the user. Try again.'
            ]);
                }

            }
        }
    }


     public function unfollow(Request $req){
          $token = $req->input('token');
        $to_un_be_followed = $req->input('id');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);

        if(!$user){
            return response()->json([
                'isAuthenticated' => false
            ]);
        }
        else if($token == "" || $to_un_be_followed == ""){
            return response()->json([
                'isAuthenticated' => true,
                'isError' => true,
                'isEmpty' => true,
                'message' => 'None of the argument can be empty.'
            ]);
        }else {
            $follow = Followers::where(['followed_user_id' => $to_un_be_followed,'follower_user_id' => $user->user_id]);
            $userr = User::where(['user_id' => $to_un_be_followed]);
            if($follow->count() <= 0){
            return response()->json([
                'isAuthenticated' => true,
                'isError' => true,
                'isEmpty' => false,
                'isAlreadyUnFollowed' => true,
                'isUnFollowed' => false,
                'message' => 'You have already unfollowed.'
            ]);
        }
            else if($userr->count() <= 0){
            return response()->json([
                'isAuthenticated' => true,
                'isError' => true,
                'isEmpty' => false,
                'isAlreadyUnFollowed' => false,
                'isUnFollowed' => false,
                'message' => 'The user does not exist.'
            ]);
            }else {

                if($follow->delete()){
            return response()->json([
                'isAuthenticated' => true,
                'isError' => false,
                'isEmpty' => false,
                'isAlreadyUnFollowed' => false,
                'isUnFollowed' => true,
                'message' => 'User is unfollowed.'
            ]);
                }else {
            return response()->json([
                'isAuthenticated' => true,
                'isError' => true,
                'isEmpty' => false,
                'isAlreadyFollowed' => false,
                'isFollowed' => false,
                'message' => 'Error occurred in unfollowing the user. Try again.'
            ]);
                }

            }
        }
    }




    //start

        public function getUsers(Request $req){
        $token = $req->input('token');

         if($token == null){
     return response()->json([
                'isAuthenticated' => false,
                'isEmpty' => true,
                'isError' => true,
                'message' => 'Arguments must be provided.'
            ]);
    }else {
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);

        if(!$user){
            return response()->json([
                'isAuthenticated' => false,
                'isEmpty' => false,
                'isError' => true,
                'message' => 'Not authenticated'
            ]);
        }
        else
        {
            $f = new Followers();
            $users = $f->getUsers($user->user_id);
            if($users->count() > 0){

                return response()->json([
                'isAuthenticated' => true,
                'isEmpty' => false,
                'isError' => false,
                'isFound' => true,
                'message' => 'loading..',
                'followers' => $users->get()
            ]);

            }else {
                return response()->json([
                'isAuthenticated' => true,
                'isEmpty' => false,
                'isError' => false,
                'isFound' => false,
                'message' => 'No User found.'
            ]);
            }
        }
    }
    }


    public function getF(){
        $f = new Followers();
        echo $f->getUsersFor(3)->get();
    }

    public function getUsersAtNacentRegisteration(Request $req){
        $token = $req->input('token');
        if($token == null){
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
            $f = new Followers();
            $users = $f->getUsersForAtStartUp($user->user_id);
            if($users->count() > 0){
                return response()->json([
                    'isAuthenticated' => true,
                    'isEmpty' => false,
                    'isFound' => true,
                    'users' => $users->get(),
                    'message' => "loading.."
                ]);
            }else {
                return response()->json([
                    'isAuthenticated' => true,
                    'isEmpty' => false,
                    'isFound' => false,
                    'message' => "No user found at the moment"
                ]);
            }
        }
    }
    }


    public function followed(Request $req){
        $token = $req->input('token');
        $followed_count = $req->input('followed_count');
        if($token == null || $followed_count == null){
            return response()->json([
                'isAuthenticated' => false,
                'isError' => true,
                'message' => "Arguments must be supplied."
            ]);
        }else {
            $verify = new VerifyToken();
            $user = $verify->verifyTokenInDb($token);
        if(!$user){
            return response()->json([
                'isAuthenticated' => false,
                'isError' => true,
                'message' => 'You are not loggedin.'
            ]);
        }
        else{
            $user->is_followed = 1;
            $user->followed = $followed_count;
            if($user->save()){
                return response()->json([
                    'isAuthenticated' => true,
                    'isError' => false,
                    'isUpdated' => true,
                    'message' => "Updated"
                ]);
            }else {
                return response()->json([
                    'isAuthenticated' => true,
                    'isError' => true,
                    'message' => "Error occurred in updating your record. Please try again."
                ]);
            }
        }
    }
    }


    public function getUserFollowers(Request $req){
        $token = $req->input('token');
        $profile_id = $req->input('profile_id');
        if($token == null || $profile_id == null){
            return response()->json([
                'isAuthenticated' => false,
                'isError' => true,
                'isEmpty' => true,
                'message' => "Arguments must be supplied."
            ]);
        }else {
            $verify = new VerifyToken();
            $user = $verify->verifyTokenInDb($token);
        if(!$user){
            return response()->json([
                'isAuthenticated' => false,
                'isError' => true,
                'isEmpty' => false,
                'message' => 'You are not loggedin.'
            ]);
        }
        else{
            $f = new Followers();
            $followers = $f->getUserFollowers($user->user_id,$profile_id);
            if($followers->count() > 0){
                return response()->json([
                    'isFound' => true,
                    'isAuthenticated' => true,
                    'isError' => false,
                'isEmpty' => false,
                    'users' => $followers->get(),
                    'message' => 'Loading...'

                ]);
            }else {
                return response()->json([
                    'isFound' => false,
                    'isAuthenticated' => true,
                    'isError' => false,
                    'message' => 'User has no followers.',
                'isEmpty' => false
                ]);
            }
        }
    }
    }
}
