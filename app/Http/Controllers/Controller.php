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
        
                $id_role = Auth::user()->getRole()->id_role;
                $role_name = Auth::user()->getRole()->role_name;

                switch($id_role){
                    //login as super admin
                    case 1 :
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
                    case 5 :
                        $menu = 
                        [
                            'Transaksi'=>[
                                'Surat Masuk' => route('transaksi.surat_masuk')
                            ],
                        ];  
                        break;
                    //login as admin tata usaha
                    case 6 :
                        $menu = 
                        [
                            'Transaksi'=>[
                                'Surat Masuk' => route('transaksi.surat_masuk'),
                                'Surat Keluar' => route('transaksi.surat_keluar')
                            ],
                            'Referensi'=>[
                                'Klasifikasi surat' => route('referensi.klasifikasi_surat.index')
                            ]
                        ];
                        
                        break;
                    //login sebagai admin monitoring
                    case 101 :
                        $menu = 
                        [
                            'Transaksi'=>[
                                'Surat Masuk' => route('transaksi.surat_masuk'),
                                'Surat Keluar' => route('transaksi.surat_keluar')
                            ]
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

                View::share('data', compact('menu', 'role_name', 'id_role'));

                return $next($request);
            }
        });
    }
}
