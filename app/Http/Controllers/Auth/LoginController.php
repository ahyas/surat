<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $redirectTo;
    public function redirectTo()
    {
        $table = DB::table("users")
        ->where("users.id", Auth::user()->id)
        ->select("permission.id_role")
        ->join("permission", "users.id","=","permission.id_user")
        ->first();

        switch($table->id_role){
            case 1:
                $this->redirectTo = '/admin';
                return $this->redirectTo;
                break;
            case 5:
                $this->redirectTo = '/operator';
                return $this->redirectTo;
                break;
            default:
                $this->redirectTo = '/login';
                return $this->redirectTo;
        }
         
        // return $next($request);
    } 

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }
}
