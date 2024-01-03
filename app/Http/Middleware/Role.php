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
    public function handle($request, Closure $next, ...$roles)
    {
        if(Auth::check()){
            $table = DB::table("users")
            ->where("users.id", Auth::user()->id)
            ->select("permission.id_role")
            ->join("permission", "users.id","=","permission.id_user")
            ->first();

            if(is_array($roles)){
                foreach($roles as $id_role){
                    if($table->id_role == $id_role){
                        return $next($request);
                    }        
                }

                abort(403, "Maaf, Anda tidak punya akses untuk halaman ini");
            }

        }else{
            return redirect()->route('login');
        }
    }
}
