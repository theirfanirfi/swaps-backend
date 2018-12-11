<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\MyClasses\VerifyToken;
use App\Models\Followers;
use App\Models\Swaps;

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

                if($sw->save())
                {
                    return response()->json([
                        'isAuthenticated' => true,
                        'isSwaped' => true,
                        'isAlready' => false,
                    'isError' => false,
                        'message' => 'Status is swaped.'
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
}
