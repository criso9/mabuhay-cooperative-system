<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class Officer
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
            if ($role == 'officer' || $role == 'admin')
            {
                return $next($request);
            } else {
                return redirect('/page_403');
            }
        }

        return redirect('/login');
    }
}
