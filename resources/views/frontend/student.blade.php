<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>{{ Auth::guard('student')->user()->name }} - {{ config('app.name') }}</title>
  	<meta name="description" content="Australian Intercultural School made by Andhana &amp; Kriswanto">
	<meta name="keywords" content="australian intercultural school education">
	<meta name="author" content="Andhana Utama">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="icon" type="image/x-icon" href="{{ asset('frontend/img/logo.png') }}">
  	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Candal|Alegreya+Sans">
  	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/font-awesome.min.css') }}">
  	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
  	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/imagehover.min.css') }}">
  	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
  	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/custom.css') }}">
  	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}">
  	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/owl.carousel/assets/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/vendor/owl.carousel/assets/owl.theme.default.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/custom-post.css') }}">
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
	    <div class="container">
		    <div class="navbar-header">
		        <a href="{{ route('front') }}"><img class="logo hidden-xs hidden-sm" src="{{ asset('frontend/img/logo.png') }}"></a>
		        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		        </button>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		        <ul class="nav navbar-nav navbar-right">
				  	<a href="{{ route('sign_out') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <button type="button" class="btn btn-default btn-siswa"><i class="fa fa-sign-out"></i> {{ __('Logout') }} </button>
                    </a>
                    <form id="logout-form" action="{{ route('sign_out') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
		        </ul>
		    </div>
	    </div>
  	</nav>
  	<section id="siswa-prof" class="section-padding"> 
		<div class="container">
			<div class="row photo">
				<div class="col-md-2">
					<?php
						if(!empty(Auth::guard('student')->user()->photo_file)) {
			              $photo_file = asset('storage/'.Auth::guard('student')->user()->photo_file);
			            } else {
			              $photo_file = asset('frontend/img/photo.png');
			            }
					?>
					<img src="{{ $photo_file }}">
				</div>
				<div class="col-md-10 nama">
					<h3>{{ Auth::guard('student')->user()->name }}</h3>
					<hr class="bottom-line">
					<h4>NIK : {{ Auth::guard('student')->user()->nis }}</h4>
				</div>
			</div>
		<div class="row table">
	  		<div class="col-sm-3">
	          <ul class="list-group">
	            <li class="list-group-item text-muted">Profil <i class="fa fa-user-circle"></i></li>
	            <li class="list-group-item text-right"><span class="pull-left"><strong>Kelas</strong></span> {{ $student->class_name }}</li>
	            <li class="list-group-item text-right"><span class="pull-left"><strong>Last seen</strong></span> {{ Auth::guard('student')->user()->last_login->diffForHumans() }}</li>
	          </ul>
	          <ul class="list-group">
	            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
	            <li class="list-group-item text-right"><span class="pull-left"><strong>Task</strong></span> 125</li>
	            <li class="list-group-item text-right"><span class="pull-left"><strong>Payment</strong></span> 13</li>
	          </ul>
	        </div>
	    	<div class="col-sm-9">
	          <ul class="nav nav-tabs" id="myTab">
	          	<li class="active nav-siswa"><a href="#event" data-toggle="tab">Event<span class="badge badge-info">4</span></a></li>
	            <li class="nav-siswa"><a href="#task" data-toggle="tab">Task<span class="badge badge-info">{{ $count_assignment_students }}</span></a></li>
	            <li class="nav-siswa"><a href="#payment" data-toggle="tab">Payment<span class="badge badge-info">4</span></a></li>
	            <li class="nav-siswa"><a href="#history_payment" data-toggle="tab">History Payment<span class="badge badge-info">4</span></a></li>
	            <li class="nav-siswa"><a href="#attendance" data-toggle="tab">Attendance <i class="fa fa-book"></i></a></li>
	            <li class="nav-siswa"><a href="#settings" data-toggle="tab">Settings <i class="fa fa-cogs"></i></a></li>
	          </ul>
	              
	          <div class="tab-content">
	          	<div class="tab-pane active" id="event">
	               <div class="row">
						<body class="w3-light-grey">
						<div class="w3-content" style="max-width:1400px">
							<div class="w3-row">
								<div class="w3-col l12 s12">
								  	<div class="w3-card-4 w3-margin w3-white">
								  		<div class="w3-container">
										    <img class="col-md-4" src="{{ asset('frontend/img/logo.png') }}" alt="Nature" style="width:100%; padding: 15px;">
										    <div class="col-md-8">
										      <h5><b>Penerimaan Murid Baru</b></h5>
										      <h5>From <span class="w3-opacity">April 7, 2018</span>&nbsp Till <span class="w3-opacity">April 8, 2018</span></h5>
										      <h5></h5>
										      <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at.</p>
										      <div class="w3-row">
										        <div class="w3-col m8 s12">
										          <p><a href="blog-single.html"><button class="w3-button w3-padding-large w3-white w3-border"><b>READ MORE »</b></button></a></p>
										        </div>
										        <div class="w3-col m4 w3-hide-small">
										        </div>
										      </div>
										    </div>
									    </div>
								  	</div>
								</div>
								<div class="w3-col l12 s12">
								  	<div class="w3-card-4 w3-margin w3-white">
								  		<div class="w3-container">
										    <img class="col-md-4" src="{{ asset('frontend/img/logo.png') }}" alt="Nature" style="width:100%; padding: 15px;">
										    <div class="col-md-8">
										      <h5><b>Penerimaan Murid Baru</b></h5>
										      <h5>From <span class="w3-opacity">April 7, 2018</span>&nbsp Till <span class="w3-opacity">April 8, 2018</span></h5>
										      <h5></h5>
										      <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at.</p>
										      <div class="w3-row">
										        <div class="w3-col m8 s12">
										          <p><a href="blog-single.html"><button class="w3-button w3-padding-large w3-white w3-border"><b>READ MORE »</b></button></a></p>
										        </div>
										        <div class="w3-col m4 w3-hide-small">
										        </div>
										      </div>
										    </div>
									    </div>
								  	</div>
								</div>
								<div class="w3-col l12 s12">
								  	<div class="w3-card-4 w3-margin w3-white">
								  		<div class="w3-container">
										    <img class="col-md-4" src="{{ asset('frontend/img/logo.png') }}" alt="Nature" style="width:100%; padding: 15px;">
										    <div class="col-md-8">
										      <h5><b>Penerimaan Murid Baru</b></h5>
										      <h5>From <span class="w3-opacity">April 7, 2018</span>&nbsp Till <span class="w3-opacity">April 8, 2018</span></h5>
										      <h5></h5>
										      <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at.</p>
										      <div class="w3-row">
										        <div class="w3-col m8 s12">
										          <p><a href="blog-single.html"><button class="w3-button w3-padding-large w3-white w3-border"><b>READ MORE »</b></button></a></p>
										        </div>
										        <div class="w3-col m4 w3-hide-small">
										        </div>
										      </div>
										    </div>
									    </div>
								  	</div>
								</div>
							</div><br>
						</div>
					</div>
	            </div><!--/tab-pane-->
	            <div class="tab-pane" id="task">
	              <div class="table-bordered">
	                <table class="table table-hover">
	                  <thead>
	                    <tr>
	                      <th>No</th>
	                      <th>Description</th>
	                      <th>Start</th>
	                      <th>Due Date</th>
	                      <th>Details</th>
	                      <!-- <th>Label </th>
	                      <th>Label </th> -->
	                    </tr>
	                  </thead>
	                  <tbody id="items">
	                  	<?php
	                  		foreach ($assignment_students as $key => $assignment) {
	                  			$today = strtotime(date("Y-m-d"));
					            $end_assignment = strtotime($assignment->end_assignment);
					            if($today > $end_assignment){
					            	$status = '';
					            } else {
					            	$status = 'info new'; 
					            }
	                  	?>
	                    <tr class="{{ $status }}">
	                      <td>{{ $key+1 }}</td>
	                      <td class="deskripsi">{{ $assignment->remark }}</td>
	                      <td>{{ date('d F Y', strtotime($assignment->start_assignment)) }}</td>
	                      <td>{{ date('d F Y', strtotime($assignment->end_assignment)) }}</td>
	                      <td><a href="" class="detail">Details.</a></td>
	                    </tr>
						<?php } ?>
	                  </tbody>
	                </table>
	                <hr>
	                <div class="row">
	                  <div class="col-md-4 col-md-offset-4 text-center">
	                  	<ul class="pagination" id="myPager"></ul>
	                  </div>
	                </div>
	              </div>
	              <hr>
	             </div>
	             <div class="tab-pane" id="payment">
	               	<ul class="list-group">
	               	@foreach($finances as $finance)
	                <li class="list-group-item text-right">
	                  	<a href="#" class="pull-left" data-toggle="modal" data-target="#{{ $finance->id }}"><strong>{{ $finance->title }}</strong><button style="border: none;
					    border-radius: inherit;
					    padding: 5px 21px;
					    margin-left: 0px;
					    background: none;
					    outline: none;">Klik detail...</button></a>
						<div class="modal fade" id="{{ $finance->id }}" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="defaultModalLabel">Deskripsi Lengkap</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">
										<p style="text-align: left;">{{ $finance->remark }}</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
					</li>
					@endforeach
	                </ul> 
	             </div><!--/tab-pane-->
	             <div class="tab-pane" id="history_payment">
	               <div class="row">
						<div class="col">
							<section class="card card-admin">
								<div class="card-body">
									<table class="table table-responsive-lg table-bordered table-striped table-sm mb-0">
										<thead>
											<tr>
												<th class="text-left">Nama Orang Tua</th>
												<th class="text-left">Total</th>
												<th class="text-left">Tgl Pembayaran</th>
												<th class="text-left">Keterangan</th>
												<th class="text-left">Payment Status</th>
											</tr>
										</thead>
										<tbody>
										@foreach($confirm_payments as $confirm)
											<?php 
											if($confirm->status == 2) {
												$status = 'Completed';
											} else {
												$status = 'Reject';
											}
											?>
											<tr>
												<td>{{ $confirm->parents_name }}</td>
												<td class="text-left">{{ 'Rp. '.number_format($confirm->total_pay, 0, ',', '.') }}</td>
												<td class="text-left">{{ date('d F Y', strtotime($confirm->created_date)) }}</td>
												<td class="text-left">{{ $confirm->remark }}</td>
												<td class="text-left">{{ $status }}</td>
											</tr>
										@endforeach
										</tbody>
									</table>
								</div>
							</section>
						</div>
					</div>
	             </div><!--/tab-pane-->
	             <div class="tab-pane" id="attendance">
	               <div class="card-body">
						<table class="table table-responsive-lg table-bordered table-striped table-sm mb-0">
							<thead>
								<tr>
									<th>Name &amp; Date</th>
									<th>{{ Auth::guard('student')->user()->name }}</th>
								</tr>
							</thead>
							<tbody>
							@foreach($absences as $absence)
							<?php
								if($absence->code == 1) {
									$code = '<span class="badge badge-dark">Sakit</span>';
								} elseif($absence->code == 2) {
									$code = '<span class="badge badge-info">Izin</span>';
								} else {
									$code = '<span class="badge badge-danger">Tanpa Keterangan</span>';
								}
							?>
								<tr>
									<td>{{ date('d F Y', strtotime($absence->absent_date)) }}</td>
									<td>{!! $code !!}</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
	             </div><!--/tab-pane-->
	             <div class="tab-pane" id="settings">
	                  <hr>
	                  <form class="form" action="{{ route('change.passwords') }}" method="POST">
	                  	{{ csrf_field() }}
	                      <div class="form-group">
	                          <div class="col-xs-6">
	                              <label for="first_name"><h4>Reset Password</h4></label>
	                              <input type="password"  name="password" class="form-control" pattern="^\S{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimal 8 karakter' : ''); if(this.checkValidity()) form.repassword.pattern = this.value;" id="password" required="required" placeholder="Ketik password kamu">
	                          </div>
	                      </div>
	                      <div class="form-group">
	                          <div class="col-xs-6">
	                            <label for="last_name"><h4>Retype Password </h4></label>
	                              <input type="password" name="repassword" class="form-control" pattern="^\S{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Mohon samakan kata sandi anda seperti kata sandi disamping' : '');" id="repassword" required="" placeholder="Ketik sekali lagi password kamu">
	                          </div>
	                      </div>
	                      <div class="form-group">
	                           <div class="col-xs-12">
	                                <br>
	                              	<button class="btn btn-lg btn-success" type="submit"><i class="fa fa-save"></i> Save</button>
	                               	<button class="btn btn-lg" type="reset"><i class="fa fa-reset"></i> Reset</button>
	                            </div>
	                      </div>
	              	</form>
	              </div>
	               
	              </div><!--/tab-pane-->
	          </div><!--/tab-content-->

	        </div><!--/col-9-->
  		</div>
  	</section>
	
	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog">
	      <!-- Modal content-->
	    <div class="modal-content">
	        <div class="modal-header">
	          <h4 class="modal-title" id="modal_header"></h4>
	        </div>
	        <div class="modal-body">
	          <input type="text" value="Testing wak" readonly="readonly">
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	    </div>
	    </div>
	</div>

	<script type="text/javascript" src="{{ asset('frontend/js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/pagination.js') }}"></script>
	<script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('frontend/vendor/jquery.appear/jquery.appear.min.js') }}"></script>
	<script src="{{ asset('frontend/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
	<script src="{{ asset('frontend/vendor/jquery-cookie/jquery-cookie.min.js') }}"></script>
	<script src="{{ asset('frontend/vendor/popper/umd/popper.min.js') }}"></script>
	<script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('frontend/vendor/common/common.min.js') }}"></script>
	<script src="{{ asset('frontend/vendor/jquery.validation/jquery.validation.min.js') }}"></script>
	<script src="{{ asset('frontend/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js') }}"></script>
	<script src="{{ asset('frontend/vendor/jquery.gmap/jquery.gmap.min.js') }}"></script>
	<script src="{{ asset('frontend/vendor/jquery.lazyload/jquery.lazyload.min.js') }}"></script>
	<script src="{{ asset('frontend/vendor/isotope/jquery.isotope.min.js') }}"></script>
	<script src="{{ asset('frontend/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('frontend/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
	<script src="{{ asset('frontend/vendor/vide/vide.min.js') }}"></script>

</body>
</html>