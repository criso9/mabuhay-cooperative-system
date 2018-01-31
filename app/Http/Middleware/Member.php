<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class Member
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
        if ( Auth::check() )
        {
            $role = Auth::user()->checkRoles();
            if ($role == 'member')
            {
                return $next($request);
            }
        }

        return redirect('/member');
    }
}
