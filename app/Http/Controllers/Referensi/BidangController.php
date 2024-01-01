<?php

namespace App\Http\Controllers\Referensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class BidangController extends Controller
{
    public function index(){
        return view('bidang/index');
    }

    public function getBidang(){
        $table=DB::table("bidang")
        ->select("id AS id_bidang","nama AS bidang")
        ->get();
        return response()->json($table);
    }
}
