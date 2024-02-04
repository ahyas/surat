<?php

namespace App\Http\Controllers\Referensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class JabatanController extends Controller
{
    public function index(){
        return view('jabatan/index');
    }

    public function getData(){
        $table=DB::table("ref_jabatan")
        ->select("id","nama AS jabatan")
        ->get();

        return response()->json($table);
    }
}
