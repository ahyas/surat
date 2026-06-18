<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class LevelUserController extends Controller
{
    public function index(){
        $user = DB::table("users")
        ->select("id","name AS nama_pegawai")
        ->orderBy("name")
        ->get();

        return view("level_user.index", compact("user"));
    }

    public function getData(){
        $table = DB::table("level_user")
        ->select("parent_user.id AS id_parent_user", "sub_user.id AS id_sub_user","parent_user.name AS parent_user","sub_user.name AS sub_user")
        ->join("users AS parent_user", "level_user.id_parent_user","=","parent_user.id")
        ->join("users AS sub_user", "level_user.id_sub_user","=","sub_user.id")
        ->get();

        return response()->json($table);
    }

    public function save(Request $request){
        $error = [];
        $data = [];
        if(empty($request["parent_user"])){
            $error["err_parent_user"] = "Parent user tidak boleh kosong";
        }

        if(empty($request["sub_user"])){
            $error["err_sub_user"] = "Sub user tidak boleh kosong";
        }

        if(!empty($request["parent_user"]) && $request["parent_user"] == $request["sub_user"]){
            $error["err_sub_user"] = "Parent user dan sub user tidak boleh sama";
        }

        if(!empty($request["parent_user"]) && !empty($request["sub_user"])){
            $exists = DB::table("level_user")
            ->where("id_parent_user", $request["parent_user"])
            ->where("id_sub_user", $request["sub_user"])
            ->exists();

            if($exists){
                $error["err_sub_user"] = "Relasi level user sudah tersedia";
            }
        }

        if(!empty($error)){
            $data["success"] = false;
            $data["message"] = $error;
        }else{
            $data["success"] = true;
            $data["message"] = "Succeed";
            DB::table("level_user")
            ->insert([
                "id_parent_user"=>$request["parent_user"],
                "id_sub_user"=>$request["sub_user"]
            ]);
        }

        return response()->json($data);
    }

    public function edit($id_parent_user, $id_sub_user){
        $table = DB::table("level_user")
        ->where("id_parent_user", $id_parent_user)
        ->where("id_sub_user", $id_sub_user)
        ->select("id_parent_user", "id_sub_user")
        ->first();

        if(!$table){
            return response()->json(["message" => "Data level user tidak ditemukan"], 404);
        }

        return response()->json($table);
    }

    public function detail($id_parent_user, $id_sub_user){
        $table = DB::table("level_user")
        ->where("level_user.id_parent_user", $id_parent_user)
        ->where("level_user.id_sub_user", $id_sub_user)
        ->select(
            "parent_user.id AS id_parent_user",
            "parent_user.name AS parent_name",
            "parent_user.email AS parent_email",
            "parent_role.name AS parent_role",
            "parent_bidang.nama AS parent_bidang",
            "parent_jabatan.nama AS parent_jabatan",
            "sub_user.id AS id_sub_user",
            "sub_user.name AS sub_name",
            "sub_user.email AS sub_email",
            "sub_role.name AS sub_role",
            "sub_bidang.nama AS sub_bidang",
            "sub_jabatan.nama AS sub_jabatan"
        )
        ->join("users AS parent_user", "level_user.id_parent_user", "=", "parent_user.id")
        ->join("users AS sub_user", "level_user.id_sub_user", "=", "sub_user.id")
        ->leftJoin("permission AS parent_permission", "parent_user.id", "=", "parent_permission.id_user")
        ->leftJoin("roles AS parent_role", "parent_permission.id_role", "=", "parent_role.id")
        ->leftJoin("bidang AS parent_bidang", "parent_user.id_bidang", "=", "parent_bidang.id")
        ->leftJoin("daftar_pegawai AS parent_pegawai", "parent_user.id", "=", "parent_pegawai.id_user")
        ->leftJoin("ref_jabatan AS parent_jabatan", "parent_pegawai.id_jabatan", "=", "parent_jabatan.id")
        ->leftJoin("permission AS sub_permission", "sub_user.id", "=", "sub_permission.id_user")
        ->leftJoin("roles AS sub_role", "sub_permission.id_role", "=", "sub_role.id")
        ->leftJoin("bidang AS sub_bidang", "sub_user.id_bidang", "=", "sub_bidang.id")
        ->leftJoin("daftar_pegawai AS sub_pegawai", "sub_user.id", "=", "sub_pegawai.id_user")
        ->leftJoin("ref_jabatan AS sub_jabatan", "sub_pegawai.id_jabatan", "=", "sub_jabatan.id")
        ->first();

        if(!$table){
            return response()->json(["message" => "Data level user tidak ditemukan"], 404);
        }

        return response()->json($table);
    }

    public function update(Request $request, $id_parent_user, $id_sub_user){
        $error = [];

        if(empty($request["parent_user"])){
            $error["err_parent_user"] = "Parent user tidak boleh kosong";
        }

        if(empty($request["sub_user"])){
            $error["err_sub_user"] = "Sub user tidak boleh kosong";
        }

        if(!empty($request["parent_user"]) && $request["parent_user"] == $request["sub_user"]){
            $error["err_sub_user"] = "Parent user dan sub user tidak boleh sama";
        }

        if(!empty($request["parent_user"]) && !empty($request["sub_user"])){
            $duplicate = DB::table("level_user")
            ->where("id_parent_user", $request["parent_user"])
            ->where("id_sub_user", $request["sub_user"])
            ->where(function($query) use ($id_parent_user, $id_sub_user){
                $query->where("id_parent_user", "!=", $id_parent_user)
                ->orWhere("id_sub_user", "!=", $id_sub_user);
            })
            ->exists();

            if($duplicate){
                $error["err_sub_user"] = "Relasi level user sudah tersedia";
            }
        }

        if(!empty($error)){
            return response()->json([
                "success" => false,
                "message" => $error
            ]);
        }

        $updated = DB::table("level_user")
        ->where("id_parent_user", $id_parent_user)
        ->where("id_sub_user", $id_sub_user)
        ->update([
            "id_parent_user" => $request["parent_user"],
            "id_sub_user" => $request["sub_user"]
        ]);

        if(!$updated && ($id_parent_user != $request["parent_user"] || $id_sub_user != $request["sub_user"])){
            return response()->json([
                "success" => false,
                "message" => ["err_sub_user" => "Data level user gagal diperbarui"]
            ]);
        }

        return response()->json([
            "success" => true,
            "message" => "Succeed"
        ]);
    }

    public function delete($id_parent_user, $id_sub_user){
        DB::table("level_user")
        ->where("id_parent_user", $id_parent_user)
        ->where("id_sub_user", $id_sub_user)
        ->delete();

        return response()->json();
    }
}
