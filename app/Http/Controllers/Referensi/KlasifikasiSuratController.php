<?php

namespace App\Http\Controllers\Referensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class KlasifikasiSuratController extends Controller
{
    public function index(){
        return view('klasifikasi_surat/index');
    }

    public function getKlasifikasi(){
        $table = DB::table("ref_klasifikasi")
        ->select(
            "id AS id_klasifikasi",
            "kode AS kode_klasifikasi",
            "deskripsi AS deskripsi_klasifikasi"
        )
        ->get();

        return response()->json($table);
    }

    public function save(Request $request){
        DB::table("ref_klasifikasi")
        ->insert([
            "kode"=>$request["kode_klasifikasi"],
            "deskripsi"=>$request["deskripsi_klasifikasi"]
        ]);

        return response()->json($request);
    }

    public function edit($id_klasifikasi){
        $table=DB::table("ref_klasifikasi")
        ->where("id", $id_klasifikasi)
        ->select(
            "id AS id_klasifikasi",
            "kode AS kode_klasifikasi",
            "deskripsi AS deskripsi_klasifikasi"
        )
        ->first();

        return response()->json($table);
    }

    public function update(Request $request, $id_klasifikasi){
        $table=DB::table("ref_klasifikasi")
        ->where("id", $id_klasifikasi)
        ->update(
            [
                "kode"=>$request["kode_klasifikasi"],
                "deskripsi"=>$request["deskripsi_klasifikasi"]
            ]
        );

        return response()->json($table);
    }

    public function delete($id_klasifikasi){
        DB::table("ref_klasifikasi")
        ->where("id", $id_klasifikasi)
        ->delete();

        return response()->json();
    }
}
