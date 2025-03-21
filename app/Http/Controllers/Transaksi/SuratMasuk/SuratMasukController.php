<?php

namespace App\Http\Controllers\Transaksi\SuratMasuk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\PDF;
use PhpParser\Node\Expr\Isset_;

class SuratMasukController extends Controller
{
    public function index(){
        $id_role = Auth::user()->getRole()->id_role;

        $klasifikasi = DB::table("ref_klasifikasi")
        ->select(
            "id AS id_klasifikasi",
            "kode AS kode_klasifikasi",
            "deskripsi AS deskripsi_klasifikasi"
        )->get();

        $user = DB::table("level_user")
        ->where("level_user.id_parent_user", Auth::user()->id)
        ->select(
            "users.id AS id_parent_user",
            "users.name AS nama_pegawai",
            "ref_jabatan.nama AS jabatan_pegawai"
        )
        ->join("users", "level_user.id_sub_user","=","users.id")
        ->leftJoin("daftar_pegawai", "users.id", "=", "daftar_pegawai.id_user")
        ->leftJoin("ref_jabatan", "daftar_pegawai.id_jabatan", "=","ref_jabatan.id")
        ->get();

        $petunjuk = DB::table("ref_petunjuk_disposisi")->select("id","name AS petunjuk_disposisi")->get();

        switch ($id_role){
            //login sebagai operator surat
            case 5:
                return view('transaksi/surat_masuk/index_5', compact("klasifikasi"));
            break;
            //login sebagai admin disposisi 1
            case 8:
                $user_pimpinan = DB::table("users")
                ->select(
                    "users.id",
                    "users.name AS nama_pegawai",
                    "ref_jabatan.nama AS jabatan_pegawai"
                )
                ->where("users.id_bidang",1)
                ->whereIn("ref_jabatan.id", [1, 2]) //hanya ketua
                ->leftJoin("daftar_pegawai", "users.id", "=", "daftar_pegawai.id_user")
                ->leftJoin("ref_jabatan", "daftar_pegawai.id_jabatan", "=","ref_jabatan.id")
                ->get();

                $bidang = DB::table("bidang")->select("id AS id_bidang","nama AS bidang")->whereIn('id', [2])->get();

                return view('transaksi/surat_masuk/index_8', compact("user","user_pimpinan","bidang","petunjuk"));
            break;

            //login sebagai admin disposisi 2
            case 10:

                return view('transaksi/surat_masuk/index_10', compact("user","petunjuk"));
            break;

            //login sebagai admin disposisi 3
            case 13:

                return view('transaksi/surat_masuk/index_13', compact("user"));
            break;

            //login sebagai ketua
            case 16:

                return view('transaksi/surat_masuk/index_16', compact("user", "petunjuk"));
            break;
            //login sebagai wakil
            case 17:

                return view('transaksi/surat_masuk/index_17', compact("user", "petunjuk"));
            break;

            //login sebagai end user
            case 18:
                return view('transaksi/surat_masuk/index_18', compact("user", "petunjuk"));
            break;
            //login sebagai admin monitoring
            case 101:
                return view('transaksi/surat_masuk/index_101');
            break;
            //login sebagai admin tata usaha
            default :
                return view('transaksi/surat_masuk/index_6', compact("user", "klasifikasi"));
        }

    }

    public function getData(){
        $id_role = Auth::user()->getRole()->id_role;
        switch ($id_role){
            //login sebagai operator surat
            case 5:
                $table=DB::table("transaksi_surat_masuk AS surat_masuk")
                ->where("surat_masuk.created_by", Auth::user()->id)
                ->where('surat_masuk.kerahasiaan', 0)
                ->select(
                    "surat_masuk.id",
                    "surat_masuk.no_surat",
                    "surat_masuk.pengirim",
                    "surat_masuk.perihal",
                    "surat_masuk.tgl_surat",
                    "surat_masuk.kerahasiaan",
                    "surat_masuk.file",
                    "users.name AS dibuat_oleh",
                    "surat_masuk.id_status",
                    "surat_masuk.is_internal",
                    DB::raw("DATE_FORMAT(surat_masuk.created_at, '%Y-%m-%d') AS tanggal_input"),
                    "ref_klasifikasi.kode AS kode_klasifikasi",
                    "ref_klasifikasi.deskripsi AS klasifikasi",
                    DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
                )
                ->orderBy("surat_masuk.created_at","DESC")
                ->leftJoin("users", "surat_masuk.created_by","=","users.id")
                ->leftJoin("ref_klasifikasi", "surat_masuk.klasifikasi_id", "=", "ref_klasifikasi.id")
                ->get();

                return response()->json($table);
            break;
            //login sebagai admin disposisi 1
            case 8:
                $table=DB::table("transaksi_surat_masuk AS surat_masuk")
                ->where("detail_surat_masuk.id_penerima", Auth::user()->id)
                ->whereNotIn("surat_masuk.id_status", [3])
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
                    DB::raw("DATE_FORMAT(surat_masuk.created_at, '%Y-%m-%d') AS tanggal_input"),
                    "detail_surat_masuk.id_penerima",
                    "ref_klasifikasi.kode AS kode_klasifikasi",
                    "ref_klasifikasi.deskripsi AS klasifikasi",
                    DB::raw("DATE_FORMAT(surat_masuk.created_at, '%Y-%m-%d') AS diterima_tanggal"),
                    DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
                )
                ->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat")
                ->leftJoin("ref_klasifikasi", "surat_masuk.klasifikasi_id", "=", "ref_klasifikasi.id")
                ->orderBy("surat_masuk.created_at","DESC")
                ->groupBy("surat_masuk.id",
                    "surat_masuk.no_surat",
                    "surat_masuk.pengirim",
                    "surat_masuk.kerahasiaan",
                    "surat_masuk.perihal",
                    "surat_masuk.tgl_surat",
                    "surat_masuk.file",
                    "surat_masuk.id_status",
                    "surat_masuk.created_at",
                    "detail_surat_masuk.id_penerima",
                    "surat_masuk.created_at",
                    "surat_masuk.is_internal",
                    "ref_klasifikasi.kode",
                    "ref_klasifikasi.deskripsi",
                    )
                ->get();

                return response()->json($table);
            break;

            //login sebagai admin disposisi 2
            case 10:
                $id_user = Auth::user()->id;
                $table=DB::table("transaksi_surat_masuk AS surat_masuk")
                ->where("detail_surat_masuk.id_penerima", $id_user)
                ->whereNotIn("surat_masuk.id_status", [3])
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
                    DB::raw("DATE_FORMAT(surat_masuk.created_at, '%Y-%m-%d') AS tanggal_input"),
                    "ref_klasifikasi.kode AS kode_klasifikasi",
                    "ref_klasifikasi.deskripsi AS klasifikasi",
                    DB::raw("DATE_FORMAT(surat_masuk.created_at, '%Y-%m-%d') AS diterima_tanggal"),
                    DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
                )
                ->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat")
                ->leftJoin("ref_klasifikasi", "surat_masuk.klasifikasi_id", "=", "ref_klasifikasi.id")
                ->orderBy("surat_masuk.created_at","DESC")
                ->get();

