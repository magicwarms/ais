<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\TeacherModel;

use Auth;

class LoginTeacherController extends Controller {

    public function index() {
    	return view('login_teacher');
    }

    public function process_login_teacher() {

    	$this->validate(request(), [
            'code' => 'required|string|max:20',
            'password' => 'required|string|min:8',
        ]);
        $code = request('code');
        $password = request('password');

        $check_status = TeacherModel::where('code', $code)->first();
        if($check_status != ''){
            if($check_status->status != 1){
                return redirect()->back()->with('info','Maaf, akun guru anda tidak aktif.');
            }
            $remembering = '';
            if(request('remember') != ''){
                $remembering = request('remember');
            }
        	if(Auth::guard('teacher')->attempt(['code' => $code, 'password' => $password], $remembering )) {
                return redirect()->route('teacher.profile')->with('success','Halo!, Selamat Datang '.Auth::guard('teacher')->user()->name);
        	}
        } else {
            return redirect()->back()->with('warning','Maaf, kami tidak menemukan akun anda.'); 
        }
    	return redirect()->back()->with('warning','Maaf, cek kode dan kata sandi kamu kembali.');
    }

    public function logout_teacher(Request $request) {
        Auth::guard('teacher')->logout();
        $request->session()->invalidate();
    	return redirect()->route('login.teacher')->with('success','Kamu sudah logout guru!');
    }

}
