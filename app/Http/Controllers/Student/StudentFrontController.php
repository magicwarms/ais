<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\FinancialModel;
use App\Model\ConfirmationModel;
use App\Model\AbsenceModel;
use App\Model\AssignmentModel;

use DB;

class StudentFrontController extends Controller {
    
	public function index() {
		$student = $this->get_data_student();
        $confirm_payments = $this->get_confirm_payments($student->parents_id);
        $finances = FinancialModel::where('class_id', $student->class_id)->get();
        $absences = AbsenceModel::where('students_id', $student->id)->select('absent_date','code')->get();
        $assignment_students = AssignmentModel::where('class_id', $student->class_id)->get();
        $count_assignment_students = count($assignment_students);

    	return view('frontend.student', compact('student','finances','confirm_payments','absences','assignment_students','count_assignment_students'));
    }

    public function get_data_student() {
        $student = DB::table('students')
        ->join('class', 'class.id', '=', 'students.class_id')
        ->where('students.id', \Auth::user('student')->id)
        ->select(['class.name AS class_name','students.class_id', 'students.parents_id', 'students.id'])
        ->first();

        return $student;;
    }

    public function get_confirm_payments($parents_id) {
        $confirm_payments = DB::table('confirm_payment')
        ->join('financial', 'financial.id', '=', 'confirm_payment.financial_id')
        ->join('parents', 'parents.id', '=', 'confirm_payment.parents_id')
        ->where('confirm_payment.parents_id', $parents_id)
        ->select([
            'parents.name AS parents_name',
            'confirm_payment.total_pay',
            'confirm_payment.created_date',
            'confirm_payment.remark',
            'confirm_payment.status',
        ])
        ->get();

        return $confirm_payments;
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

}
