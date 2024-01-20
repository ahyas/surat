<?php

namespace App\Http\Controllers\Transaksi\SuratMasuk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class SuratMasukController extends Controller
{
    public function index(){
        $id_role = Auth::user()->getRole()->id_role;
        switch ($id_role){
            //login sebagai operator surat
            case 5:
                return view('transaksi/surat_masuk/index_5');
            break;
            //login sebagai admin monitoring
            case 101:
                return view('transaksi/surat_masuk/index_101');
            break;
            //login sebagai admin forwarder
            default :
                return view('transaksi/surat_masuk/index_6');
        }

    }

    public function getData(){
        $id_role = Auth::user()->getRole()->id_role;
        switch ($id_role){
            //login sebagai operator surat
            case 5:
                $table=DB::table("transaksi_surat_masuk")
                ->where("rahasia", 'false')
                ->select(
                    "id",
                    "no_surat",
                    "pengirim",
                    "perihal",
                    "tgl_surat",
                    "file"
                )
                ->orderBy("created_at","DESC")
                ->get();

                return response()->json($table);
            break;
            //login sebagai admin forwarder
            default :
                $table=DB::table("transaksi_surat_masuk")
                ->select(
                    "id",
                    "no_surat",
                    "pengirim",
                    "perihal",
                    "tgl_surat",
                    "rahasia",
                    "file"
                )
                ->orderBy("created_at","DESC")
                ->get();

                return response()->json($table);
        }

        
    }

    public function save(Request $request){
        $errors = [];
        $data = [];

        if (empty($request["nomor_surat"])) {
            $errors['nomor_surat'] = 'Nomor surat tidak boleh kosong';
        }

        if (empty($request["pengirim"])) {
            $errors['pengirim'] = 'Pihak pengirim tidak boleh kosong';
        }

        if (empty($request["perihal"])) {
            $errors['perihal'] = 'Perihal surat tidak boleh kosong';
        }

        if (empty($request["tgl_surat"])) {
            $errors['tgl_surat'] = 'Tanggal surat tidak boleh kosong';
        }

        if(empty($request->hasFile('file_surat'))){
            $errors['file_surat'] = 'File surat tidak boleh kosong';

        }else{
            $allowed = ["pdf"];
            $ext = strtolower($request->file_surat->extension());
            if(!in_array($ext, $allowed)){
                $errors['file_surat'] = 'Jenis file harus PDF';
            }
        }

        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
            $data['success'] = true;
            $data['message'] = 'Success!';

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

        return response()->json($data);
    }

    public function edit($id){
        $table = DB::table("transaksi_surat_masuk")
        ->where("id",$id)
        ->select(
            "no_surat",
            "pengirim",
            "perihal",
            "tgl_surat",
            "rahasia"
        )->get();

        return response()->json($table);
    }

    public function update(Request $request, $id){
        $errors = [];
        $data = [];

        if (empty($request["nomor_surat"])) {
            $errors['nomor_surat'] = 'Nomor surat tidak boleh kosong';
        }

        if (empty($request["pengirim"])) {
            $errors['pengirim'] = 'Pihak pengirim tidak boleh kosong';
        }

        if (empty($request["perihal"])) {
            $errors['perihal'] = 'Perihal surat tidak boleh kosong';
        }

        if (empty($request["tgl_surat"])) {
            $errors['tgl_surat'] = 'Tanggal surat tidak boleh kosong';
        }

        if($request->hasFile('file_surat')){
            $allowed = ["pdf"];
            $ext = strtolower($request->file_surat->extension());
            if(!in_array($ext, $allowed)){
                $errors['file_surat'] = 'Jenis file harus PDF';
            }
        }

        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
            $data['success'] = true;
            $data['message'] = 'Success!';

            if($request->hasFile('file_surat')){
                //cari file lama
                $old_file = DB::table("transaksi_surat_masuk")->select('file')->where('id',$id)->first();
                //overwrite file lama
                if (file_exists( public_path('/uploads/surat_masuk/'.$old_file->file))) {
                    unlink(public_path('/uploads/surat_masuk/'.$old_file->file));
                }
    
                $fileName = time().'.'.$request->file_surat->extension();
                $tujuan_upload = public_path('/uploads/surat_masuk');
                $request->file_surat->move($tujuan_upload, $fileName);
    
                DB::table("transaksi_surat_masuk")
                ->where("id", $id)
                ->update(
                    [
                        "no_surat"=>$request["nomor_surat"],
                        "pengirim"=>$request["pengirim"],
                        "perihal"=>$request["perihal"],
                        "tgl_surat"=>$request["tgl_surat"],
                        "rahasia"=>isset($request["rahasia"]) ? 'true' : 'false',
                        "file"=>$fileName
                    ]
                );
            }else{
                DB::table("transaksi_surat_masuk")
                ->where("id", $id)
                ->update(
                    [
                        "no_surat"=>$request["nomor_surat"],
                        "pengirim"=>$request["pengirim"],
                        "perihal"=>$request["perihal"],
                        "tgl_surat"=>$request["tgl_surat"],
                        "rahasia"=>isset($request["rahasia"]) ? 'true' : 'false'
                    ]
                );
            }
    
        }

        return response()->json($data);
    }

    public function delete($id){
        $old_file = DB::table("transaksi_surat_masuk")->select('file')->where('id',$id)->first();

        if (file_exists( public_path('/uploads/surat_masuk/'.$old_file->file))) {
            unlink(public_path('/uploads/surat_masuk/'.$old_file->file));
        }

        DB::table("transaksi_surat_masuk")
        ->where("id",$id)
        ->delete();

        return response()->json();
    }
}
