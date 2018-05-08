<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use App\Model\ClassModel;
use DB;

class ClassController extends Controller {
    
	public function index_class() {
		return view('backend.class');
	}

    public function show_class() {
        $classes = ClassModel::all();
        return Datatables::of($classes)
        ->editColumn('status', function ($model) {
            $status = $model->status;
            if($status == 1){
                $status = '<a href="#" data-uk-tooltip title="Aktif"><i class="material-icons md-36 uk-text-success">&#xE86C;</i></a>';
            } else {
                $status='<a href="#" data-uk-tooltip title="Tak Aktif"><i class="material-icons  md-36 uk-text-danger">&#xE5C9;</i></a>';
            }
            return $status;
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
        ->rawColumns(['status','action'])
        ->addIndexColumn()->make(true);
    }

    function fetch_data_class($class_id) {
        $class = ClassModel::findOrFail($class_id);
        if($class->status == 1)$status='true'; else $status='';
        $output = array(
            'name'    =>  $class->name,
            'code'     =>  $class->code,
            'status'     =>  $status
        );
        echo json_encode($output);
    }

	public function save_class() {
		DB::beginTransaction();
		$this->validate(request(), [
            'name' => 'required|max:60|min:3',
            'code' => 'required|min:3|unique:class,code',
        ]);

		if(request('status') == 'on')$status=1; else $status=0;
    	ClassModel::create([
    		'name' => request('name'),
    		'code' => request('code'),
            'status' => $status,
    	]);

    	DB::commit();
        return response()->json(['status' => 'success','msg' => 'Data Kelas Berhasil Ditambahkan']);
	}

	public function delete_class(){
		DB::beginTransaction();
		try {
            $class = ClassModel::findOrFail(request('id'));
	        $class->delete();

	        DB::commit();
            return response()->json(['status' => 'success','msg' => 'Data Kelas Berhasil Dihapus']);
        } catch (\Exception $e) {
        	DB::rollBack();
            \Log::error($e);
            return response()->json(['status' => 'error','msg' => $e]);
        }
    }

    public function update_class() {
    	DB::beginTransaction();
        $this->validate(request(), [
            'name' => 'required|max:60|min:3',
            'code' => 'required|min:3',
        ]);

        if(request('status') == 'on')$status=1; else $status=0;
        $class = ClassModel::findOrFail(request('id'));
        $class->name = request('name');
        $class->code = request('code');
        $class->status = $status;
        $class->save();

    	DB::commit();
        return response()->json(['status' => 'success','msg' => 'Data Kelas Berhasil Diperbaharui']);
    }
}
