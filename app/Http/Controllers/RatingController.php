<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rattings;
use App\Models\Statuses;
use App\Models\Swaps;
use App\Http\MyClasses\VerifyToken;

class RatingController extends Controller
{
    //

    public function getStatusRatings(Request $req){
        $token = $req->input('token');
        $status_id = $req->input('status_id');
        $verify = new VerifyToken();
        $user = $verify->verifyTokenInDb($token);

        if(!$user){
            return response()->json([
                'isAuthenticated' => false
            ]);
        }
        else
        {
            if($token == "" || $status_id == ""){
                return response()->json([
                    'isAuthenticated' => true,
                    'isError' => true, 
                    'isEmpty' => true, 
                    'message' => 'Arguments must be provide.'
                ]);
            }else {

                $rating = new Rattings();
                $average_rating = $rating->getAverageRating($status_id)->get()->first();
                $status = $rating->getStatus($status_id)->first();
                $rating = $rating->getRatings($status_id);
                $swaps_count = Swaps::where(['status_id' => $status_id])->count();
        
                if($rating->count() > 0){
                   $rt = $rating->get();
                    return response()->json([
                        'isAuthenticated' => true,
                        'isError' => false, 
                        'isEmpty' => false, 
                        'isFound' => true,
                        'raters' => $rt,
                        'status' => $status,
                        'swaps_count' => $swaps_count,
                        'average_rating' => $average_rating->avg_rating,
                    ]);

                }else {

                    return response()->json([
                        'isAuthenticated' => true,
                        'isError' => false, 
                        'isEmpty' => false, 
                        'isFound' => false,
                        'status' => $status,
                        'swaps_count' => $swaps_count,
                        'average_rating' => $average_rating->avg_rating,
                        'message' => "Status Raters not found"
                    ]);
                }

            }
        }

    }
}
