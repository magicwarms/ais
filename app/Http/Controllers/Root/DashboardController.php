<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller {

	public function home(){
		return view('backend.dashboard');
	}

}
