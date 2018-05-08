<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ParentModel;

use Auth;
use Carbon\Carbon;

class LoginParentController extends Controller {
	
	public function index() {
    	return view('login_parent');
    }

    public function process_signin() {
    	$this->validate(request(), [
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8',
        ]);

        $phone = request('phone');
        $password = request('password');

        $check_status = ParentModel::where('phone', $phone)->first();
        if($check_status != ''){
            if($check_status->status != 1){
                return redirect()->back()->with('info','Maaf, akun anda tidak aktif.');
            }

        	if(Auth::guard('parent')->attempt(['phone' => $phone, 'password' => $password])) {
        		$parent = ParentModel::findOrFail(Auth::guard('parent')->user()->id);
                $parent->last_login = Carbon::now();
                $parent->save();
                return redirect()->route('parents')->with('success','Halo!, Selamat Datang '.Auth::guard('parent')->user()->name);
        	}
        } else {
            return redirect()->back()->with('warning','Maaf, kami tidak menemukan akun anda.'); 
        }
    	return redirect()->back()->with('warning','Maaf, cek No. Handphone dan kata sandi anda kembali.');
    }

    public function sign_out_parent(Request $request) {
        Auth::guard('parent')->logout();
        $request->session()->invalidate();
    	return redirect()->route('signin_parent')->with('success','Kamu sudah logout');
    }  

}
