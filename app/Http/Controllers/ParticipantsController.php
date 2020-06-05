<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participants;
use App\User;
use App\Http\MyClasses\VerifyToken;

class ParticipantsController extends Controller
{
    //
    public function getParticipants(Request $req)
    {

        $token = $req->input('token');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);

        if (!$user) {
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'Not authenticated'
            ]);
        } else {

            if ($token == "") {
                return response()->json([
                    'isEmpty' => true,
                    'isError' => true,
                    'isAuthenticated' => false,
                    'message' => 'Arugments must be provided.'
                ]);
            } else {
                $p = new Participants();
                //$p = $p->getParticipants($user->user_id);
                $p = $p->getParticipantsAndGroups($user->user_id);
                if (sizeof($p) > 0) {
                    //$p = $p->get();
                    return response()->json([
                        'participants' => $p,
                        'isAuthenticated' => true,
                        'isError' => false,
                        'isFound' => true,
                        'message' => 'Loading...'
                    ]);
                } else {
                    return response()->json([
                        'isAuthenticated' => true,
                        'isError' => false,
                        'isFound' => false,
                        'message' => 'You have no started chat with any user it.'
                    ]);
                }
            }
        }
    }

    public function createParticipants(Request $req)
    {

        $token = $req->input('token');
        $id = $req->input('id');


        if ($token == "" || $id == "") {
            return response()->json([
                'isEmpty' => true,
                'isError' => true,
                'isAuthenticated' => false,
                'message' => 'Arugments must be provided.'
            ]);
        } else {
            $verify = new VerifyToken();
            $user = $verify->verifyTokenInDb($token);

            if (!$user) {
                return response()->json([
                    'isAuthenticated' => false,
                    'message' => 'Not authenticated'
                ]);
            } else {
                $p = new Participants();
                $p->user_one = $user->user_id;
                $p->user_two = $id;
                if ($p->save()) {
                    return response()->json([
                        'participants' => $p,
                        'user_to_chat_with' => User::find($id),
                        'isAuthenticated' => true,
                        'isError' => false,
                        'isInitiated' => true,
                        'message' => 'Loading...'
                    ]);
                } else {
                    return response()->json([
                        'isAuthenticated' => true,
                        'isError' => false,
                        'isInitiated' => false,
                        'message' => 'Error occurred, please try again.'
                    ]);
                }
            }
        }
    }



    public function getUnReadMessageAndCount(Request $req)
    {

        $token = $req->input('token');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);

        if (!$user) {
            return response()->json([
                'isAuthenticated' => false,
                'message' => 'Not authenticated'
            ]);
        } else {

            if ($token == "") {
                return response()->json([
                    'isEmpty' => true,
                    'isError' => true,
                    'isAuthenticated' => false,
                    'message' => 'Arugments must be provided.'
                ]);
            } else {
            }
        }
    }
}
