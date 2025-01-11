<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;

class RegisterSuratKeluarController extends Controller
{
    public function index($tahun){
        $table = DB::table("transaksi_surat_keluar AS surat_keluar")
            ->where("surat_keluar.id_status",1)
            ->whereNotIn("surat_keluar.internal",[111])
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
                "surat_keluar.id_status",
                "ref_fungsi.kode AS kode_fungsi",
                "ref_kegiatan.kode AS kode_kegiatan",
                "ref_transaksi.kode AS kode_transaksi",
                "users.name AS dibuat_oleh",
                "users.id AS id_user",
                "permission.id_role",
                DB::raw("(CASE WHEN surat_keluar.id_status = 1 THEN 'Draft' ELSE 'Done' END) AS status"),
                DB::raw('COUNT(detail_transaksi_surat.id_surat) AS jumlah_tembusan'),
                DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.deskripsi ELSE ref_transaksi.deskripsi END) AS deskripsi"),
                DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.kode ELSE ref_transaksi.kode END) AS kode_surat"),
            )->leftJoin("ref_fungsi", "surat_keluar.id_ref_fungsi","=", "ref_fungsi.id")
            ->leftJoin("ref_kegiatan", "surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
            ->leftJoin("ref_transaksi", "surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
            ->leftJoin("detail_transaksi_surat", "surat_keluar.id","=","detail_transaksi_surat.id_surat")
            ->leftJoin("users", "surat_keluar.created_by","=","users.id")
            ->leftJoin("permission","users.id","=","permission.id_user")
            ->groupBy(
                "surat_keluar.id",
                "surat_keluar.id_ref_klasifikasi",
                "surat_keluar.id_ref_fungsi",
                "surat_keluar.id_ref_kegiatan",
                "surat_keluar.id_ref_transaksi",
                "surat_keluar.id_nomenklatur_jabatan",
                "surat_keluar.no_surat","surat_keluar.tujuan",
                "surat_keluar.perihal",
                "surat_keluar.tgl_surat",
                "surat_keluar.file",
                "surat_keluar.id_status",
                "ref_fungsi.kode",
                "ref_kegiatan.kode",
                "ref_transaksi.kode",
                "ref_kegiatan.deskripsi",
                "ref_transaksi.deskripsi",
                "surat_keluar.internal",
                "users.name",
                "users.id",
                "permission.id_role")
            ->orderBy("surat_keluar.created_at","DESC")->get();

        return response()->json($table);
    }

    public function print(Request $request){
        $table = DB::table("transaksi_surat_keluar AS surat_keluar")
            ->where("surat_keluar.id_status",1)
            ->whereNotIn("surat_keluar.internal",[111])
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
                "surat_keluar.id_status",
                "ref_fungsi.kode AS kode_fungsi",
                "ref_kegiatan.kode AS kode_kegiatan",
                "ref_transaksi.kode AS kode_transaksi",
                "users.name AS dibuat_oleh",
                "users.id AS id_user",
                "permission.id_role",
                DB::raw("(CASE WHEN surat_keluar.id_status = 1 THEN 'Draft' ELSE 'Done' END) AS status"),
                DB::raw('COUNT(detail_transaksi_surat.id_surat) AS jumlah_tembusan'),
                DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.deskripsi ELSE ref_transaksi.deskripsi END) AS deskripsi"),
                DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.kode ELSE ref_transaksi.kode END) AS kode_surat"),
            )->leftJoin("ref_fungsi", "surat_keluar.id_ref_fungsi","=", "ref_fungsi.id")
            ->leftJoin("ref_kegiatan", "surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
            ->leftJoin("ref_transaksi", "surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
            ->leftJoin("detail_transaksi_surat", "surat_keluar.id","=","detail_transaksi_surat.id_surat")
            ->leftJoin("users", "surat_keluar.created_by","=","users.id")
            ->leftJoin("permission","users.id","=","permission.id_user")
            ->groupBy(
                "surat_keluar.id",
                "surat_keluar.id_ref_klasifikasi",
                "surat_keluar.id_ref_fungsi",
                "surat_keluar.id_ref_kegiatan",
                "surat_keluar.id_ref_transaksi",
                "surat_keluar.id_nomenklatur_jabatan",
                "surat_keluar.no_surat","surat_keluar.tujuan",
                "surat_keluar.perihal",
                "surat_keluar.tgl_surat",
                "surat_keluar.file",
                "surat_keluar.id_status",
                "ref_fungsi.kode",
                "ref_kegiatan.kode",
                "ref_transaksi.kode",
                "ref_kegiatan.deskripsi",
                "ref_transaksi.deskripsi",
                "surat_keluar.internal",
                "users.name",
                "users.id",
                "permission.id_role")
            ->orderBy("surat_keluar.created_at","DESC")->get();
            
            $pdf = PDF::loadView('register/surat_keluar/print', ['table'=>$table,'tahun'=>$request->tahun])->setPaper('a4', 'landscape');

            return $pdf->stream("file.pdf");
    }
}
