<?php

namespace App\Http\Controllers\Template\SuratKeluar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use PhpOffice\PhpWord\TemplateProcessor;

class TemplateSuratKeluarController extends Controller
{
    public function index(){
        $id_role = Auth::user()->getRole()->id_role;
        $klasifikasi = DB::table("ref_klasifikasi")
        ->select(
            "id AS id_klasifikasi",
            "kode AS kode_klasifikasi",
            "deskripsi AS deskripsi_klasifikasi"
        )->get();

        $template_surat_keluar = DB::table("template_jenis_surat_keluar")
        ->select(
            "id",
            "keterangan",
        )->get();

        $draft_surat_keluar = DB::table("transaksi_surat_keluar")
        ->where("id_status",1) //status draft/konsep
        ->where("created_by",Auth::user()->id)
        ->whereNotIn("id", function($query){
            $query->select("id_surat_keluar")->from("template_transaksi");
        })
        ->select("id","no_surat")
        ->get();

        $user = DB::table("users")->select("id AS id_user","name AS nama_pegawai")->get();

        $nomenklatur_jabatan = DB::table("ref_nomenklatur_jabatan")
        ->select(
            "id",
            "nomenklatur"
        )->get();
        
        switch ($id_role){
            case 10:
                return view('template.surat_keluar.index_10', compact(
                    "klasifikasi",
                    "nomenklatur_jabatan",
                    "user",
                    "template_surat_keluar",
                    "draft_surat_keluar",
                ));
            break;
            
            default :
                return view('template.surat_keluar.index_6', 
                compact(
                    "klasifikasi",
                    "nomenklatur_jabatan",
                    "user",
                    "template_surat_keluar",
                    "draft_surat_keluar",
                    )
                );
        }
    }

    public function getData(){
        $table = DB::table("template_transaksi")
        ->where("transaksi_surat_keluar.created_by",Auth::user()->id)
        ->select(
            "transaksi_surat_keluar.id AS id_surat",
            "transaksi_surat_keluar.no_surat",
            "transaksi_surat_keluar.internal",
            "transaksi_surat_keluar.perihal",
            "transaksi_surat_keluar.tgl_surat",
            "template_jenis_surat_keluar.keterangan AS jenis_template",
            "template_transaksi.file")
        ->join("transaksi_surat_keluar", "template_transaksi.id_surat_keluar","=","transaksi_surat_keluar.id")
        ->join("template_jenis_surat_keluar", "template_transaksi.id_jenis","=","template_jenis_surat_keluar.id")
        ->get();

        return response()->json($table);
    }

    public function save(Request $request){
        $errors = [];
        $data = [];

        if (empty($request["nomor_surat_keluar"])) {
            $errors['nomor_surat_keluar'] = 'Nomor surat tidak boleh kosong';
        }

        if (empty($request["perihal"])) {
            $errors['perihal'] = 'Perihal surat tidak boleh kosong';
        }

        if (empty($request["tgl_surat"])) {
            $errors['tgl_surat'] = 'Tanggal surat tidak boleh kosong';
        }

        if (empty($request["template_surat_keluar"])) {
            $errors['template_surat_keluar'] = 'Pilih template yang sesuai';
        }

        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
            $data['success'] = true;
            $data['message'] = 'Success!';

            //masukan transaksi surat
            DB::table("transaksi_surat_keluar")
            ->where("id",$request["id_surat_keluar"])
            ->update([
                "perihal"=>$request["perihal"],
                "tgl_surat"=>$request["tgl_surat"],
            ]);

            DB::table("template_transaksi")
            ->insertOrIgnore(
                ["id_jenis"=>$request["template_surat_keluar"], "id_surat_keluar"=>$request["nomor_surat_keluar"]],
            );

            DB::table("template_sk")
            ->insert([
                "id_surat_keluar"=>$request["id_surat_keluar"]
            ]);
        }

