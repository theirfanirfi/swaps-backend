<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    //

    protected $table = "status_shares";

    public function checkWhetherSharedOrNot($status_id,$user_id){
        $like = Share::where(['status_id' => $status_id, 'user_id' => $user_id]);
        return $like->count() > 0 ? true : false;
    }

}
