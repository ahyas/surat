<?php

namespace App\Http\Controllers\Transaksi\SuratKeluar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class SuratKeluarController extends Controller
{
    public function index(){
        $id_role = Auth::user()->getRole()->id_role;
        
        switch ($id_role){
            //login sebagai admin disposisi 1
            case 8:
                return view('transaksi/surat_keluar/index_8');
            break;
            //login sebagai admin monitoring
            case 101:
                return view('transaksi.surat_keluar.index_101');
            break;
            
            default :
                $klasifikasi = DB::table("ref_klasifikasi")
                ->select(
                    "id AS id_klasifikasi",
                    "kode AS kode_klasifikasi",
                    "deskripsi AS deskripsi_klasifikasi"
                )->get();

                $user = DB::table("users")->select("id AS id_user","name AS nama_pegawai")->get();
        
                $nomenklatur_jabatan = DB::table("ref_nomenklatur_jabatan")
                ->select(
                    "id",
                    "nomenklatur"
                )->get();

                return view("transaksi.surat_keluar.index", compact("klasifikasi","nomenklatur_jabatan","user"));
        }

    }

    public function getFungsiList($id_ref_klasifikasi){
        $fungsi = DB::table("ref_fungsi")
        ->where("id_ref_klasifikasi", $id_ref_klasifikasi)
        ->select(
            "id AS id_fungsi",
            "kode AS kode_fungsi",
            "deskripsi AS deskripsi_fungsi"
        )->get();

        return response()->json($fungsi);
    }

    public function getKegiatanList($id_ref_fungsi){
        $kegiatan = DB::table("ref_kegiatan")
        ->where("id_ref_fungsi", $id_ref_fungsi)
        ->select(
            "id AS id_kegiatan",
            "kode AS kode_kegiatan",
            "deskripsi AS deskripsi_kegiatan"
        )->get();

        return response()->json($kegiatan);
    }

    public function getTransaksiList($id_ref_kegiatan){
        $transaksi = DB::table("ref_transaksi")
        ->where("id_ref_kegiatan", $id_ref_kegiatan)
        ->select(
            "id AS id_transaksi",
            "kode AS kode_transaksi",
            "deskripsi AS deskripsi_transaksi"
        )->get();

        return response()->json($transaksi);
    }

