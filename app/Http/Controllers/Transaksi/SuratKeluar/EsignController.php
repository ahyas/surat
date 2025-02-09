<?php

namespace App\Http\Controllers\Transaksi\SuratKeluar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PhpOffice\PhpWord\TemplateProcessor;
use File;

class EsignController extends Controller
{
    public function index(){
        return view('transaksi/surat_keluar/esign/index');
    }

    public function getData(){
        $table = DB::table("transaksi_surat_keluar AS surat_keluar")
        ->where("surat_keluar.id_status",1)
        ->whereNotNull("surat_keluar.file")
        ->whereNotIn("surat_keluar.internal",[111])
        ->where('transaksi_esign.status', 1)
        //s->whereNotNull('surat_keluar.file')
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
            "users.name AS dibuat_oleh",
            DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.deskripsi ELSE ref_transaksi.deskripsi END) AS deskripsi"),
            DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.kode ELSE ref_transaksi.kode END) AS kode_surat"),
        )->leftJoin("ref_fungsi", "surat_keluar.id_ref_fungsi","=", "ref_fungsi.id")
        ->leftJoin("ref_kegiatan", "surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
        ->leftJoin("ref_transaksi", "surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
        ->leftJoin("detail_transaksi_surat", "surat_keluar.id","=","detail_transaksi_surat.id_surat")
        ->leftJoin("users", "surat_keluar.created_by","=","users.id")
        ->join('transaksi_esign', 'surat_keluar.id', '=', 'transaksi_esign.id_surat')
        ->groupBy("surat_keluar.id",
            "surat_keluar.id_ref_klasifikasi",
            "surat_keluar.id_ref_fungsi",
            "surat_keluar.id_ref_kegiatan",
            "surat_keluar.id_ref_transaksi",
            "surat_keluar.id_nomenklatur_jabatan",
            "surat_keluar.no_surat",
            "surat_keluar.tujuan",
            "surat_keluar.perihal",
            "surat_keluar.tgl_surat",
            "surat_keluar.file",
            "ref_fungsi.kode",
            "ref_kegiatan.kode",
            "ref_transaksi.kode",
            "ref_kegiatan.deskripsi",
            "ref_transaksi.deskripsi",
            "surat_keluar.internal", 
            "users.name",)
        ->orderBy("surat_keluar.created_at","DESC")->get();

        return response()->json($table);
    }

    public function saveEsign(Request $request){

        $file = DB::table('transaksi_surat_keluar')->where('id',$request->id_surat)->first();

        $current_doc_path = public_path('uploads/surat_keluar/'.$file->file);
        
        $templateProcessor = new TemplateProcessor($current_doc_path);

        $variable = $templateProcessor->getVariables();

        if($variable){
            if($variable[0] == 'esign'){
                DB::table('transaksi_esign')
                ->insert([
                    'id_surat' => $request->id_surat,
                    'status' => 1,
                ]);

                $msg='';
            }
        }else{
            $msg= 'Error: Variabel ${{esign}} belum didefinisikan. Periksa kembali dokumen Anda.';
        }

        return response()->json($msg);
    }

    public function otorisasi(Request $request){
        $file = DB::table('transaksi_surat_keluar')->where('id',$request->id_surat)->first();

        $current_doc_path = public_path('uploads/surat_keluar/'.$file->file);
        
        $templateProcessor = new TemplateProcessor($current_doc_path);
        //$templateProcessor->setValue('esign', "BARCODE");
        $templateProcessor->setImageValue('esign', array('path' => asset('public/qr.png'), 'width' => 100, 'height' => 100, 'ratio' => false));

        //$templateProcessor->save();
        File::delete(public_path('/uploads/surat_keluar/'.$file->file));
        $templateProcessor->saveAs(public_path('/uploads/surat_keluar/'.$file->file));

        DB::table('transaksi_esign')->where('id_surat', $request->id_surat)->update([
            'status' => 2
        ]);

        return response()->json($file->file);
    }
}
