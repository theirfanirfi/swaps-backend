<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class NotAuthWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {
            return response()->json([
                'isLoggedIn' => true,
                'message' => 'Please logout of the current account then try again.'
            ]);
        }
        return $next($request);
    }
}