    public function getData(){
        $id_role = Auth::user()->getRole()->id_role;
        switch ($id_role){
            //login sebagai admin disposisi 1
            case 8:
                $table = DB::table("transaksi_surat_keluar AS surat_keluar")
                ->whereNotIn("internal", [111]) //nomor tidak terpakai
                ->where('detail_transaksi_surat.id_penerima', Auth::user()->id)
                ->select(
                    "surat_keluar.id AS id_surat",
                    "surat_keluar.id_ref_klasifikasi",
                    "surat_keluar.id_ref_fungsi",
                    "surat_keluar.id_ref_kegiatan",
                    "surat_keluar.id_ref_transaksi",
                    "surat_keluar.id_nomenklatur_jabatan",
                    "surat_keluar.no_surat",
                    "surat_keluar.tujuan",
                    "surat_keluar.internal",
                    "surat_keluar.perihal",
                    "surat_keluar.tgl_surat",
                    "surat_keluar.file",
                    "ref_fungsi.kode AS kode_fungsi",
                    "ref_kegiatan.kode AS kode_kegiatan",
                    "ref_transaksi.kode AS kode_transaksi",
                    DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN CONCAT(ref_kegiatan.kode,' - ',ref_kegiatan.deskripsi) ELSE CONCAT(ref_transaksi.kode,' - ',ref_transaksi.deskripsi) END) AS deskripsi"),
                    DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.kode ELSE ref_transaksi.kode END) AS kode_surat"),
                )->leftJoin("ref_fungsi", "surat_keluar.id_ref_fungsi","=", "ref_fungsi.id")
                ->leftJoin("ref_kegiatan", "surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
                ->leftJoin("ref_transaksi", "surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
                ->leftJoin("detail_transaksi_surat", "surat_keluar.id","=","detail_transaksi_surat.id_surat")
                ->groupBy("surat_keluar.id","surat_keluar.id_ref_klasifikasi","surat_keluar.id_ref_fungsi","surat_keluar.id_ref_kegiatan","surat_keluar.id_ref_transaksi","surat_keluar.id_nomenklatur_jabatan","surat_keluar.no_surat","surat_keluar.tujuan","surat_keluar.perihal","surat_keluar.tgl_surat","surat_keluar.file","ref_fungsi.kode","ref_kegiatan.kode","ref_transaksi.kode","ref_kegiatan.deskripsi","ref_transaksi.deskripsi","surat_keluar.internal")
                ->orderBy("surat_keluar.created_at","DESC")->get();

                return response()->json($table);
            break;

            default:
            $table = DB::table("transaksi_surat_keluar AS surat_keluar")
            ->whereNotIn("internal", [111]) //nomor tidak terpakai
            ->select(
                "surat_keluar.id AS id_surat",
                "surat_keluar.id_ref_klasifikasi",
                "surat_keluar.id_ref_fungsi",
                "surat_keluar.id_ref_kegiatan",
                "surat_keluar.id_ref_transaksi",
                "surat_keluar.id_nomenklatur_jabatan",
                "surat_keluar.no_surat",
                "surat_keluar.tujuan",
                "surat_keluar.internal",
                "surat_keluar.perihal",
                "surat_keluar.tgl_surat",
                "surat_keluar.file",
                "ref_fungsi.kode AS kode_fungsi",
                "ref_kegiatan.kode AS kode_kegiatan",
                "ref_transaksi.kode AS kode_transaksi",
                DB::raw('COUNT(detail_transaksi_surat.id_surat) AS jumlah_tembusan'),
                DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN CONCAT(ref_kegiatan.kode,' - ',ref_kegiatan.deskripsi) ELSE CONCAT(ref_transaksi.kode,' - ',ref_transaksi.deskripsi) END) AS deskripsi"),
                DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.kode ELSE ref_transaksi.kode END) AS kode_surat"),
            )->leftJoin("ref_fungsi", "surat_keluar.id_ref_fungsi","=", "ref_fungsi.id")
            ->leftJoin("ref_kegiatan", "surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
            ->leftJoin("ref_transaksi", "surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
            ->leftJoin("detail_transaksi_surat", "surat_keluar.id","=","detail_transaksi_surat.id_surat")
            ->groupBy("surat_keluar.id","surat_keluar.id_ref_klasifikasi","surat_keluar.id_ref_fungsi","surat_keluar.id_ref_kegiatan","surat_keluar.id_ref_transaksi","surat_keluar.id_nomenklatur_jabatan","surat_keluar.no_surat","surat_keluar.tujuan","surat_keluar.perihal","surat_keluar.tgl_surat","surat_keluar.file","ref_fungsi.kode","ref_kegiatan.kode","ref_transaksi.kode","ref_kegiatan.deskripsi","ref_transaksi.deskripsi","surat_keluar.internal")
            ->orderBy("surat_keluar.created_at","DESC")->get();

            return response()->json($table);

        }
    }

