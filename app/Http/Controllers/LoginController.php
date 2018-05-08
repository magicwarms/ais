<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserAdminModel;
use Carbon\Carbon;

use Auth;

class LoginController extends Controller {

    public function index() {
    	return view('login');
    }

    public function process_login(Request $request) {

    	$this->validate(request(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        $email = filter_var($request->email, FILTER_VALIDATE_EMAIL);
        $password = $request->password;

        $check_status = UserAdminModel::where('email', $email)->first();
        if($check_status != ''){
            if($check_status->status_admin != 1){
                return redirect()->back()->with('info','Maaf, akun anda tidak aktif.');
            }
            $remembering = '';
            if(request('remember') != ''){
                $remembering = request('remember');
            }
        	if(Auth::attempt(['email' => $email, 'password' => $password], $remembering )) {
                $user = UserAdminModel::find(Auth::user()->id);
                $user->last_login = Carbon::now();
                $user->save();

                return redirect()->route('beranda')->with('success','Halo!, Selamat Datang '.Auth::user()->name);
        	}
        } else {
            return redirect()->back()->with('warning','Maaf, kami tidak menemukan akun anda.'); 
        }
    	return redirect()->back()->with('warning','Maaf, cek email dan kata sandi kamu kembali.');
    }

    public function logout(Request $request) {
    	Auth::guard('web')->logout();
        $request->session()->invalidate();
    	return redirect()->route('login')->with('success','Kamu sudah logout!');
    }

}
