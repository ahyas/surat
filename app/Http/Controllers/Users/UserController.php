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

        $jabatan = DB::table("ref_jabatan")->select("id","nama AS jabatan")->get();

        return view("user/index", compact("table","table2","jabatan"));
    }

    public function getUser(){
        $table=DB::table("users")
        ->where("users.id","!=", 1)
        ->select("users.id AS id_user",
            "users.name AS nama",
            "bidang.nama AS bidang",
            "users.email",
            "bidang.id AS id_bidang",
            "ref_jabatan.nama AS jabatan",
            "daftar_pegawai.nip"
        )
        ->leftJoin("bidang", "users.id_bidang","=","bidang.id")
        ->leftJoin("daftar_pegawai","users.id","=","daftar_pegawai.id_user")
        ->leftJoin("ref_jabatan","daftar_pegawai.id_jabatan","=","ref_jabatan.id")
        ->orderBy("users.created_at", 'DESC')
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

        if(empty($request["jabatan"])){
            $errors['jabatan'] = 'Pilih Jabatan yang sesuai';
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
                "id_bidang"=>$request['bidang'],
                "created_at" => now(), # new \Datetime()
                "updated_at" => now(),  # new \Datetime()
            ]);

            $userId = DB::getPdo()->lastInsertId();

            DB::table("permission")
            ->insert([
                "id_user"=>$userId,
                "id_role"=>18
            ]);

            DB::table("daftar_pegawai")
            ->insert([
                "id_user"=>$userId,
                "id_jabatan"=>$request["jabatan"],
                "nip"=>$request["nip"]
            ]);
        }

        return response()->json($data);
    }

    public function edit($id_user){
        $table=DB::table("users")
        ->where("users.id",$id_user)
        ->select(
            "users.id AS id_user",
            "users.name AS nama",
            "bidang.id AS id_bidang",
            "users.email",
            "daftar_pegawai.id_jabatan",
            "daftar_pegawai.nip"
        )
        ->leftJoin("permission", "users.id","=","permission.id_user")
        ->leftJoin("bidang", "users.id_bidang","=","bidang.id")
        ->leftJoin("daftar_pegawai","users.id","=","daftar_pegawai.id_user")
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

        if(empty($request["jabatan"])){
            $errors['jabatan'] = 'Pilih Jabatan yang sesuai';
        }

        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
            $data['success'] = true;
            $data['message'] = 'Success!';

            DB::table("users")
            ->where("id", $id_user)
            ->update(
                [
                    "name"=>$request["name"],
                    "id_bidang"=>$request['bidang']
                ]);

            DB::table("daftar_pegawai")
            ->updateOrInsert(["id_user"=>$id_user], [
                "id_user"=>$id_user,
                "id_jabatan"=>$request["jabatan"],
                "nip"=>$request["nip"]
            ]);

            DB::table("permission")
            ->updateOrInsert([
                "id_user"=>$id_user
            ], [
                "id_user"=>$id_user
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

        DB::table("daftar_pegawai")
        ->where("id_user", $id_user)
        ->delete();

        return response()->json();
    }
}