        return response()->json($data);
    }

    public function detailSurat($id){
        $detail = DB::table("transaksi_surat_keluar")->where("id",$id)->first();

        return response()->json(
            ["detail"=>$detail]
        );
    }

    public function count(){
        $count = DB::table("transaksi_surat_keluar")
        ->where("id_status",1) //status draft/konsep
        ->where("created_by",Auth::user()->id)
        ->whereNotIn("id", function($query){
            $query->select("id_surat_keluar")->from("template_transaksi");
        })->count();

        return response()->json($count);
    }

    public function editSurat($id){
        $nomenklatur_jabatan = DB::table("ref_nomenklatur_jabatan")
        ->select("id","nomenklatur")
        ->get();

        $table= DB::table("transaksi_surat_keluar")
        ->select(
            "transaksi_surat_keluar.id AS id_surat",
            "transaksi_surat_keluar.no_surat",
            "transaksi_surat_keluar.perihal",
            "transaksi_surat_keluar.id_nomenklatur_jabatan",
            "transaksi_surat_keluar.tgl_surat",
            "template_sk.menetapkan",
            "transaksi_surat_keluar.perihal"
            )
        ->where("transaksi_surat_keluar.id",$id)
        ->join("template_sk", "transaksi_surat_keluar.id","=","template_sk.id_surat_keluar")
        ->first();

        $pegawai = DB::table("users")
        ->select("id","name")
        ->get();

        return view("template_master.template_sk", compact("table","nomenklatur_jabatan","pegawai"));
    }

    public function getNominatif($id_surat_keluar){
        $table = DB::table("template_sk_nominatif AS nominatif")
        ->where("nominatif.id_surat_keluar",$id_surat_keluar)
        ->join("users", "nominatif.id_user","=","users.id")
        ->join("daftar_pegawai","nominatif.id_user","=","daftar_pegawai.id_user")
        ->join("ref_jabatan","daftar_pegawai.id_jabatan","=","ref_jabatan.id")
        ->select(
            "nominatif.id_user",
            "nominatif.id_surat_keluar",
            "users.name",
            "nominatif.jabatan_dalam_tim",
            "ref_jabatan.nama AS jabatan",
            "daftar_pegawai.nip")
        ->get();

        return response()->json($table);
    }

    public function deleteNominatif($id_surat_keluar, $id_user){
        DB::table("template_sk_nominatif")
        ->where("id_surat_keluar",$id_surat_keluar)
        ->where("id_user",$id_user)
        ->delete();
        return response()->json();
    }

    public function saveNominatif(Request $request, $id_surat_keluar){
        $data=[];
        $error=[];

        $count = DB::table("template_sk_nominatif")
        ->where("id_user", $request["pegawai"])
        ->where("id_surat_keluar", $id_surat_keluar)
        ->count();

        if($count > 0){
            $error["err_exist"] = "User sudah ada. Cari yang lain.";
        }

        if($request["pegawai"] == 0){
            $error["err_pegawai"] = "Pilih pegawai yang sesuai";
        }

        if($request["jabatan_tim"] == ""){
            $error["err_jabatan_tim"] = "Masukan jabatan tim yang sesuai";
        }

        if(!empty($error)){
            $data["success"] = false;
            $data["msg"] = $error;
        }else{
            $data["success"] = true;
            $data["msg"] = "Success";

            DB::table("template_sk_nominatif")
            ->insert([
                "id_user"=>$request["pegawai"],
                "id_surat_keluar"=>$id_surat_keluar,
                "jabatan_dalam_tim"=>$request["jabatan_tim"]
            ]);
        }

        return response()->json($data);
    }

    public function editNominatif($id_surat_keluar, $id_user){
        $table = DB::table("template_sk_nominatif")
        ->where("id_surat_keluar",$id_surat_keluar)
        ->where("id_user",$id_user)
        ->first();

        return response()->json($table);
    }

    public function updateNominatif(Request $request, $id_surat_keluar, $id_user){
        $data = [];
        $error=[];

        if($request["jabatan_tim"] == ""){
            $error["err_jabatan_tim"] = "Masukan jabatan tim yang sesuai";
        }

        if(!empty($error)){
            $data["success"] = false;
            $data["msg"] = $error;
        }else{
            $data["success"] = true;
            $data["msg"] = "Success";

            DB::table("template_sk_nominatif")
            ->where("id_surat_keluar",$id_surat_keluar)
            ->where("id_user",$id_user)
            ->update([
                "jabatan_dalam_tim"=>$request["jabatan_tim"]
            ]);
        }

        return response()->json($data);
    }

    public function updateSurat(Request $request, $id){  
        $errors = [];
        $data = [];

        if (empty($request["perihal"])) {
            $errors['perihal'] = 'perihal surat harus diisi.';
        }

        if (empty($request["tgl_surat"])) {
            $errors['tgl_surat'] = 'Tanggal surat harus diisi.';
        }

        if (empty($request["menetapkan"])) {
            $errors['menetapkan'] = 'Tanggal surat harus diisi.';
        }

        if(!empty($errors)){
            $data["success"] = false;
            $data["errors"] = $errors;
        }else{
            $data['success'] = true;
            $data['message'] = 'Success!';

            DB::table("template_sk")
            ->where("id_surat_keluar",$id)
            ->update([
                "menetapkan"=>$request["menetapkan"]
            ]);

            DB::table("transaksi_surat_keluar")
            ->where("id",$id)
            ->update([
                "perihal"=>$request["perihal"],
                "tgl_surat"=>$request["tgl_surat"],
            ]);

            $filename = $id.".docx";

            DB::table("template_transaksi")
            ->where("id_surat_keluar", $id)
            ->update([
                "file"=>$filename
            ]);

            $menimbang = DB::table("template_sk_menimbang")
            ->where("id_surat_keluar",$id)
            ->select("keterangan AS menimbang")
            ->get();

            $mengingat = DB::table("template_sk_mengingat")
            ->where("id_surat_keluar",$id)
            ->select("keterangan AS mengingat")
            ->get();

            $menetapkan = DB::table("template_sk_menetapkan")
            ->where("id_surat_keluar",$id)
            ->select(
                "list_order AS nomor",
                "keterangan AS list_menetapkan")
            ->get();

            $daftar_nominatif = DB::table("template_sk_nominatif AS nominatif")
            ->where("nominatif.id_surat_keluar",$id)
            ->join("users", "nominatif.id_user","=","users.id")
            ->join("daftar_pegawai","nominatif.id_user","=","daftar_pegawai.id_user")
            ->join("ref_jabatan","daftar_pegawai.id_jabatan","=","ref_jabatan.id")
            ->select(
                "users.name AS pegawai",
                "ref_jabatan.nama AS jabatan",
                "nominatif.jabatan_dalam_tim",
                "daftar_pegawai.nip"
                )
            ->get();

            $file = public_path('template.docx');
            $templateProcessor = new TemplateProcessor($file);
            $templateProcessor->setValue('nomor_surat', $request["nomor_surat"]);
            $templateProcessor->setValue('perihal', $request["perihal"]);
            foreach($menimbang AS $row){
                $list_menimbang[]= array('menimbang' => $row->menimbang);
            }
            $templateProcessor->cloneBlock('block_menimbang', 0, true, false, $list_menimbang);

            foreach($mengingat AS $row){
                $list_mengingat[]= array('mengingat' => $row->mengingat);
            }
            $templateProcessor->cloneBlock('block_mengingat', 0, true, false, $list_mengingat);

            $templateProcessor->setValue('menetapkan', $request["menetapkan"]);

            $templateProcessor->cloneRowAndSetValues('nomor', $menetapkan);

            $templateProcessor->setValue('tgl_surat', $request["tgl_surat"]);

            $templateProcessor->cloneRowAndSetValues('pegawai', $daftar_nominatif);
            
            $templateProcessor->setValue('pageBreakHere', '</w:t></w:r>'.'<w:r><w:br w:type="page"/></w:r>'.'<w:r><w:t>');
            $templateProcessor->saveAs(storage_path($filename));

            return redirect()->route("template.surat_keluar", compact("data"));
        }
    }

    public function deleteSurat($id_surat_keluar){
        $old_file = DB::table("template_transaksi")->where('id_surat_keluar',$id_surat_keluar)
        ->first();

        if($old_file->file !== null){    
            //overwrite file lama
            if (file_exists( public_path('/storage/'.$old_file->file))) {
                unlink(public_path('/storage/'.$old_file->file));
            }
        }

        DB::table("template_sk")
        ->where("id_surat_keluar",$id_surat_keluar)
        ->delete();

        DB::table("template_transaksi")
        ->where("id_surat_keluar",$id_surat_keluar)
        ->delete();

        return response()->json();
    }

    public function getMenimbang($id){
        $table = DB::table("template_sk_menimbang")
        ->where("template_sk_menimbang.id_surat_keluar", $id)
        ->select("template_sk_menimbang.id","template_sk_menimbang.keterangan AS menimbang")
        ->get();

        return response()->json($table);
    }

    public function saveMenimbang(Request $request, $id){
        $data = [];
        $error= [];

        if(empty($request["rincian_menimbang"])){
            $error["menimbang"] = "Masukan rincian yang sesuai";
        }

        if(!empty($error)){
            $data['success'] = false;
            $data['msg'] = $error;
        }else{
            $data['success'] = true;
            $data['msg'] = "Success";
            
            DB::table("template_sk_menimbang")
            ->insert([
                "id_surat_keluar"=>$id,
                "keterangan"=>$request["rincian_menimbang"]
            ]);
        }

        return response()->json($data);
    }

    public function editMenimbang($id){
        $table = DB::table("template_sk_menimbang")
        ->where("template_sk_menimbang.id", $id)
        ->select("template_sk_menimbang.id","template_sk_menimbang.keterangan AS menimbang")
        ->first();

        return response()->json($table);
    }

    public function updateMenimbang(Request $request, $id_menimbang){
        $data = [];
        $errors = [];

        if(empty($request["rincian_menimbang"])){
            $errors["err_menimbang"] = "Masukan rincian yang sesuai";
        }

        if(!empty($errors)){
            $data["success"] = false;
            $data["msg"] = $errors;
        }else{
            $data["success"] = true;
            $data["msg"] = "Success";

            DB::table("template_sk_menimbang")
            ->where("template_sk_menimbang.id", $id_menimbang)
            ->update([
                "keterangan"=>$request["rincian_menimbang"]
            ]);
        }

        return response()->json($data);
    }

    public function deleteMenimbang($id_menimbang){
        DB::table("template_sk_menimbang")
        ->where("template_sk_menimbang.id", $id_menimbang)
        ->delete();

        return response()->json();
    }

    public function getMengingat($id){
        $table = DB::table("template_sk_mengingat")
        ->where("template_sk_mengingat.id_surat_keluar", $id)
        ->select("template_sk_mengingat.id","template_sk_mengingat.keterangan AS mengingat")
        ->get();

        return response()->json($table);
    }

    public function saveMengingat(Request $request, $id){
        $data = [];
        $error=[];
        if(empty($request["rincian_mengingat"])){
            $error["err_mengingat"] = "Masukan rincian yang sesuai";
        }

        if(!empty($error)){
            $data["success"] = false;
            $data["msg"] = $error;
        }else{
            $data["success"] = true;
            $data["msg"] = "Success";

            DB::table("template_sk_mengingat")
            ->insert([
                "id_surat_keluar"=>$id,
                "keterangan"=>$request["rincian_mengingat"]
            ]);
        }

        return response()->json($data);
    }

    public function editMengingat($id_mengingat){
        $table = DB::table("template_sk_mengingat")
        ->where("id",$id_mengingat)
        ->select("id","keterangan AS mengingat")
        ->first();

        return response()->json($table);
    }

    public function updateMengingat(Request $request, $id_mengingat){
        $data = [];
        $error = [];

        if(empty($request["rincian_mengingat"])){
            $error["err_mengingat"] = "Masukan rincian yang sesuai";
        }

        if(!empty($error)){
            $data["success"] = false;
            $data["msg"] = $error;
        }else{
            $data["success"] = true;
            $data["msg"] = "Success";

            DB::table("template_sk_mengingat")
            ->where("id",$id_mengingat)
            ->update([
                "keterangan"=>$request["rincian_mengingat"]
            ]);
        }

        return response()->json($data);
    }

    public function deleteMengingat($id_mengingat){
        DB::table("template_sk_mengingat")
        ->where("id",$id_mengingat)
        ->delete();

        return response()->json();
    }

    public function getMenetapkan($id){
        $table = DB::table("template_sk_menetapkan")
        ->where("template_sk_menetapkan.id_surat_keluar", $id)
        ->select("template_sk_menetapkan.id","template_sk_menetapkan.keterangan AS menetapkan")
        ->get();

        return response()->json($table);
    }

    function penyebut($nilai){
        $nilai = abs($nilai);
        $huruf = array("","PERTAMA","DUA","TIGA","EMPAT","LIMA","ENAM","TUJUH","DELAPAN","SEMBILAN","SEPULUH","SEBELAS");
        $temp = "";
        
        if($nilai<12){
            $temp = " ".$huruf[$nilai];
        }
    }

    public function saveMenetapkan(Request $request, $id){
        $data=[];
        $error=[];


        if(empty($request["rincian_menetapkan"])){
            $error["err_menetapkan"] = "Masukan rincian yang sesuai";
        }

        if(!empty($error)){
            $data["success"] = false;
            $data["msg"] = $error;
        }else{
            $data["success"] = true;
            $data["msg"] = "Success";

            $count = DB::table("template_sk_menetapkan")
            ->where("id_surat_keluar",$id)
            ->count();

            $nilai = $count +1;

            $huruf = array("","PERTAMA","KEDUA","KETIGA","KEEMPAT","KELIMA","KEENAM","KETUJUH","KEDELAPAN","KESEMBILAN","KESEPULUH","KESEBELAS");
            $temp = "";
            
            if($nilai<12){
                $temp = " ".$huruf[$nilai];
            }

            DB::table("template_sk_menetapkan")
            ->insert([
                "id_surat_keluar"=>$id,
                "list_order"=>$temp,
                "keterangan"=>$request["rincian_menetapkan"]
            ]);

        }

        return response()->json($data);
    }

    public function editMenetapkan($id){
        $table = DB::table("template_sk_menetapkan")
        ->where("template_sk_menetapkan.id", $id)
        ->select(
            "template_sk_menetapkan.keterangan AS menetapkan")
        ->first();

        return response()->json($table);
    }

    public function updateMenetapkan(Request $request, $id_menetapkan){
        $data = [];
        $error = [];
        
        if(empty($request["rincian_menetapkan"])){
            $error["err_menetapkan"] = "Masukan rincian yang sesuai";
        }

        if(!empty($error)){
            $data["success"]=false;
            $data["msg"] = $error;
        }else{
            $data["success"]=true;
            $data["msg"]="Success";

            DB::table("template_sk_menetapkan")
            ->where("template_sk_menetapkan.id", $id_menetapkan)
            ->update([
                "keterangan"=>$request["rincian_menetapkan"]
            ]);
        }

        return response()->json($data);
    }

    public function deleteMenetapkan($id_menetapkan){
        DB::table("template_sk_menetapkan")
        ->where("template_sk_menetapkan.id", $id_menetapkan)
        ->delete();

        return response()->json();
    }
}
