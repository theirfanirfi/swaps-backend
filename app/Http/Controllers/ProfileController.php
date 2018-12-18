<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\MyClasses\VerifyToken;
use App\User;
use App\Models\Swaps;
use App\Models\Statuses;
use App\Models\Followers;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function updateImage(Request $req){

        $token = $req->input('token');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);

        if(!$user){
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'Not authenticated'
            ]);
        }
        else
        {
             
        if(!$req->hasFile('image') || $token == ""){
            return response()->json([
                'isEmpty' => true,
                'isError' => true,
                'isAuthenticated' => true,
                'message' => 'Either image or arugment is not provided.'
            ]);
            }else {
    
                $file = $req->file('image');
                $path = "./profile/";
                $file_name = $file->getClientOriginalName();
                $user_id = $user->user_id;
                if($file->move($path,$file_name)){
                    $u = User::find($user_id);
                    $u->profile_image = asset("profile/")."/".$file_name;

                    if($u->save()){

                        return response()->json([
                            'isEmpty' => false,
                            'isError' => false,
                            'isAuthenticated' => true,
                            'isMoved' => true,
                            'isSaved' => true,
                            'user' => $u,
                            'message' => 'Profile Image changed.'
                        ]);
                    } else {

                        return response()->json([
                            'isEmpty' => false,
                            'isError' => false,
                            'isAuthenticated' => true,
                            'isMoved' => true,
                            'isSaved' => false,
                            'message' => 'Error occurred in saving the image. Try again.'
                        ]);
                    }
                } else {
                    return response()->json([
                            'isEmpty' => false,
                            'isError' => true,
                            'isAuthenticated' => true,
                            'isMoved' => false,
                            'isSaved' => false,
                            'message' => 'Error occurred in saving the image. Try again.'
                    ]);
                }

            }
        }

    }

    public function updateDescription(Request $req){
        $token = $req->input('token');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);
        $desc = $req->input('description');

        if(!$user){
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'Not authenticated'
            ]);
        }
        else{
            if($token == "" || $desc == ""){
                return response()->json([
                    'isEmpty' => true,
                    'isError' => true,
                    'isAuthenticated' => true,
                    'message' => 'Arguments required.'
                ]);
            } else {
                $user->profile_description = $desc;
                if($user->save()){
                    return response()->json([
                        'isEmpty' => false,
                        'isError' => false,
                        'isAuthenticated' => true,
                        'isUpdated' => true,
                        'user' => $user,
                        'message' => 'Description updated.'
                    ]);
                } else {
                    return response()->json([
                        'isEmpty' => false,
                        'isError' => true,
                        'isAuthenticated' => true,
                        'isUpdated' => false,
                        'message' => 'Error occurred in updating the description. Try again.'
                    ]);
                }
            }
        }
    }

    public function getProfileStats(Request $req){
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
            if($token == ""){
                return response()->json([
                    'isEmpty' => true,
                    'isError' => true,
                    'isAuthenticated' => true,
                    'message' => 'Arguments required.'
                ]);
            } else {
                $swaps = Swaps::where(['poster_user_id' => $user->user_id])->count();
                $status = Statuses::where(['user_id' => $user->user_id])->count();
                $followers = Followers::where(['followed_user_id' => $user->user_id])->count();

                return response()->json([
                    'isEmpty' => false,
                    'isError' => false,
                    'isFound' => true,
                    'swaps' => $swaps,
                    'statuses' => $status,
                    'followers' => $followers,
                    'isAuthenticated' => true,
                ]);
            }
        }
    }

    public function getProfileUserStats(Request $req){
        $user_id = $req->input('id');
            if($user_id == ""){
                return response()->json([
                    'isEmpty' => true,
                    'isError' => true,
                    'isAuthenticated' => true,
                    'message' => 'Arguments required.'
                ]);
            } else {
                $swaps = Swaps::where(['poster_user_id' => $user_id])->count();
                $status = Statuses::where(['user_id' => $user_id])->count();
                $followers = Followers::where(['followed_user_id' => $user_id])->count();
                $user = User::where(['user_id' => $user_id])->select('profile_image','name','user_id')->first();

                return response()->json([
                    'isEmpty' => false,
                    'isError' => false,
                    'isFound' => true,
                    'swaps' => $swaps,
                    'statuses' => $status,
                    'followers' => $followers,
                    'user' => $user,
                    'isAuthenticated' => true,
                ]);
            }
        
    }
    public function updateProfileDetails(Request $req){
        $token = $req->input('token');
        $name = $req->input('name');
        $username = $req->input('username');
        $email = $req->input('email');

        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);
        if(!$user){
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'Not authenticated'
            ]);
        }
        else{
            if($token == "" || $name == "" || $username == "" || $email == ""){
                return response()->json([
                    'isEmpty' => true,
                    'isError' => true,
                    'isAuthenticated' => true,
                    'message' => 'Arguments required.'
                ]);
            } else {
                $user->name = $name;
                $user->username = $username;
                $user->email = $email;
                if($user->save()){
                    return response()->json([
                        'isEmpty' => false,
                        'isError' => false,
                        'isAuthenticated' => true,
                        'isUpdated' => true,
                        'user' => $user,
                        'message' => 'Changes made.'
                    ]);
                } else {
                    return response()->json([
                        'isEmpty' => false,
                        'isError' => true,
                        'isAuthenticated' => true,
                        'isUpdated' => false,
                        'message' => 'Error occurred in making the changes. Try again.'
                    ]);
                }
            }
        }
    }

    public function changePassword(Request $req){
        $token = $req->input('token');
        $newpass = $req->input('newpass');
        $confirmpass = $req->input('confirmpass');
        $oldpass = $req->input('oldpass');

        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);
        if(!$user){
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'Not authenticated'
            ]);
        }
        else{
            if($token == "" || $newpass == "" || $confirmpass == "" || $oldpass == ""){
                return response()->json([
                    'isEmpty' => true,
                    'isError' => true,
                    'isNotMatched' => false,
                    'isAuthenticated' => true,
                    'message' => 'Arguments required.'
                ]);
            } else if($confirmpass != $newpass) {
                return response()->json([
                    'isEmpty' => false,
                    'isError' => true,
                    'isNotMatched' => true,
                    'isOldPasswordInCorrect' => false,
                    'isAuthenticated' => true,
                    'message' => 'New and Confirm Password do not match.'
                ]);
            }else if(strlen($newpass) < 6){
                return response()->json([
                    'isEmpty' => false,
                    'isError' => true,
                    'isNotMatched' => false,
                    'isOldPasswordInCorrect' => false,
                    'isAuthenticated' => true,
                    'isLengthError' => true,
                    'message' => 'New Password Length must be at least characters Long.'
                ]);
            } else if(Hash::check($oldpass,$user->password)){
                    $user->password = Hash::make($newpass);
                    if($user->save()){
                        return response()->json([
                            'isEmpty' => false,
                            'isError' => false,
                            'isNotMatched' => false,
                            'isOldPasswordInCorrect' => false,
                            'isAuthenticated' => true,
                            'isChanged' => true,
                            'message' => 'Password Changed.'
                        ]);
                    }else {
                        return response()->json([
                            'isEmpty' => false,
                            'isError' => true,
                            'isNotMatched' => false,
                            'isOldPasswordInCorrect' => false,
                            'isAuthenticated' => true,
                            'isChanged' => false,
                            'message' => 'Error Occurred in changing the password. Try again.'
                        ]);
                    }
            }else {
                return response()->json([
                    'isEmpty' => false,
                    'isError' => true,
                    'isNotMatched' => false,
                    'isOldPasswordInCorrect' => true,
                    'isAuthenticated' => true,
                    'message' => 'Current Password is Incorrect.'
                ]);
            }
        }
    }
}
