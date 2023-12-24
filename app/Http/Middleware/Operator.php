<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;

class Operator
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
        $table = DB::table("users")
        ->where("users.id", Auth::user()->id)
        ->select("permission.id_role")
        ->join("permission", "users.id","=","permission.id_user")
        ->first();

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($table->id_role == 1) {
            return redirect()->route('admin');
        }

        if ($table->id_role == 5) {
            return $next($request);
        }
        //return $next($request);
    }
}
