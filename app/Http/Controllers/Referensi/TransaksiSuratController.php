<?php

namespace App\Http\Controllers\Referensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class TransaksiSuratController extends Controller
{
    public function detailTransaksiSurat($id_ref_kegiatan){
        $table=DB::table("ref_transaksi")
        ->where("id_ref_kegiatan",$id_ref_kegiatan)
        ->select(
            "id AS id_transaksi",
            "kode AS kode_transaksi", 
            "deskripsi AS deskripsi_transaksi")
        ->get();

        return response()->json($table);
    }

    public function save(Request $request){
        DB::table("ref_transaksi")
        ->insert([
            "id_ref_kegiatan"=>$request["id_ref_kegiatan"],
            "kode"=>$request["kode_transaksi"],
            "deskripsi"=>$request["deskripsi_transaksi"]
        ]);

        return response()->json();
    }

    public function edit($id_transaksi){
        $table=DB::table("ref_transaksi")
        ->where("id",$id_transaksi)
        ->first();

        return response()->json($table);
    }

    public function update(Request $request, $id_transaksi){
        DB::table("ref_transaksi")
        ->where("id",$id_transaksi)
        ->update(
            [
                "kode"=>$request["kode_transaksi"],
                "deskripsi"=>$request["deskripsi_transaksi"]
            ]
        );

        return response()->json();
    }

    public function delete($id_transaksi){
        $errors = [];
        $data = [];

        $count = DB::table("transaksi_surat_keluar")
        ->where("id_ref_transaksi", $id_transaksi)
        ->count();

        if($count > 0){
            $errors['data_exist'] = 'Tidak dapat menghapus. Data sudah digunakan.';    
        }

        if (!empty($errors)) {
            $data['success'] = false;
            $data['message'] = $errors;
        } else {
            $data['success'] = true;
            $data['message'] = 'Success!';

            DB::table("ref_transaksi")
            ->where("id",$id_transaksi)
            ->delete();
        }  

        return response()->json($data);
    }
}
