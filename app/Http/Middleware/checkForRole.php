<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;

class checkForRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next ,$role)
    {
        if(!\Illuminate\Support\Facades\Session::has('role') || $role !== \Illuminate\Support\Facades\Session::get('role')){
            abort(403,"You don't have permissions to access this page !");
        }
        return $next($request);
    }
}
