<?php

namespace App\Http\Middleware;

use Closure;

class User
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
        $user = Auth::user();
        // dd($user->type);
        if ($user->type == 'member') {
            return $next($request);
        } else {
            return redirect()->guest('guest');
        }
        // return $next($request);
    }
}
