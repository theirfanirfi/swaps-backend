<?php 

namespace App\Http\MyClasses;
use App\User;
class VerifyToken {

    public function verifyTokenInDb($token)
    {
        $user = User::where(['token' => $token])->get();
        if($user->count() > 0)
        {
            return $user->first();
        }
        else
        {
            return false;
        }
    }
}

?>