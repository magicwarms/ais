<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\Model\UserAdminModel;
use App\Model\MenuJoinAdminModel;

use DB;
use Carbon\Carbon;

class UserController extends Controller {
    
    public function index_user($id=NULL) {
        $users = UserAdminModel::all();

        if($id != NULL){
            $tab = array(
                'data-tab' => '',
                'form-tab' => 'uk-active',
            );
            $get_user = UserAdminModel::where('id', $id)->first();
        } else {
            $tab = array(
                'data-tab' => 'uk-active',
                'form-tab' => '',
            );
            $get_user = UserAdminModel::get_new();
        }
        
        return view('backend.user_admin', compact('users','tab','get_user'));
    }

    public function save_user() {
        DB::beginTransaction();
        $this->validate(request(), [
            'name' => 'required|max:45|min:3',
            'email' => 'required|email|min:3|unique:user_admin,email',
            'password' => 'required|min:8',
            'level' => 'required',
        ]);
    
        if(request('status_admin') == 'on')$status=1; else $status=0;
        $save_user_admin = UserAdminModel::create([
            'name' => request('name'),
            'email' => strtolower(request('email')),
            'password' => bcrypt(request('password')),
            'status_admin' => $status,
            'level' => request('level'),
            'last_login' => Carbon::now(),
        ]);
        
        foreach (request('menu_admin_id') as $value) {
            $datas['user_admin_id'] = $save_user_admin->id;
            $datas['menu_admin_id'] = $value;
            $checkinginput = MenuJoinAdminModel::where('user_admin_id', $datas['user_admin_id'])->where('menu_admin_id', $datas['menu_admin_id'])->first();
            if($checkinginput != ''){
                return redirect()->route('user')->with('warning','Pengguna yang anda daftarkan sudah memiliki menu tersebut.');
            } else {
                MenuJoinAdminModel::create([
                    'user_admin_id' => $datas['user_admin_id'],
                    'menu_admin_id' => $datas['menu_admin_id'],
                ]);
            }
        }

        DB::commit();
        $send_email_acc_created = $this->send_email_account_created(strtolower(request('email')));
        if($send_email_acc_created == 'success'){
            return redirect()->route('user')->with('info','Pengguna Berhasil Ditambahkan');
        }
    }

    public function delete_user(){
        DB::beginTransaction();
        try {
            $user = UserAdminModel::findOrFail(request('id'));
            $user->delete();

            DB::commit();
            return redirect()->route('user')->with('success','Pengguna Berhasil Dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e);
            return redirect()->route('user')->with('error', $e);
        }
    }

    public function update_user(UserAdminModel $user) {
        DB::beginTransaction();
        $this->validate(request(), [
            'name' => 'required|max:25|min:3',
            'email' => 'required|email|min:3',
            'level' => 'required',
        ]);

        if(request('status_admin') == 'on')$status=1; else $status=0;
        $user->update([
            'name' => request('name'),
            'email' => strtolower(request('email')),
            'status_admin' => $status,
            'level' => request('level'),
        ]);

        DB::table('menu_join_admin')->where('user_admin_id', $user->id)->delete();

        foreach (request('menu_admin_id') as $value) {
            $datas['user_admin_id'] = $user->id;
            $datas['menu_admin_id'] = $value;
            
            MenuJoinAdminModel::create([
                'user_admin_id' => $datas['user_admin_id'],
                'menu_admin_id' => $datas['menu_admin_id'],
            ]);
        }
        DB::commit();
        return redirect()->route('user')->with('success','Pengguna Berhasil Diperbaharui');
    }

    public function change_password_user() {
        DB::beginTransaction();
        $this->validate(request(), [
            'password' => 'required|min:8',
        ]);
        DB::table('user_admin')->where('id', request('id'))->update(['password' => bcrypt(request('password'))]);
        DB::commit();

        $admin_data = UserAdminModel::select('email','name')->where('id', request('id'))->first();
        $send_email_reset = $this->send_email_reset_password($admin_data->email, $admin_data->name);

        if($send_email_reset == 'success'){
            return redirect()->route('user')->with('success','Kata sandi Pengguna Berhasil Dirubah');
        }
    }

    public function send_email_reset_password($email, $receiver) {
        Mail::send('mails.account_reset_password', ['receiver' => $receiver], function ($message) use ($email) {
            $message->to($email)->subject("Kata sandi berhasil dirubah");

        });
        return 'success';
    }

    public function send_email_account_created($email) {
        Mail::send('mails.account_created', [], function ($message) use ($email) {
            $message->to($email)->subject("Selamat datang!");

        });
        return 'success';
    }
}
