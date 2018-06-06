<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>{{ Auth::guard('parent')->user()->name }} - {{ config('app.name') }}</title>
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
	<nav class="navbar navbar-default navbar-fixed-top parents">
	    <div class="container">
		    <div class="navbar-header">
		        <a href="{{ route('parents') }}"><img class="logo hidden-xs hidden-sm" src="{{ asset('frontend/img/logo.png') }}"></a>
		        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		        </button>
		    </div>
		    <div class="collapse navbar-collapse siswa" id="myNavbar">
		        <ul class="nav navbar-nav navbar-right">
				  	<a href="{{ route('sign_out_parent') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <button type="button" class="btn btn-default btn-ortu"><i class="fa fa-sign-out"></i> {{ __('Logout') }} </button>
                    </a>
                    <form id="logout-form" action="{{ route('sign_out_parent') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
		        </ul>
		    </div>
	    </div>
  	</nav>
  	<section id="siswa-prof" class="section-padding"> 
		<div class="container">
			@if(session('success'))
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Selamat!</strong> Anda berhasil login, {{ Auth::guard('parent')->user()->name }}.
			</div>
			@endif
			<div class="row photo">
				<div class="col-md-10 nama">
					<h3>{{ Auth::guard('parent')->user()->name }}</h3>
					<hr class="bottom-line">
					<h4>NO. HANDPHONE : {{ Auth::guard('parent')->user()->phone }}</h4>
				</div>
			</div>
		<div class="row table">
	  		<div class="col-sm-3">
	          <ul class="list-group">
	            <li class="list-group-item text-muted">Profile <i class="fa fa-user-circle"></i></li>
	            <li class="list-group-item text-right"><span class="pull-left"><strong>Terakhir Login</strong></span> {{ Auth::guard('parent')->user()->last_login->diffForHumans() }}</li>
	          </ul>
	          <ul class="list-group">
	            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
	            <li class="list-group-item text-right"><span class="pull-left"><strong>Payment</strong></span> {{ $count_finance }}</li>
	          </ul>
	          
	        </div><!--/col-3-->
	    	<div class="col-sm-9">
	          
	          <ul class="nav nav-tabs" id="myTab">
	          	<li class="active nav-siswa"><a href="#event" data-toggle="tab">Event<span class="badge badge-info">{{ $count_event }}</span></a></li>
	            <li class="nav-siswa"><a href="#payment" data-toggle="tab">Payment<span class="badge badge-info">{{ $count_finance }}</span></a></li>
	            <li class="nav-siswa"><a href="#history_payment" data-toggle="tab">History Payment<span class="badge badge-info">{{ $count_confirm_payment }}</span></a></li>
	            <li class="nav-siswa"><a href="#attendance" data-toggle="tab">Attendance<span class="badge badge-info">{{ $count_absent_students }}</span></a></li>
	            <li class="nav-siswa"><a href="#settings" data-toggle="tab">Settings <i class="fa fa-cogs"></i></a></li>
	          </ul>
	              
	          <div class="tab-content">
	          	<div class="tab-pane active" id="event">
	               <div class="row">
						<body class="w3-light-grey">
						<div class="w3-content" style="max-width:1400px">
							<div class="w3-row">
							@foreach($events as $event)
								<div class="w3-col l12 s12">
								  	<div class="w3-card-4 w3-margin w3-white">
								  		<div class="w3-container">
										    <img class="col-md-4" src="{{ asset('storage/'.$event->event_file) }}" alt="{{ $event->title }}" style="width:100%; padding: 15px;">
										    <div class="col-md-8">
										      <h5><b>{{ $event->title }}</b></h5>
										      <h5>From <span class="w3-opacity">{{ date('d F Y', strtotime($event->start_event)) }}</span>&nbsp; Till <span class="w3-opacity">{{ date('d F Y', strtotime($event->end_event)) }}</span></h5>
										      <div class="eventDescription">
										      	{{ $event->description }}
										      </div>
										    </div>
									    </div>
								  	</div>
								</div>
							@endforeach
							</div><br>
						</div>
					</div>
	            </div><!--/tab-pane-->
	            <div class="tab-pane" id="payment">
	            	<br>
	            	<div id="output"></div>
	               <ul class="list-group">
	                @foreach($finances as $finance)
	                  <li class="list-group-item text-right">
	                  	<a href="#" class="pull-left" data-toggle="modal" data-target="#{{ $finance->id }}"><strong>{{ $finance->title }}</strong><button style="border: none;
					    border-radius: inherit;
					    padding: 5px 21px;
					    margin-left: 0px;
					    background: none;
					    outline: none;">Klik detail...</button></a> 
	                  	<button class="btn btn-primary" data-toggle="modal" data-target="#confirm-{{ $finance->id }}">
							Konfirmasi
						</button>
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
						<div class="modal fade" id="confirm-{{ $finance->id }}" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="formModalLabel">Konfirmasi Pembayaran - {{ $finance->title }}</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">
										<form method="POST" class="mb-4 form_input_confirmation" enctype="multipart/form-data">
											<h5 class="form-list">Silakan isi form bukti pembayaran berikut : </h5>
											<input type="hidden" name="financial_id" id="financial_id" value="{{ $finance->id }}">
											<input type="hidden" name="parents_id" value="{{ \Auth::user('parent')->id }}">
											<div class="form-group row align-items-center">
												<div class="col-sm-9">
													<input type="text" name="total_pay" class="form-control" placeholder="Total yang harus dibayar..." required="required" />
												</div>
											</div>
											<div class="form-group row align-items-center">
												<div class="col-sm-9">
													{{ Form::select('students_id', $student_parent, null, array('class' =>'md-input', 'placeholder' => 'Pilih Anak', 'id' => 'students_id','required')) }}
												</div>
											</div>
											<div class="form-group row align-items-center">
												<div class="col-lg-6">
													<div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="input-append">
															<input type="file" name="confirm_file" accept="image/png, image/jpg, image/jpeg"/>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-sm-9">
													<textarea rows="5" name="remark" class="form-control" placeholder="Keterangan..." required></textarea>
												</div>
											</div>
										</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-primary">Send</button>
											</div>
										</form>
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
												<th class="text-left">Nama Murid</th>
												<th class="text-left">Total</th>
												<th class="text-left">Due Date</th>
												<th class="text-left">Keterangan</th>
												<th class="text-left">Payment Status</th>
												<th class="text-left">Ket. Admin</th>
											</tr>
										</thead>
										<tbody>
										@foreach($confirm_payments as $confirm)
											<?php 
											if($confirm->status == 1) {
												$status = 'On Process';
											} else if ($confirm->status == 2) {
												$status = 'Completed';
											} else {
												$status = 'Reject';
											}
											?>
											<tr>
												<td>{{ $confirm->parents_name }}</td>
												<td>{{ $confirm->students_name }}</td>
												<td class="text-left">{{ 'Rp. '.number_format($confirm->total_pay, 0, ',', '.') }}</td>
												<td class="text-left">{{ date('d F Y', strtotime($confirm->created_date)) }}</td>
												<td class="text-left">{{ $confirm->remark }}</td>
												<td class="text-left">{{ $status }}</td>
												<td class="text-left">{{ $confirm->remark_admin }}</td>
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
									<th>No.</th>
									<th>Nama</th>
									<th>Kelas</th>
									<th>Tgl. Absen</th>
									<th>Kode Absen</th>
								</tr>
							</thead>
							<tbody>
							@foreach($absent_students as $key => $absence)
								<?php
									if($absence->code == 1){
						                $code = '<span class="badge badge-primary">Sakit</span>';
						            } elseif($absence->code == 2) {
						                $code ='<span class="badge badge-success">Izin</span>';
						            } else {
						                $code = '<span class="badge badge-warning">Tanpa Keterangan</span>';
						            }
								?>
								<tr>
									<td>{{ $key+1 }}</td>
									<td>{{ $absence->students_name }}</td>
									<td>{{ $absence->class_name }}</td>
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
	                  <form class="form" action="{{ route('change.passwords.parent') }}" method="POST">
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

