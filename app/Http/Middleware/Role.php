<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
        if(Auth::check()){
            foreach($roles as $role){
                if(Auth::user()->hasRole($role)){
                    return $next($request);
                }
                    
                return abort(403);
                
            }
        }else{
            return redirect()->route('login');
        }
    }
}
