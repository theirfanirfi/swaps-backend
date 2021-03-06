<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\MyClasses\VerifyToken;
use App\Models\Statuses;
use App\User;

class SearchController extends Controller
{
    //search statuse for react tab


    public function searchStatusesForReactTab(Request $req){
        $token = $req->input('token');
        $search = $req->input('search');

        if($token == null || $search == null){
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
          $statuses = Statuses::searchStatusesForReact($search,$user->user_id);
         // echo sizeof($statuses);
           if(sizeof($statuses) > 0){
               return response()->json([
                'statuses' => $statuses,
                'isAuthenticated' => true,
                'isFound' => true,
                'message' => 'loading....'
               ]);
           }else {
            return response()->json([
                'isAuthenticated' => true,
                'isFound' => false,
                'message' => 'No such statuses found.'
               ]);
           }
       }
    }
    }



    public function searchStatuses(Request $req){
        $token = $req->input('token');
        $search = $req->input('search');

        if($token == null || $search == null){
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
           $st = new Statuses();
           $statuses = $st->searchStatuses($search,$user->user_id);
           if($statuses->count() > 0){
               return response()->json([
                'statuses' => $statuses->get(),
                'isAuthenticated' => true,
                'isFound' => true,
                'message' => 'loading....'
               ]);
           }else {
            return response()->json([
                'isAuthenticated' => true,
                'isFound' => false,
                'message' => 'loading....'
               ]);
           }
       }
    }
    }


    public function searchUsers(Request $req){
        $token = $req->input('token');
        $search = $req->input('search');

        if($token == null || $search == null){
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
           //echo "controller : ".$user->user_id;
           $userr = new User();
           $users = $userr->searchUsers($search,$user->user_id);
           if($users->count() > 0){
               return response()->json([
                'users' => $users->get(),
                'isAuthenticated' => true,
                'isFound' => true,
                'message' => 'loading....'
               ]);
           }else {
            return response()->json([
                'isAuthenticated' => true,
                'isFound' => false,
                'message' => 'loading....'
               ]);
           }
       }
    }
    }



    public function searchUsersForReactTab(Request $req){
        $token = $req->input('token');
        $search = $req->input('search');

        if($token == null || $search == null){
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
           //echo "controller : ".$user->user_id;

           $users = User::searchUsersForReact($search,$user->user_id);
           if(sizeof($users) > 0){
               return response()->json([
                'users' => $users,
                'isAuthenticated' => true,
                'isFound' => true,
                'message' => 'loading....'
               ]);
           }else {
            return response()->json([
                'isAuthenticated' => true,
                'isFound' => false,
                'message' => 'loading....'
               ]);
           }
       }
    }
    }
}
