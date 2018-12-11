<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    //

    public function getUser()
    {
        $user = Auth::user();
        return response()->json($user);
    }
}
