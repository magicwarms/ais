<?php

namespace App\Http\Controllers\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParentFrontController extends Controller {
    
	public function index() {
    	return view('frontend.parent');
    }

}
