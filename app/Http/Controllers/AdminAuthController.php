<?php

namespace App\Http\Controllers;

use App\Models\PrinterQueue;
use App\Models\User;
use Illuminate\Foundation\Exceptions\Whoops\WhoopsHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function admin_login()
    {
        return view('auth.login');
    }

    //LOGIN CODE
    public function admin_login_action(Request $req)
    {
        $email = $req->email;
        $password = $req->password;
        // dd(array(
        //     $email, $password
        // ));
        if (Auth::attempt(["email" => $email, "password" => $password])) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid Employee Code Or Password.');
        }
    }

    public function dashboard(){
        $get_all_print_queues = PrinterQueue::whereDate('rec_date_time',date('Y-m-d'))->orderBy('id', 'DESC')->get();
        $get_all_printers = json_decode(printer_list(),true)['data'];
        return view('web.dashboard', compact('get_all_print_queues','get_all_printers'));
    }

    //LOGOUT CODE
    public function logout()
    {
        session()->flush();
        Auth::logout();
        return redirect()->route('login');
    }

    //STORING DATA IN SESSION
    public function get_session_data(Request $req)
    {
        $req->session()->put('user_id', Auth::user()->id);
        $req->session()->put('user_name', Auth::user()->name);
        //GET ALL DATA FROM SESSION
        $value = session()->all();
        dd($value);
    }
}
