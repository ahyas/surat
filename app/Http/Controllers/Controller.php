<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use View;
use Auth;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        //user info can be accessed from all views
        $this->middleware(function ($request, $next) {
            if(Auth::check()){
                $table = DB::table("users")
                ->where("users.id", Auth::user()->id)
                ->select("permission.id_role","roles.name AS role")
                ->join("permission", "users.id","=","permission.id_user")
                ->join("roles", "permission.id_role","=","roles.id")
                ->first();
        
                $role = $table->role;

                //login as admin
                if($table->id_role == 1){
                    $menu = 
                    [
                        'Manajemen Pengguna'=>[
                            "Daftar" => route('admin.user'),
                            'Roles' => '',
                            'Permission' => ''
                        ],
                        'Referensi'=>[
                            "Klasifikasi surat" => route('admin.referensi.klasifikasi_surat'),
                            'Bidang' => route('admin.referensi.bidang')
                        ]
                    ];
                //Login as operator
                }else{
                    $menu = [
                        'Menu Op'=>route('admin'),
                        'Menu Op2'=>route('operator.user'),
                        'Menu Op3'=>'url_op_3'
                    ];  
                }

                View::share('data', compact('menu', 'role' ));

                return $next($request);
            }
        });
    }
}
