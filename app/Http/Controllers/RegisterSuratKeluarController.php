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

    public function getData($tahun){
        $table = DB::table("transaksi_surat_keluar AS surat_keluar")
        ->where("surat_keluar.tahun", $tahun)
        ->where("surat_keluar.id_status",1)
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
        )->groupBy(
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
            "surat_keluar.id_status")
        ->orderBy("surat_keluar.created_at","DESC")
        ->get();

        return response()->json($table);
    }

    public function print(Request $request){
        $table = DB::table("transaksi_surat_keluar AS surat_keluar")
        ->where("surat_keluar.tahun", $request->tahun)
        ->where("surat_keluar.id_status",1)
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
        )->groupBy(
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
            "surat_keluar.id_status")
        ->orderBy("surat_keluar.created_at","DESC")
        ->get();
            
        $pdf = PDF::loadView('register/surat_keluar/print', ['table'=>$table,'tahun'=>$request->tahun])->setPaper('a4', 'landscape');

        return $pdf->stream("file.pdf");
    }
}
