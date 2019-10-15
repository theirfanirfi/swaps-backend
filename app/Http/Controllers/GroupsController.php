<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use App\Models\Participants;
use Illuminate\Http\Request;
use App\Http\MyClasses\VerifyToken;


class GroupsController extends Controller
{
    //


    public function createGroup(Request $req){
        $token = $req->input('token');
        $group_name = $req->input('gpn');
        $group_description = $req->input('gpd');

    	if($token == null || $group_name == null || $group_description == null){

    		return response()->json([
    			'isError' => true,
    			'isEmpty' => true,
    			'message' => 'Argument must be provided.'
    		]);

    	}else {

    	// verifying user

    	$verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);
        //if not verified
        if(!$user){
        	    return response()->json([
    			'isError' => true,
    			'isAuthenticated' => false,
    			'message' => 'Either your credentials are incorrect or you are not loggedin to perform this action.'
    		]);
        }
        //else - if verified
        else {
            $group = new Groups();
            $group->created_by_user_id = $user->user_id;
            $group->group_name = $group_name;
            $group->group_description = $group_description;

            if($group->save()){
                $par = new Participants();
                $par->user_one = $user->user_id;
                $par->user_two = $user->user_id;
                $par->is_group = 1;
                $par->group_id = $group->id;

                if($par->save()){
                    return response()->json([
                        'isError' => false,
                        'isAuthenticated' => true,
                        'isEmpty' => false,
                        'isCreated' => true,
                        'group' => $group,
                        'message' => 'Group created. Now, invite users to the group.'
                    ]);
                }else {
                    $group->delete();

                    return response()->json([
                        'isError' => true,
                        'isAuthenticated' => true,
                        'isEmpty' => false,
                        'message' => 'Error occurred in creating the group. Please try again.'
                    ]);
                }
            }else {
    		return response()->json([
                'isError' => true,
                'isAuthenticated' => true,
    			'isEmpty' => false,
    			'message' => 'Error occurred in creating the group. Please try again.'
    		]);
            }
        }
    }
    }
}