    public function getDetailSurat($id_surat){
        $table = DB::table("detail_transaksi_surat")
        ->where("id_surat", $id_surat)
        ->select("users.name AS nama_penerima", "users.email","bidang.nama AS nama_bidang")
        ->join("users", "detail_transaksi_surat.id_penerima","=","users.id")
        ->leftJoin("bidang","users.id_bidang","=","bidang.id")
        ->get();

        return response()->json($table);
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

    public function save(Request $request){
        $errors = [];
        $data = [];

        if (empty($request["nomenklatur_jabatan"])) {
            $errors['nomenklatur_jabatan'] = 'Nomenklatur jabatan tidak boleh kosong';    
        }else{
            
            $date = strtotime($request["tgl_surat"]);
            $bulan = $this->getBulanRomawi($request["tgl_surat"]);
            $tahun = date("Y", $date); 

            $count = DB::table("transaksi_surat_keluar")->max("no_agenda");

            $num = $count +1;

            $no_agenda = sprintf('%03d', $num);

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

        if(empty($request["penerima_surat"])){
            $errors['penerima_surat'] = 'Penerima surat tidak boleh kosong';
        }else{
            if($request["penerima_surat"] == 1){
                if (empty($request["tujuan"])) {
                    $errors['tujuan'] = 'Tujuan surat tidak boleh kosong';
                }
            }else{
                if (empty($request["tujuan-external"])) {
                    $errors['tujuan'] = 'Tujuan surat tidak boleh kosong';
                }
            }
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
            $tujuan_upload = public_path('/uploads/surat_keluar');
            $request->file_surat->move($tujuan_upload, $fileName);
            //masukan transaksi surat
            DB::table("transaksi_surat_keluar")
            ->insert([
                "id_ref_klasifikasi"=>$request["klasifikasi"],
                "id_ref_fungsi"=>$request["fungsi"],
                "id_ref_kegiatan"=>$request["kegiatan"],
                "id_ref_transaksi"=>$request["transaksi"],
                "id_nomenklatur_jabatan"=>$request["nomenklatur_jabatan"],
                "no_agenda"=>$num,
                "no_surat"=>$nomor_surat,
                "internal"=>$request["penerima_surat"],
                "perihal"=>$request["perihal"],
                "tgl_surat"=>$request["tgl_surat"],
                "file"=>$fileName
            ]);

            $id_surat = DB::getPdo()->lastInsertId();
            //internal
            if($request["penerima_surat"] == 1){
                //detail transaksi surat
                $tujuan = $request["tujuan"];
                $value = array();
                //get last id
                //get penerima surat
                foreach($tujuan as $id_pegawai){
                    if(!empty($id_pegawai)){
                        $value[] = [
                            "id_surat"=>$id_surat,
                            "id_penerima"=>$id_pegawai
                        ];
                    }
                }
                //insert penerima surat
                DB::table('detail_transaksi_surat')
                ->insert($value);                
            //eksternal
            }else{
                DB::table("transaksi_surat_keluar")
                ->where("id", $id_surat)
                ->update([
                    "tujuan"=>$request["tujuan-external"]
                ]);
            }

        }

        return response()->json($data);
    }

    public function edit($id_surat){
        $table=DB::table("transaksi_surat_keluar")
        ->where("id",$id_surat)
        ->first();

        $id_klasifikasi = $table->id_ref_klasifikasi;
        $id_fungsi = $table->id_ref_fungsi;
        $id_kegiatan = $table->id_ref_kegiatan;
        $id_transaksi = $table->id_ref_transaksi;
        $id_nomenklatur = $table->id_nomenklatur_jabatan;

        $ref_fungsi = DB::table("ref_fungsi")
        ->select(
            "id AS id_fungsi",
            "kode AS kode_fungsi",
            "deskripsi AS deskripsi_fungsi"
        )
        ->where("id_ref_klasifikasi", $id_klasifikasi)
        ->get();

        $kegiatan = DB::table("ref_kegiatan")
        ->where("id_ref_fungsi", $id_fungsi)
        ->select(
            "id AS id_kegiatan",
            "kode AS kode_kegiatan",
            "deskripsi AS deskripsi_kegiatan"
        )->get();

        $transaksi = DB::table("ref_transaksi")
        ->where("id_ref_kegiatan", $id_kegiatan)
        ->select(
            "id AS id_transaksi",
            "kode AS kode_transaksi",
            "deskripsi AS deskripsi_transaksi"
        )->get();

        $tujuan_surat = DB::table("detail_transaksi_surat")
        ->select("id_penerima")
        ->where("id_surat", $id_surat)
        ->get();

        return response()->json([
            "tujuan_surat"=>$tujuan_surat,
            "surat_keluar"=>$table, 
            "id_klasifikasi"=>$id_klasifikasi,
            "id_fungsi"=>$id_fungsi, 
            "ref_fungsi"=>$ref_fungsi,
            "id_kegiatan"=>$id_kegiatan,
            "ref_kegiatan"=>$kegiatan,
            "id_transaksi"=>$id_transaksi,
            "ref_transaksi"=>$transaksi,
            "id_nomenklatur"=>$id_nomenklatur
        ]);
    }

    public function update(Request $request, $id){
        $errors = [];
        $data = [];

        if (empty($request["nomenklatur_jabatan"])) {
            $errors['nomenklatur_jabatan'] = 'Nomenklatur jabatan tidak boleh kosong';    
        }else{
            $date = strtotime($request["tgl_surat"]);
            $bulan = $this->getBulanRomawi($request["tgl_surat"]);
            $tahun = date("Y", $date); 

            $count = DB::table("transaksi_surat_keluar")
            ->select(
                "id AS id_surat"
            )->count();

            $num = $count +1;

            $no_agenda = sprintf('%03d', $num);

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

        
        if($request["penerima_surat"] == 1){
            if (empty($request["tujuan"])) {
                $errors['tujuan'] = 'Tujuan surat tidak boleh kosong';
            }
        }else{
            if (empty($request["tujuan-external"])) {
                $errors['tujuan'] = 'Tujuan surat tidak boleh kosong';
            }
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
                $old_file = DB::table("transaksi_surat_keluar")->select('file')->where('id',$id)
                ->first();

                //overwrite file lama
                if (file_exists( public_path('/uploads/surat_keluar/'.$old_file->file))) {
                    unlink(public_path('/uploads/surat_keluar/'.$old_file->file));
                }
    
                $fileName = time().'.'.$request->file_surat->extension();
                $tujuan_upload = public_path('/uploads/surat_keluar');
                $request->file_surat->move($tujuan_upload, $fileName);
    
                DB::table("transaksi_surat_keluar")
                ->where("id", $id)
                ->update(
                    [
                        "id_ref_klasifikasi"=>$request["klasifikasi"],
                        "id_ref_fungsi"=>$request["fungsi"],
                        "id_ref_kegiatan"=>$request["kegiatan"],
                        "id_ref_transaksi"=>$request["transaksi"],
                        "id_nomenklatur_jabatan"=>$request["nomenklatur_jabatan"],
                        "no_surat"=>$nomor_surat,
                        "perihal"=>$request["perihal"],
                        "tgl_surat"=>$request["tgl_surat"],
                        "file"=>$fileName
                    ]
                );

                //internal
            if($request["penerima_surat"] == 1){
                //replace old data with new data
                DB::table("detail_transaksi_surat")
                ->where("id_surat", $id)
                ->delete();

                //detail transaksi surat
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
            }else{
                DB::table("transaksi_surat_keluar")
                ->where("id", $id)
                ->update([
                    "tujuan"=>$request["tujuan-external"]
                ]);
            }

            }else{
                DB::table("transaksi_surat_keluar")
                ->where("id", $id)
                ->update(
                    [
                        "id_ref_klasifikasi"=>$request["klasifikasi"],
                        "id_ref_fungsi"=>$request["fungsi"],
                        "id_ref_kegiatan"=>$request["kegiatan"],
                        "id_ref_transaksi"=>$request["transaksi"],
                        "id_nomenklatur_jabatan"=>$request["nomenklatur_jabatan"],
                        "no_surat"=>$nomor_surat,
                        "perihal"=>$request["perihal"],
                        "tgl_surat"=>$request["tgl_surat"],
                    ]
                );
                 //internal
                if($request["penerima_surat"] == 1){
                    //replace old data with new data
                    DB::table("detail_transaksi_surat")
                    ->where("id_surat", $id)
                    ->delete();

                    //detail transaksi surat
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

                    DB::table('detail_transaksi_surat')
                    ->insert($value);
                }else{
                    DB::table("transaksi_surat_keluar")
                    ->where("id", $id)
                    ->update([
                        "tujuan"=>$request["tujuan-external"]
                    ]);
                }
                
            }
    
        }

        return response()->json($data);
    }

    public function delete($id_surat){
        DB::table("transaksi_surat_keluar")->where("id", $id_surat)->delete();
        DB::table("detail_transaksi_surat")->where("id_surat", $id_surat)->delete();
        return response()->json();
    }
}
