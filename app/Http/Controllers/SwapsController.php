<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Swaps;
use App\Http\MyClasses\VerifyToken;

class SwapsController extends Controller
{
    //

    public function getSwaps(Request $req){

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
            $swaps = new Swaps();
            $s = $swaps->getSwapsTab($user->user_id);

            if(sizeof($s) > 0 ){
               // $s = $s->get();
                return response()->json([
                    'isAuthenticated' => true,
                    'isFound' => true,
                    'isError' => false,
                    'swaps' => $s
                ]);
            }
            else {
                $s = $s->get();
                return response()->json([
                    'isAuthenticated' => true,
                    'isFound' => false,
                    'isError' => false,
                    'swaps' => $s
                ]);
            }

        }

    }

    public function getSwap(Request $req){
        $token = $req->input('token');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);
        $swap_id = $req->input('swap_id');

        if(!$user){
            return response()->json([
                'isAuthenticated' => false
            ]);
        }
        else
        {
            if($token == null || $swap_id == null){
                return response()->json([
                    'isAuthenticated' => true,
                    'isError' => true,
                    'isEmpty' => true,
                    'message' => 'Arguments must be provide.'
                ]);
            }else {
            $swap = Swaps::where(['swap_id' => $swap_id]);
            if($swap->count() > 0){
                $s = $swap->get()->first();
                return response()->json([
                    'isAuthenticated' => true,
                    'isFound' => true,
                    'isError' => false,
                    'swap' => $s,
                    'message' => 'Swap found.'

                ]);

            }else {
                return response()->json([
                    'isAuthenticated' => true,
                    'isFound' => false,
                    'isError' => false,
                    'message' => 'Swap not found. '.$swap_id
                ]);
            }
        }
        }
    }

    public function unswap(Request $req){
        $token = $req->input('token');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);
        $swap_id = $req->input('swap_id');

        if(!$user){
            return response()->json([
                'isAuthenticated' => false
            ]);
        }
        else
        {
            if($token == null || $swap_id == null){
                return response()->json([
                    'isAuthenticated' => true,
                    'isError' => true,
                    'isEmpty' => true,
                    'message' => 'Arguments must be provide.'
                ]);
            }else {
                $swap = Swaps::where(['swap_id' => $swap_id]);
                if($swap->count() > 0){

                    if($swap->first()->delete()){

                        return response()->json([
                            'isAuthenticated' => true,
                            'isError' => false,
                            'isEmpty' => false,
                            'isFound' => true,
                            'isDeSwap' => true,
                            'message' => 'Status unswaped.'
                        ]);

                    } else {
                        return response()->json([
                            'isAuthenticated' => true,
                            'isError' => false,
                            'isEmpty' => false,
                            'isFound' => true,
                            'isDeSwap' => false,
                            'message' => 'Error occurred in unswaping the status.'
                        ]);

                    }

                } else {
                    return response()->json([
                        'isAuthenticated' => true,
                        'isError' => false,
                        'isEmpty' => false,
                        'isFound' => false,
                        'isDeSwap' => false,
                        'message' => 'Swap not found.'
                    ]);
                }
            }
        }
    }

    public function getUserSwaps(Request $req){

        $user_id = $req->input('id');
            $swaps = new Swaps();
            $s = $swaps->getSwapsTab($user_id);

            if($s->count() > 0 ){
                $s = $s->get();
                return response()->json([
                    'isAuthenticated' => true,
                    'isFound' => true,
                    'isError' => false,
                    'swaps' => $s
                ]);
            }
            else {
                $s = $s->get();
                return response()->json([
                    'isAuthenticated' => true,
                    'isFound' => false,
                    'isError' => false,
                    'swaps' => $s
                ]);
            }
    }



    public function getSwapReviewsForUserProfile(Request $req){

        $user_id = $req->input('id');
        $token = $req->input('token');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);

        if($user_id == "" || empty($id) || $token == "" || empty($token)){
            return response()->json([
                'isAuthenticated' => false,
                'isError' => true,
                'message' => 'Arguments must be provided.'
            ]);
        }else {
        if(!$user){
            return response()->json([
                'isAuthenticated' => false,
                'isError' => true,
                'message' => 'you are not logged in to perform this action'
            ]);
        }
        else
        {
            $swaps = Swaps::getSwapReviews($user_id);
            // $s = $swaps->getSwapsTab($user_id);

            if(sizeof($swaps) > 0 ){
               // $s = $s->get();
                return response()->json([
                    'isAuthenticated' => true,
                    'isFound' => true,
                    'isError' => false,
                    'swaps_reviews' => $swaps[0],
                ]);
            }
            else {
                return response()->json([
                    'isAuthenticated' => true,
                    'isFound' => false,
                    'isError' => false,
                    'message' => 'No reviews found.'
                ]);
            }
        }
    }
    }

}
