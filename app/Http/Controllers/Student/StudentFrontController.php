<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentFrontController extends Controller {
    
	public function index() {
    	return view('frontend.student');
    }

}
