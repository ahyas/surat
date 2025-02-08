<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;

class RegisterSuratKeluarController extends Controller
{
    public function index(){
       return view('register/surat_keluar/index');
    }

    public function getData($tahun, $bulan){
        if($tahun !== '0000' && $bulan == '0'){
            $table = DB::table("transaksi_surat_keluar AS surat_keluar")
            ->where("surat_keluar.tahun", $tahun)
            ->whereNotIn("surat_keluar.internal",[111])
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
                "surat_keluar.id_status",
                "users.name AS dibuat_oleh",
            )
            ->leftJoin("users", "surat_keluar.created_by","=","users.id")
            ->groupBy(
                "surat_keluar.id",
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
                "surat_keluar.id_status",
                "users.name")
            ->orderBy("surat_keluar.created_at","DESC")
            ->get();
        }else{
            $table = DB::table("transaksi_surat_keluar AS surat_keluar")
            ->where("surat_keluar.tahun", $tahun)
            ->whereMonth("surat_keluar.tgl_surat", $bulan)
            ->whereNotIn("surat_keluar.internal",[111])
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
                "surat_keluar.id_status",
                "users.name AS dibuat_oleh",
            )
            ->leftJoin("users", "surat_keluar.created_by","=","users.id")
            ->groupBy(
                "surat_keluar.id",
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
                "surat_keluar.id_status",
                "users.name")
            ->orderBy("surat_keluar.created_at","DESC")
            ->get();
        }

        return response()->json($table);
    }

    public function print(Request $request){
        if($request->tahun !== '0000' && $request->bulan == '0'){
            $bulan = '';
            $table = DB::table("transaksi_surat_keluar AS surat_keluar")
            ->where("surat_keluar.tahun", $request->tahun)
            ->whereNotIn("surat_keluar.internal",[111])
            ->select(
                "surat_keluar.id AS id_surat",
                "surat_keluar.id_ref_klasifikasi",
                "surat_keluar.id_ref_fungsi",
                "surat_keluar.id_ref_kegiatan",
                "surat_keluar.id_ref_transaksi",
                "surat_keluar.id_nomenklatur_jabatan",
                "surat_keluar.no_surat",
                DB::raw("(CASE WHEN surat_keluar.internal = 1 THEN 'Internal' ELSE surat_keluar.tujuan END) AS tujuan"),
                "surat_keluar.internal",
                "surat_keluar.perihal",
                "surat_keluar.tgl_surat",
                "surat_keluar.file",
                "surat_keluar.id_status",
                "users.name AS dibuat_oleh",
            )->leftJoin("users", "surat_keluar.created_by","=","users.id")
            ->groupBy(
                "surat_keluar.id",
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
                "surat_keluar.id_status",
                "users.name"
                )
            ->orderBy("surat_keluar.created_at","DESC")
            ->get();
        }else{
            $bulan = $request->bulan;
            $table = DB::table("transaksi_surat_keluar AS surat_keluar")
            ->where("surat_keluar.tahun", $request->tahun)
            ->whereMonth("surat_keluar.tgl_surat", $request->bulan)
            ->whereNotIn("surat_keluar.internal",[111])
            ->select(
                "surat_keluar.id AS id_surat",
                "surat_keluar.id_ref_klasifikasi",
                "surat_keluar.id_ref_fungsi",
                "surat_keluar.id_ref_kegiatan",
                "surat_keluar.id_ref_transaksi",
                "surat_keluar.id_nomenklatur_jabatan",
                "surat_keluar.no_surat",
                DB::raw("(CASE WHEN surat_keluar.internal = 1 THEN 'Internal' ELSE surat_keluar.tujuan END) AS tujuan"),
                "surat_keluar.internal",
                "surat_keluar.perihal",
                "surat_keluar.tgl_surat",
                "surat_keluar.file",
                "surat_keluar.id_status",
                "users.name AS dibuat_oleh",
            )->leftJoin("users", "surat_keluar.created_by","=","users.id")
            ->groupBy(
                "surat_keluar.id",
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
                "surat_keluar.id_status",
                "users.name"
                )
            ->orderBy("surat_keluar.created_at","DESC")
            ->get();
        }
            
        $pdf = PDF::loadView('register/surat_keluar/print', ['table'=>$table,'tahun'=>$request->tahun, 'bulan'=>$bulan])->setPaper('a4', 'landscape');

        return $pdf->stream("file.pdf");
    }
}
