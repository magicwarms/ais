<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\FinancialModel;
use App\Model\ConfirmationModel;
use App\Model\AbsenceModel;
use App\Model\AssignmentModel;
use App\Model\FinanceDetailModel;

use DB;

class StudentFrontController extends Controller {
    
	public function index() {
		$student = $this->get_data_student();
        $finances = FinancialModel::where('students_id', $student->id)->get();

        foreach ($finances as $key => $detail) {
            $finance_detail[$key] = FinanceDetailModel::where('financial_id', $detail->id)->get();
        }
        $count_finance = count($finances);
        $absences = AbsenceModel::where('students_id', $student->id)->select('absent_date','code','remark')->get();
        $assignment_students = $this->get_assignment_student($student->class_id);
        $count_assignment_students = count($assignment_students);
        $events = $this->get_data_event();
        $count_event = count($events);

    	return view('frontend.student', compact('student','finances','finance_detail','count_finance','confirm_payments','count_confirm_payment','absences','assignment_students','count_assignment_students','events','count_event'));
    }

    public function get_data_student() {
        
        $student = DB::table('students')
        ->join('class', 'class.id', '=', 'students.class_id')
        ->where('students.id', \Auth::user('student')->id)
        ->select(['class.name AS class_name','students.class_id', 'students.parents_id', 'students.id'])
        ->first();

        return $student;;
    }

    public function get_data_event() {
        $event = DB::table('event_news')
        ->whereRaw('now() BETWEEN start_event AND end_event')
        ->get();

        return $event;
    }

    public function change_password_fro_student() {
        DB::beginTransaction();
        $this->validate(request(), [
            'password' => 'required|min:8',
        ]);
        DB::table('students')->where('id', \Auth::guard('student')->user()->id)->update(['password' => bcrypt(request('password'))]);
        DB::commit();
        // $admin_data = UserAdminModel::select('email','name')->where('id', request('id'))->first();
        // $send_email_reset = $this->send_email_reset_password($admin_data->email, $admin_data->name);

        //if($send_email_reset == 'success'){
        return redirect()->route('front')->with('success','Kata sandi kamu berhasil dirubah');
        //}
    }

    public function get_assignment_student($class_id) {
        $assignment_students = DB::table('student_assignments')
        ->join('subjects', 'subjects.id', '=', 'student_assignments.subjects_id')
        ->where('student_assignments.class_id', $class_id)
        ->whereRaw('now() BETWEEN student_assignments.start_assignment AND student_assignments.end_assignment')
        ->select([
            'student_assignments.id AS assignment_id',
            'student_assignments.name',
            'student_assignments.assignment_file',
            'student_assignments.remark',
            'student_assignments.start_assignment',
            'student_assignments.end_assignment',
            'subjects.name AS subject_name'
        ])
        ->get();

        return $assignment_students;
    }

    public function fetch_data_task($task_id) {
        $task = DB::table('student_assignments')
        ->join('subjects', 'subjects.id', '=', 'student_assignments.subjects_id')
        ->where('student_assignments.id', $task_id)
        ->select([
            'student_assignments.id AS assignment_id',
            'student_assignments.name',
            'student_assignments.assignment_file',
            'student_assignments.remark',
            'student_assignments.start_assignment',
            'student_assignments.end_assignment',
            'subjects.name AS subject_name'
        ])
        ->first();
        $output = array(
            'name'     =>  $task->name,
            'start_assignment'     =>  date('d F Y', strtotime($task->start_assignment)),
            'end_assignment'     =>  date('d F Y', strtotime($task->end_assignment)),
            'remark'     =>  $task->remark,
            'assignment_file'     =>  $task->assignment_file,
            'subject_name'     =>  $task->subject_name,
        );
        echo json_encode($output);
    }

}