                return response()->json($table);
            break;

            //login sebagai admin disposisi 3
            case 13:
                $table=DB::table("transaksi_surat_masuk AS surat_masuk")
                ->where("detail_surat_masuk.id_penerima", Auth::user()->id)
                ->whereNotIn("surat_masuk.id_status",[3])
                ->select(
                    "surat_masuk.id",
                    "surat_masuk.no_surat",
                    "surat_masuk.pengirim",
                    "surat_masuk.kerahasiaan",
                    "surat_masuk.perihal",
                    "surat_masuk.tgl_surat",
                    "surat_masuk.file",
                    "surat_masuk.is_internal",
                    DB::raw("DATE_FORMAT(surat_masuk.created_at, '%Y-%m-%d') AS tanggal_input"),
                    "ref_klasifikasi.kode AS kode_klasifikasi",
                    "ref_klasifikasi.deskripsi AS klasifikasi",
                    DB::raw("DATE_FORMAT(surat_masuk.created_at, '%Y-%m-%d') AS diterima_tanggal"),
                    "surat_masuk.id_status",
                    DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
                )
                ->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat")
                ->leftJoin("ref_klasifikasi", "surat_masuk.klasifikasi_id", "=", "ref_klasifikasi.id")
                ->orderBy("surat_masuk.created_at","DESC")
                ->get();

                return response()->json($table);
            break;

