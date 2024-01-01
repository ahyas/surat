<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $table = DB::table("users")
        ->where("users.id", Auth::user()->id)
        ->select("permission.id_role","roles.alias")
        ->join("permission", "users.id","=","permission.id_user")
        ->join("roles","permission.id_role","=","roles.id")
        ->first();

        return view('home', compact('table'));
    }
}
