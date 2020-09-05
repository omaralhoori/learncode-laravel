<?php

namespace App\Http\Middleware;

use Closure;

class Owner
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
        $user = auth()->user();
        if(strtolower($user->email) == env('ADMIN_EMAIL', 'admin_email@mail.com')){
            return $next($request);
        }
        return abort(404);
    }
}
