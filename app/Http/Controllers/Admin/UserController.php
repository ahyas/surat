<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;

class UserController extends Controller
{
    public function index(){
        $table=DB::table("roles")
        ->select("id","name","keterangan")
        ->get();

        $table2=DB::table("bidang")
        ->select("id AS id_bidang","nama AS bidang")
        ->get();

        return view("admin/user/index", compact("table","table2"));
    }

    public function getUser(){
        $table=DB::table("users")
        ->select("users.id AS id_user","users.name AS nama","roles.name AS role","bidang.nama AS bidang","users.email")
        ->join("permission", "users.id","=","permission.id_user")
        ->join("roles", "permission.id_role","=","roles.id")
        ->leftJoin("bidang", "users.id_bidang","=","bidang.id")
        ->get();

        return response()->json($table);
    }

    public function save(Request $request){
        DB::table("users")
        ->insert([
            "name"=>$request['name'],
            "email"=>$request['email'],
            "password"=>Hash::make("ptapabar"),
            "id_bidang"=>$request['bidang']
        ]);

        $userId = DB::getPdo()->lastInsertId();

        DB::table("permission")
        ->insert([
            "id_user"=>$userId,
            "id_role"=>$request['user_role'],
        ]);

        return response()->json();
    }

    public function edit($id_user){
        $table=DB::table("users")
        ->where("users.id",$id_user)
        ->select("users.id AS id_user","users.name AS nama","bidang.id AS id_bidang","users.email","permission.id_role")
        ->join("permission", "users.id","=","permission.id_user")
        ->leftJoin("bidang", "users.id_bidang","=","bidang.id")
        ->first();

        return response()->json($table);
    }

    public function update(Request $request, $id_user){
        DB::table("users")
        ->where("id", $id_user)
        ->update([
            "name"=>$request['name'],
            "email"=>$request['email'],
            "id_bidang"=>$request['bidang']
        ]);

        DB::table("permission")
        ->where("id_user", $id_user)
        ->update([
            "id_role"=>$request['user_role'],
        ]);

        return response()->json();
    }

    public function delete($id_user){
        DB::table("users")
        ->where("id",$id_user)
        ->delete();

        DB::table("permission")
        ->where("id_user", $id_user)
        ->delete();

        return response()->json();
    }
}
