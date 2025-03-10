<?php

namespace App\Http\Controllers\Arsip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class ArsipSuratMasukController extends Controller
{
    public function index(){
        return view('arsip/surat_masuk/index');
    }

    public function getData(){
        $id_role = Auth::user()->getRole()->id_role;
        switch ($id_role){
            //login sebagai operator surat
            case 5:
                $table=DB::table("transaksi_surat_masuk AS surat_masuk")
                ->where("surat_masuk.id_status",3)
                ->select(
                    "surat_masuk.id",
                    "surat_masuk.no_surat",
                    "surat_masuk.pengirim",
                    "surat_masuk.kerahasiaan",
                    "surat_masuk.perihal",
                    "surat_masuk.tgl_surat",
                    "surat_masuk.file",
                    "surat_masuk.id_status",
                    DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
                );

                $table = $table->addSelect(DB::raw("'1' as jenis_surat"));
                $table = $table->orderBy("surat_masuk.tgl_surat","DESC")->get();

                $table2 = DB::table("transaksi_surat_keluar AS surat_keluar")
                ->whereIn("detail_transaksi_surat.id_penerima",[Auth::user()->id])
                ->whereNotIn("surat_keluar.internal",[111])
                ->where("surat_keluar.id_status",1)
                ->whereNotNull("surat_keluar.file")
                ->select(
                    "surat_keluar.id",
                    "surat_keluar.no_surat",
                    "users.name AS pengirim",
                    "users.name AS rahasia",
                    "surat_keluar.perihal",
                    "surat_keluar.tgl_surat",
                    "surat_keluar.file",
                    "surat_keluar.id_status AS status",
                    DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.deskripsi ELSE ref_transaksi.deskripsi END) AS deskripsi")
                )->leftJoin("ref_fungsi", "surat_keluar.id_ref_fungsi","=", "ref_fungsi.id")
                ->leftJoin("ref_kegiatan", "surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
                ->leftJoin("ref_transaksi", "surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
                ->leftJoin("detail_transaksi_surat", "surat_keluar.id","=","detail_transaksi_surat.id_surat")
                ->leftJoin("users", "surat_keluar.created_by","=","users.id");

                $table2 = $table2->addSelect(DB::raw("'2' as jenis_surat"));
                $table2 = $table2->orderBy("surat_keluar.created_at","DESC")
                ->get();

                $merged = $table->merge($table2);

                return response()->json($merged);
            break;

            //login sebagai admin tata usaha
            case 6:
                $table=DB::table("transaksi_surat_masuk AS surat_masuk")
                ->where("surat_masuk.id_status",3)
                ->select(
                    "surat_masuk.id",
                    "surat_masuk.no_surat",
                    "surat_masuk.pengirim",
                    "surat_masuk.kerahasiaan",
                    "surat_masuk.perihal",
                    "surat_masuk.tgl_surat",
                    "surat_masuk.file",
                    "surat_masuk.id_status",
                    DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status")
                );

                $table = $table->addSelect(DB::raw("'1' as jenis_surat"));
                $table = $table->orderBy("surat_masuk.updated_at","DESC")->get();

                $table2 = DB::table("transaksi_surat_keluar AS surat_keluar")
                ->whereIn("detail_transaksi_surat.id_penerima",[Auth::user()->id])
                ->whereNotIn("surat_keluar.internal",[111])
                ->where("surat_keluar.id_status",1)
                ->whereNotNull("surat_keluar.file")
                ->select(
                    "surat_keluar.id",
                    "surat_keluar.no_surat",
                    "users.name AS pengirim",
                    "users.name AS rahasia",
                    "surat_keluar.perihal",
                    "surat_keluar.tgl_surat",
                    "surat_keluar.file",
                    DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.deskripsi ELSE ref_transaksi.deskripsi END) AS deskripsi"),
                    "surat_keluar.id_status AS status"
                )->leftJoin("ref_fungsi", "surat_keluar.id_ref_fungsi","=", "ref_fungsi.id")
                ->leftJoin("ref_kegiatan", "surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
                ->leftJoin("ref_transaksi", "surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
                ->leftJoin("detail_transaksi_surat", "surat_keluar.id","=","detail_transaksi_surat.id_surat")
                ->leftJoin("users", "surat_keluar.created_by","=","users.id");

                $table2 = $table2->addSelect(DB::raw("'2' as jenis_surat"));
                $table2 = $table2->orderBy("surat_keluar.created_at","DESC")
                ->get();

                $merged = $table->merge($table2);

                return response()->json($merged);
            break;
            //login sebagai admin disposisi 2
            case 10:
                $table=DB::table("transaksi_surat_masuk AS surat_masuk")
                ->where("detail_surat_masuk.id_penerima", Auth::user()->id)
                ->where("surat_masuk.id_status",3)
                ->select(
                    "surat_masuk.id",
                    "surat_masuk.no_surat",
                    "surat_masuk.pengirim",
                    "surat_masuk.kerahasiaan",
                    "surat_masuk.perihal",
                    "surat_masuk.tgl_surat",
                    "surat_masuk.file",
                    "surat_masuk.id_status",
                    DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status")
                )->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat");

                $table = $table->addSelect(DB::raw("'1' as jenis_surat"));
                $table = $table->orderBy("surat_masuk.tgl_surat","DESC")->get();

                $table2 = DB::table("transaksi_surat_keluar AS surat_keluar")
                ->whereIn("detail_transaksi_surat.id_penerima",[Auth::user()->id])
                ->whereNotIn("surat_keluar.internal",[111])
                ->where("surat_keluar.id_status",1)
                ->whereNotNull("surat_keluar.file")
                ->select(
                    "surat_keluar.id",
                    "surat_keluar.no_surat",
                    "users.name AS pengirim",
                    "users.name AS rahasia",
                    "surat_keluar.perihal",
                    "surat_keluar.tgl_surat",
                    "surat_keluar.file",
                    "surat_keluar.id_status AS status",
                    DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.deskripsi ELSE ref_transaksi.deskripsi END) AS deskripsi"),
                )->leftJoin("ref_fungsi", "surat_keluar.id_ref_fungsi","=", "ref_fungsi.id")
                ->leftJoin("ref_kegiatan", "surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
                ->leftJoin("ref_transaksi", "surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
                ->leftJoin("detail_transaksi_surat", "surat_keluar.id","=","detail_transaksi_surat.id_surat")
                ->leftJoin("users", "surat_keluar.created_by","=","users.id");

                $table2 = $table2->addSelect(DB::raw("'2' as jenis_surat"));
                $table2 = $table2->orderBy("surat_keluar.created_at","DESC")
                ->get();

                $merged = $table->merge($table2);

                return response()->json($merged);
            break;
            
            //login sebagai admin disposisi 1/Kasubag/End user
            default:
                $table=DB::table("transaksi_surat_masuk AS surat_masuk")
                ->where("detail_surat_masuk.id_penerima", Auth::user()->id)
                ->where("surat_masuk.id_status",3)
                ->select(
                    "surat_masuk.id",
                    "surat_masuk.no_surat",
                    "surat_masuk.pengirim",
                    "surat_masuk.kerahasiaan",
                    "surat_masuk.perihal",
                    "surat_masuk.tgl_surat",
                    "surat_masuk.file",
                    "surat_masuk.id_status",
                    DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status")
                )
                ->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat");
                
                $table = $table->addSelect(DB::raw("'1' as jenis_surat"));
                $table = $table->orderBy("surat_masuk.updated_at","DESC")->get();

                $table2 = DB::table("transaksi_surat_keluar AS surat_keluar")
                ->whereIn("detail_transaksi_surat.id_penerima",[Auth::user()->id])
                ->whereNotIn("surat_keluar.internal",[111])
                ->where("surat_keluar.id_status",1)
                ->whereNotNull("surat_keluar.file")
                ->select(
                    "surat_keluar.id",
                    "surat_keluar.no_surat",
                    "users.name AS pengirim",
                    "users.name AS rahasia",
                    "surat_keluar.perihal",
                    "surat_keluar.tgl_surat",
                    "surat_keluar.file",
                    "surat_keluar.id_status AS status",
                    DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.deskripsi ELSE ref_transaksi.deskripsi END) AS deskripsi")
                )->leftJoin("ref_fungsi", "surat_keluar.id_ref_fungsi","=", "ref_fungsi.id")
                ->leftJoin("ref_kegiatan", "surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
                ->leftJoin("ref_transaksi", "surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
                ->leftJoin("detail_transaksi_surat", "surat_keluar.id","=","detail_transaksi_surat.id_surat")
                ->leftJoin("users", "surat_keluar.created_by","=","users.id");

                $table2 = $table2->addSelect(DB::raw("'2' as jenis_surat"));
                $table2 = $table2->orderBy("surat_keluar.created_at","DESC")
                ->get();

                $merged = $table->merge($table2);

                return response()->json($merged);

        }

    }
}
