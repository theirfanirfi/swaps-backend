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
                'message' => 'None of the field can be empty'
            ]);
        }
        else
        {
            if(Auth::attempt(['email'=>$email, 'password' => $password]))
            {
               
                $user = User::where(['email' => $email])->first();
                $token = Hash::make(base64_encode($user->name.":".time()));
                $user->token = $token;
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
                'message' => 'None of the field can be empty '.$password
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
            $user->token = $token;

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
}
