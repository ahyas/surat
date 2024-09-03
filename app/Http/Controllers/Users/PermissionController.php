<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PermissionController extends Controller
{
    public function index(){
        $table=DB::table("roles")
        ->where('id','!=',1)
        ->select("id","name","keterangan")
        ->get();

        return view('permission/index', compact('table'));
    }

    public function getPermission(){

        $table = DB::table("users")
        ->where("users.id","!=",1)
        ->where("daftar_pegawai.status", 1)
        ->select("users.id AS id_user","users.name AS nama","users.email","roles.name AS role")
        ->Join("permission", "users.id","=","permission.id_user")
        ->join("daftar_pegawai", "users.id", "=", "daftar_pegawai.id_user")
        ->leftJoin("roles","permission.id_role","=","roles.id")
        ->orderBy("users.created_at", 'DESC')
        ->get();

        return response()->json($table);
    }

    public function edit($id_user){
        $table=DB::table("users")
        ->where("users.id",$id_user)
        ->select("users.id AS id_user","users.name AS nama","permission.id_role")
        ->join("permission", "users.id","=","permission.id_user")
        ->first();

        return response()->json($table);
    }

    public function update(Request $request, $id_user){
        $errors = [];
        $data = [];

        if (empty($request["user_role"])) {
            $errors['user_role'] = 'Pilih role yang sesuai';
        }

        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
            $data['success'] = true;
            $data['message'] = 'Success!';

            DB::table("permission")
            ->where("id_user", $id_user)
            ->update([
                "id_role"=>$request['user_role'],
            ]);
        }

        return response()->json($data);
    }
}
