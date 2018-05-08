<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use App\Model\StudentModel;
use App\Model\ClassModel;
use App\Model\ParentModel;
use DB;
use File;

class StudentController extends Controller {
    
	public function index_student() {
        $classes = ClassModel::where('status', 1)->pluck('name','id');
        $parents = ParentModel::where('status', 1)->pluck('name','id');
		return view('backend.student', compact('classes','parents'));
	}

    public function show_student() {
        $students = DB::table('students')
        ->join('parents', 'parents.id', '=', 'students.parents_id')
        ->join('class', 'class.id', '=', 'students.class_id')
        ->select([ // [ ]<-- biar lebih rapi aja
            'students.id',
            'students.gender',
            'students.birthday',
            'students.photo_file',
            'students.name AS students_name',
            'students.nis',
            'class.name AS class_name',
            'parents.name AS parent_name',
            'students.address',
            'students.status',
            'students.created_date',
            'students.updated_date'
        ])
        ->get();
        return Datatables::of($students)
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
        ->editColumn('photo_file', function ($model) {
            if(!empty($model->photo_file)) {
              $photo_file = asset('storage/'.$model->photo_file);
            } else {
              $photo_file = asset('storage/no-image-available.png');
            }

            return '<img src="'.$photo_file.'" alt="'.$model->students_name.'" class="img_medium"/>';
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
                <a href="#studentID" class="md-btn md-btn2" data-id="'.$model->id.'" data-uk-modal="{target:"#studentID"}"><i class="md-icon material-icons uk-text-danger">&#xE8C6;</i></a>
            ';
            return $sandi;
        })
        ->rawColumns(['status','action','photo_file','sandi','gender'])
        ->addIndexColumn()->make(true);
    }

    function fetch_data_student($student_id) {
        $student = StudentModel::findOrFail($student_id);
        if($student->status == 1)$status='true'; else $status='';
        $output = array(
            'class_id'    =>  $student->class_id,
            'parents_id'     =>  $student->parents_id,
            'nis'     =>  $student->nis,
            'birthday'     =>  date('d.m.Y', strtotime($student->birthday)),
            'name'     =>  $student->name,
            'gender'     =>  $student->gender,
            'address'     =>  $student->address,
            'photo_file'     =>  $student->photo_file,
            'status'     =>  $status
        );
        echo json_encode($output);
    }

	public function save_student() {
		DB::beginTransaction();
		$this->validate(request(), [
            'class_id' => 'required',
            'parents_id' => 'required',
            'name' => 'required|min:3|max:80',
            'nis' => 'required|unique:students,nis',
            'password' => 'required|min:8',
            'address' => 'required',
            'gender' => 'required',
            'birthday' => 'required|date',
            'photo_file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
	
		if(request('status') == 'on')$status=1; else $status=0;
		$photo_file = request('photo_file');
		$photo_file = $photo_file->storeAs('photo_profile_student', 'profile-student-'.strtolower(request('nis')).'.'.$photo_file->getClientOriginalExtension());
		request()->photo_file->move(public_path('storage/photo_profile_student'), $photo_file);

    	StudentModel::create([
    		'class_id' => request('class_id'),
            'parents_id' => request('parents_id'),
            'name' => request('name'),
            'nis' => request('nis'),
            'password' => bcrypt(request('password')),
            'address' => request('address'),
            'gender' => request('gender'),
            'birthday' => date("Y-m-d",strtotime(request('birthday'))),
            'status' => $status,
            'photo_file' => $photo_file,
    	]);
        \Artisan::call('cache:clear');
    	DB::commit();
        return response()->json(['status' => 'success','msg' => 'Data Murid Berhasil Ditambahkan']);
	}

	public function delete_student(){
		DB::beginTransaction();
		try {
            $student = StudentModel::findOrFail(request('id'));
            $file_to_delete = public_path('storage/').$student->photo_file;
	        File::delete($file_to_delete); // For delete from folder  
	        $student->delete();

	        DB::commit();
            return response()->json(['status' => 'success','msg' => 'Data Murid Berhasil Dihapus']);
        } catch (\Exception $e) {
        	DB::rollBack();
            \Log::error($e);
            return response()->json(['status' => 'error','msg' => $e]);
        }
    }

    public function delete_profile_picture_student($id){
		try {
            $student = StudentModel::findOrFail($id);
            //hapus file nya dulu
            $files_to_delete = public_path('storage/').$student->photo_file;
	        File::delete($files_to_delete); // For delete from folder
	        //lalu update table
	        DB::table('students')->where('id', $student->id)->update(['photo_file' => '']);

            return response()->json(['status' => 'success','msg' => 'Data Gambar Murid Berhasil Dihapus']);
        } catch (\Exception $e) {
        	DB::rollBack();
            \Log::error($e);
            return response()->json(['status' => 'error','msg' => $e]);
        }
    }

    public function update_student() {
    	DB::beginTransaction();
        $this->validate(request(), [
            'class_id' => 'required',
            'parents_id' => 'required',
            'name' => 'required|min:3|max:80',
            'nis' => 'required',
            'address' => 'required|min:10',
            'gender' => 'required',
            'birthday' => 'required|date',
            'photo_file' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if(request('status') == 'on')$status=1; else $status=0;
    	if(request('photo_file') == NULL){
            
            $student = StudentModel::findOrFail(request('id'));
            $student->class_id = request('class_id');
            $student->parents_id = request('parents_id');
            $student->name = request('name');
            $student->nis = request('nis');
            $student->address = request('address');
            $student->gender = request('gender');
            $student->birthday = date("Y-m-d",strtotime(request('birthday')));
            $student->status = $status;
            $student->save();
            
        } else {
            
        	if(request('status') == 'on')$status=1; else $status=0;
            $photo_file = request('photo_file');
			$photo_file = $photo_file->storeAs('photo_profile_student', 'profile-student-'.strtolower(request('nis')).'.'.$photo_file->getClientOriginalExtension());
			request()->photo_file->move(public_path('storage/photo_profile_student'), $photo_file);

            $student = StudentModel::findOrFail(request('id'));
            $student->class_id = request('class_id');
            $student->parents_id = request('parents_id');
            $student->name = request('name');
            $student->nis = request('nis');
            $student->address = request('address');
            $student->gender = request('gender');
            $student->birthday = date("Y-m-d",strtotime(request('birthday')));
            $student->status = $status;
            $student->photo_file = $photo_file;
            $student->save();

        }
        \Artisan::call('cache:clear');
        DB::commit();
        return response()->json(['status' => 'success','msg' => 'Data Murid Berhasil Diperbaharui']);
    }

    public function change_password_student() {
        DB::beginTransaction();
        $this->validate(request(), [
            'password' => 'required|min:8',
        ]);
        DB::table('students')->where('id', request('id'))->update(['password' => bcrypt(request('password'))]);
        DB::commit();

        // $admin_data = UserAdminModel::select('email','name')->where('id', request('id'))->first();
        // $send_email_reset = $this->send_email_reset_password($admin_data->email, $admin_data->name);

        //if($send_email_reset == 'success'){
        return response()->json(['status' => 'success','msg' => 'Kata sandi Murid Berhasil Dirubah']);
        //}
    }
}
