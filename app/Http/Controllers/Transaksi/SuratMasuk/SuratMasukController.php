<?php

namespace App\Http\Controllers\Transaksi\SuratMasuk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SuratMasukController extends Controller
{
    public function index(){
        return view('transaksi/surat_masuk/index');
    }

    public function getData(){
        $table=DB::table("transaksi_surat_masuk")
        ->select(
            "id",
            "no_surat",
            "pengirim",
            "perihal",
            "tgl_surat",
            "file"
        )->get();

        return response()->json($table);
    }

    public function save(Request $request){
        if($request->hasFile('file_surat')){
            $fileName = time().'.'.$request->file_surat->extension();
            $tujuan_upload = public_path('/uploads/surat_masuk');
            $request->file_surat->move($tujuan_upload, $fileName);
            DB::table("transaksi_surat_masuk")
            ->insert([
                "no_surat"=>$request["nomor_surat"],
                "pengirim"=>$request["pengirim"],
                "perihal"=>$request["perihal"],
                "tgl_surat"=>$request["tgl_surat"],
                "file"=>$fileName
            ]);
        }

        return response()->json();
    }
}
