<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use PDF;

class RegisterSuratMasukController extends Controller
{
    public function index(){
        return view('register/surat_masuk/index');
    }

    public function getData($tahun){
        $table=DB::table("transaksi_surat_masuk AS surat_masuk")
        ->where("surat_masuk.tahun", $tahun)
        ->select(
            //DB::raw("surat_masuk.created_at AS tahun"),
            "surat_masuk.id",
            "surat_masuk.tahun",
            "surat_masuk.no_surat",
            "surat_masuk.pengirim",
            "surat_masuk.rahasia",
            "surat_masuk.perihal",
            "surat_masuk.tgl_surat",
            "surat_masuk.file",
            "surat_masuk.id_status",
            "users.name AS dibuat_oleh",
            DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
        )->leftJoin("users", "surat_masuk.created_by","=","users.id")
        ->orderBy("surat_masuk.created_at","DESC")
        ->get();

        return response()->json($table);
    }

    public function print(Request $request){
        $table=DB::table("transaksi_surat_masuk AS surat_masuk")
        ->whereYear('surat_masuk.created_at', $request->tahun)
        ->select(
            "surat_masuk.id",
            "surat_masuk.no_surat",
            "surat_masuk.pengirim",
            "surat_masuk.rahasia",
            "surat_masuk.perihal",
            "surat_masuk.tgl_surat",
            "surat_masuk.file",
            "users.name AS dibuat_oleh",
            "surat_masuk.id_status",
            DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
        )
        ->leftJoin("users", "surat_masuk.created_by","=","users.id")
        ->orderBy("surat_masuk.created_at","DESC")
        ->get();

        $pdf = PDF::loadView('register/surat_masuk/print', ['table'=>$table,'tahun'=>$request->tahun])->setPaper('a4', 'landscape');

        return $pdf->stream("file.pdf");
    }
}
