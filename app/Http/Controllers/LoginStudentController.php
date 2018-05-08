<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\StudentModel;

use Auth;
use Carbon\Carbon;

class LoginStudentController extends Controller {

	public function index() {
    	return view('login_student');
    }

    public function process_signin() {
    	$this->validate(request(), [
            'nis' => 'required|string|max:20',
            'password' => 'required|string|min:8',
        ]);
        $nis = request('nis');
        $password = request('password');

        $check_status = StudentModel::where('nis', $nis)->first();
        if($check_status != ''){
            if($check_status->status != 1){
                return redirect()->back()->with('info','Maaf, akun anda tidak aktif.');
            }

        	if(Auth::guard('student')->attempt(['nis' => $nis, 'password' => $password])) {
        		$student = StudentModel::findOrFail(Auth::guard('student')->user()->id);
                $student->last_login = Carbon::now();
                $student->save();
                return redirect()->route('front')->with('success','Halo!, Selamat Datang '.Auth::guard('student')->user()->name);
        	}
        } else {
            return redirect()->back()->with('warning','Maaf, kami tidak menemukan akun anda.'); 
        }
    	return redirect()->back()->with('warning','Maaf, cek nis dan kata sandi kamu kembali.');
    }

    public function sign_out(Request $request) {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
    	return redirect()->route('signin')->with('success','Kamu sudah logout');
    }

}
