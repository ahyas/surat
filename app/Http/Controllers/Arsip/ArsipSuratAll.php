<?php

namespace App\Http\Controllers\Arsip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class ArsipSuratAll extends Controller
{
    public function index(){
        $id_role = Auth::user()->getRole()->id_role;
        //login sebagai admin disposisi
        if($id_role == 6){
            $show_print_disposisi = true;
        }else{
            $show_print_disposisi = false;
        }

        return view('arsip/semua_surat/index', compact('show_print_disposisi'));
    }

    public function getData(){
        $id_role = Auth::user()->getRole()->id_role;

        switch ($id_role){
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
                    "surat_masuk.is_internal",
                    "ref_klasifikasi.kode AS kode_klasifikasi",
                    "ref_klasifikasi.deskripsi AS klasifikasi",
                    DB::raw('COUNT(detail_surat_masuk.id_surat) AS jumlah_tembusan'),
                    DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status")
                )->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat")
                ->leftJoin("ref_klasifikasi", "surat_masuk.klasifikasi_id", "=", "ref_klasifikasi.id")
                ->groupBy("surat_masuk.id",
                    "surat_masuk.no_surat",
                    "surat_masuk.pengirim",
                    "surat_masuk.kerahasiaan",
                    "surat_masuk.perihal",
                    "surat_masuk.tgl_surat",
                    "surat_masuk.file",
                    "surat_masuk.id_status",
                    "surat_masuk.is_internal",
                    "ref_klasifikasi.kode",
                    "ref_klasifikasi.deskripsi",
                    "detail_surat_masuk.id_surat"
                );

                $table = $table->addSelect(DB::raw("'1' as jenis_surat"));
                $table = $table->addSelect(DB::raw("3 AS internal"));
                    $table = $table->addSelect(DB::raw("NULL AS tujuan"));
                $table = $table->orderBy("surat_masuk.tgl_surat","DESC")->get();

                $table2 = DB::table("transaksi_surat_keluar AS surat_keluar")
                ->where("surat_keluar.id_status",2)
                ->whereNotIn('surat_keluar.created_by', [Auth::user()->id])
                ->whereNotIn("surat_keluar.internal",[111])
                ->whereNotNull("surat_keluar.file")
                ->select(
                    "surat_keluar.id",
                    "surat_keluar.no_surat",
                    "users.name AS pengirim",
                    "users.name AS rahasia",
                    "surat_keluar.perihal",
                    "surat_keluar.tgl_surat",
                    "surat_keluar.file",
                    "surat_keluar.internal",
                    "surat_keluar.tujuan",
                    "surat_keluar.id_status AS status",
                    DB::raw('COUNT(detail_transaksi_surat.id_surat) AS jumlah_tembusan'),
                    DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.deskripsi ELSE ref_transaksi.deskripsi END) AS deskripsi"),
                )->leftJoin("ref_fungsi", "surat_keluar.id_ref_fungsi","=", "ref_fungsi.id")
                ->leftJoin("ref_kegiatan", "surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
                ->leftJoin("ref_transaksi", "surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
                ->leftJoin("detail_transaksi_surat", "surat_keluar.id","=","detail_transaksi_surat.id_surat")
                ->leftJoin("users", "surat_keluar.created_by","=","users.id")
                ->groupBy("surat_keluar.id",
                    "surat_keluar.no_surat",
                    "surat_keluar.perihal",
                    "surat_keluar.tgl_surat",
                    "surat_keluar.file",
                    "surat_keluar.id_status",
                    "ref_transaksi.deskripsi",
                    "surat_keluar.id_ref_transaksi",
                    "ref_kegiatan.deskripsi",
                    "users.name",
                    "detail_transaksi_surat.id_surat",
                    "surat_keluar.internal",
                    "surat_keluar.tujuan");

                $table2 = $table2->addSelect(DB::raw("'2' as jenis_surat"));
                $table2 = $table2->orderBy("surat_keluar.created_at","DESC")
                ->get();

                $merged = $table->merge($table2);

                $table3 = DB::table("transaksi_surat_keluar AS surat_keluar")
                ->where("surat_keluar.id_status",2)
                ->where("surat_keluar.created_by",Auth::user()->id)
                ->select(
                    "surat_keluar.id",
                    "surat_keluar.no_surat",
                    "users.name AS pengirim",
                    "users.name AS rahasia",
                    "surat_keluar.perihal",
                    "surat_keluar.tgl_surat",
                    "surat_keluar.file",
                    "surat_keluar.internal",
                    "surat_keluar.tujuan",
                    "surat_keluar.id_status AS status",
                    DB::raw('COUNT(detail_transaksi_surat.id_surat) AS jumlah_tembusan'),
                    DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.deskripsi ELSE ref_transaksi.deskripsi END) AS deskripsi"),
                )->leftJoin("ref_fungsi", "surat_keluar.id_ref_fungsi","=", "ref_fungsi.id")
                ->leftJoin("ref_kegiatan", "surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
                ->leftJoin("ref_transaksi", "surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
                ->leftJoin("detail_transaksi_surat", "surat_keluar.id","=","detail_transaksi_surat.id_surat")
                ->leftJoin("users", "surat_keluar.created_by","=","users.id")
                ->groupBy("surat_keluar.id",
                    "surat_keluar.no_surat",
                    "surat_keluar.perihal",
                    "surat_keluar.tgl_surat",
                    "surat_keluar.file",
                    "surat_keluar.id_status",
                    "ref_transaksi.deskripsi",
                    "surat_keluar.id_ref_transaksi",
                    "ref_kegiatan.deskripsi",
                    "users.name",
                    "detail_transaksi_surat.id_surat",
                    "surat_keluar.internal",
                    "surat_keluar.tujuan");

                $table3 = $table3->addSelect(DB::raw("'2' as jenis_surat"));
                $table3 = $table3->orderBy("surat_keluar.created_at","DESC")
                ->get();

                $merged2 = $merged->merge($table3);

                return response()->json($merged2);
            break;
            //login sebagai admin disposisi 1 /Sekretaris / Panitera
            case 8:
                $table=DB::table("transaksi_surat_masuk AS surat_masuk")
                ->where("surat_masuk.id_status",3)
                ->select(
                    "surat_masuk.id",
                    "surat_masuk.no_surat",
                    "surat_masuk.pengirim",
                    "surat_masuk.kerahasiaan",
                    "surat_masuk.perihal",
                    "surat_masuk.is_internal",
                    "surat_masuk.tgl_surat",
                    "surat_masuk.file",
                    "surat_masuk.id_status",
                    "ref_klasifikasi.kode AS kode_klasifikasi",
                    "ref_klasifikasi.deskripsi AS klasifikasi",
                    DB::raw('COUNT(detail_surat_masuk.id_surat) AS jumlah_tembusan'),
                    DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status")
                )->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat")
                ->leftJoin("ref_klasifikasi", "surat_masuk.klasifikasi_id", "=", "ref_klasifikasi.id")
                ->groupBy("surat_masuk.id",
                    "surat_masuk.no_surat",
                    "surat_masuk.pengirim",
                    "surat_masuk.kerahasiaan",
                    "surat_masuk.perihal",
                    "surat_masuk.is_internal",
                    "surat_masuk.tgl_surat",
                    "surat_masuk.file",
                    "surat_masuk.id_status",
                    "detail_surat_masuk.id_surat",
                    "ref_klasifikasi.kode",
                    "ref_klasifikasi.deskripsi",
                );

                $table = $table->addSelect(DB::raw("'1' as jenis_surat"));
                $table = $table->addSelect(DB::raw("3 AS internal"));
                $table = $table->addSelect(DB::raw("NULL AS tujuan"));
                $table = $table->orderBy("surat_masuk.tgl_surat","DESC")->get();

                $table2 = DB::table("transaksi_surat_keluar AS surat_keluar")
                ->where("surat_keluar.id_status",2)
                ->whereNotIn('surat_keluar.created_by', [Auth::user()->id])
                ->whereNotIn("surat_keluar.internal",[111])
                ->whereNotNull("surat_keluar.file")
                ->select(
                    "surat_keluar.id",
                    "surat_keluar.no_surat",
                    "users.name AS pengirim",
                    "users.name AS rahasia",
                    "surat_keluar.perihal",
                    "surat_keluar.tgl_surat",
                    "surat_keluar.file",
                    "surat_keluar.internal",
                    "surat_keluar.tujuan",
                    "surat_keluar.id_status AS status",
                    DB::raw('COUNT(detail_transaksi_surat.id_surat) AS jumlah_tembusan'),
                    DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.deskripsi ELSE ref_transaksi.deskripsi END) AS deskripsi"),
                )->leftJoin("ref_fungsi", "surat_keluar.id_ref_fungsi","=", "ref_fungsi.id")
                ->leftJoin("ref_kegiatan", "surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
                ->leftJoin("ref_transaksi", "surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
                ->leftJoin("detail_transaksi_surat", "surat_keluar.id","=","detail_transaksi_surat.id_surat")
                ->leftJoin("users", "surat_keluar.created_by","=","users.id")
                ->groupBy("surat_keluar.id",
                    "surat_keluar.no_surat",
                    "surat_keluar.perihal",
                    "surat_keluar.tgl_surat",
                    "surat_keluar.file",
                    "surat_keluar.id_status",
                    "ref_transaksi.deskripsi",
                    "surat_keluar.id_ref_transaksi",
                    "ref_kegiatan.deskripsi",
                    "users.name",
                    "detail_transaksi_surat.id_surat",
                    "surat_keluar.internal",
                    "surat_keluar.tujuan");

                $table2 = $table2->addSelect(DB::raw("'2' as jenis_surat"));
                $table2 = $table2->orderBy("surat_keluar.created_at","DESC")
                ->get();

                $merged = $table->merge($table2);

                $table3 = DB::table("transaksi_surat_keluar AS surat_keluar")
                ->where("surat_keluar.id_status",2)
                ->where("surat_keluar.created_by",Auth::user()->id)
                ->select(
                    "surat_keluar.id",
                    "surat_keluar.no_surat",
                    "users.name AS pengirim",
                    "users.name AS rahasia",
                    "surat_keluar.perihal",
                    "surat_keluar.tgl_surat",
                    "surat_keluar.file",
                    "surat_keluar.internal",
                    "surat_keluar.tujuan",
                    "surat_keluar.id_status AS status",
                    DB::raw('COUNT(detail_transaksi_surat.id_surat) AS jumlah_tembusan'),
                    DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.deskripsi ELSE ref_transaksi.deskripsi END) AS deskripsi"),
                )->leftJoin("ref_fungsi", "surat_keluar.id_ref_fungsi","=", "ref_fungsi.id")
                ->leftJoin("ref_kegiatan", "surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
                ->leftJoin("ref_transaksi", "surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
                ->leftJoin("detail_transaksi_surat", "surat_keluar.id","=","detail_transaksi_surat.id_surat")
                ->leftJoin("users", "surat_keluar.created_by","=","users.id")
                ->groupBy("surat_keluar.id",
                    "surat_keluar.no_surat",
                    "surat_keluar.perihal",
                    "surat_keluar.tgl_surat",
                    "surat_keluar.file",
                    "surat_keluar.id_status",
                    "ref_transaksi.deskripsi",
                    "surat_keluar.id_ref_transaksi",
                    "ref_kegiatan.deskripsi",
                    "users.name",
                    "detail_transaksi_surat.id_surat",
                    "surat_keluar.internal",
                    "surat_keluar.tujuan"
                );

                $table3 = $table3->addSelect(DB::raw("'2' as jenis_surat"));
                $table3 = $table3->orderBy("surat_keluar.created_at","DESC")
                ->get();

                $merged2 = $merged->merge($table3);

                return response()->json($merged2);
            break;

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
                "surat_masuk.is_internal",
                "ref_klasifikasi.kode AS kode_klasifikasi",
                "ref_klasifikasi.deskripsi AS klasifikasi",
                DB::raw('COUNT(detail_surat_masuk.id_surat) AS jumlah_tembusan'),
                DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status")
            )->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat")
            ->leftJoin("ref_klasifikasi", "surat_masuk.klasifikasi_id", "=", "ref_klasifikasi.id")
            ->groupBy("surat_masuk.id",
                "surat_masuk.no_surat",
                "surat_masuk.pengirim",
                "surat_masuk.kerahasiaan",
                "surat_masuk.perihal",
                "surat_masuk.tgl_surat",
                "surat_masuk.file",
                "surat_masuk.id_status",
                "surat_masuk.is_internal",
                "ref_klasifikasi.kode",
                "ref_klasifikasi.deskripsi",
                "detail_surat_masuk.id_surat"
            );

            $table = $table->addSelect(DB::raw("1 as jenis_surat"));
            $table = $table->addSelect(DB::raw("3 AS internal"));
            $table = $table->addSelect(DB::raw("NULL AS tujuan"));
            $table = $table->orderBy("surat_masuk.tgl_surat","DESC")->get();

            $table2 = DB::table("transaksi_surat_keluar AS surat_keluar")
            ->whereNotIn('surat_keluar.created_by', [Auth::user()->id])
            ->whereNotIn("surat_keluar.internal",[111])
            ->whereNotNull("surat_keluar.file")
            ->where("detail_transaksi_surat.id_penerima", Auth::user()->id)
            ->select(
                "surat_keluar.id",
                "surat_keluar.no_surat",
                "users.name AS pengirim",
                "users.name AS rahasia",
                "surat_keluar.perihal",
                "surat_keluar.tgl_surat",
                "surat_keluar.file",
                "surat_keluar.internal",
                "surat_keluar.tujuan",
                "surat_keluar.id_status AS status",
                DB::raw('COUNT(detail_transaksi_surat.id_surat ) AS jumlah_tembusan'),
                DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.deskripsi ELSE ref_transaksi.deskripsi END) AS deskripsi"),
            )->leftJoin("ref_fungsi", "surat_keluar.id_ref_fungsi","=", "ref_fungsi.id")
            ->leftJoin("ref_kegiatan", "surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
            ->leftJoin("ref_transaksi", "surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
            ->leftJoin("detail_transaksi_surat", "surat_keluar.id","=","detail_transaksi_surat.id_surat")
            ->leftJoin("users", "surat_keluar.created_by","=","users.id")
            ->leftjoin('transaksi_esign', 'surat_keluar.id', '=', 'transaksi_esign.id_surat')
            ->groupBy("surat_keluar.id",
                "surat_keluar.no_surat",
                "surat_keluar.perihal",
                "surat_keluar.tgl_surat",
                "surat_keluar.file",
                "surat_keluar.id_status",
                "ref_transaksi.deskripsi",
                "surat_keluar.id_ref_transaksi",
                "ref_kegiatan.deskripsi",
                "users.name",
                "detail_transaksi_surat.id_surat",
                "surat_keluar.internal",
                "surat_keluar.tujuan"
                );

            

            $table2 = $table2->addSelect(DB::raw("'2' as jenis_surat"));
            $table2 = $table2->orderBy("surat_keluar.created_at","DESC")
            ->get();

            $merged = $table->merge($table2);

            $table3 = DB::table("transaksi_surat_keluar AS surat_keluar")
            ->where("surat_keluar.id_status",2)
            ->where("surat_keluar.created_by",Auth::user()->id)
            ->select(
                "surat_keluar.id",
                "surat_keluar.no_surat",
                "users.name AS pengirim",
                "users.name AS rahasia",
                "surat_keluar.perihal",
                "surat_keluar.tgl_surat",
                "surat_keluar.file",
                "surat_keluar.internal",
                "surat_keluar.tujuan",
                "surat_keluar.id_status AS status",
                DB::raw('COUNT(detail_transaksi_surat.id_surat) AS jumlah_tembusan'),
                DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.deskripsi ELSE ref_transaksi.deskripsi END) AS deskripsi"),
            )->leftJoin("ref_fungsi", "surat_keluar.id_ref_fungsi","=", "ref_fungsi.id")
            ->leftJoin("ref_kegiatan", "surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
            ->leftJoin("ref_transaksi", "surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
            ->leftJoin("detail_transaksi_surat", "surat_keluar.id","=","detail_transaksi_surat.id_surat")
            ->leftJoin("users", "surat_keluar.created_by","=","users.id")
            ->groupBy("surat_keluar.id",
                "surat_keluar.no_surat",
                "surat_keluar.perihal",
                "surat_keluar.tgl_surat",
                "surat_keluar.file",
                "surat_keluar.id_status",
                "ref_transaksi.deskripsi",
                "surat_keluar.id_ref_transaksi",
                "ref_kegiatan.deskripsi",
                "users.name",
                "detail_transaksi_surat.id_surat",
                "surat_keluar.internal",
                "surat_keluar.tujuan"
            );

            $table3 = $table3->addSelect(DB::raw("'2' as jenis_surat"));
            $table3 = $table3->orderBy("surat_keluar.created_at","DESC")
            ->get();

            $merged2 = $merged->merge($table3);

            return response()->json($merged2);
        }
    }
}
