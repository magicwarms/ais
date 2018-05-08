<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use App\Model\ParentModel;
use DB;

class ParentController extends Controller {

	public function index_parent() {
		return view('backend.parent');
	}

    public function show_parent() {
        $parents = ParentModel::all();
        return Datatables::of($parents)
        ->editColumn('status', function ($model) {
            $status = $model->status;
            if($status == 1){
                $status = '<a href="#" data-uk-tooltip title="Aktif"><i class="material-icons md-36 uk-text-success">&#xE86C;</i></a>';
            } else {
                $status='<a href="#" data-uk-tooltip title="Tak Aktif"><i class="material-icons  md-36 uk-text-danger">&#xE5C9;</i></a>';
            }
            return $status;
        })
        ->editColumn('gender', function ($model) {
            $gender = $model->gender;
            if($gender == 1){
                $gender = '<span class="uk-badge uk-badge-primary">Laki-laki</span>';
            } else {
                $gender='<span class="uk-badge uk-badge-danger">Perempuan</span>';
            }
            return $gender;
        })
        ->editColumn('created_date', function ($model) {
            $created = date('d F Y H:i:s', strtotime($model->created_date));
            return $created;
        })
        ->editColumn('updated_date', function ($model) {
            $updated = $model->updated_date;
            if($updated != null){
              $updated = date('d F Y H:i:s', strtotime($updated));
            } else {
              $updated = '-';
            }
            return $updated;
        })
        ->addColumn('action', function ($model) {
            $action = '
                <a href="#" class="edit_data" data-id="'.$model->id.'"><i class="md-icon material-icons">&#xE254;</i></a>
                <a onclick="delete_data('.$model->id.')" href="#"><i class="md-icon material-icons">&#xE16C;</i>
                </a>
            ';
            return $action;
        })
        ->addColumn('sandi', function ($model) {
            $sandi = '
                <a href="#parentID" class="md-btn md-btn2" data-id="'.$model->id.'" data-uk-modal="{target:"#parentID"}"><i class="md-icon material-icons uk-text-danger">&#xE8C6;</i></a>
            ';
            return $sandi;
        })
        ->rawColumns(['status','action','gender','sandi'])
        ->addIndexColumn()->make(true);
    }

    function fetch_data_parent($parent_id) {
        $parent = ParentModel::findOrFail($parent_id);
        if($parent->status == 1)$status='true'; else $status='';
        $output = array(
            'name'    =>  $parent->name,
            'phone'     =>  $parent->phone,
            'address'     =>  $parent->address,
            'gender'     =>  $parent->gender,
            'status'     =>  $status
        );
        echo json_encode($output);
    }

	public function save_parent() {
		DB::beginTransaction();
		$this->validate(request(), [
            'name' => 'required|max:80|min:3',
            'address' => 'required|min:10',
            'phone' => 'required|unique:parents,phone|regex:/08[0-9]{9,}/',
            'password' => 'required|min:8',
            'gender' => 'required',
        ]);
	
		if(request('status') == 'on')$status=1; else $status=0;
    	ParentModel::create([
    		'name' => request('name'),
    		'address' => request('address'),
    		'password' => bcrypt(request('password')),
    		'gender' => request('gender'),
    		'phone' => request('phone'),
            'status' => $status,
    	]);

        DB::commit();
        return response()->json(['status' => 'success','msg' => 'Data Orang Tua Berhasil Ditambahkan']);
	}

	public function delete_parent(){
		DB::beginTransaction();
		try {
            $parent = ParentModel::findOrFail(request('id'));
	        $parent->delete();

	        DB::commit();
            return response()->json(['status' => 'success','msg' => 'Data Orang Tua Berhasil Dihapus']);
        } catch (\Exception $e) {
        	DB::rollBack();
            \Log::error($e);
            return response()->json(['status' => 'error','msg' => $e]);
        }
    }

    public function update_parent() {
    	DB::beginTransaction();
        $this->validate(request(), [
            'name' => 'required|max:80|min:3',
            'address' => 'required|min:10',
            'phone' => 'required|regex:/08[0-9]{9,}/',
            'gender' => 'required',
        ]);

        if(request('status') == 'on')$status=1; else $status=0;
        $parent = ParentModel::findOrFail(request('id'));
        $parent->name = request('name');
        $parent->address = request('address');
        $parent->phone = request('phone');
        $parent->gender = request('gender');
        $parent->status = $status;
        $parent->save();

    	DB::commit();
        return response()->json(['status' => 'success','msg' => 'Data Orang Tua Berhasil Diperbaharui']);
    }

    public function change_password_parent() {
        DB::beginTransaction();
        $this->validate(request(), [
            'password' => 'required|min:8',
        ]);
        DB::table('parents')->where('id', request('id'))->update(['password' => bcrypt(request('password'))]);
        DB::commit();
        // $admin_data = UserAdminModel::select('email','name')->where('id', request('id'))->first();
        // $send_email_reset = $this->send_email_reset_password($admin_data->email, $admin_data->name);

        //if($send_email_reset == 'success'){
        return response()->json(['status' => 'success','msg' => 'Kata sandi Orang Tua Berhasil Dirubah']);
        //}
    }
}
