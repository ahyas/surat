<?php

namespace App\Http\Controllers\Referensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class FungsiSuratController extends Controller
{
    public function getFungsiSurat(){
        $table = DB::table("ref_klasifikasi")
        ->select(
            "ref_klasifikasi.deskripsi AS deskripsi_klasifikasi",
            "ref_klasifikasi.kode AS kode_klasifikasi",
            "ref_klasifikasi.deskripsi AS deskripsi_klasifikasi",
            "ref_fungsi.id_ref_klasifikasi AS id_klasifikasi",
            "ref_fungsi.kode AS kode_fungsi",
            "ref_fungsi.deskripsi AS deskripsi_fungsi")
        ->join("ref_fungsi", "ref_klasifikasi.id","=","ref_fungsi.id_ref_klasifikasi")
        ->get();

        return response()->json($table);
    }

    public function detailFungsiSurat($id_ref_klasifikasi){
        $table = DB::table("ref_fungsi")
        ->where("id_ref_klasifikasi", $id_ref_klasifikasi)
        ->select(
            "id_ref_klasifikasi",
            "id AS id_fungsi",
            "kode AS kode_fungsi",
            "deskripsi AS deskripsi_fungsi")
        ->get();

        return response()->json($table);
    }

    public function save(Request $request){
        DB::table("ref_fungsi")
        ->insert([
            "id_ref_klasifikasi"=>$request["id_ref_klasifikasi"],
            "kode"=>$request["kode_ref_fungsi"],
            "deskripsi"=>$request["deskripsi_ref_fungsi"]
        ]);

        return response()->json($request);
    }

    public function edit($id_fungsi){
        $table=DB::table("ref_fungsi")
        ->select(
            "id_ref_klasifikasi",
            "id AS id_fungsi",
            "kode AS kode_fungsi",
            "deskripsi AS deskripsi_fungsi"
        )
        ->where("id",$id_fungsi)
        ->first();

        return response()->json($table);
    }

    public function update(Request $request, $id_fungsi){
        DB::table("ref_fungsi")
        ->where("id", $id_fungsi)
        ->update([
            "kode"=>$request["kode_ref_fungsi"],
            "deskripsi"=>$request["deskripsi_ref_fungsi"]
        ]);

        return response()->json();
    }

    public function delete($id_fungsi){
        DB::table("ref_fungsi")
        ->where("id",$id_fungsi)
        ->delete();
        
        return response()->json();
    }
}
