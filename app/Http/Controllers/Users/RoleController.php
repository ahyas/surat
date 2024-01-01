<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class RoleController extends Controller
{
    public function index(){
        return view("roles/index");
    }

    public function getRole(){
        $table = DB::table("roles")
        ->where('id','!=',1)
        ->orderBy("seq","ASC")
        ->select("id AS id_role", "seq AS urutan","name AS role", "keterangan")
        ->get();

        return response()->json($table);
    }
}
