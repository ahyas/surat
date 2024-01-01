<?php

namespace App\Http\Controllers\Referensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class KegiatanSuratController extends Controller
{
    public function detailKegiatanSurat($id_ref_fungsi){
        $table = DB::table("ref_kegiatan")
        ->where("id_ref_fungsi", $id_ref_fungsi)
        ->select("id_ref_fungsi","id AS id_kegiatan","kode AS kode_kegiatan", "deskripsi AS deskripsi_kegiatan")
        ->get();

        return response()->json($table);
    }

    public function save(Request $request){
        DB::table("ref_kegiatan")
        ->insert([
            "id_ref_fungsi"=>$request["id_ref_fungsi"],
            "kode"=>$request["kode_kegiatan"],
            "deskripsi"=>$request["deskripsi_kegiatan"]
        ]);

        return response()->json();
    }

    public function edit($id_kegiatan){
        $table = DB::table("ref_kegiatan")
        ->where("id", $id_kegiatan)
        ->select("id AS id_kegiatan","kode AS kode_kegiatan", "deskripsi AS deskripsi_kegiatan")
        ->first();

        return response()->json($table);
    }

    public function update(Request $request, $id_kegiatan){
        DB::table("ref_kegiatan")
        ->where("id", $id_kegiatan)
        ->update([
            "kode"=>$request["kode_kegiatan"],
            "deskripsi"=>$request["deskripsi_kegiatan"]
        ]);

        return response()->json();
    }

    public function delete($id_kegiatan){
        DB::table("ref_kegiatan")
        ->where("id", $id_kegiatan)
        ->delete();

        return response()->json();
    }
}
