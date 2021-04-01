<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CanEnterDashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       $RoleName= Auth::user()->role->name;
        if( $RoleName =='superadmin' or $RoleName == 'admin' )
            return $next($request);

        return redirect(url('/'));
    }
}
