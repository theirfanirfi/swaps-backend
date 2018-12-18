<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\MyClasses\VerifyToken;
use App\Models\Notifications;
use App\Models\Swaps;

class NotificationController extends Controller
{
    //

    public function getNotifications(Request $req){
        $token = $req->input('token');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);

        if(!$user){
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'Not authenticated'
            ]);
        }
        else{
            $n = new Notifications();
            $noc = $n->getNotifications($user->user_id);
            if($noc->count() > 0){
                $n = $noc->get();
            return response()->json([
                'isAuthenticated' => true,
                'isFound' => true,
                'notifications' => $n
            ]);
            }else {
                return response()->json([
                    'isAuthenticated' => true,
                    'isFound' => false,
                ]);
            }
        }
    }

    
    public function getNotificationsCount(Request $req){
        $token = $req->input('token');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);

        if(!$user){
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'Not authenticated'
            ]);
        }
        else{
            $n = new Notifications();
            $n = $n->getNotifications($user->user_id)->count();
            return response()->json([
                'isAuthenticated' => true,
                'notifications_count' => $n
            ]);
        }

    }

    public function approveSwap(Request $req){
        $token = $req->input('token');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);
        $swap_id = $req->input('swap_id');

        if(!$user){
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'Not authenticated'
            ]);
        }
        else{

            if($token == null || $swap_id == null){
                return response()->json([
                    'isAuthenticated' => true,
                    'isError' => true, 
                    'isEmpty' => true, 
                    'message' => 'Arguments must be provide.'
                ]);
            }else {
                $swap = Swaps::where(['swap_id' => $swap_id]);
                $notification = Notifications::where(['swap_id' => $swap_id]);
                if($swap->count() > 0 && $notification->count() > 0){

                    $swap = $swap->first();
                    $notification = $notification->first();

                    $swap->is_accepted = 1;
                    $notification->isAccepted = 1;

                    if($swap->save() && $notification->save()){
                        return response()->json([
                            'isAuthenticated' => true,
                            'isError' => false, 
                            'isEmpty' => false, 
                            'isApproved' => true,
                            'message' => 'Swap Accepted.'
                        ]);
                    }else {
                        return response()->json([
                            'isAuthenticated' => true,
                            'isError' => true, 
                            'isEmpty' => false, 
                            'isApproved' => false,
                            'message' => 'Error occurred in accepting the Swap. Try again.'
                        ]);
                    }

                   

                }else {
                    return response()->json([
                        'isAuthenticated' => true,
                        'isError' => true, 
                        'isEmpty' => false, 
                        'message' => 'No Swap found.'
                    ]);
                   
                }
                
            }
        }
    }

    public function clear(Request $req){
        $token = $req->input('token');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);
        $notification_id = $req->input('id');

        if(!$user){
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'Not authenticated'
            ]);
        }
        else{

            if($token == null || $notification_id == null){
                return response()->json([
                    'isAuthenticated' => true,
                    'isError' => true, 
                    'isEmpty' => true, 
                    'message' => 'Arguments must be provide.'
                ]);
            }else {
                $no = Notifications::where(['notification_id' => $notification_id]);
                if($no->count() > 0){

                    if($no->delete()){
                        return response()->json([
                            'isAuthenticated' => true,
                            'isError' => false, 
                            'isEmpty' => false, 
                            'isCleared' => true,
                            'message' => 'Notification Cleared.'
                        ]);
                    }else {
                        return response()->json([
                            'isAuthenticated' => true,
                            'isError' => true, 
                            'isEmpty' => false, 
                            'isCleared' => false,
                            'message' => 'Error occurred in clearing the Notification. Try again.'
                        ]);
                    }
                   
                }else {
                    return response()->json([
                        'isAuthenticated' => true,
                        'isError' => false, 
                        'isEmpty' => false, 
                        'isCleared' => false,
                        'message' => 'Error occurred in clearing the Notification. Try again.'
                    ]);
                }
            }
        }
    }
}
