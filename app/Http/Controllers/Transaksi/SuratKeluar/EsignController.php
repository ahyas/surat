<?php

namespace App\Http\Controllers\Transaksi\SuratKeluar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Crypt;

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
        ->where('transaksi_nomenklatur_jabatan.user_id', auth()->user()->id)
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
        ->join('transaksi_nomenklatur_jabatan', 'surat_keluar.id_nomenklatur_jabatan', 'transaksi_nomenklatur_jabatan.nomenklatur_id')
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
        $errors = [];
        $data = [];

        $file = DB::table('transaksi_surat_keluar')->where('id',$request->id_surat)->first();

        $current_doc_path = public_path('uploads/surat_keluar/'.$file->file);
        
        $templateProcessor = new TemplateProcessor($current_doc_path);

        $variable = $templateProcessor->getVariables();
            //chek if variable defined inside document
            if($variable){
                if($file->id_nomenklatur_jabatan == 1 && !in_array('esign_ketua', $variable)){ //ketua
                    $errors['err_marking_ketua'] = "Error: Marking tidak sesuai dengan Nomenklatur Jabatan Ketua. Periksa kembali dokumen Anda.";
                }elseif($file->id_nomenklatur_jabatan == 2 && !in_array('esign_panitera', $variable)){ //panitera
                    $errors['err_marking_panitera'] = "Error: Marking tidak sesuai dengan Nomenklatur Jabatan Panitera. Periksa kembali dokumen Anda.";
                }elseif($file->id_nomenklatur_jabatan == 3 && !in_array('esign_sekretaris', $variable)){ //sekretaris
                    $errors['err_marking_sekretaris'] = "Error: Marking tidak sesuai dengan Nomenklatur Jabatan Sekretaris. Periksa kembali dokumen Anda.";
                }else{
                    DB::table('transaksi_esign')
                    ->insert([
                        'id_surat' => $request->id_surat,
                        'status' => 1,
                    ]);
                }

            }else{
                $errors['err_variable']= 'Error: Marking belum di definisikan, periksa kembali dokumen Anda. Pastikan hanya menggunakan marking yang valid untuk dokumen digital: ${esign_ketua}, ${esign_panitera} atau ${esign_sekretaris}';
            }

            //get error/success message
            if (!empty($errors)) {
                $data['success'] = false;
                $data['errors'] = $errors;
            } else {
                $data['success'] = true;
                $data['message'] = 'Success!';
            }

            return response()->json($data);
        }

    public function otorisasi(Request $request){
        $file = DB::table('transaksi_surat_keluar')->where('id',$request->id_surat)->first();
        
        if($file->id_nomenklatur_jabatan == 1){ //ketua
            $file_ttd = "esign_ketua.jpg";
            $marking_ttd = "esign_ketua";
        }else if($file->id_nomenklatur_jabatan == 2){ //panitera
            $file_ttd = "esign_panitera.jpg";
            $marking_ttd = "esign_panitera";
        }else{//sekretaris
            $file_ttd = "esign_sekretaris.jpg";
            $marking_ttd = "esign_sekretaris";
        }
        //start generate qrcode
        $file_qrcode = $request->id_surat.'.png';
        $path_qrcode = storage_path('app/public/qrcodes/'.$file_qrcode);
        
        $generate_qrcode = QrCode::format('png')->size(130)->generate(route('transaksi.surat_keluar.verify', Crypt::encrypt($request->id_surat)));

        //Storage::put('public/qrcodes', $file_qrcode, $generate_qrcode);
        Storage::disk('local')->put('public/qrcodes/'.$file_qrcode, $generate_qrcode);
        //end generate qrcode

        //ambil dokumen
        $current_doc_path = public_path('uploads/surat_keluar/'.$file->file);
        
        $templateProcessor = new TemplateProcessor($current_doc_path);
        //$templateProcessor->setValue('esign', "BARCODE");
        $templateProcessor->setValue('no_surat', $file->no_surat);
        //$templateProcessor->setImageValue($marking_ttd, array('path' => asset('public/'.$file_ttd), 'width' => 100, 'height' => 100, 'ratio' => false));
        $templateProcessor->setImageValue($marking_ttd, array('path' => $path_qrcode, 'width' => 100, 'height' => 100, 'ratio' => false));

        //$templateProcessor->save();
        File::delete(public_path('/uploads/surat_keluar/'.$file->file));
        $new_file = 'signed_'.$file->file;
        $templateProcessor->saveAs(public_path('/uploads/surat_keluar/'.$new_file));

        DB::table('transaksi_esign')->where('id_surat', $request->id_surat)->update([
            'status' => 2,
        ]);
        
        DB::table('transaksi_surat_keluar')->where('id',$request->id_surat)
        ->update([
            'file'=>$new_file    
        ]);

        return response()->json($file->file);
    }
}
