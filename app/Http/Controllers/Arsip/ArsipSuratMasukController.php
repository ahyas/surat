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
                ->where("surat_masuk.rahasia", "false")
                ->where("daftar_pegawai.id_jabatan", 17)
                ->select(
                    "surat_masuk.id",
                    "surat_masuk.no_surat",
                    "surat_masuk.pengirim",
                    "surat_masuk.rahasia",
                    "surat_masuk.perihal",
                    "surat_masuk.tgl_surat",
                    "surat_masuk.file",
                    "users.name AS dibuat_oleh",
                    "surat_masuk.id_status",
                    DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
                )->leftJoin("users", "surat_masuk.created_by","=","users.id")
                ->leftJoin("daftar_pegawai","surat_masuk.created_by","=","daftar_pegawai.id_user")
                ->orderBy("surat_masuk.updated_at","DESC")
                ->get();

                return response()->json($table);
            break;

            //login sebagai admin tata usaha
            case 6:
                $table=DB::table("transaksi_surat_masuk AS surat_masuk")
                ->where("surat_masuk.id_status",3)
                ->select(
                    "surat_masuk.id",
                    "surat_masuk.no_surat",
                    "surat_masuk.pengirim",
                    "surat_masuk.rahasia",
                    "surat_masuk.perihal",
                    "surat_masuk.tgl_surat",
                    "surat_masuk.file",
                    "users.name AS dibuat_oleh",
                    "surat_masuk.id_status",
                    DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
                )->leftJoin("users", "surat_masuk.created_by","=","users.id")
                ->orderBy("surat_masuk.updated_at","DESC")
                ->get();

                return response()->json($table);
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
                    "surat_masuk.rahasia",
                    "surat_masuk.perihal",
                    "surat_masuk.tgl_surat",
                    "surat_masuk.file",
                    "surat_masuk.id_status",
                    DB::raw("DATE_FORMAT(surat_masuk.created_at, '%Y-%m-%d') AS diterima_tanggal"),
                    DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
                    "jabatan_penerima.nama AS jab_penerima",
                    "jabatan_pengirim.nama AS jab_pengirim"
                )
                ->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat")
                ->join("users AS penerima", "detail_surat_masuk.id_penerima","=","penerima.id")
                ->join("users AS pengirim", "detail_surat_masuk.id_asal", "=","pengirim.id")
                ->leftJoin("daftar_pegawai AS pegawai_penerima", "penerima.id", "=", "pegawai_penerima.id_user")
                ->leftJoin("daftar_pegawai AS pegawai_pengirim", "pengirim.id", "=", "pegawai_pengirim.id_user")
                ->leftJoin("ref_jabatan AS jabatan_penerima", "pegawai_penerima.id_jabatan", "=","jabatan_penerima.id")
                ->leftJoin("ref_jabatan AS jabatan_pengirim", "pegawai_pengirim.id_jabatan", "=","jabatan_pengirim.id")
                ->orderBy("surat_masuk.updated_at","DESC")
                ->get();

                return response()->json($table);
            break;
            
            //login sebagai admin disposisi 1/Kasubag
            default:
                $table=DB::table("transaksi_surat_masuk AS surat_masuk")
                ->where("detail_surat_masuk.id_penerima", Auth::user()->id)
                ->where("surat_masuk.id_status",3)
                ->select(
                    "surat_masuk.id",
                    "surat_masuk.no_surat",
                    "surat_masuk.pengirim",
                    "surat_masuk.rahasia",
                    "surat_masuk.perihal",
                    "surat_masuk.tgl_surat",
                    "surat_masuk.file",
                    "surat_masuk.id_status",
                    DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
                    "jabatan_penerima.nama AS jab_penerima",
                    "jabatan_pengirim.nama AS jab_pengirim"
                )
                ->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat")
                ->join("users AS penerima", "detail_surat_masuk.id_penerima","=","penerima.id")
                ->join("users AS pengirim", "detail_surat_masuk.id_asal", "=","pengirim.id")
                ->leftJoin("daftar_pegawai AS pegawai_penerima", "penerima.id", "=", "pegawai_penerima.id_user")
                ->leftJoin("daftar_pegawai AS pegawai_pengirim", "pengirim.id", "=", "pegawai_pengirim.id_user")
                ->leftJoin("ref_jabatan AS jabatan_penerima", "pegawai_penerima.id_jabatan", "=","jabatan_penerima.id")
                ->leftJoin("ref_jabatan AS jabatan_pengirim", "pegawai_pengirim.id_jabatan", "=","jabatan_pengirim.id")
                ->orderBy("surat_masuk.updated_at","DESC")
                ->get();

                return response()->json($table);

        }

    }
}
