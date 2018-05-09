<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use App\Model\FinancialModel;
use App\Model\ClassModel;
use App\Model\ConfirmationModel;

use DB;

class FinancialController extends Controller {
    
	public function index_finance() {
		$classes = ClassModel::where('status', 1)->pluck('name','id');
		return view('backend.financial', compact('classes'));
	}

    public function show_finance() {
        $finance = DB::table('financial')
        ->join('class', 'class.id', '=', 'financial.class_id')
        ->select([ // [ ]<-- biar lebih rapi aja
            'financial.id',
            'financial.title',
            'financial.remark',
            'financial.total_pay',
            'class.name AS class_name',
            'financial.created_date',
            'financial.updated_date'
        ])
        ->get();
        return Datatables::of($finance)
        ->editColumn('remark', function ($model) {
            $remark = str_limit($model->remark, 40, ' ...');
            return $remark;
        })
        ->editColumn('total_pay', function ($model) {
            $total_pay = 'Rp. '.number_format($model->total_pay, 0, ',', '.');
            return $total_pay;
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
        ->rawColumns(['action'])
        ->addIndexColumn()->make(true);
    }

    function fetch_data_finance($finance_id) {
        $finance = FinancialModel::findOrFail($finance_id);
        $output = array(
            'class_id'    =>  $finance->class_id,
            'title'     =>  $finance->title,
            'remark'     =>  $finance->remark,
            'total_pay'     =>  $finance->total_pay
        );
        echo json_encode($output);
    }

	public function save_finance() {
		DB::beginTransaction();
		$this->validate(request(), [
            'class_id' => 'required',
            'title' => 'required|min:3',
            'remark' => 'min:3',
            'total_pay' => 'required|min:3',
        ]);

    	FinancialModel::create([
    		'class_id' => request('class_id'),
    		'title' => request('title'),
    		'remark' => request('remark'),
    		'total_pay' => request('total_pay'),
    		'input_by' => \Auth::user()->id
    	]);

    	DB::commit();
        return response()->json(['status' => 'success','msg' => 'Data Pembayaran Berhasil Ditambahkan']);
	}

	public function delete_finance(){
		DB::beginTransaction();
		try {
            $finance = FinancialModel::findOrFail(request('id'));
	        $finance->delete();

	        DB::commit();
            return response()->json(['status' => 'success','msg' => 'Data Pembayaran Berhasil Dihapus']);
        } catch (\Exception $e) {
        	DB::rollBack();
            \Log::error($e);
            return response()->json(['status' => 'error','msg' => $e]);
        }
    }

    public function update_finance() {
    	DB::beginTransaction();
        $this->validate(request(), [
            'class_id' => 'required',
            'title' => 'required|min:3',
            'remark' => 'min:3',
            'total_pay' => 'required|min:3',
        ]);

        $finance = FinancialModel::findOrFail(request('id'));
        $finance->class_id = request('class_id');
        $finance->title = request('title');
        $finance->remark = request('remark');
        $finance->total_pay = request('total_pay');
        $finance->save();

    	DB::commit();
        return response()->json(['status' => 'success','msg' => 'Data Pembayaran Berhasil Diperbaharui']);
    }

    public function index_confirmation(){
		return view('backend.confirmation');
    }

    public function show_confirmation() {
        $finance = DB::table('confirm_payment')
        ->join('financial', 'financial.id', '=', 'confirm_payment.financial_id')
        ->join('parents', 'parents.id', '=', 'confirm_payment.parents_id')
        ->select([ // [ ]<-- biar lebih rapi aja
            'financial.title',
            'parents.name AS parents_name',
            'confirm_payment.id',
            'confirm_payment.confirm_file',
            'confirm_payment.remark',
            'confirm_payment.total_pay',
            'confirm_payment.remark_admin',
            'confirm_payment.status',
            'confirm_payment.created_date',
            'confirm_payment.updated_date'
        ])
        ->get();
        return Datatables::of($finance)
        ->editColumn('total_pay', function ($model) {
            $total_pay = 'Rp. '.number_format($model->total_pay, 0, ',', '.');
            return $total_pay;
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
        ->addColumn('status', function ($model) {
            if($model->status == 1){
                $status = '<span class="uk-badge">WAITING CONFIRMATION</span>';
            } elseif ($model->status == 2) {
                $status = '<span class="uk-badge uk-badge-success">COMPLETED</span>';
            } else {
                $status = '<span class="uk-badge uk-badge-danger">REJECT</span>';
            }
            return $status;
        })
        ->addColumn('action', function ($model) {
            $action = '-';
            if($model->status != 2){
                $action = '
                    <a id="view_data_confirm" class="md-btn md-btn-success md-btn-wave-light" data-uk-tooltip="{pos:"bottom"}" title="Lihat Detail Konfirmasi Pembayaran" data-id="'.$model->id.'"><i class="material-icons">done_all</i>
                    </a>
                ';
            }
            return $action;
        })
        ->rawColumns(['action','status'])
        ->addIndexColumn()->make(true);
    }

    public function fetch_data_confirmation($id) {
        $confirm = DB::table('confirm_payment')
        ->where('confirm_payment.id', $id)
        ->join('financial', 'financial.id', '=', 'confirm_payment.financial_id')
        ->join('parents', 'parents.id', '=', 'confirm_payment.parents_id')
        ->select([ // [ ]<-- biar lebih rapi aja
            'financial.title',
            'parents.name AS parents_name',
            'confirm_payment.confirm_file',
            'confirm_payment.remark',
            'confirm_payment.total_pay',
            'confirm_payment.remark_admin',
        ])
        ->first();

        $output = array(
            'title'    =>  $confirm->title,
            'parents_name'     =>  $confirm->parents_name,
            'confirm_file'     =>  $confirm->confirm_file,
            'remark'     =>  $confirm->remark,
            'total_pay'     =>  $confirm->total_pay,
            'remark_admin'     =>  $confirm->remark_admin,
        );
        
        echo json_encode($output);
    }

    public function update_confirmation_data() {
        DB::beginTransaction();
        $this->validate(request(), [
            'status'     =>  'required',
        ]);
        $remark_admin = request('remark_admin');
        if(request('remark_admin') == ''){
            $remark_admin = '-';
        }
        if(request('status') == 2){
            $remark_admin = '-';
        }
        $confirm = ConfirmationModel::findOrFail(request('id'));
        $confirm->status = request('status');
        $confirm->remark_admin =  $remark_admin;
        $confirm->save();

        DB::commit();
        return response()->json(['status' => 'success','msg' => 'Data Konfirmasi Berhasil Diperbaharui']);
    }
}
