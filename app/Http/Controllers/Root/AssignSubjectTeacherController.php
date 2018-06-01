<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use App\Model\SubjectModel;
use App\Model\AssignSubjectTeacherModel;
use App\Model\TeacherModel;

use DB;

class AssignSubjectTeacherController extends Controller {
    
	public function index_assign_subject_teacher() {
        $subjects = SubjectModel::where('status', 1)->pluck('name','id');
        $teachers = TeacherModel::where('status', 1)->pluck('name','id');
        return view('backend.assign_subject_teacher', compact('subjects','teachers'));
    }

    public function show_assign_subject_teacher() {
        $assign_subject_teacher = DB::table('subject_join_teacher')
        ->join('subjects', 'subjects.id', '=', 'subject_join_teacher.subjects_id')
        ->join('teachers', 'teachers.id', '=', 'subject_join_teacher.teachers_id')
        ->select([ // [ ]<-- biar lebih rapi aja
            'subjects.name as subject_name',
            'teachers.name as teacher_name',
            'subject_join_teacher.id',
            'subject_join_teacher.subject_day_time',
            'subject_join_teacher.created_date',
            'subject_join_teacher.updated_date'
        ])
        ->get();
        return Datatables::of($assign_subject_teacher)
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

    public function save_assign_subject_teacher() {
        DB::beginTransaction();
        $this->validate(request(), [
            'subjects_id' => 'required',
            'teachers_id' => 'required',
            'subject_day_time' => 'required',
        ]);
        $exist_assign = DB::table('subject_join_teacher')->where('subjects_id',request('subjects_id'))->where('teachers_id',request('teachers_id'))->first();
        if(!empty($exist_assign)){
            return response()->json(['status' => 'warning','msg' => 'Maaf, sepertinya guru yang dipilih, sudah ada mata pelajaran tersebut.']);
        }
        AssignSubjectTeacherModel::create([
            'subjects_id' => request('subjects_id'),
            'teachers_id' => request('teachers_id'),
            'subject_day_time' => request('subject_day_time')
        ]);

        DB::commit();
        return response()->json(['status' => 'success','msg' => 'Data Assign Berhasil Ditambahkan']);
    }

    function fetch_data_assign_subject_teacher($assign_id) {
        $assign = AssignSubjectTeacherModel::findOrFail($assign_id);
        $output = array(
            'subjects_id'    =>  $assign->subjects_id,
            'teachers_id'     =>  $assign->teachers_id,
            'subject_day_time'     =>  $assign->subject_day_time
        );
        echo json_encode($output);
    }

    public function update_assign_subject_teacher() {
        DB::beginTransaction();
        $this->validate(request(), [
            'subjects_id' => 'required',
            'teachers_id' => 'required',
            'subject_day_time' => 'required',
        ]);
        $exist_assign = DB::table('subject_join_teacher')->where('subjects_id',request('subjects_id'))->where('teachers_id',request('teachers_id'))->first();
        if(!empty($exist_assign)){
            if($exist_assign->subject_day_time == request('subject_day_time')){
                return response()->json(['status' => 'warning','msg' => 'Maaf, sepertinya jadwal guru yang anda inputkan sudah ada, mohon ulangi kembali.']);
            }
        }
        
        $assign = AssignSubjectTeacherModel::findOrFail(request('id'));
        $assign->subjects_id = request('subjects_id');
        $assign->teachers_id = request('teachers_id');
        $assign->subject_day_time = request('subject_day_time');
        $assign->save();

        DB::commit();
        return response()->json(['status' => 'success','msg' => 'Data Assign Berhasil Diperbaharui']);
    }

    public function delete_assign_subject_teacher(){
        DB::beginTransaction();
        try {
            $assign = AssignSubjectTeacherModel::findOrFail(request('id')); 
            $assign->delete();

            DB::commit();
            return response()->json(['status' => 'success','msg' => 'Data Assign Berhasil Dihapus']);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e);
            return response()->json(['status' => 'error','msg' => $e]);
        }
    }   
}
