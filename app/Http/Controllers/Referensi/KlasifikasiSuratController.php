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
        $error = [];
        $data = [];
        if(empty($request["kode_klasifikasi"])){
            $error["err_kode"] = "Kode klasifikasi tidak boleh kosong";
        }

        if(empty($request["deskripsi_klasifikasi"])){
            $error["err_deskripsi"] = "Deskripsi klasifikasi tidak boleh kosong";
        }

        if(!empty($error)){
            $data["success"] = false;
            $data["message"] = $error;
        }else{
            $data["success"] = true;
            $data["message"] = "Success";
            DB::table("ref_klasifikasi")
            ->insert([
                "kode"=>$request["kode_klasifikasi"],
                "deskripsi"=>$request["deskripsi_klasifikasi"]
            ]);
        }

        return response()->json($data);
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

        $error = [];
        $data = [];

        if(empty($request["deskripsi_klasifikasi"])){
            $error["err_deskripsi"] = "Deskripsi klasifikasi tidak boleh kosong";
        }

        if(!empty($error)){
            $data["success"] = false;
            $data["message"] = $error;
        }else{
            $data["success"] = true;
            $data["message"] = "Success";
            DB::table("ref_klasifikasi")
            ->where("id", $id_klasifikasi)
            ->update(
                [
                    "deskripsi"=>$request["deskripsi_klasifikasi"]
                ]
            );
        }

        return response()->json($data);
    }

    public function delete($id_klasifikasi){
        $errors = [];
        $data = [];

        $count = DB::table("transaksi_surat_keluar")
        ->where("id_ref_klasifikasi", $id_klasifikasi)
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

            DB::table("ref_klasifikasi")
            ->where("id", $id_klasifikasi)
            ->delete();
        }        

        return response()->json($data);
    }
}
