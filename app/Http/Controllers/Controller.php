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
        
                $role = Auth::user()->getRole()->role;
                $role_name = Auth::user()->getRole()->role_name;
                switch($role){
                    //login as super admin
                    case 'super_admin' :
                        $menu = 
                        [
                            'Manajemen Pengguna'=>[
                                "Daftar" => route('user.list.index'),
                                'Roles' => route('user.role.index'),
                                'Permissions' => route('user.permission.index')
                            ],
                            'Referensi'=>[
                                'Klasifikasi surat' => route('referensi.klasifikasi_surat.index'),
                                'Bidang' => route('referensi.bidang.index')
                            ]
                        ];
                    break;
                    //login as operator surat
                    case 'operator_surat' :
                        $menu = 
                        [
                            'Transaksi'=>[
                                'Surat Masuk' => route('transaksi.surat_masuk'),
                                'Surat Keluar' => ''
                            ],
                        ];  
                        break;
                    //login as admin tata usaha
                    case 'admin_tata_usaha' :
                        $menu = 
                        [
                            'Transaksi'=>[
                                'Surat Masuk' => route('transaksi.surat_masuk'),
                                'Surat Keluar' => ''
                            ],
                        ];
                        
                        break;
                    default :
                        $menu = 
                        [
                            'Menu Op'=>'#',
                            'Menu Op2'=>'#',
                            'Menu Op3'=>'#'
                        ];  

                }

                View::share('data', compact('menu', 'role_name' ));

                return $next($request);
            }
        });
    }
}
