<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;

class UserController extends Controller
{
    public function index(){
        $table=DB::table("roles")
        ->where('id','!=',1)
        ->select("id","name","keterangan")
        ->get();

        $table2=DB::table("bidang")
        ->select("id AS id_bidang","nama AS bidang")
        ->get();

        return view("user/index", compact("table","table2"));
    }

    public function getUser(){
        $table=DB::table("users")
        ->where("users.id","!=", 1)
        ->select("users.id AS id_user","users.name AS nama","bidang.nama AS bidang","users.email","bidang.id AS id_bidang")
        ->leftJoin("bidang", "users.id_bidang","=","bidang.id")
        ->get();

        return response()->json($table);
    }

    public function save(Request $request){
        $errors = [];
        $data = [];

        if (empty($request["name"])) {
            $errors['name'] = 'Nama tidak boleh kosong';
        }
        
        if (empty($request["email"])) {
            $errors['email'] = 'Email tidak boleh kosong';
        }else{
            $count=DB::table("users")->where("email",$request["email"])->count();   
            if($count>0){
                $errors['email'] = 'Email sudah digunakan';
            }
        }

        if (empty($request["bidang"])) {
            $errors['bidang'] = 'Pilih bidang yang sesuai';
        }

        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
            $data['success'] = true;
            $data['message'] = 'Success!';

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
                "id_user"=>$userId
            ]);
        }

        return response()->json($data);
    }

    public function edit($id_user){
        $table=DB::table("users")
        ->where("users.id",$id_user)
        ->select("users.id AS id_user","users.name AS nama","bidang.id AS id_bidang","users.email")
        ->join("permission", "users.id","=","permission.id_user")
        ->leftJoin("bidang", "users.id_bidang","=","bidang.id")
        ->first();

        return response()->json($table);
    }

    public function update(Request $request, $id_user){
        $errors = [];
        $data = [];

        if (empty($request["name"])) {
            $errors['name'] = 'Nama tidak boleh kosong';
        }

        if (empty($request["bidang"])) {
            $errors['bidang'] = 'Pilih bidang yang sesuai';
        }

        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
            $data['success'] = true;
            $data['message'] = 'Success!';

            DB::table("users")
            ->where("id", $id_user)
            ->update([
                "name"=>$request['name'],
                "email"=>$request['email'],
                "id_bidang"=>$request['bidang']
            ]);

        }

        return response()->json($data);
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