<script type="text/javascript" src="{{ asset('frontend/js/jquery.js') }}"></script>
<script src="{{ asset('frontend/js/readmore.min.js') }}"></script>
<script type="text/javascript">
	$('.eventDescription').readmore({
		speed: 570,
		moreLink: '<div class="w3-row"><div class="w3-col m8 s12"><p><a href="#"><button class="w3-button w3-padding-large w3-white w3-border"><b>Selengkapnya »</b></button></a></p></div><div class="w3-col m4 w3-hide-small"></div></div>',
		lessLink: '<div class="w3-row"><div class="w3-col m8 s12"><p><a href="#"><button class="w3-button w3-padding-large w3-white w3-border"><b>Tutup x</b></button></a></p></div><div class="w3-col m4 w3-hide-small"></div></div>'
	});
</script>
<script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/pagination.js') }}"></script>
<script type="text/javascript">
	var finance_id = $('#financial_id').val();
	$(".form_input_confirmation").on('submit',function() {
      $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        },
        url: "{{ route('parents.confirm') }}",
        processData: false,
        contentType: false,
        cache: false,
        data: new FormData($(this)[0]),
        dataType: 'JSON',
        success: function(result) {
          $('.form_input_confirmation')[0].reset();
          $('#confirm-'+finance_id).modal('toggle');
          if(result.status=='success'){
            $('#output').html('<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Sukses!</strong>' +result.msg+'</div>')
          } else {
          	$('#output').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Kesalahan!</strong> '+result.msg+'</div>')
          }
        },
        error: function (result) {
        	$('#confirm-'+finance_id).modal('toggle');
        	var response = JSON.parse(result.responseText)
	          	$.each(response.errors, function (key, value) {
	            $('#output').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Kesalahan!</strong> '+value+'</div>')
          	});
        }
      });
      event.preventDefault();
    });
</script>
</body>
</html>