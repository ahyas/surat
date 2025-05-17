<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class VerifyDocument extends Controller
{
    public function verify($id_surat){
        $table = DB::table("transaksi_surat_keluar AS surat_keluar")
        ->where("surat_keluar.id", Crypt::decrypt($id_surat))
        ->whereNotIn("surat_keluar.internal",[111]);

        $find = $table->count();

        if($find > 0){
            $surat_keluar = $table->select(
                "surat_keluar.id AS id_surat",
                "surat_keluar.no_surat",
                "surat_keluar.perihal",
                "surat_keluar.tgl_surat",
                "surat_keluar.file",
                "surat_keluar.created_at",
                "ref_fungsi.kode AS kode_fungsi",
                "ref_kegiatan.kode AS kode_kegiatan",
                "ref_transaksi.kode AS kode_transaksi",
                "users.name AS dibuat_oleh",
                "users.id AS id_user",
                DB::raw("(CASE WHEN surat_keluar.id_status = 1 THEN 'Draft' ELSE 'Done' END) AS status"),
                DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.deskripsi ELSE ref_transaksi.deskripsi END) AS deskripsi"),
                DB::raw("(CASE WHEN surat_keluar.id_ref_transaksi IS NULL THEN ref_kegiatan.kode ELSE ref_transaksi.kode END) AS kode_surat"),
            )->leftJoin("ref_fungsi", "surat_keluar.id_ref_fungsi","=", "ref_fungsi.id")
            ->leftJoin("ref_kegiatan", "surat_keluar.id_ref_kegiatan","=", "ref_kegiatan.id")
            ->leftJoin("ref_transaksi", "surat_keluar.id_ref_transaksi","=", "ref_transaksi.id")
            ->leftJoin("detail_transaksi_surat", "surat_keluar.id","=","detail_transaksi_surat.id_surat")
            ->leftJoin("users", 
            "surat_keluar.created_by","=","users.id")
            ->first();

        }else{
            $surat_keluar = '';
        }

        return view('transaksi.surat_keluar.verify', compact('surat_keluar'));
    }
}
