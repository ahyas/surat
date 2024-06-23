<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TestController extends Controller
{
    public function index(){
        $table = DB::table("template_sk_menetapkan")
        ->where("id_surat_keluar",308)
        ->get();

        return view("test");
    }
}
