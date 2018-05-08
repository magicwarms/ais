<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use App\Model\ClassModel;
use App\Model\AssignClassTeacherModel;
use App\Model\TeacherModel;

use DB;

class AssignClassTeacherController extends Controller {
    
	public function index_assign_class_teacher() {
        $classes = ClassModel::where('status', 1)->pluck('name','id');
        $teachers = TeacherModel::where('status', 1)->pluck('name','id');
        return view('backend.assign_class_teacher', compact('classes','teachers'));
    }

    public function show_assign_class_teacher() {
        $assign_class_teacher = DB::table('class_join_teacher')
        ->join('class', 'class.id', '=', 'class_join_teacher.class_id')
        ->join('teachers', 'teachers.id', '=', 'class_join_teacher.teachers_id')
        ->select([ // [ ]<-- biar lebih rapi aja
            'class.name as class_name',
            'teachers.name as teacher_name',
            'class_join_teacher.id',
            'class_join_teacher.created_date',
            'class_join_teacher.updated_date'
        ])
        ->get();
        return Datatables::of($assign_class_teacher)
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

    public function save_assign_class_teacher() {
        DB::beginTransaction();
        $this->validate(request(), [
            'class_id' => 'required',
            'teachers_id' => 'required',
        ]);
        $exist_assign = DB::table('class_join_teacher')->where('class_id',request('class_id'))->where('teachers_id',request('teachers_id'))->first();
        if(!empty($exist_assign)){
            return response()->json(['status' => 'warning','msg' => 'Maaf, sepertinya guru yang dipilih, sudah ada dikelas tersebut.']);
        }
        AssignClassTeacherModel::create([
            'class_id' => request('class_id'),
            'teachers_id' => request('teachers_id'),
        ]);

        DB::commit();
        return response()->json(['status' => 'success','msg' => 'Data Assign Kelas Berhasil Ditambahkan']);
    }

    function fetch_data_assign_class_teacher($assign_id) {
        $assign = AssignClassTeacherModel::findOrFail($assign_id);
        $output = array(
            'class_id'    =>  $assign->class_id,
            'teachers_id'     =>  $assign->teachers_id
        );
        echo json_encode($output);
    }

    public function update_assign_class_teacher() {
        DB::beginTransaction();
        $this->validate(request(), [
            'class_id' => 'required',
            'teachers_id' => 'required',
        ]);
        $exist_assign = DB::table('class_join_teacher')->where('class_id',request('class_id'))->where('teachers_id',request('teachers_id'))->first();
        if(!empty($exist_assign)){
            return response()->json(['status' => 'warning','msg' => 'Maaf, sepertinya guru yang dipilih, sudah ada dikelas tersebut.']);
        }
        $assign = AssignClassTeacherModel::findOrFail(request('id'));
        $assign->class_id = request('class_id');
        $assign->teachers_id = request('teachers_id');
        $assign->save();

        DB::commit();
        return response()->json(['status' => 'success','msg' => 'Data Assign Kelas Berhasil Diperbaharui']);
    }

    public function delete_assign_class_teacher(){
        DB::beginTransaction();
        try {
            $assign = AssignClassTeacherModel::findOrFail(request('id')); 
            $assign->delete();

            DB::commit();
            return response()->json(['status' => 'success','msg' => 'Data Assign Kelas Berhasil Dihapus']);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e);
            return response()->json(['status' => 'error','msg' => $e]);
        }
    }
}
