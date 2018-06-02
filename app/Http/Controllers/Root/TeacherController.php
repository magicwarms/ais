<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use App\Model\TeacherModel;
use App\Model\AssignmentModel;
use DB;
use File;

class TeacherController extends Controller {
    
	public function index_teacher() {
		return view('backend.teacher');
	}

    public function show_teacher() {
        $teachers = TeacherModel::all();
        return Datatables::of($teachers)
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
        ->editColumn('photo_file', function ($model) {
            if(!empty($model->photo_file)) {
              $photo_file = asset('storage/'.$model->photo_file);
            } else {
              $photo_file = asset('storage/no-image-available.png');
            }

            return '<img src="'.$photo_file.'" alt="'.$model->name.'" class="img_medium"/>';
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
                <a href="#teacherID" class="md-btn md-btn2" data-id="'.$model->id.'" data-uk-modal="{target:"#teacherID"}"><i class="md-icon material-icons uk-text-danger">&#xE8C6;</i></a>
            ';
            return $sandi;
        })
        ->rawColumns(['status','action','photo_file','sandi'])
        ->addIndexColumn()->make(true);
    }

    function fetch_data_teacher($teacher_id) {
        $teacher = TeacherModel::findOrFail($teacher_id);
        if($teacher->status == 1)$status='true'; else $status='';
        $output = array(
            'name'     =>  $teacher->name,
            'address'     =>  $teacher->address,
            'birthday'     =>  date('d.m.Y', strtotime($teacher->birthday)),
            'code'     =>  $teacher->code,
            'gender'     =>  $teacher->gender,
            'education'     =>  $teacher->education,
            'photo_file'     =>  $teacher->photo_file,
            'phone'     =>  $teacher->phone,
            'status'     =>  $status
        );
        echo json_encode($output);
    }

	public function save_teacher() {
		DB::beginTransaction();
		$this->validate(request(), [
            'name' => 'required|max:80|min:3',
            'address' => 'required|min:10',
            'birthday' => 'required|date',
            'code' => 'required|min:3|unique:teachers,code',
            'password' => 'required|min:8',
            'gender' => 'required',
            'education' => 'required|min:10|max:30',
            'photo_file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'phone' => 'required|unique:teachers,phone|regex:/08[0-9]{9,}/',
        ]);
	
		$photo_file = request('photo_file');
        if($photo_file){
    		$photo_file = $photo_file->storeAs('photo_profile_teacher', 'profile-teacher-'.strtolower(request('code')).'.'.$photo_file->getClientOriginalExtension());
    		request()->photo_file->move(public_path('storage/photo_profile_teacher'), $photo_file);
        }

        if(request('status') == 'on')$status=1; else $status=0;
    	TeacherModel::create([
    		'name' => request('name'),
    		'address' => request('address'),
    		'birthday' => date("Y-m-d",strtotime(request('birthday'))),
    		'code' => request('code'),
    		'password' => bcrypt(request('password')),
    		'gender' => request('gender'),
            'education' => request('education'),
    		'phone' => request('phone'),
            'status' => $status,
            'photo_file' => $photo_file,
    	]);
        \Artisan::call('cache:clear');
    	DB::commit();
        return response()->json(['status' => 'success','msg' => 'Data Guru Berhasil Ditambahkan']);
	}

	public function delete_teacher(){
		DB::beginTransaction();
		try {
            $teacher = TeacherModel::findOrFail(request('id'));
            $file_to_delete = public_path('storage/').$teacher->photo_file;
	        File::delete($file_to_delete); // For delete from folder  
	        $teacher->delete();

	        DB::commit();
            return response()->json(['status' => 'success','msg' => 'Data Guru Berhasil Dihapus']);
        } catch (\Exception $e) {
        	DB::rollBack();
            \Log::error($e);
            return response()->json(['status' => 'error','msg' => $e]);
        }
    }

    public function delete_profile_picture_teacher($id){
		try {
            $teacher = TeacherModel::findOrFail($id);
            //hapus file nya dulu
            $file_to_delete = public_path('storage/').$teacher->photo_file;
	        File::delete($file_to_delete); // For delete from folder
	        //lalu update table
	        DB::table('teachers')->where('id', $teacher->id)->update(['photo_file' => '']);
            return response()->json(['status' => 'success','msg' => 'Data Gambar Guru Berhasil Dihapus']);

        } catch (\Exception $e) {
        	DB::rollBack();
            \Log::error($e);
            return response()->json(['status' => 'error','msg' => $e]);
        }
    }

