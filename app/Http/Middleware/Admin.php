<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class Admin
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
       if (Auth::check())
        {
            $role = Auth::user()->checkRoles();
            if ($role == 'admin')
            {
                return $next($request);
            } else {
                return redirect('/page_403');
            }
        }
        
        return $next($request);

        // return redirect('/login');
    }
}