            //login sebagai ketua
            case 16:
                $table=DB::table("transaksi_surat_masuk AS surat_masuk")
                ->where("detail_surat_masuk.id_penerima", Auth::user()->id)
                ->whereNotIn("surat_masuk.id_status", [3])
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
                    DB::raw("DATE_FORMAT(surat_masuk.created_at, '%Y-%m-%d') AS tanggal_input"),
                    "ref_klasifikasi.kode AS kode_klasifikasi",
                    "ref_klasifikasi.deskripsi AS klasifikasi",
                    DB::raw("DATE_FORMAT(surat_masuk.created_at, '%Y-%m-%d') AS diterima_tanggal"),
                    DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
                    "users.name AS dari"
                )->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat")
                ->leftJoin("users", "detail_surat_masuk.id_asal","=","users.id")
                ->leftJoin("ref_klasifikasi", "surat_masuk.klasifikasi_id", "=", "ref_klasifikasi.id")
                ->orderBy("surat_masuk.created_at","DESC")
                ->get();

                return response()->json($table);
            break;

            //login sebagai wakil
            case 17:
                $table=DB::table("transaksi_surat_masuk AS surat_masuk")
                ->where("detail_surat_masuk.id_penerima", Auth::user()->id)
                ->whereNotIn("surat_masuk.id_status", [3])
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
                    DB::raw("DATE_FORMAT(surat_masuk.created_at, '%Y-%m-%d') AS tanggal_input"),
                    "ref_klasifikasi.kode AS kode_klasifikasi",
                    "ref_klasifikasi.deskripsi AS klasifikasi",
                    DB::raw("DATE_FORMAT(surat_masuk.created_at, '%Y-%m-%d') AS diterima_tanggal"),
                    DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
                    "users.name AS dari"
                )->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat")
                ->leftJoin("users", "detail_surat_masuk.id_asal","=","users.id")
                ->leftJoin("ref_klasifikasi", "surat_masuk.klasifikasi_id", "=", "ref_klasifikasi.id")
                ->orderBy("surat_masuk.created_at","DESC")
                ->get();

                return response()->json($table);
            break;

            //login sebagai end user
            case 18:
                $table=DB::table("transaksi_surat_masuk AS surat_masuk")
                ->where("detail_surat_masuk.id_penerima", Auth::user()->id)
                ->whereNotIn("surat_masuk.id_status",[3])
                ->select(
                    "surat_masuk.id",
                    "surat_masuk.no_surat",
                    "surat_masuk.pengirim",
                    "surat_masuk.kerahasiaan",
                    "surat_masuk.perihal",
                    "surat_masuk.tgl_surat",
                    "surat_masuk.file",
                    "surat_masuk.is_internal",
                    DB::raw("DATE_FORMAT(surat_masuk.created_at, '%Y-%m-%d') AS tanggal_input"),
                    "ref_klasifikasi.kode AS kode_klasifikasi",
                    "ref_klasifikasi.deskripsi AS klasifikasi",
                    'detail_surat_masuk.status AS status_id',
                    DB::raw("DATE_FORMAT(surat_masuk.created_at, '%Y-%m-%d') AS diterima_tanggal"),
                    "surat_masuk.id_status",
                    DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
                )
                ->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat")
                ->leftJoin("ref_klasifikasi", "surat_masuk.klasifikasi_id", "=", "ref_klasifikasi.id")
                ->orderBy("surat_masuk.created_at","DESC")
                ->get();

                return response()->json($table);
            break;

            //login sebagai admin tata usaha
            default :
                $table=DB::table("transaksi_surat_masuk AS surat_masuk")
                ->whereNull("surat_masuk.id_status")
                ->orWhereIn("surat_masuk.id_status",[1,2, 4,5])
                ->select(
                    "surat_masuk.id",
                    "surat_masuk.no_surat",
                    "surat_masuk.pengirim",
                    "surat_masuk.kerahasiaan",
                    "surat_masuk.perihal",
                    "surat_masuk.tgl_surat",
                    "surat_masuk.file",
                    DB::raw("DATE_FORMAT(surat_masuk.created_at, '%Y-%m-%d') AS tanggal_input"),
                    "users.name AS dibuat_oleh",
                    "surat_masuk.id_status",
                    DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
                    "surat_masuk.is_internal",
                    "ref_klasifikasi.kode AS kode_klasifikasi",
                    "ref_klasifikasi.deskripsi AS klasifikasi",
                    DB::raw('MAX(detail_surat_masuk.created_at)')
                )
                ->leftJoin("users", "surat_masuk.created_by","=","users.id")
                ->leftJoin("ref_klasifikasi", "surat_masuk.klasifikasi_id", "=", "ref_klasifikasi.id")
                ->leftjoin('detail_transaksi_surat_masuk AS detail_surat_masuk', 'surat_masuk.id', 'detail_surat_masuk.id_surat')
                ->groupBy(
                    'detail_surat_masuk.id_surat',
                    'surat_masuk.id',
                    'surat_masuk.no_surat',
                    'surat_masuk.pengirim',
                    'surat_masuk.kerahasiaan',
                    'surat_masuk.perihal',
                    'surat_masuk.tgl_surat',
                    'surat_masuk.file',
                    'surat_masuk.created_at',
                    'users.name',
                    'surat_masuk.id_status',
                    'surat_masuk.is_internal',
                    'ref_klasifikasi.kode',
                    'ref_klasifikasi.deskripsi',
                )
                ->orderBy("surat_masuk.created_at","DESC")
                ->get();

                return response()->json(['table'=>$table]);
        }
    }

    public function detail($id_surat){
        $table=DB::table("transaksi_surat_masuk AS surat_masuk")
        ->where("surat_masuk.id", $id_surat)
        ->select(
            "surat_masuk.id",
            "surat_masuk.no_surat",
            "surat_masuk.pengirim",
            "surat_masuk.kerahasiaan",
            "surat_masuk.perihal",
            "surat_masuk.tgl_surat",
            "surat_masuk.file",
            "surat_masuk.id_status",
            "surat_masuk.file_tindak_lanjut",
            "surat_masuk.catatan_tindaklanjut",
            DB::raw("DATE_FORMAT(surat_masuk.created_at, '%Y-%m-%d') AS diterima_tanggal"),
            "users.name AS tindaklanjut_oleh",
            DB::raw("DATE_FORMAT(surat_masuk.tgl_tindak_lanjut, '%Y-%m-%d') AS tgl_tindak_lanjut"),
            DB::raw("DATE_FORMAT(surat_masuk.tgl_tindak_lanjut, '%H:%i') AS waktu_tindak_lanjut"),
            DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
            "ref_jabatan.nama AS jabatan_pegawai",
            "surat_masuk.is_internal",
            "ref_klasifikasi.kode AS kode_klasifikasi",
            "ref_klasifikasi.deskripsi AS klasifikasi",
        )->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat")
        ->leftJoin("users","surat_masuk.id_user_tindak_lanjut","=","users.id")
        ->leftJoin("daftar_pegawai", "users.id", "=", "daftar_pegawai.id_user")
        ->leftJoin("ref_jabatan", "daftar_pegawai.id_jabatan", "=","ref_jabatan.id")
        ->leftJoin("ref_klasifikasi", "surat_masuk.klasifikasi_id", "=", "ref_klasifikasi.id")
        ->orderBy("surat_masuk.created_at","DESC")
        ->get();

        return response()->json($table);
    }

    public function printDisposisi($id_surat_masuk){
        $table = DB::table("detail_transaksi_surat_masuk AS detail_surat_masuk")
        ->where("detail_surat_masuk.id_surat", $id_surat_masuk)
        //->whereNotIn("detail_surat_masuk.status", [4,5])//sembunyikan status diteruskan dan dari pimpinan
        ->select(
            "penerima.name AS nama_penerima",
            "pengirim.name AS nama_pengirim",
            "detail_surat_masuk.catatan",
            DB::raw("(CASE WHEN detail_surat_masuk.status = 1 THEN 'Disposisi' WHEN detail_surat_masuk.status = 2 THEN 'Diteruskan' WHEN detail_surat_masuk.status = 3 THEN 'Tindak lanjut' WHEN detail_surat_masuk.status = 4 THEN 'Dinaikan' WHEN detail_surat_masuk.status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
            DB::raw("DATE_FORMAT(detail_surat_masuk.created_at, '%Y-%m-%d') AS tanggal"),
            DB::raw("DATE_FORMAT(detail_surat_masuk.created_at, '%H:%i') AS waktu"),
            "jabatan_penerima.nama AS jab_penerima",
            "jabatan_pengirim.nama AS jab_pengirim",
            "ref_petunjuk_disposisi.name AS petunjuk"
        )
        ->join("users AS penerima", "detail_surat_masuk.id_penerima","=","penerima.id")
        ->join("users AS pengirim", "detail_surat_masuk.id_asal", "=","pengirim.id")
        ->leftJoin("daftar_pegawai AS pegawai_penerima", "penerima.id", "=", "pegawai_penerima.id_user")
        ->leftJoin("daftar_pegawai AS pegawai_pengirim", "pengirim.id", "=", "pegawai_pengirim.id_user")
        ->leftJoin("ref_jabatan AS jabatan_penerima", "pegawai_penerima.id_jabatan", "=","jabatan_penerima.id")
        ->leftJoin("ref_jabatan AS jabatan_pengirim", "pegawai_pengirim.id_jabatan", "=","jabatan_pengirim.id")
        ->leftJoin("ref_petunjuk_disposisi", "detail_surat_masuk.petunjuk","=","ref_petunjuk_disposisi.id")
        ->orderBy("detail_surat_masuk.created_at","ASC")
        ->get();

        $detail_surat=DB::table("transaksi_surat_masuk AS surat_masuk")
        ->where("surat_masuk.id", $id_surat_masuk)
        ->select(
            "surat_masuk.no_surat",
            "surat_masuk.pengirim",
            "surat_masuk.kerahasiaan",
            "surat_masuk.perihal",
            "surat_masuk.tgl_surat",
            "surat_masuk.id_status",
            "surat_masuk.catatan_tindaklanjut",
            DB::raw("DATE_FORMAT(surat_masuk.created_at, '%Y-%m-%d') AS diterima_tanggal"),
            "users.name AS tindaklanjut_oleh",
            DB::raw("DATE_FORMAT(surat_masuk.tgl_tindak_lanjut, '%Y-%m-%d') AS tgl_tindak_lanjut"),
            DB::raw("DATE_FORMAT(surat_masuk.tgl_tindak_lanjut, '%H:%i') AS waktu_tindak_lanjut"),
            DB::raw("(CASE WHEN surat_masuk.id_status = 1 THEN 'Disposisi' WHEN surat_masuk.id_status = 2 THEN 'Diteruskan' WHEN surat_masuk.id_status = 3 THEN 'Tindak lanjut' WHEN surat_masuk.id_status = 4 THEN 'Dinaikan' WHEN surat_masuk.id_status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
            "ref_jabatan.nama AS jabatan_pegawai",
        )->leftJoin("detail_transaksi_surat_masuk AS detail_surat_masuk", "surat_masuk.id","=","detail_surat_masuk.id_surat")
        ->leftJoin("users","surat_masuk.id_user_tindak_lanjut","=","users.id")
        ->leftJoin("daftar_pegawai", "users.id", "=", "daftar_pegawai.id_user")
        ->leftJoin("ref_jabatan", "daftar_pegawai.id_jabatan", "=","ref_jabatan.id")
        ->orderBy("surat_masuk.created_at","DESC")
        ->first();

        $pdf = PDF::loadView('arsip/disposisi/print', ['table'=>$table,'detail_surat'=>$detail_surat])->setPaper('a4', 'portrait');

        return $pdf->stream("file.pdf");
    }

    public function daftarDisposisi($id_surat_masuk){
        $id_role = Auth::user()->getRole()->id_role;
        switch($id_role){
            //admin surat
            case 6:
                $table = DB::table("detail_transaksi_surat_masuk AS detail_surat_masuk")
                ->where("detail_surat_masuk.id_surat", $id_surat_masuk)
                //->whereNotIn("detail_surat_masuk.status", [4,5])//sembunyikan status diteruskan dan dari pimpinan
                ->select(
                    "penerima.name AS nama_penerima",
                    "pengirim.name AS nama_pengirim",
                    "detail_surat_masuk.catatan",
                    DB::raw("(CASE WHEN detail_surat_masuk.status = 1 THEN 'Disposisi' WHEN detail_surat_masuk.status = 2 THEN 'Diteruskan' WHEN detail_surat_masuk.status = 3 THEN 'Tindak lanjut' WHEN detail_surat_masuk.status = 4 THEN 'Dinaikan' WHEN detail_surat_masuk.status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
                    DB::raw("DATE_FORMAT(detail_surat_masuk.created_at, '%Y-%m-%d') AS tanggal"),
                    DB::raw("DATE_FORMAT(detail_surat_masuk.created_at, '%H:%i') AS waktu"),
                    "jabatan_penerima.nama AS jab_penerima",
                    "jabatan_pengirim.nama AS jab_pengirim",
                    "ref_petunjuk_disposisi.name AS petunjuk"
                )
                ->join("users AS penerima", "detail_surat_masuk.id_penerima","=","penerima.id")
                ->join("users AS pengirim", "detail_surat_masuk.id_asal", "=","pengirim.id")
                ->leftJoin("daftar_pegawai AS pegawai_penerima", "penerima.id", "=", "pegawai_penerima.id_user")
                ->leftJoin("daftar_pegawai AS pegawai_pengirim", "pengirim.id", "=", "pegawai_pengirim.id_user")
                ->leftJoin("ref_jabatan AS jabatan_penerima", "pegawai_penerima.id_jabatan", "=","jabatan_penerima.id")
                ->leftJoin("ref_jabatan AS jabatan_pengirim", "pegawai_pengirim.id_jabatan", "=","jabatan_pengirim.id")
                ->leftJoin("ref_petunjuk_disposisi", "detail_surat_masuk.petunjuk","=","ref_petunjuk_disposisi.id")
                ->orderBy("detail_surat_masuk.created_at","ASC")
                ->get();

                return response()->json($table);
            break;

            //admin disposisi 2 kabag/panmud
            case 10:
                $table = DB::table("detail_transaksi_surat_masuk AS detail_surat_masuk")
                ->where("detail_surat_masuk.id_surat", $id_surat_masuk)
                ->whereNotIn("detail_surat_masuk.status", [2,4,5])//sembunyikan status diteruskan dan dari pimpinan
                ->select(
                    "penerima.name AS nama_penerima",
                    "pengirim.name AS nama_pengirim",
                    "detail_surat_masuk.catatan",
                    DB::raw("(CASE WHEN detail_surat_masuk.status = 1 THEN 'Disposisi' WHEN detail_surat_masuk.status = 2 THEN 'Diteruskan' WHEN detail_surat_masuk.status = 3 THEN 'Tindak lanjut' WHEN detail_surat_masuk.status = 4 THEN 'Dinaikan' WHEN detail_surat_masuk.status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
                    DB::raw("DATE_FORMAT(detail_surat_masuk.created_at, '%Y-%m-%d') AS tanggal"),
                    DB::raw("DATE_FORMAT(detail_surat_masuk.created_at, '%H:%i') AS waktu"),
                    "jabatan_penerima.nama AS jab_penerima",
                    "jabatan_pengirim.nama AS jab_pengirim",
                    "ref_petunjuk_disposisi.name AS petunjuk"
                )
                ->join("users AS penerima", "detail_surat_masuk.id_penerima","=","penerima.id")
                ->join("users AS pengirim", "detail_surat_masuk.id_asal", "=","pengirim.id")
                ->leftJoin("daftar_pegawai AS pegawai_penerima", "penerima.id", "=", "pegawai_penerima.id_user")
                ->leftJoin("daftar_pegawai AS pegawai_pengirim", "pengirim.id", "=", "pegawai_pengirim.id_user")
                ->leftJoin("ref_jabatan AS jabatan_penerima", "pegawai_penerima.id_jabatan", "=","jabatan_penerima.id")
                ->leftJoin("ref_jabatan AS jabatan_pengirim", "pegawai_pengirim.id_jabatan", "=","jabatan_pengirim.id")
                ->leftJoin("ref_petunjuk_disposisi", "detail_surat_masuk.petunjuk","=","ref_petunjuk_disposisi.id")
                ->orderBy("detail_surat_masuk.created_at","ASC")
                ->get();

                return response()->json($table);
            break;
            //admin disposisi 3 kasubag/pp
            case 13:
                $table = DB::table("detail_transaksi_surat_masuk AS detail_surat_masuk")
                ->where("detail_surat_masuk.id_surat", $id_surat_masuk)
                ->whereNotIn("detail_surat_masuk.status", [2,4,5])//sembunyikan status diteruskan dan dari pimpinan
                ->select(
                    "penerima.name AS nama_penerima",
                    "pengirim.name AS nama_pengirim",
                    "detail_surat_masuk.catatan",
                    DB::raw("(CASE WHEN detail_surat_masuk.status = 1 THEN 'Disposisi' WHEN detail_surat_masuk.status = 2 THEN 'Diteruskan' WHEN detail_surat_masuk.status = 3 THEN 'Tindak lanjut' WHEN detail_surat_masuk.status = 4 THEN 'Dinaikan' WHEN detail_surat_masuk.status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
                    DB::raw("DATE_FORMAT(detail_surat_masuk.created_at, '%Y-%m-%d') AS tanggal"),
                    DB::raw("DATE_FORMAT(detail_surat_masuk.created_at, '%H:%i') AS waktu"),
                    "jabatan_penerima.nama AS jab_penerima",
                    "jabatan_pengirim.nama AS jab_pengirim",
                    "ref_petunjuk_disposisi.name AS petunjuk"
                )
                ->join("users AS penerima", "detail_surat_masuk.id_penerima","=","penerima.id")
                ->join("users AS pengirim", "detail_surat_masuk.id_asal", "=","pengirim.id")
                ->leftJoin("daftar_pegawai AS pegawai_penerima", "penerima.id", "=", "pegawai_penerima.id_user")
                ->leftJoin("daftar_pegawai AS pegawai_pengirim", "pengirim.id", "=", "pegawai_pengirim.id_user")
                ->leftJoin("ref_jabatan AS jabatan_penerima", "pegawai_penerima.id_jabatan", "=","jabatan_penerima.id")
                ->leftJoin("ref_jabatan AS jabatan_pengirim", "pegawai_pengirim.id_jabatan", "=","jabatan_pengirim.id")
                ->leftJoin("ref_petunjuk_disposisi", "detail_surat_masuk.petunjuk","=","ref_petunjuk_disposisi.id")
                ->orderBy("detail_surat_masuk.created_at","ASC")
                ->get();

                return response()->json($table);
            break;
            //admin disposisi 1 panitera/sekretaris
            default:
                $table = DB::table("detail_transaksi_surat_masuk AS detail_surat_masuk")
                ->where("detail_surat_masuk.id_surat", $id_surat_masuk)
                //->whereNotIn("detail_surat_masuk.status", [2])//sembunyikan status diteruskan
                ->select(
                    "penerima.name AS nama_penerima",
                    "pengirim.name AS nama_pengirim",
                    "detail_surat_masuk.catatan",
                    DB::raw("(CASE WHEN detail_surat_masuk.status = 1 THEN 'Disposisi' WHEN detail_surat_masuk.status = 2 THEN 'Diteruskan' WHEN detail_surat_masuk.status = 3 THEN 'Tindak lanjut' WHEN detail_surat_masuk.status = 4 THEN 'Dinaikan' WHEN detail_surat_masuk.status = 5 THEN 'Diturunkan' ELSE '-' END) AS status"),
                    DB::raw("DATE_FORMAT(detail_surat_masuk.created_at, '%Y-%m-%d') AS tanggal"),
                    DB::raw("DATE_FORMAT(detail_surat_masuk.created_at, '%H:%i') AS waktu"),
                    "jabatan_penerima.nama AS jab_penerima",
                    "jabatan_pengirim.nama AS jab_pengirim",
                    "ref_petunjuk_disposisi.name AS petunjuk"
                )
                ->join("users AS penerima", "detail_surat_masuk.id_penerima","=","penerima.id")
                ->join("users AS pengirim", "detail_surat_masuk.id_asal", "=","pengirim.id")
                ->leftJoin("daftar_pegawai AS pegawai_penerima", "penerima.id", "=", "pegawai_penerima.id_user")
                ->leftJoin("daftar_pegawai AS pegawai_pengirim", "pengirim.id", "=", "pegawai_pengirim.id_user")
                ->leftJoin("ref_jabatan AS jabatan_penerima", "pegawai_penerima.id_jabatan", "=","jabatan_penerima.id")
                ->leftJoin("ref_jabatan AS jabatan_pengirim", "pegawai_pengirim.id_jabatan", "=","jabatan_pengirim.id")
                ->leftJoin("ref_petunjuk_disposisi", "detail_surat_masuk.petunjuk","=","ref_petunjuk_disposisi.id")
                ->orderBy("detail_surat_masuk.created_at","ASC")
                ->get();

                return response()->json($table);

        }

    }

    public function tindakLanjut(Request $request){
        $error = [];
        $data = [];

        if(empty($request["tindaklanjut_catatan"])){
            $error["err_catatan"] = "Catatan tidak boleh kosong";
        }

        if(empty($request->hasFile('file_tindaklanjut'))){
            $error['err_file_tindaklanjut'] = 'File surat tidak boleh kosong';

        }else{
            $allowed = ["pdf"];
            $ext = strtolower($request->file_tindaklanjut->extension());
            if(!in_array($ext, $allowed)){
                $error['err_file_tindaklanjut'] = 'Jenis file harus PDF';
            }
        }

        if(!empty($error)){
            $data["success"] = false;
            $data["message"] = $error;
        }else{
            $data["success"] = true;
            $data["message"] = "Success";

            $fileName = time().'.'.$request->file_tindaklanjut->extension();
            $tujuan_upload = public_path('/uploads/tindak_lanjut');
            $request->file_tindaklanjut->move($tujuan_upload, $fileName);

            DB::table("transaksi_surat_masuk")
            ->where("id",$request["id_surat_masuk"])
            ->update([
                "id_user_tindak_lanjut"=>Auth::user()->id,
                "tgl_tindak_lanjut"=>date('Y-m-d H:i:s'),
                "id_status"=>3,
                "file_tindak_lanjut"=>$fileName,
                "catatan_tindaklanjut"=>$request["tindaklanjut_catatan"]
            ]);

            DB::table("detail_transaksi_surat_masuk")
            ->where("id_surat", $request["id_surat_masuk"])
            ->where("id_penerima", Auth::user()->id)
            ->where("status", "!=", 2) //semua kecuali yang diteruskan
            ->update([
                "status"=>3 //status tindak lanjut
            ]);

        }

        return response()->json($data);
    }
    //kirim disposisi
    public function kirim(Request $request){
        $error = [];
        $data = [];

        if(empty($request["catatan"])){
            $error["err_catatan"] = "Catatan tidak boleh kosong";
        }

        if(empty($request["petunjuk"])){
            $error["err_petunjuk"] = "Pilih petunjuk disposisi yang sesuai";
        }

        if(empty($request["tujuan"])){
            $error["err_tujuan"] = "Tujuan disposisi tidak boleh kosong";
        }else{
            //check apakah sudah pernah mendapat disposisi
            $count = DB::table("detail_transaksi_surat_masuk")
            ->where("id_surat", $request["id_surat_masuk"])
            ->where("id_penerima", $request["tujuan"])
            ->where("status", 1)
            ->count();

            if($count>0){
                $error["err_disposisi"] = "User ini sudah mendapat disposisi";
            }
        }

        if(!empty($error)){
            $data["success"] = false;
            $data["message"] = $error;
        }else{
            $data["success"] = true;
            $data["message"] = "Success";

            DB::table("transaksi_surat_masuk")
            ->where("id", $request["id_surat_masuk"])
            ->update([
                "id_status"=> Auth::user()->getRole()->id_role == 16 ? 5 : 1 //bila sebagai ketua status diturunkan
            ]);
            if(Auth::user()->getRole()->id_role == 16){
                $status = 5;
            }elseif(Auth::user()->getRole()->id_role == 17){
                $status = 5;
            }else{
                $status = 1;
            }
             //insert penerima surat
             DB::table('detail_transaksi_surat_masuk')->insertOrIgnore([
                "id_surat"=>$request["id_surat_masuk"],
                "id_asal"=>Auth::user()->id,
                "id_penerima"=>$request["tujuan"],
                "petunjuk"=>$request["petunjuk"],
                "catatan"=>$request["catatan"],
                "status"=>$status //bila sebagai ketua atau wakil status diturunkan
            ]);
        }

        return response()->json($data);
    }
    //teruskan surat
    public function teruskan(Request $request){
        $error = [];
        $data = [];

        if(empty($request["tujuan"])){
            $error["err_tujuan"] = "Tujuan tidak boleh kosong";
        }

        if(!empty($error)){
            $data["success"] = false;
            $data["message"] = $error;
        }else{
            $data["success"] = true;
            $data["message"] = "Success";

            DB::table("transaksi_surat_masuk")
            ->where("id", $request["teruskan-id_surat_masuk"])
            ->update([
                "id_status"=>2 //diteruskan
            ]);
            //insert penerima surat
            DB::table('detail_transaksi_surat_masuk')
            ->insert(
            [
                "id_surat" => $request["teruskan-id_surat_masuk"],
                "id_asal" =>Auth::user()->id,
                "id_penerima" =>$request["tujuan"],
                "catatan" =>$request["catatan"],
                "status" =>2, //status disposisi
            ]);
        }

        return response()->json($data);
    }

    public function naikan(Request $request){
        $error = [];
        $data = [];

        if(empty($request["naikan-catatan"])){
            $error["err_catatan"] = "Catatan tidak boleh kosong";
        }

        if(empty($request["naikan-tujuan"])){
            $error["err_tujuan"] = "Tujuan disposisi tidak boleh kosong";
        }

        if(!empty($error)){
            $data["success"] = false;
            $data["message"] = $error;
        }else{
            $data["success"] = true;
            $data["message"] = "Success";

            DB::table("transaksi_surat_masuk")
            ->where("id", $request["naikan-id_surat_masuk"])
            ->update([
                "id_status"=>4 //Dinaikan
            ]);
             //insert penerima surat
            DB::table('detail_transaksi_surat_masuk')->insertOrIgnore([
                "id_surat"=>$request["naikan-id_surat_masuk"],
                "id_asal"=>Auth::user()->id,
                "id_penerima"=>$request["naikan-tujuan"],
                "catatan"=>$request["naikan-catatan"],
                "status"=>4, //status dinaikan
            ]);
        }

        return response()->json($data);
    }

    public function turunkan(Request $request){
        $error = [];
        $data = [];

        if(empty($request["turunkan-catatan"])){
            $error["err_catatan"] = "Catatan tidak boleh kosong";
        }

        if(empty($request["turunkan-tujuan"])){
            $error["err_tujuan"] = "Tujuan disposisi tidak boleh kosong";
        }

        if(!empty($error)){
            $data["success"] = false;
            $data["message"] = $error;
        }else{
            $data["success"] = true;
            $data["message"] = "Success";

            DB::table("transaksi_surat_masuk")
            ->where("id", $request["turunkan-id_surat_masuk"])
            ->update([
                "id_status"=>5 //diturunkan
            ]);
             //insert penerima surat
            DB::table('detail_transaksi_surat_masuk')->insertOrIgnore([
                "id_surat"=>$request["naikan-id_surat_masuk"],
                "id_asal"=>Auth::user()->id,
                "id_penerima"=>$request["naikan-tujuan"],
                "catatan"=>$request["naikan-catatan"],
                "status"=>5, //status diturunkan
            ]);
        }

        return response()->json($data);
    }

    public function save(Request $request){
        $errors = [];
        $data = [];

        if (empty($request["nomor_surat"])) {
            $errors['nomor_surat'] = 'Nomor surat tidak boleh kosong';
        }

        if(empty($request["pengirim_surat"])){
            $errors["pengirim_surat"] = "Pilih salah satu pengirim surat";
        }else{
            if($request["pengirim_surat"] == 1){
                if (empty($request["klasifikasi"])) {
                    $errors['klasifikasi'] = 'Klasifikasi surat tidak boleh kosong';
                }

                if(empty($request["pengirim"])){
                    $errors['pengirim'] = 'Pengirim surat tidak boleh kosong';
                }
            }else{
                if (empty($request["pengirim"])) {
                    $errors['pengirim'] = 'Pengirim surat tidak boleh kosong';
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
        
        if(Auth::user()->getRole()->id_role !== 5 ){
            if($request["kerahasiaan"] == ""){
                $errors['kerahasiaan'] = 'Sifat surat tidak boleh kosong';
            }else{
                $kerahasiaan = $request["kerahasiaan"];
            }
        }else{
            $kerahasiaan = 0;
        }

        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
            $data['success'] = true;
            $data['message'] = 'Success!';

            $fileName = time().'.'.$request->file_surat->extension();
            $tujuan_upload = public_path('/uploads/surat_masuk');
            $request->file_surat->move($tujuan_upload, $fileName);
            
            $tahun = date("Y", strtotime($request["tgl_surat"])); 

            DB::table("transaksi_surat_masuk")
            ->insert([
                "no_surat"=>$request["nomor_surat"],
                "is_internal"=>$request["pengirim_surat"],
                "klasifikasi_id"=>$request["klasifikasi"],
                "pengirim"=>$request["pengirim"],
                "perihal"=>$request["perihal"],
                "kerahasiaan"=>$kerahasiaan,
                "tgl_surat"=>$request["tgl_surat"],
                "tahun"=>$tahun,
                "created_by"=>Auth::user()->id,
                "file"=>$fileName
            ]);

        }

        return response()->json($data);
    }

    public function edit($id){
        $table = DB::table("transaksi_surat_masuk AS surat_masuk")
        ->where("surat_masuk.id",$id)
        ->select(
            "surat_masuk.no_surat",
            "surat_masuk.pengirim",
            "surat_masuk.perihal",
            "surat_masuk.tgl_surat",
            "surat_masuk.kerahasiaan",
            "surat_masuk.is_internal",
            "ref_klasifikasi.id AS id_klasifikasi"
        )->leftJoin("ref_klasifikasi", "surat_masuk.klasifikasi_id", "=", "ref_klasifikasi.id")
        ->get();

        $tujuan_surat = DB::table("detail_transaksi_surat_masuk")
        ->select("id_penerima")
        ->where("id_surat", $id)
        ->get();
        //periksa apakanh surat sudah di disposisi
        $count_disposisi=DB::table("detail_transaksi_surat_masuk")
        ->where("id_surat", $id)
        ->where("id_asal", Auth::user()->id)
        ->where(function($query){
            return $query->where('status', 1)->orWhere('status', 5);
        })
        ->count();

        //periksa penerima surat terakhir
        $penerima_terakhir = DB::table("detail_transaksi_surat_masuk")
        ->where('id_surat', $id)
        ->select(
            'id_penerima AS id_last_penerima',
            'status',
            'created_at',
        )
        ->orderBy('created_at', 'DESC')
        ->first();


        return response()->json(["table"=>$table,"tujuan_surat"=>$tujuan_surat, "count_disposisi"=>$count_disposisi, 'penerima_terakhir'=>$penerima_terakhir]);
    }

    public function getLastPenerima($id_surat){
         //periksa penerima surat terakhir
         $no_surat = DB::table("transaksi_surat_masuk")
         ->where('id', $id_surat)
         ->select('no_surat')
         ->first();

         $count_disposisi=DB::table("detail_transaksi_surat_masuk")
        ->where("id_surat", $id_surat)
        ->where("id_asal", Auth::user()->id)
        ->where(function($query){
            return $query->where('status', 1)->orWhere('status', 5);
        })
        ->count();
        
         $penerima_terakhir = DB::table("detail_transaksi_surat_masuk")
         ->where('id_surat', $id_surat)
         ->select(
             'id_penerima AS id_last_penerima',
             'status',
             'created_at',
         )
         ->orderBy('created_at', 'DESC')
         ->first();

        return response()->json(["count_disposisi"=>$count_disposisi, 'penerima_terakhir'=>$penerima_terakhir, 'no_surat'=>$no_surat->no_surat]);
    }

    public function update(Request $request, $id){
        $errors = [];
        $data = [];

        if (empty($request["nomor_surat"])) {
            $errors['nomor_surat'] = 'Nomor surat tidak boleh kosong';
        }

        if(empty($request["pengirim_surat"])){
            $errors["pengirim_surat"] = "Pilih salah satu pengirim surat";
        }else{
            if($request["pengirim_surat"] == 1){
                if (empty($request["klasifikasi"])) {
                    $errors['klasifikasi'] = 'Klasifikasi surat tidak boleh kosong';
                }

                if(empty($request["pengirim"])){
                    $errors['pengirim'] = 'Pengirim surat tidak boleh kosong';
                }
            }else{
                if (empty($request["pengirim"])) {
                    $errors['pengirim'] = 'Pengirim surat tidak boleh kosong';
                }
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
                $old_file = DB::table("transaksi_surat_masuk")->select('file')->where('id',$id)->first();
                //overwrite file lama
                if (file_exists( public_path('/uploads/surat_masuk/'.$old_file->file))) {
                    unlink(public_path('/uploads/surat_masuk/'.$old_file->file));
                }
    
                $fileName = time().'.'.$request->file_surat->extension();
                $tujuan_upload = public_path('/uploads/surat_masuk');
                $request->file_surat->move($tujuan_upload, $fileName);
    
                DB::table("transaksi_surat_masuk")
                ->where("id", $id)
                ->update(
                    [
                        "no_surat"=>$request["nomor_surat"],
                        "pengirim"=>$request["pengirim"],
                        "perihal"=>$request["perihal"],
                        "tgl_surat"=>$request["tgl_surat"],
                        "kerahasiaan"=>$request["kerahasiaan"],
                        "file"=>$fileName
                    ]
                );

            }else{
                DB::table("transaksi_surat_masuk")
                ->where("id", $id)
                ->update(
                    [
                        "no_surat"=>$request["nomor_surat"],
                        "is_internal"=>$request["pengirim_surat"],
                        "klasifikasi_id"=>$request["klasifikasi"],
                        "pengirim"=>$request["pengirim"],
                        "perihal"=>$request["perihal"],
                        "tgl_surat"=>$request["tgl_surat"],
                        "kerahasiaan"=>$request["kerahasiaan"],
                    ]
                );
            }
    
        }

        return response()->json($data);
    }

    public function delete($id){
        $old_file = DB::table("transaksi_surat_masuk")->select('file')->where('id',$id)->first();

        if (file_exists( public_path('/uploads/surat_masuk/'.$old_file->file))) {
            unlink(public_path('/uploads/surat_masuk/'.$old_file->file));
        }

        DB::table("transaksi_surat_masuk")
        ->where("id",$id)
        ->delete();

        DB::table("detail_transaksi_surat_masuk")
        ->where("id_surat", $id)
        ->delete();

        return response()->json();
    }
}
