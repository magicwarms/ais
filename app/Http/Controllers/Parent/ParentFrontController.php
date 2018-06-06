<?php

namespace App\Http\Controllers\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\FinancialModel;
use App\Model\ConfirmationModel;
use App\Model\AbsenceModel;
use App\Model\AssignmentModel;
use App\Model\StudentModel;
use App\Model\FinanceDetailModel;

use DB;

class ParentFrontController extends Controller {
    
	public function index_parent() {
		$student = $this->get_data_student();
		$finances = FinancialModel::where('students_id', $student->id)->get();
        foreach ($finances as $key => $detail) {
            $finance_detail[$key] = FinanceDetailModel::where('financial_id', $detail->id)->get();
        }
        $count_finance = count($finances);
		$events = $this->get_data_event();
        $count_event = count($events);
        $confirm_payments = $this->get_confirm_payments(\Auth::user('parent')->id);
        $count_confirm_payment = count($confirm_payments);
        $assignment_students = AssignmentModel::where('class_id', $student->class_id)->get();
        $count_assignment_students = count($assignment_students);
        $student_parent = StudentModel::where('status', 1)->where('parents_id', \Auth::user('parent')->id)->pluck('name','id');
        $absent_students = $this->get_data_absent_students();
        $count_absent_students = count($absent_students);

    	return view('frontend.parent', compact('events','count_event','finances','finance_detail','count_finance','confirm_payments','count_confirm_payment','assignment_students','count_assignment_students','student_parent','absent_students','count_absent_students'));
    }

    public function get_data_student() {
    	$student = DB::table('students')
        ->join('class', 'class.id', '=', 'students.class_id')
        ->where('students.parents_id', \Auth::user('parent')->id)
        ->select(['class.name AS class_name','students.class_id', 'students.parents_id', 'students.id'])
        ->first(); 

        return $student;
    }

    public function get_data_event() {
        $event = DB::table('event_news')
        ->whereRaw('now() BETWEEN start_event AND end_event')
        ->get();

        return $event;
    }

    public function get_confirm_payments($parents_id) {
        $confirm_payments = DB::table('confirm_payment')
        ->join('financial', 'financial.id', '=', 'confirm_payment.financial_id')
        ->join('parents', 'parents.id', '=', 'confirm_payment.parents_id')
        ->join('students', 'students.id', '=', 'confirm_payment.students_id')
        ->where('confirm_payment.parents_id', $parents_id)
        ->select([
            'parents.name AS parents_name',
            'students.name AS students_name',
            'confirm_payment.total_pay',
            'confirm_payment.created_date',
            'confirm_payment.remark',
            'confirm_payment.status',
            'confirm_payment.remark_admin',
        ])
        ->get();

        return $confirm_payments;
    }

    public function get_data_absent_students(){
        $absences = DB::table('absent_students')
        ->join('students', 'students.id', '=', 'absent_students.students_id')
        ->join('class', 'class.id', '=', 'absent_students.class_id')
        ->where('students.parents_id', \Auth::user('parent')->id)
        ->select([
            'students.name AS students_name',
            'class.name AS class_name',
            'absent_students.code',
            'absent_students.remark',
            'absent_students.absent_date',
        ])
        ->get();

        return $absences;
    }

    public function process_confirm() {
		DB::beginTransaction();
		$this->validate(request(), [
	        'confirm_file' => 'required',
	        'students_id' => 'required',
	        'remark' => 'required|min:10',
	        'total_pay' => 'required|numeric',
	    ]);

		$check_total_pay = FinancialModel::where('id', request('financial_id'))->select('total_pay')->first();
		if(request('total_pay') > $check_total_pay->total_pay){
			return response()->json(['status' => 'danger','msg' => 'Maaf, nominal yang anda bayarkan lebih besar dari nilai pembayaran yang seharusnya']);
		} elseif (request('total_pay') < $check_total_pay->total_pay) {
			return response()->json(['status' => 'danger','msg' => 'Maaf, nominal yang anda bayarkan lebih kecil dari nilai pembayaran yang seharusnya']);
		}

		$confirm_file = request('confirm_file');
	    if($confirm_file){
			$confirm_file = $confirm_file->storeAs('file_confirm_payment', request('financial_id').'_'.request('parents_id').'_'.request('students_id').'_'.$confirm_file->getClientOriginalName());
			request()->confirm_file->move(public_path('storage/file_confirm_payment'), $confirm_file);
	    }

		ConfirmationModel::create([
			'financial_id' => request('financial_id'),
			'parents_id' => request('parents_id'),
			'students_id' => request('students_id'),
			'remark' => request('remark'),
			'total_pay' => request('total_pay'),
	        'confirm_file' => $confirm_file,
	        'status' => 1,
	        'remark_admin' => '-'
		]);

		DB::commit();
	    return response()->json(['status' => 'success','msg' => 'Data Konfirmasi Pembayaran Berhasil Ditambahkan']);
    }

    public function change_password_fro_parent() {
        DB::beginTransaction();
        $this->validate(request(), [
            'password' => 'required|min:8',
        ]);
        DB::table('parents')->where('id', \Auth::guard('parent')->user()->id)->update(['password' => bcrypt(request('password'))]);
        DB::commit();
        return redirect()->route('parents')->with('success','Kata sandi kamu berhasil dirubah');
    }
}
