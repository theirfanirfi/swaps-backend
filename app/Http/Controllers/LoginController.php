<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    //

    public function login($data)
    {
        $arr = base64_decode($data);
        $arr = json_decode($arr);

        $email = $arr[0];
        $password = $arr[1];

        if($email == "" || $password == "")
        {
            return response()->json([
                'isError' => true,
                'isUser' => false,
                'user' => false,
                'tokenError' => false,
                'message' => 'None of the field can be empty'
            ]);
        }
        else
        {
            if(Auth::attempt(['email'=>$email, 'password' => $password]))
            {

                $user = User::where(['email' => $email])->first();
                $token = Hash::make(base64_encode($user->name.":".time()));
                $user->token = base64_encode($token);
                if($user->save()){
                return response()->json([
                    'isError' => false,
                    'isUser' => true,
                    'user' => $user,
                    'tokenError' => false,
                    'token' => $token,
                    'message' => 'Login was successful'
                ]);
                }
                else {
                  return response()-json([
                    'isError' => false,
                    'isUser' => true,
                    'user' => false,
                    'tokenError' => true,
                    'token' => false,
                    'message' => 'Login was successful'
                  ]);
                }
            }
            else
            {
                return response()->json([
                'isError' => true,
                'isUser' => false,
                'user' => false,
                'tokenError' => false,
                'message' => 'Entered User credentials are incorrect.'
                ]);
            }
        }


    }

    public function register($data)
    {
        // $email = $req->query('email');
        // $password = $req->query('password');

        $arr = base64_decode($data);
        $arr = json_decode($arr);
        $name = $arr[0];
        $username = $arr[1];
        $email = $arr[2];
        $password = $arr[3];

        $user = User::where(['email' => $email])->count();
        $userN = User::where(['username' => $username])->count();

        if($email == "" || $password == "" || $name == "" || $username == "")
        {
            return response()->json([
                'isError' => true,
                'isFieldEmpty' => true,
                'isPasswordError' => false,
                'isEmailTaken'=> false,
                'isUserRegistered' => false,
                'user' => false,
                'isUser' => false,
                'isUserNameTaken' => false,
                'isUsernameLengthError' => false,
                'message' => 'None of the field can be empty '
            ]);
        }
        else if(strlen($password) < 6)
        {
            return response()->json([
                'isError' => true,
                'isFieldEmpty' => false,
                'isPasswordError' => true,
                'isEmailTaken'=> false,
                'isUserRegistered' => false,
                'user' => false,
                'isUser' => false,
                'isUserNameTaken' => false,
                'isUsernameLengthError' => false,
                'message' => 'Password length must be atleast 6 characters long.'
            ]);
        }
        else if(strlen($username) < 4)
        {
            return response()->json([
                'isError' => true,
                'isFieldEmpty' => false,
                'isPasswordError' => true,
                'isEmailTaken'=> false,
                'isUserRegistered' => false,
                'user' => false,
                'isUser' => false,
                'isUserNameTaken' => false,
                'isUsernameLengthError' => true,
                'message' => 'Username length must be atleast 4 characters long.'
            ]);
        }
        else if($user > 0)
        {
            return response()->json([
                'isError' => true,
                'isFieldEmpty' => false,
                'isPasswordError' => false,
                'isEmailTaken'=> true,
                'isUserRegistered' => false,
                'user' => false,
                'isUser' => false,
                'isUserNameTaken' => false,
                'isUsernameLengthError' => false,
                'message' => 'Email is already taken. Please use another one.'
            ]);
        }
        else if($userN > 0)
        {
            return response()->json([
                'isError' => true,
                'isFieldEmpty' => false,
                'isPasswordError' => false,
                'isEmailTaken'=> true,
                'isUserRegistered' => false,
                'user' => false,
                'isUser' => false,
                'isUserNameTaken' => true,
                'isUsernameLengthError' => false,
                'message' => 'Username is already taken. Please use another one.'
            ]);
        }
        else
        {

            $user = new User();

            $user->name = $name;
            $user->email = $email;
            $user->username = $username;
            $user->password = Hash::make($password);
            $token = Hash::make(base64_encode($name.":".time()));
            $user->token = base64_encode($token);
            $user->is_followed = 0;
            $user->followed = 0;
            $user->is_invited = 0;
            $user->invites = 0;
            $user->is_soc = 0;

            if($user->save())
            {
                return response()->json([
                    'isError' => false,
                    'isUserRegistered' => true,
                    'user' => $user,
                    'isFieldEmpty' => false,
                    'isPasswordError' => false,
                    'isEmailTaken'=> false,
                    'isUser' => true,
                    'isUserNameTaken' => false,
                    'isUsernameLengthError' => false,
                    'message' => 'Registeration was successful.'
                ]);
            }
            else
            {
                return response()->json([
                    'isError' => false,
                    'isFieldEmpty' => false,
                    'isPasswordError' => false,
                    'isEmailTaken'=> false,
                    'isUserRegistered' => false,
                    'user' => false,
                    'isUser' => false,
                    'isUserNameTaken' => false,
                    'isUsernameLengthError' => false,
                    'message' => 'Registeration was unsuccessful. Please try again.'
                ]);
            }



        }
    }

    public function slogin(Request $req){
        $id = $req->input('id');
        $name = $req->input('name');
        $network = $req->input('net');
        $profile_image = $req->input('profile_image');

        if($id == "" || $name == "" || $network == "" || $profile_image == ""){
            return response()->json([
                'isError' => true,
                'isFieldEmpty' => true,
                'isPasswordError' => false,
                'isEmailTaken'=> false,
                'isUserRegistered' => false,
                'user' => false,
                'isUser' => false,
                'isUserNameTaken' => false,
                'isUsernameLengthError' => false,
                'message' => 'None of the field can be empty '
            ]);
        }else {

            $user = User::where(['slogin_id' => $id, 'email' => $id,'slogin_title' => $network]);

            if($user->count() > 0){
                if(Auth::attempt(['email' => $id, 'password' => $id])){
                    return response()->json([
                        'isError' => false,
                        'isUserRegistered' => true,
                        'user' => $user->first(),
                        'isFieldEmpty' => false,
                        'isPasswordError' => false,
                        'isEmailTaken'=> false,
                        'isUser' => true,
                        'isUserNameTaken' => false,
                        'isUsernameLengthError' => false,
                        'message' => 'Login was successful.'
                    ]);
                }else {
                    $newUser = new User();

                    $newUser->name = $name;
                    $newUser->email = $id;
                    $newUser->username = $name;
                    $newUser->profile_image = $profile_image;
                    $newUser->password = Hash::make($id);
                    $token = Hash::make(base64_encode($id.":".time()));
                    $newUser->token = base64_encode($token);
                    $newUser->is_followed = 0;
                    $newUser->followed = 0;
                    $newUser->is_invited = 0;
                    $newUser->invites = 0;
                    $newUser->is_soc = 0;
                    $newUser->is_slogin = 1;
                    $newUser->slogin_title = $network;
                    $newUser->slogin_id = $id;

                    if($newUser->save()){
                        return response()->json([
                            'isError' => false,
                            'isUserRegistered' => true,
                            'user' => $newUser,
                            'isFieldEmpty' => false,
                            'isPasswordError' => false,
                            'isEmailTaken'=> false,
                            'isUser' => true,
                            'isUserNameTaken' => false,
                            'isUsernameLengthError' => false,
                            'message' => 'Registeration was successful.'
                        ]);
                    }else {
                        return response()->json([
                            'isError' => true,
                            'isFieldEmpty' => false,
                            'isPasswordError' => false,
                            'isEmailTaken'=> false,
                            'isUserRegistered' => false,
                            'user' => false,
                            'isUser' => false,
                            'isUserNameTaken' => false,
                            'isUsernameLengthError' => false,
                            'message' => 'Registeration was unsuccessful. Please try again.'
                        ]);
                    }
                }
            }else {
                $newUser = new User();

                $newUser->name = $name;
                $newUser->email = $id;
                $newUser->username = $name;
                $newUser->password = Hash::make($id);
                $newUser->profile_image = $profile_image;
                $token = Hash::make(base64_encode($id.":".time()));
                $newUser->token = base64_encode($token);
                $newUser->is_followed = 0;
                $newUser->followed = 0;
                $newUser->is_invited = 0;
                $newUser->invites = 0;
                $newUser->is_soc = 0;
                $newUser->is_slogin = 1;
                $newUser->slogin_title = $network;
                $newUser->slogin_id = $id;

                if($newUser->save()){
                    return response()->json([
                        'isError' => false,
                        'isUserRegistered' => true,
                        'user' => $newUser,
                        'isFieldEmpty' => false,
                        'isPasswordError' => false,
                        'isEmailTaken'=> false,
                        'isUser' => true,
                        'isUserNameTaken' => false,
                        'isUsernameLengthError' => false,
                        'message' => 'Registeration was successful.'
                    ]);
                }else {
                    return response()->json([
                        'isError' => true,
                        'isFieldEmpty' => false,
                        'isPasswordError' => false,
                        'isEmailTaken'=> false,
                        'isUserRegistered' => false,
                        'user' => false,
                        'isUser' => false,
                        'isUserNameTaken' => false,
                        'isUsernameLengthError' => false,
                        'message' => 'Registeration was unsuccessful. Please try again.'
                    ]);
                }

            }
        }

    }

    public function checktoken(Request $req){
        $user = User::where(['token' => $req->input('token')]);
        echo $user->count();
    }
}
