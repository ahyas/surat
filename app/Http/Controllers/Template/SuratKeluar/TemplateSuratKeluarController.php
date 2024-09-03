<?php

namespace App\Http\Controllers\Template\SuratKeluar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use PhpOffice\PhpWord\TemplateProcessor;
use Validator;
use PDF;

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

        $user = DB::table("users")
        ->where("daftar_pegawai.status", 1)
        ->select("users.id AS id_user","users.name AS nama_pegawai")
        ->join("daftar_pegawai", "users.id","=","daftar_pegawai.id_user")
        ->get();

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
        $table= DB::table("transaksi_surat_keluar")
        ->where("transaksi_surat_keluar.id",$id)
        ->select(
            "transaksi_surat_keluar.id AS id_surat",
            "transaksi_surat_keluar.id_ref_klasifikasi",
            "transaksi_surat_keluar.id_ref_fungsi",
            "transaksi_surat_keluar.id_ref_kegiatan",
            "transaksi_surat_keluar.id_ref_transaksi",
            "transaksi_surat_keluar.no_surat",
            "transaksi_surat_keluar.perihal",
            "transaksi_surat_keluar.id_nomenklatur_jabatan",
            "transaksi_surat_keluar.tgl_surat",
            "template_sk.menetapkan",
            "transaksi_surat_keluar.perihal",
            DB::raw("(CASE WHEN transaksi_surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.kode ELSE ref_transaksi.kode END) AS kode_surat"),
            )
        ->leftJoin("ref_kegiatan", "transaksi_surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
        ->leftJoin("ref_transaksi", "transaksi_surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
        ->join("template_sk", "transaksi_surat_keluar.id","=","template_sk.id_surat_keluar")
        ->first();

        $nomenklatur_jabatan = DB::table("ref_nomenklatur_jabatan")
        ->select("id","nomenklatur")
        ->get();

        $klasifikasi = DB::table("ref_klasifikasi")
        ->select(
            "id AS id_klasifikasi",
            "kode AS kode_klasifikasi",
            "deskripsi AS deskripsi_klasifikasi"
        )->get();

        $fungsi = DB::table("ref_fungsi")
        ->where("id_ref_klasifikasi", $table->id_ref_klasifikasi)
        ->select(
            "id AS id_fungsi",
            "kode AS kode_fungsi",
            "deskripsi AS deskripsi_fungsi"
        )->get();

        $kegiatan = DB::table("ref_kegiatan")
        ->where("id_ref_fungsi", $table->id_ref_fungsi)
        ->select(
            "id AS id_kegiatan",
            "kode AS kode_kegiatan",
            "deskripsi AS deskripsi_kegiatan"
        )->get();

        $transaksi = DB::table("ref_transaksi")
        ->where("id_ref_kegiatan", $table->id_ref_kegiatan)
        ->select(
            "id AS id_transaksi",
            "kode AS kode_transaksi",
            "deskripsi AS deskripsi_transaksi"
        )->get();

        $pegawai = DB::table("users")
        ->select("users.id","users.name")
        ->where("daftar_pegawai.status",1)
        ->join("daftar_pegawai","users.id","=","daftar_pegawai.id_user")
        ->get();

        $user = DB::table("users")
        ->where("daftar_pegawai.status", 1)
        ->select("users.id AS id_user","users.name AS nama_pegawai")
        ->join("daftar_pegawai", "users.id","=","daftar_pegawai.id_user")
        ->get();

        $count_menimbang = DB::table("template_sk_menimbang")->where("id_surat_keluar",$id)->count();
        $count_mengingat = DB::table("template_sk_mengingat")->where("id_surat_keluar",$id)->count();
        $count_menetapkan = DB::table("template_sk_menetapkan")->where("id_surat_keluar",$id)->count();

        return view("template_master.template_sk", 
        compact(
            "table",
            "nomenklatur_jabatan",
            "pegawai",
            "count_menimbang",
            "count_mengingat",
            "count_menetapkan",
            "klasifikasi",
            "fungsi",
            "kegiatan",
            "transaksi",
            "user")
        );
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

    public function getBulanRomawi($tgl_surat){
        $date = strtotime($tgl_surat);
        
        $bulan =  ltrim(date("m", $date), "0"); 

        switch($bulan){
            case 1:
                return "I";
            break;
            case 2:
                return "II";
            break;
            case 3:
                return "III";
            break;
            case 4:
                return "IV";
            break;
            case 5:
                return "V";
            break;
            case 6:
                return "VI";
            break;
            case 7:
                return "VII";
            break;
            case 8:
                return "VIII";
            break;
            case 9:
                return "IX";
            break;
            case 10:
                return "X";
            break;
            case 11:
                return "XI";
            break;
            case 12:
                return "XII";
            break;
            default:

                return "";

        }
    }

    public function updateSurat(Request $request, $id){  
        $errors = [];
        $data = [];

        if (empty($request["nomenklatur_jabatan"])) {
            $errors['nomenklatur_jabatan'] = 'Nomenklatur jabatan tidak boleh kosong';    
        }else{
            $date = strtotime($request["tgl_surat"]);
            $bulan = $this->getBulanRomawi($request["tgl_surat"]);
            $tahun = date("Y", $date); 

            $agenda = DB::table("transaksi_surat_keluar")
            ->where("id",$id)
            ->select(
                "no_agenda"
            )->first();

            $no_agenda = sprintf('%03d', $agenda->no_agenda);

            if($request["nomenklatur_jabatan"] == 1){
                $nomor_surat =  $no_agenda."/KPTA.W31-A/".$request['kode_surat']."/".$bulan."/".$tahun;
            }

            if($request["nomenklatur_jabatan"] == 2){
                $nomor_surat = $no_agenda."/PAN.PTA.W31-A/".$request['kode_surat']."/".$bulan."/".$tahun;
            }

            if($request["nomenklatur_jabatan"] == 3){
                $nomor_surat = $no_agenda."/SEK.PTA.W31-A/".$request['kode_surat']."/".$bulan."/".$tahun;
                
            }
        }

      
        if (empty($request["tujuan"])) {
            $errors['tujuan'] = 'Tujuan surat tidak boleh kosong';
        }

        if (empty($request["perihal"])) {
            $errors['perihal'] = 'Perihal surat tidak boleh kosong';
        }

        if (empty($request["tgl_surat"])) {
            $errors['tgl_surat'] = 'Tanggal surat tidak boleh kosong';
        }

        if (empty($request["count_menetapkan"])) {
            $errors['count_menetapkan'] = 'Menetapkan surat tidak boleh kosong';
        }

        if (empty($request["count_mengingat"])) {
            $errors['count_mengingat'] = 'Mengingat tidak boleh kosong';
        }

        if (empty($request["count_menimbang"])) {
            $errors['count_menimbang'] = 'Menimbang tidak boleh kosong';
        }

        if (empty($request["menetapkan"])) {
            $errors['menetapkan'] = 'Menetapkan tidak boleh kosong';
        }

        //-----


        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
            $data['success'] = true;
            $data['message'] = 'Success!';
            //--------start save daftar penerima surat-------------
            DB::table("detail_transaksi_surat")
            ->where("id_surat", $id)
            ->delete();

            $tujuan = $request["tujuan"];
            $value = array();
            
            foreach($tujuan as $id_pegawai){
                if(!empty($id_pegawai)){
                    $value[] = [
                        "id_surat"=>$id,
                        "id_penerima"=>$id_pegawai
                    ];
                }
            }

            DB::table('detail_transaksi_surat')->insert($value);
            //--------end save daftar penerima surat-------------
            
            DB::table("template_sk")
            ->where("id_surat_keluar",$id)
            ->update([
                "menetapkan"=>$request["menetapkan"]
            ]);

            $filename = $id.".docx";

            DB::table("transaksi_surat_keluar")
            ->where("id",$id)
            ->update([
                "id_ref_klasifikasi"=>$request["klasifikasi"],
                "id_ref_fungsi"=>$request["fungsi"],
                "id_ref_kegiatan"=>$request["kegiatan"],
                "id_ref_transaksi"=>$request["transaksi"],
                "id_nomenklatur_jabatan"=>$request["nomenklatur_jabatan"],
                "no_surat"=>$nomor_surat,
                "perihal"=>$request["perihal"],
                "tgl_surat"=>$request["tgl_surat"],
                "file"=>$filename
            ]);

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
            
            //load template file
            $file = public_path('template.docx');
            $templateProcessor = new TemplateProcessor($file);
            $templateProcessor->setValue('nomor_surat', $nomor_surat);
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
            //$templateProcessor->saveAs(storage_path($filename));
            $templateProcessor->saveAs(public_path('/uploads/surat_keluar/'.$filename));

        }

        return response()->json(["data"=>$data,"request"=>$request]);

    }

    public function deleteSurat($id_surat_keluar){
        $old_file = DB::table("template_transaksi")->where('id_surat_keluar',$id_surat_keluar)
        ->first();
        //delete file
     
        if (file_exists(storage_path($old_file->file))) {
            unlink(storage_path($old_file->file));
        }

        DB::table("template_sk")
        ->where("id_surat_keluar",$id_surat_keluar)
        ->delete();

        DB::table("template_sk_menetapkan")
        ->where("id_surat_keluar",$id_surat_keluar)
        ->delete();

        DB::table("template_sk_mengingat")
        ->where("id_surat_keluar",$id_surat_keluar)
        ->delete();

        DB::table("template_sk_menimbang")
        ->where("id_surat_keluar",$id_surat_keluar)
        ->delete();

        DB::table("template_sk_nominatif")
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
            
            //$data['count'] = DB::table("template_sk_menimbang")->where("id_surat_keluar",$id)->count();
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