    public function update_teacher() {
    	DB::beginTransaction();
        $this->validate(request(), [
            'name' => 'required|max:80|min:3',
            'address' => 'required|min:10',
            'birthday' => 'required|date',
            'code' => 'required|min:3',
            'gender' => 'required',
            'education' => 'required|min:10|max:30',
            'photo_file' => 'image|mimes:jpeg,png,jpg|max:2048',
            'phone' => 'required|regex:/08[0-9]{9,}/'
        ]);

        if(request('status') == 'on')$status=1; else $status=0;
    	if(request('photo_file') == NULL){

            $teacher = TeacherModel::findOrFail(request('id'));
            $teacher->name = request('name');
            $teacher->address = request('address');
            $teacher->birthday = date("Y-m-d",strtotime(request('birthday')));
            $teacher->code = request('code');
            $teacher->gender = request('gender');
            $teacher->education = request('education');
            $teacher->phone = request('phone');
            $teacher->status = $status;
            $teacher->save();

        } else {
            
            $photo_file = request('photo_file');
			$photo_file = $photo_file->storeAs('photo_profile_teacher', 'profile-teacher-'.strtolower(request('code')).'.'.$photo_file->getClientOriginalExtension());
			request()->photo_file->move(public_path('storage/photo_profile_teacher'), $photo_file);

			if(request('status') == 'on')$status=1; else $status=0;
            $teacher = TeacherModel::findOrFail(request('id'));
            $teacher->name = request('name');
            $teacher->address = request('address');
            $teacher->birthday = date("Y-m-d",strtotime(request('birthday')));
            $teacher->code = request('code');
            $teacher->gender = request('gender');
            $teacher->education = request('education');
            $teacher->phone = request('phone');
            $teacher->photo_file = $photo_file;
            $teacher->status = $status;
            $teacher->save();
        }
        \Artisan::call('cache:clear');
    	DB::commit();
        return response()->json(['status' => 'success','msg' => 'Data Guru Berhasil Diperbaharui']);
    }

    public function change_password_teacher() {
        DB::beginTransaction();
        $this->validate(request(), [
            'password' => 'required|min:8',
        ]);
        if(request('password') != request('repassword')){
            return response()->json(['status' => 'warning','msg' => 'Maaf, kata sandi anda tidak sama dengan konfirmasi kata sandi, mohon ulangi.']);
        }

        DB::table('teachers')->where('id', request('id'))->update(['password' => bcrypt(request('password'))]);
        DB::commit();
        return response()->json(['status' => 'success','msg' => 'Kata sandi Guru Berhasil Dirubah']);
    }

    public function teacher_profile() {
        $teacher = TeacherModel::where('id', \Auth::user('teacher')->id)->first();
        $assignment_students = $this->assignment_students();
        $count_assignment = count($assignment_students);
        $schedule_teacher = $this->schedule_subject_teacher();
        $count_subject = $this->count_subject();

        return view('backend.teacher_profile', compact('teacher','assignment_students','count_assignment','schedule_teacher','count_subject'));
    }

    public function assignment_students() {
        $assignment_students = DB::table('student_assignments')
        ->join('class', 'class.id', '=', 'student_assignments.class_id')
        ->where('student_assignments.teachers_id', \Auth::user('teacher')->id)
        ->select([ // [ ]<-- biar lebih rapi aja
            'student_assignments.name',
            'student_assignments.start_assignment',
            'student_assignments.end_assignment',
            'student_assignments.assignment_file',
            'class.name as class_name',
        ])
        ->get();
        return $assignment_students;
    }

    public function schedule_subject_teacher() {
        $schedule_teacher = DB::table('subject_join_teacher')
        ->join('subjects', 'subjects.id', '=', 'subject_join_teacher.subjects_id')
        ->where('subject_join_teacher.teachers_id', \Auth::user('teacher')->id)
        ->select([
            'subjects.name as subject_name',
            'subject_join_teacher.subject_day_time',
            'subject_join_teacher.total_hours'
        ])
        ->get();

        return $schedule_teacher;
    }

    public function count_subject() {
        $count_subject = DB::table('subject_join_teacher')
        ->join('subjects', 'subjects.id', '=', 'subject_join_teacher.subjects_id')
        ->select([
            'subject_join_teacher.teachers_id', 
            DB::raw('sum(total_hours) as total_hours'),
            'subjects.name as subject_name'
        ])
        ->groupBy('subject_join_teacher.subjects_id')
        ->where('subject_join_teacher.teachers_id', \Auth::user('teacher')->id)
        ->get();

        return $count_subject;
    }
}
