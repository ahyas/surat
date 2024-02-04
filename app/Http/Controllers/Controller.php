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
                $user = DB::table("users")
                ->where("users.id", Auth::user()->id)
                ->select("ref_jabatan.nama AS nama_jabatan")
                ->leftJoin("daftar_pegawai", "users.id","=","daftar_pegawai.id_user")
                ->leftJoin("ref_jabatan","daftar_pegawai.id_jabatan","=","ref_jabatan.id")
                ->first();
                $jabatan = $user->nama_jabatan;

                switch($id_role){
                    //login as super admin
                    case 1 :
                        $menu = 
                        [
                            'Manajemen Pengguna'=>[
                                "Daftar" => route('user.list.index'),
                                'Permissions' => route('user.permission.index'),
                                'Level user' => route('user.level.index'),
                            ],
                            'Referensi'=>[
                                'Klasifikasi surat' => route('referensi.klasifikasi_surat.index'),
                                'Roles' => route('user.role.index'),
                                'Bidang' => route('referensi.bidang.index'),
                                'Jabatan' => route('referensi.jabatan.index'),
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
                    //login as admin disposisi 1
                    case 8 :
                        $menu = 
                        [
                            'Transaksi'=>[
                                'Surat Masuk' => route('transaksi.surat_masuk'),
                            ],
                        ];
                        
                        break;
                    //login as admin disposisi 2
                    case 10 :
                        $menu = 
                        [
                            'Transaksi'=>[
                                'Surat Masuk' => route('transaksi.surat_masuk'),
                            ],
                        ];
                        
                        break;
                         //login as admin disposisi 3
                    case 13 :
                        $menu = 
                        [
                            'Transaksi'=>[
                                'Surat Masuk' => route('transaksi.surat_masuk'),
                            ],
                        ];
                        
                        break;
                    //login sebagai ketua
                    case 16 :
                        $menu = 
                        [
                            'Transaksi'=>[
                                'Surat Masuk' => route('transaksi.surat_masuk'),
                            ],
                        ];
                        
                        break;
                    //login sebagai end user
                    case 18 :
                        $menu = 
                        [
                            'Transaksi'=>[
                                'Surat Masuk' => '',
                            ],
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

                View::share('data', compact('menu', 'role_name', 'id_role','jabatan'));

                return $next($request);
            }
        });
    }
}
