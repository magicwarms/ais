<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use App\Model\AbsenceModel;
use App\Model\StudentModel;
use App\Model\ClassModel;
use DB;

class AbsenceController extends Controller {
    
	public function index_absence() {
        $classes = ClassModel::orderBy('name','asc')->where('status', 1)->pluck('name','id');
		$students = StudentModel::orderBy('name','asc')->where('status', 1)->pluck('name','id');
		return view('backend.absence', compact('students','classes'));
	}

    public function show_absence($class_id, $start_date, $end_date) {
        $absence = DB::table('absent_students')
        ->join('students', 'students.id', '=', 'absent_students.students_id')
        ->join('class', 'class.id', '=', 'absent_students.class_id')
        ->whereRaw('absent_students.absent_date BETWEEN '."'".date("Y-m-d", strtotime($start_date))."'".' AND '."'".date("Y-m-d", strtotime($end_date))."'".'')
        ->where('absent_students.class_id', $class_id)
        ->select([ // [ ]<-- biar lebih rapi aja
            'students.name AS students_name',
            'class.name AS class_name',
            'absent_students.id',
            'absent_students.code',
            'absent_students.remark',
            'absent_students.absent_date',
            'absent_students.updated_date'
        ])
        ->get();
        //dd($absence);
        return Datatables::of($absence)
        ->editColumn('code', function ($model) {
            $code = $model->code;
            if($code == 1){
                $code = '<span class="uk-badge uk-badge-danger">SAKIT</span>';
            } elseif($code == 2) {
                $code ='<span class="uk-badge uk-badge-warning">IZIN</span>';
            } else {
                $code = '<span class="uk-badge uk-badge-danger">TANPA KETERANGAN</span>';
            }
            return $code;
        })
        ->editColumn('absent_date', function ($model) {
            $created = date('d F Y', strtotime($model->absent_date));
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
        ->rawColumns(['code','action'])
        ->addIndexColumn()->make(true);
    }

    function fetch_data_absence($absence_id) {
        $absence = DB::table('absent_students')
        ->join('students', 'students.id', '=', 'absent_students.students_id')
        ->join('class', 'class.id', '=', 'absent_students.class_id')
        ->select([ // [ ]<-- biar lebih rapi aja
            'absent_students.students_id',
            'absent_students.code',
            'absent_students.remark'
        ])
        ->where('absent_students.id', $absence_id)
        ->first();
        $output = array(
            'students_id'     =>  $absence->students_id,
            'code'     =>  $absence->code,
            'remark'     =>  $absence->remark,
        );
        echo json_encode($output);
    }

	public function save_absence() {
		DB::beginTransaction();
		$this->validate(request(), [
            'students_id' => 'required',
            'code' => 'required',
        ]);
        $remark = request('remark');
		if($remark == ''){
			$remark = '-';
		}
		$get_class = DB::table('students')->where('id', request('students_id'))->select('class_id')->first();
    	AbsenceModel::create([
    		'students_id' => request('students_id'),
    		'code' => request('code'),
    		'input_by' => \Auth::user()->id,
            'class_id' => $get_class->class_id,
    		'absent_date' => date('Y-m-d'),
    		'remark' => $remark
    	]);

    	DB::commit();
        return response()->json(['status' => 'success','msg' => 'Data Absen Berhasil Ditambahkan']);
	}

	public function delete_absence(){
		DB::beginTransaction();
		try {
            $absence = AbsenceModel::findOrFail(request('id'));
	        $absence->delete();

	        DB::commit();
            return response()->json(['status' => 'success','msg' => 'Data Absen Berhasil Dihapus']);
        } catch (\Exception $e) {
        	DB::rollBack();
            \Log::error($e);
            return response()->json(['status' => 'error','msg' => $e]);
        }
    }

    public function update_absence() {
    	DB::beginTransaction();
        $this->validate(request(), [
            'students_id' => 'required',
            'code' => 'required',
        ]);

        $remark = request('remark');
		if($remark == ''){
			$remark = '-';
		}
        $get_class = DB::table('students')->where('id', request('students_id'))->select('class_id')->first();
        $absence = AbsenceModel::findOrFail(request('id'));
        $absence->students_id = request('students_id');
        $absence->code = request('code');
        $absence->class_id = $get_class->class_id;
        $absence->absent_date = date('Y-m-d');
        $absence->remark = $remark;
        $absence->save();

    	DB::commit();
        return response()->json(['status' => 'success','msg' => 'Data Absen Berhasil Diperbaharui']);
    }

}
