<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use App\Model\AssignmentModel;
use App\Model\AssignClassTeacherModel;
use App\Model\SubjectModel;

use DB;
use File;

class AssignmentController extends Controller {

	public function index_assignment() {
		$classes = DB::table('class_join_teacher')
        ->join('class', 'class.id', '=', 'class_join_teacher.class_id')
        ->select([ // [ ]<-- biar lebih rapi aja
            'class.id as class_id',
            'class.name as class_name',
        ])
        ->where('class_join_teacher.teachers_id', \Auth::user('teacher')->id)
        ->pluck('class_name','class_id');

        $subjects = DB::table('subject_join_teacher')
        ->join('subjects', 'subjects.id', '=', 'subject_join_teacher.subjects_id')
        ->select([ // [ ]<-- biar lebih rapi aja
            'subjects.id as subjects_id',
            'subjects.name as subjects_name',
        ])
        ->where('subject_join_teacher.teachers_id', \Auth::user('teacher')->id)
        ->pluck('subjects_name','subjects_id');

		return view('backend.assignment',compact('classes','subjects'));
	}

	 public function show_assignment() {
        $student_assignments = DB::table('student_assignments')
        ->join('subjects', 'subjects.id', '=', 'student_assignments.subjects_id')
        ->join('class', 'class.id', '=', 'student_assignments.class_id')
        ->where('teachers_id', \Auth::user('teacher')->id)
        ->select([ // [ ]<-- biar lebih rapi aja
            'student_assignments.id',
            'student_assignments.name',
            'student_assignments.assignment_file',
            'student_assignments.remark',
            'student_assignments.status',
            'student_assignments.start_assignment',
            'student_assignments.end_assignment',
            'student_assignments.created_date',
            'student_assignments.updated_date',
            'class.name AS class_name',
            'subjects.name AS subjects_name',
        ])
        ->get();
        return Datatables::of($student_assignments)
        ->editColumn('status', function ($model) {
            $status = $model->status;
            if($status == 1){
                $status = '<a href="#" data-uk-tooltip title="Aktif"><i class="material-icons md-36 uk-text-success">&#xE86C;</i></a>';
            } else {
                $status='<a href="#" data-uk-tooltip title="Tak Aktif"><i class="material-icons  md-36 uk-text-danger">&#xE5C9;</i></a>';
            }
            return $status;
        })
        ->editColumn('start_assignment', function ($model) {
            $start_assignment = str_replace('-', '.', date('d.m.Y',strtotime($model->start_assignment)));
            return $start_assignment;
        })
        ->editColumn('end_assignment', function ($model) {
            $end_assignment = str_replace('-', '.', date('d.m.Y',strtotime($model->end_assignment)));
            return $end_assignment;
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
        ->editColumn('assignment_file', function ($model) {
            if(!empty($model->assignment_file)) {
              $assignment_file = asset($model->assignment_file);
            } else {
              $assignment_file = '-';
            }

            return '<a href="'.$assignment_file.'" target="_blank">
                    <i class="material-icons md-24">content_copy</i>
                    Filename: "'.basename($assignment_file).'"
                    </a>';
        })
        ->addColumn('action', function ($model) {
            $action = '
                <a href="#" class="edit_data" data-id="'.$model->id.'"><i class="md-icon material-icons">&#xE254;</i></a>
                <a onclick="delete_data('.$model->id.')" href="#"><i class="md-icon material-icons">&#xE16C;</i>
                </a>
            ';
            return $action;
        })
        ->rawColumns(['status','action','assignment_file'])
        ->addIndexColumn()->make(true);
    }

    function fetch_data_assignment($assignment_id) {
        $assignment_file = AssignmentModel::findOrFail($assignment_id);
        if($assignment_file->status == 1)$status='true'; else $status='';
        $output = array(
            'name'     =>  $assignment_file->name,
            'class_id'     =>  $assignment_file->class_id,
            'subjects_id'     =>  $assignment_file->subjects_id,
            'start_assignment'     =>  str_replace('-', '.', date('d.m.Y',strtotime($assignment_file->start_assignment))),
            'end_assignment'     =>  str_replace('-', '.', date('d.m.Y',strtotime($assignment_file->end_assignment))),
            'assignment_file'     =>  $assignment_file->assignment_file,
            'remark'     =>  $assignment_file->remark,
            'status'     =>  $status
        );
        echo json_encode($output);
    }

	public function save_assignment() {
		DB::beginTransaction();
		$this->validate(request(), [
            'name' => 'required|max:80|min:3',
            'class_id' => 'required',
            'subjects_id' => 'required',
            'assignment_file' => 'required|mimes:jpeg,png,jpg,pdf,doc,pptx,xlsx|max:2048',
            'remark' => 'required|min:5',
            'start_assignment' => 'required|date',
            'end_assignment' => 'required|date',
        ]);
		//start process make folder if not exist
        $path = public_path('storage/file_tugas_guru/'.\Auth::user('teacher')->id);
        if (!file_exists($path)){
            mkdir($path, 0777, true);
        }
        //end process make folder if not exist
		$assignment_file = request('assignment_file');
		$file_directory = 'storage/file_tugas_guru/'.\Auth::user('teacher')->id;
        if($assignment_file){
    		$assignment_file = $assignment_file->storeAs($file_directory, request('class_id').'_'.$assignment_file->getClientOriginalName());
    		request()->assignment_file->move($path, $assignment_file);
        }

        if(request('status') == 'on')$status=1; else $status=0;
    	AssignmentModel::create([
    		'name' => request('name'),
    		'class_id' => request('class_id'),
    		'start_assignment' => date("Y-m-d",strtotime(request('start_assignment'))),
    		'end_assignment' => date("Y-m-d",strtotime(request('end_assignment'))),
    		'subjects_id' => request('subjects_id'),
    		'teachers_id' => \Auth::user('teacher')->id,
    		'input_by' => \Auth::user('teacher')->id,
    		'remark' => request('remark'),
            'status' => $status,
            'assignment_file' => $assignment_file,
    	]);
        \Artisan::call('cache:clear');
    	DB::commit();
        return response()->json(['status' => 'success','msg' => 'File Tugas Berhasil Ditambahkan']);
	}

	public function delete_assignment(){

		DB::beginTransaction();
		try {
            $assignment = AssignmentModel::findOrFail(request('id'));
            $file_to_delete = public_path($assignment->assignment_file);
	        File::delete($file_to_delete); // For delete from folder  
	        $assignment->delete();

	        DB::commit();
            return response()->json(['status' => 'success','msg' => 'Data Tugas Berhasil Dihapus']);
        } catch (\Exception $e) {
        	DB::rollBack();
            \Log::error($e);
            return response()->json(['status' => 'error','msg' => $e]);
        }
    }

    public function update_assignment() {
    	DB::beginTransaction();
        $this->validate(request(), [
            'name' => 'required|max:80|min:3',
            'class_id' => 'required',
            'subjects_id' => 'required',
            'assignment_file' => 'required|image|mimes:jpeg,png,jpg,pdf,doc,pptx,xlsx|max:2048',
            'remark' => 'required|min:5',
            'start_assignment' => 'required|date',
            'end_assignment' => 'required|date',
        ]);

        if(request('status') == 'on')$status=1; else $status=0;
    	if(request('assignment_file') == NULL){

            $assignment = AssignmentModel::findOrFail(request('id'));
            $assignment->name = request('name');
            $assignment->class_id = request('class_id');
            $assignment->subjects_id = request('subjects_id');
            $assignment->teachers_id = \Auth::user('teacher')->id;
            $assignment->input_by = \Auth::user('teacher')->id;
            $assignment->remark = request('remark');
            $assignment->start_assignment = date("Y-m-d",strtotime(request('start_assignment')));
            $assignment->end_assignment = date("Y-m-d",strtotime(request('end_assignment')));
            $assignment->status = $status;
            $assignment->save();

        } else {
            $path = public_path('storage/file_tugas_guru/'.\Auth::user('teacher')->id);
            $assignment_file = request('assignment_file');
            $file_directory = 'storage/file_tugas_guru/'.\Auth::user('teacher')->id;
			$assignment_file = $assignment_file->storeAs($file_directory, request('class_id').'_'.$assignment_file->getClientOriginalName());
    		request()->assignment_file->move($path, $assignment_file);

			if(request('status') == 'on')$status=1; else $status=0;
            $assignment = AssignmentModel::findOrFail(request('id'));
            $assignment->name = request('name');
            $assignment->class_id = request('class_id');
            $assignment->subjects_id = request('subjects_id');
            $assignment->teachers_id = \Auth::user('teacher')->id;
            $assignment->input_by = \Auth::user('teacher')->id;
            $assignment->remark = request('remark');
            $assignment->start_assignment = date("Y-m-d",strtotime(request('start_assignment')));
            $assignment->end_assignment = date("Y-m-d",strtotime(request('end_assignment')));
            $assignment->assignment_file = $assignment_file;
            $assignment->status = $status;
            $assignment->save();
        }
        \Artisan::call('cache:clear');
    	DB::commit();
        return response()->json(['status' => 'success','msg' => 'Data Tugas Berhasil Diperbaharui']);
    }

	public function delete_file_assignment($id){
		try {
            $assignment = AssignmentModel::findOrFail($id);
            //hapus file nya dulu
            $file_to_delete = public_path($assignment->assignment_file);
	        File::delete($file_to_delete); // For delete from folder
	        //lalu update table
	        DB::table('student_assignments')->where('id', $assignment->id)->update(['assignment_file' => '']);
            return response()->json(['status' => 'success','msg' => 'File Tugas Berhasil Dihapus']);

        } catch (\Exception $e) {
        	DB::rollBack();
            \Log::error($e);
            return response()->json(['status' => 'error','msg' => $e]);
        }
    }
}
