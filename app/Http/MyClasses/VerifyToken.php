<?php 

namespace App\Http\MyClasses;
use App\User;
use App\Models\Statuses;
class VerifyToken {

    public function verifyTokenInDb($token)
    {
        $user = User::where(['token' => $token]);
        if($user->count() > 0)
        {
            return $user->get()->first();
        }
        else
        {
            return false;
        }
    }

    public function BelongToUserOrNot($status_id,$user_id){
        $status = Statuses::where(['user_id' => $user_id,'status_id' => $status_id]);
        return $status->count() > 0 ? true : false;
    }

        public function BelongToUserOrNotStatusReturn($status_id,$user_id){
        $status = Statuses::where(['user_id' => $user_id,'status_id' => $status_id]);
        return $status->count() > 0 ? $status->first() : false;
    }
}

?>