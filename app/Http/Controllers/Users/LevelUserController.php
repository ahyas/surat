<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class LevelUserController extends Controller
{
    public function index(){
        $user = DB::table("users")->select("id","name AS nama_pegawai")->get();

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

    public function delete($id_parent_user, $id_sub_user){
        DB::table("level_user")
        ->where("id_parent_user", $id_parent_user)
        ->where("id_sub_user", $id_sub_user)
        ->delete();

        return response()->json();
    }
}
