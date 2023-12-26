<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    public function index(){
        return view('admin/bidang/index');
    }

    public function getBidang(){
        $table=DB::table("bidang")
        ->select("id AS id_bidang","nama AS bidang")
        ->get();
        return response()->json($table);
    }
}
