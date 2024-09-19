<?php

namespace App\Http\Controllers\Arsip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class ArsipsuratKeluarController extends Controller
{
    public function index(){
        return view('arsip/surat_keluar/index');
    }

    public function getData(){
        $id_role = Auth::user()->getRole()->id_role;
        switch ($id_role){
            //login sebagai admin tata usaha
            case 6:
                $table = DB::table("transaksi_surat_keluar AS surat_keluar")
                ->where("surat_keluar.id_status",2)
                ->select(
                    "surat_keluar.id AS id_surat",
                    "surat_keluar.id_ref_klasifikasi",
                    "surat_keluar.id_ref_fungsi",
                    "surat_keluar.id_ref_kegiatan",
                    "surat_keluar.id_ref_transaksi",
                    "surat_keluar.id_nomenklatur_jabatan",
                    "surat_keluar.no_surat",
                    "surat_keluar.tujuan",
                    "surat_keluar.internal",
                    "surat_keluar.perihal",
                    "surat_keluar.tgl_surat",
                    "surat_keluar.file",
                    "ref_fungsi.kode AS kode_fungsi",
                    "ref_kegiatan.kode AS kode_kegiatan",
                    "ref_transaksi.kode AS kode_transaksi",
                    "surat_keluar.id_status",
                    "users.name AS dibuat_oleh",
                    DB::raw("(CASE WHEN surat_keluar.id_status = 1 THEN 'Draft' ELSE 'Done' END) AS status"),
                    DB::raw('COUNT(detail_transaksi_surat.id_surat) AS jumlah_tembusan'),
                    DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.deskripsi ELSE ref_transaksi.deskripsi END) AS deskripsi"),
                    DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.kode ELSE ref_transaksi.kode END) AS kode_surat"),
                )->leftJoin("ref_fungsi", "surat_keluar.id_ref_fungsi","=", "ref_fungsi.id")
                ->leftJoin("ref_kegiatan", "surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
                ->leftJoin("ref_transaksi", "surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
                ->leftJoin("detail_transaksi_surat", "surat_keluar.id","=","detail_transaksi_surat.id_surat")
                ->leftJoin("users", "surat_keluar.created_by","=","users.id")
                ->groupBy("surat_keluar.id","surat_keluar.id_ref_klasifikasi","surat_keluar.id_ref_fungsi","surat_keluar.id_ref_kegiatan","surat_keluar.id_ref_transaksi","surat_keluar.id_nomenklatur_jabatan","surat_keluar.no_surat","surat_keluar.tujuan","surat_keluar.perihal","surat_keluar.tgl_surat","surat_keluar.file","surat_keluar.id_status","ref_fungsi.kode","ref_kegiatan.kode","ref_transaksi.kode","ref_kegiatan.deskripsi","ref_transaksi.deskripsi","surat_keluar.internal","users.name")
                ->orderBy("surat_keluar.created_at","DESC")->get();
        
                return response()->json($table);
            break;
            //login sebagai admin disposisi 1
            case 8:
                $table = DB::table("transaksi_surat_keluar AS surat_keluar")
                ->where("surat_keluar.id_status",2)
                ->select(
                    "surat_keluar.id AS id_surat",
                    "surat_keluar.id_ref_klasifikasi",
                    "surat_keluar.id_ref_fungsi",
                    "surat_keluar.id_ref_kegiatan",
                    "surat_keluar.id_ref_transaksi",
                    "surat_keluar.id_nomenklatur_jabatan",
                    "surat_keluar.no_surat",
                    "surat_keluar.tujuan",
                    "surat_keluar.internal",
                    "surat_keluar.perihal",
                    "surat_keluar.tgl_surat",
                    "surat_keluar.file",
                    "ref_fungsi.kode AS kode_fungsi",
                    "ref_kegiatan.kode AS kode_kegiatan",
                    "ref_transaksi.kode AS kode_transaksi",
                    "surat_keluar.id_status",
                    "users.name AS dibuat_oleh",
                    DB::raw("(CASE WHEN surat_keluar.id_status = 1 THEN 'Draft' ELSE 'Done' END) AS status"),
                    DB::raw('COUNT(detail_transaksi_surat.id_surat) AS jumlah_tembusan'),
                    DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.deskripsi ELSE ref_transaksi.deskripsi END) AS deskripsi"),
                    DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.kode ELSE ref_transaksi.kode END) AS kode_surat"),
                )->leftJoin("ref_fungsi", "surat_keluar.id_ref_fungsi","=", "ref_fungsi.id")
                ->leftJoin("ref_kegiatan", "surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
                ->leftJoin("ref_transaksi", "surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
                ->leftJoin("detail_transaksi_surat", "surat_keluar.id","=","detail_transaksi_surat.id_surat")
                ->leftJoin("users", "surat_keluar.created_by","=","users.id")
                ->groupBy("surat_keluar.id","surat_keluar.id_ref_klasifikasi","surat_keluar.id_ref_fungsi","surat_keluar.id_ref_kegiatan","surat_keluar.id_ref_transaksi","surat_keluar.id_nomenklatur_jabatan","surat_keluar.no_surat","surat_keluar.tujuan","surat_keluar.perihal","surat_keluar.tgl_surat","surat_keluar.file","surat_keluar.id_status","ref_fungsi.kode","ref_kegiatan.kode","ref_transaksi.kode","ref_kegiatan.deskripsi","ref_transaksi.deskripsi","surat_keluar.internal","users.name")
                ->orderBy("surat_keluar.created_at","DESC")->get();
        
                return response()->json($table);
            break;

            //login sebagai admin disposisi 2 kabag/panmud
            default:
            $table = DB::table("transaksi_surat_keluar AS surat_keluar")
            ->where("surat_keluar.created_by",Auth::user()->id)
            ->where("surat_keluar.id_status",2)
                ->select(
                    "surat_keluar.id AS id_surat",
                    "surat_keluar.id_ref_klasifikasi",
                    "surat_keluar.id_ref_fungsi",
                    "surat_keluar.id_ref_kegiatan",
                    "surat_keluar.id_ref_transaksi",
                    "surat_keluar.id_nomenklatur_jabatan",
                    "surat_keluar.no_surat",
                    "surat_keluar.tujuan",
                    "surat_keluar.internal",
                    "surat_keluar.perihal",
                    "surat_keluar.tgl_surat",
                    "surat_keluar.file",
                    "ref_fungsi.kode AS kode_fungsi",
                    "ref_kegiatan.kode AS kode_kegiatan",
                    "ref_transaksi.kode AS kode_transaksi",
                    "surat_keluar.id_status",
                    "users.name AS dibuat_oleh",
                    DB::raw("(CASE WHEN surat_keluar.id_status = 1 THEN 'Draft' ELSE 'Done' END) AS status"),
                    DB::raw('COUNT(detail_transaksi_surat.id_surat) AS jumlah_tembusan'),
                    DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.deskripsi ELSE ref_transaksi.deskripsi END) AS deskripsi"),
                    DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.kode ELSE ref_transaksi.kode END) AS kode_surat"),
                )->leftJoin("ref_fungsi", "surat_keluar.id_ref_fungsi","=", "ref_fungsi.id")
                ->leftJoin("ref_kegiatan", "surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
                ->leftJoin("ref_transaksi", "surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
                ->leftJoin("detail_transaksi_surat", "surat_keluar.id","=","detail_transaksi_surat.id_surat")
                ->leftJoin("users", "surat_keluar.created_by","=","users.id")
                ->groupBy("surat_keluar.id","surat_keluar.id_ref_klasifikasi","surat_keluar.id_ref_fungsi","surat_keluar.id_ref_kegiatan","surat_keluar.id_ref_transaksi","surat_keluar.id_nomenklatur_jabatan","surat_keluar.no_surat","surat_keluar.tujuan","surat_keluar.perihal","surat_keluar.tgl_surat","surat_keluar.file","surat_keluar.id_status","ref_fungsi.kode","ref_kegiatan.kode","ref_transaksi.kode","ref_kegiatan.deskripsi","ref_transaksi.deskripsi","surat_keluar.internal","users.name")
                ->orderBy("surat_keluar.created_at","DESC")->get();
        
                return response()->json($table);
        }

    }
}
