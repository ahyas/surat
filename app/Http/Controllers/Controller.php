<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
                ->select(
                    "ref_jabatan.nama AS nama_jabatan",
                    "daftar_pegawai.status",
                    "daftar_pegawai.photo_user"
                )
                ->leftJoin("daftar_pegawai", "users.id","=","daftar_pegawai.id_user")
                ->leftJoin("ref_jabatan","daftar_pegawai.id_jabatan","=","ref_jabatan.id")
                ->first();

                $photo_user = $user->photo_user;
                //if user status inactive
                if($user->status == 1){
                    $jabatan = $user->nama_jabatan;

                    switch($id_role){
                        //login as super admin
                        case 1 :
                            $tot_count=DB::table("transaksi_surat_masuk AS surat_masuk")
                            ->where("detail_surat_masuk.id_penerima", Auth::user()->id)
                            ->whereNotIn("surat_masuk.id_status",[3])
                            ->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat")
                            ->orderBy("surat_masuk.created_at","ASC")
                            ->count();
                            $tot_count_surat_keluar = 0;
                            $tot_count_esign = 0;
                            
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
                            $count_onprocessed = DB::table("transaksi_surat_masuk AS surat_masuk")
                            ->where("surat_masuk.created_by", Auth::user()->id)
                            
                            ->whereNull("surat_masuk.id_status")
                            ->orWhereIn("surat_masuk.id_status",[1,2, 4,5])
                            ->leftJoin("users", "surat_masuk.created_by","=","users.id")
                            ->count();
                            //$count_unprocessed = DB::table("transaksi_surat_masuk")->whereNull("id_status")->count();
                            $tot_count = $count_onprocessed;
                            $tot_count_surat_keluar = 0;
                            $tot_count_esign = 0;

                            $menu = 
                            [
                                'Transaksi'=>[
                                    'Surat Masuk' => route('transaksi.surat_masuk')
                                ],
                                'Arsip'=>[
                                    //'Surat Masuk' => route('arsip.surat_masuk.index'),
                                    'Semua surat' =>route('arsip.semua_surat.index')
                                ]
                            ];  
                            break;
                        //login as admin tata usaha
                        case 6 :
                            $count_unprocessed = DB::table("transaksi_surat_masuk")->where("id_status",'!=', 3)->count();
                            $count_onprocessed = DB::table("transaksi_surat_masuk")->whereNull("id_status")->count();
                            $tot_count = $count_unprocessed + $count_onprocessed;

                            $tot_count_surat_keluar = DB::table("transaksi_surat_keluar AS surat_keluar")
                            ->whereNotIn("surat_keluar.internal",[111])
                            ->where("surat_keluar.id_status",1)
                            ->count();

                            $tot_count_esign = 0;

                            $menu = 
                            [
                                'Transaksi'=>[
                                    'Surat Masuk' => route('transaksi.surat_masuk'),
                                    'Surat Keluar' => route('transaksi.surat_keluar')
                                ],
                                'Referensi'=>[
                                    'Klasifikasi surat' => route('referensi.klasifikasi_surat.index')
                                ],
                                'Arsip'=>[
                                    'Semua surat' =>route('arsip.semua_surat.index')
                                ],
                                'Register'=>[
                                    'Surat Masuk'=>route('register.surat_masuk'),
                                    'Surat Keluar'=>route('register.surat_keluar')
                                ]
                            ];
                            
                            break;
                        //login as admin disposisi 1
                        case 8 :

                            $tot_count=DB::table("transaksi_surat_masuk AS surat_masuk")
                            ->where("detail_surat_masuk.id_penerima", Auth::user()->id)
                            ->whereNotIn("surat_masuk.id_status", [3])
                            //->where("detail_surat_masuk.status",2)
                            ->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat")
                            ->count();
                            
                            $tot_count_surat_keluar = DB::table("transaksi_surat_keluar AS surat_keluar")
                            ->whereNotIn("surat_keluar.internal",[111])
                            ->where("surat_keluar.id_status",1)
                            ->whereNotNull("surat_keluar.file")
                            ->count();

                            $nomenklatur = DB::table("users")
                            ->where('users.id', auth()->user()->id)
                            ->join("transaksi_nomenklatur_jabatan", 'users.id','transaksi_nomenklatur_jabatan.user_id')
                            ->select('transaksi_nomenklatur_jabatan.nomenklatur_id')
                            ->first();

                            $tot_count_esign = DB::table('transaksi_esign')
                            ->where('transaksi_esign.status', 1)
                            ->where('transaksi_surat_keluar.id_nomenklatur_jabatan', $nomenklatur->nomenklatur_id)
                            ->join('transaksi_surat_keluar', 'transaksi_esign.id_surat', 'transaksi_surat_keluar.id')
                            ->count();

                            $menu = 
                            [
                                'Transaksi'=>[
                                    'Surat Masuk' => route('transaksi.surat_masuk'),
                                    'Surat Keluar' => route('transaksi.surat_keluar'),
                                    'eSIGN' => route('transaksi.surat_keluar.esign.index'),
                                ],
                                'Arsip'=>[
                                    //'Surat Masuk' => route('arsip.surat_masuk.index'),
                                    //'Surat Keluar' => route('arsip.surat_keluar.index'),
                                    'Semua surat' =>route('arsip.semua_surat.index')
                                ]
                            ];
                            
                            break;
                        //login as admin disposisi 2
                        case 10 :
                            $tot_count=DB::table("transaksi_surat_masuk AS surat_masuk")
                            ->where("detail_surat_masuk.id_penerima", Auth::user()->id)
                            ->whereNotIn("surat_masuk.id_status",[3])
                            ->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat")
                            ->join("users AS penerima", "detail_surat_masuk.id_penerima","=","penerima.id")
                            ->join("users AS pengirim", "detail_surat_masuk.id_asal", "=","pengirim.id")
                            ->leftJoin("daftar_pegawai AS pegawai_penerima", "penerima.id", "=", "pegawai_penerima.id_user")
                            ->leftJoin("daftar_pegawai AS pegawai_pengirim", "pengirim.id", "=", "pegawai_pengirim.id_user")
                            ->leftJoin("ref_jabatan AS jabatan_penerima", "pegawai_penerima.id_jabatan", "=","jabatan_penerima.id")
                            ->leftJoin("ref_jabatan AS jabatan_pengirim", "pegawai_pengirim.id_jabatan", "=","jabatan_pengirim.id")
                            ->orderBy("surat_masuk.created_at","ASC")
                            ->count();

                            $tot_count_surat_keluar = DB::table("transaksi_surat_keluar AS surat_keluar")
                            ->whereIn("surat_keluar.created_by",[Auth::user()->id])
                            ->whereNotIn("surat_keluar.internal",[111])
                            ->where("surat_keluar.id_status",1)
                            ->count();

                            $tot_count_esign = DB::table('transaksi_esign')->where('status', 1)->count();

                            $menu = 
                            [
                                'Transaksi'=>[
                                    'Surat Masuk' => route('transaksi.surat_masuk'),
                                    'Surat Keluar' => route('transaksi.surat_keluar'),
                                ],
                                'Arsip'=>[
                                    //'Surat Masuk' => route('arsip.surat_masuk.index'),
                                    //'Surat Keluar' => route('arsip.surat_keluar.index'),
                                    'Semua surat' =>route('arsip.semua_surat.index')
                                ]
                            ];
                            
                            break;
                            //login as admin disposisi 3/kasubag
                        case 13 :
                            $tot_count=DB::table("transaksi_surat_masuk AS surat_masuk")
                            ->where("detail_surat_masuk.id_penerima", Auth::user()->id)
                            ->whereNotIn("surat_masuk.id_status",[3])
                            ->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat")
                            ->orderBy("surat_masuk.created_at","ASC")
                            ->count();

                            $tot_count_surat_keluar = DB::table("transaksi_surat_keluar AS surat_keluar")
                            ->whereIn("surat_keluar.created_by",[Auth::user()->id])
                            ->whereNotIn("surat_keluar.internal",[111])
                            ->where("surat_keluar.id_status",1)
                            ->count();
                            $tot_count_esign = 0;

                            $menu = 
                            [
                                'Transaksi'=>[
                                    'Surat Masuk' => route('transaksi.surat_masuk'),
                                    'Surat Keluar' => route('transaksi.surat_keluar'),
                                ],
                                'Arsip'=>[
                                    //'Surat Masuk' => route('arsip.surat_masuk.index'),
                                    //'Surat Keluar' => route('arsip.surat_keluar.index'),
                                    'Semua surat' =>route('arsip.semua_surat.index')
                                ]
                            ];
                            
                            break;
                        //login sebagai ketua
                        case 16 :
                            $tot_count=DB::table("transaksi_surat_masuk AS surat_masuk")
                            ->where("detail_surat_masuk.id_penerima", Auth::user()->id)
                            ->whereNotIn("surat_masuk.id_status", [3])
                            
                            ->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat")
                            ->count();
                            
                            $tot_count_surat_keluar = 0;
                            $tot_count_esign = DB::table('transaksi_esign')
                            ->where('transaksi_esign.status', 1)
                            ->where('transaksi_surat_keluar.id_nomenklatur_jabatan', 1)
                            ->join('transaksi_surat_keluar', 'transaksi_esign.id_surat', 'transaksi_surat_keluar.id')
                            ->count();

                            $menu = 
                            [
                                'Transaksi'=>[
                                    'Surat Masuk' => route('transaksi.surat_masuk'),
                                    'Surat Keluar' => route('transaksi.surat_keluar'),
                                    'eSIGN' => route('transaksi.surat_keluar.esign.index'),
                                ],
                                'Arsip'=>[
                                    'Semua surat' => route('arsip.semua_surat.index')
                                ]
                            ];
                            
                            break;
                        //sebagai wakil
                        case 17 :
                            $tot_count=DB::table("transaksi_surat_masuk AS surat_masuk")
                            ->where("detail_surat_masuk.id_penerima", Auth::user()->id)
                            ->whereNotIn("surat_masuk.id_status", [3])
                            
                            ->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat")
                            ->count();
                            
                            $tot_count_surat_keluar = 0;
                            $tot_count_esign = 0;

                            $menu = 
                            [
                                'Transaksi'=>[
                                    'Surat Masuk' => route('transaksi.surat_masuk'),
                                    'Surat Keluar' => route('transaksi.surat_keluar'),
                                ],
                                'Arsip'=>[
                                    'Semua surat' =>route('arsip.semua_surat.index')
                                ]
                            ];
                            
                            break;
                        //login sebagai end user
                        case 18 :
          
                            $table=DB::table("transaksi_surat_masuk AS surat_masuk")
                            ->where("detail_surat_masuk.id_penerima", Auth::user()->id)
                            ->whereNotIn("surat_masuk.id_status",[3])
                            ->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat")
                            ->leftJoin("ref_klasifikasi", "surat_masuk.klasifikasi_id", "=", "ref_klasifikasi.id")
                            ->get();

                            $tot_count = $table->count();

                            $tot_count_surat_keluar = 0;
                            $tot_count_esign = 0;

                            $menu = 
                            [
                                'Transaksi'=>[
                                    'Surat Masuk' => route('transaksi.surat_masuk')
                                ],
                                'Arsip'=>[
                                    'Semua surat' =>route('arsip.semua_surat.index')
                                ]
                            ];
                            
                            break;
                        //login sebagai admin monitoring
                        case 101 :
                            $count_unprocessed = DB::table("transaksi_surat_masuk")->where("id_status",'!=', 3)->count();
                            $count_onprocessed = DB::table("transaksi_surat_masuk")->whereNull("id_status")->count();
                            $tot_count = $count_unprocessed + $count_onprocessed;
                            $tot_count_esign = 0;
                            
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

                    View::share('data', compact('menu', 'role_name', 'id_role','jabatan', 'tot_count', 'tot_count_surat_keluar', 'tot_count_esign', 'photo_user'));

                }else{
                    return response(view('unauthenticated'));
                }
                
            }

            return $next($request);
            
        });
    }
}
