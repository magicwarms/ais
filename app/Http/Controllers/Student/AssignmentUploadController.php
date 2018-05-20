<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\AssignmentUploadModel;

use DB;

class AssignmentUploadController extends Controller {
    
	public function process_upload_task_student() {
		DB::beginTransaction();
		$this->validate(request(), [
	        'students_assignment_id' => 'required',
	        'students_id' => 'required',
	        'assignment_file' => 'mimes:doc,pdf,docx,zip,jpeg,png,jpg|required|max:2048',
	    ]);

		$assignment_file = request('assignment_file');
	    if($assignment_file){
			$assignment_file = $assignment_file->storeAs('file_task_student', request('students_assignment_id').'_'.request('students_id').'_'.$assignment_file->getClientOriginalName());
			request()->assignment_file->move(public_path('storage/file_task_student'), $assignment_file);
	    }

		AssignmentUploadModel::create([
			'students_assignment_id' => request('students_assignment_id'),
			'students_id' => request('students_id'),
			'remark' => request('remark'),
	        'assignment_file' => $assignment_file,
		]);

		DB::commit();
	    return response()->json(['status' => 'success','msg' => 'Well done! Tugasmu sudah berhasil dikirim! Terima kasih']);
    }

}
