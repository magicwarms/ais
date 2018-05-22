<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\StudentModel;
use App\Model\ClassModel;
use App\Model\SubjectModel;
use App\Model\TeacherModel;
use DB;

class DashboardController extends Controller {

	public function home(){
		$count_students = StudentModel::query()->where('status', 1)->whereYear('created_date', date('Y'))->count();
		$count_clasess = ClassModel::query()->where('status', 1)->whereYear('created_date', date('Y'))->count();
		$count_subjects = ClassModel::query()->where('status', 1)->whereYear('created_date', date('Y'))->count();
		$count_teachers = ClassModel::query()->where('status', 1)->whereYear('created_date', date('Y'))->count();
		return view('backend.dashboard', compact('count_students','count_clasess','count_subjects','count_teachers'));
	}

}
