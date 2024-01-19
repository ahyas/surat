<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class HomeController extends Controller
{
    
    public function index()
    {
        $table = DB::table("users")
        ->where("users.id", Auth::user()->id)
        ->select("permission.id_role","roles.alias")
        ->join("permission", "users.id","=","permission.id_user")
        ->join("roles","permission.id_role","=","roles.id")
        ->first();

        $count_surat_keluar = DB::table("transaksi_surat_keluar")->count();
        $count_surat_keluar_internal = DB::table("transaksi_surat_keluar")->where("internal", 1)->count();
        $count_surat_keluar_eksternal = DB::table("transaksi_surat_keluar")->where("internal", 2)->count();

        $count_surat_masuk = DB::table("transaksi_surat_masuk")->count();

        $top_3 = DB::table("transaksi_surat_keluar")
        ->select("ref_klasifikasi.kode","ref_klasifikasi.deskripsi", DB::raw('COUNT(transaksi_surat_keluar.id_ref_klasifikasi) AS jumlah_pemakaian'))
        ->join("ref_klasifikasi", "transaksi_surat_keluar.id_ref_klasifikasi","=","ref_klasifikasi.id")
        ->groupBy("ref_klasifikasi.kode","ref_klasifikasi.deskripsi")
        ->take(3)
        ->orderBy("jumlah_pemakaian","DESC")
        ->get();

        $top_3_surat = $table = DB::table("transaksi_surat_keluar AS surat_keluar")
        ->select(
            "surat_keluar.no_surat",
            "surat_keluar.tujuan",
            "surat_keluar.internal",
            "surat_keluar.perihal",
            "surat_keluar.tgl_surat",
            "surat_keluar.file",
            "ref_fungsi.kode AS kode_fungsi",
            "ref_kegiatan.kode AS kode_kegiatan",
            "ref_transaksi.kode AS kode_transaksi",
            DB::raw('COUNT(detail_transaksi_surat.id_surat_keluar) AS jumlah_tembusan'),
            DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN CONCAT(ref_kegiatan.kode,' - ',ref_kegiatan.deskripsi) ELSE CONCAT(ref_transaksi.kode,' - ',ref_transaksi.deskripsi) END) AS deskripsi"),
            DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.kode ELSE ref_transaksi.kode END) AS kode_surat"),
        )->leftJoin("ref_fungsi", "surat_keluar.id_ref_fungsi","=", "ref_fungsi.id")
        ->leftJoin("ref_kegiatan", "surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
        ->leftJoin("ref_transaksi", "surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
        ->leftJoin("detail_transaksi_surat", "surat_keluar.id","=","detail_transaksi_surat.id_surat_keluar")
        ->groupBy("surat_keluar.id","surat_keluar.id_ref_klasifikasi","surat_keluar.id_ref_fungsi","surat_keluar.id_ref_kegiatan","surat_keluar.id_ref_transaksi","surat_keluar.id_nomenklatur_jabatan","surat_keluar.no_surat","surat_keluar.tujuan","surat_keluar.perihal","surat_keluar.tgl_surat","surat_keluar.file","ref_fungsi.kode","ref_kegiatan.kode","ref_transaksi.kode","ref_kegiatan.deskripsi","ref_transaksi.deskripsi","surat_keluar.internal")
        ->orderBy("surat_keluar.created_at","DESC")
        ->take(4)
        ->get();

        $count_pimpinan=DB::table("transaksi_surat_keluar")->where("id_nomenklatur_jabatan",1)->count();
        $count_kepaniteraan=DB::table("transaksi_surat_keluar")->where("id_nomenklatur_jabatan",2)->count();
        $count_kesekretariatan=DB::table("transaksi_surat_keluar")->where("id_nomenklatur_jabatan",3)->count();

        return view('home', 
        compact('table',
                'count_surat_masuk',
                'count_surat_keluar',
                'count_surat_keluar_internal',
                'count_surat_keluar_eksternal',
                "top_3",
                "top_3_surat",
                "count_pimpinan",
                "count_kesekretariatan",
                "count_kepaniteraan"
            )
        );
    }
}
