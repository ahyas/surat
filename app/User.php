<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRole(){
        $table = DB::table("users")
        ->where("users.id", Auth::user()->id)
        ->select("roles.alias AS role", "roles.name AS role_name","permission.id_role")
        ->join("permission", "users.id","=","permission.id_user")
        ->join("roles", "permission.id_role","=","roles.id")
        ->first();

        return $table;
    }

}
