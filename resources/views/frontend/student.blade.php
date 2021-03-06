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
			<div class="row">
				<div class="col">
					<div id="output"></div> <!-- ajax response -->
				</div>
			</div>
			@if(session('success'))
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Selamat!</strong> Anda berhasil login, {{ Auth::guard('student')->user()->name }}.
			</div>
			@endif
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
	            <li class="list-group-item text-right"><span class="pull-left"><strong>Terakhir Login</strong></span> {{ Auth::guard('student')->user()->last_login->diffForHumans() }}</li>
	          </ul>
	          <ul class="list-group">
	            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
	            <li class="list-group-item text-right"><span class="pull-left"><strong>Task</strong></span> {{ $count_assignment_students }}</li>
	            <li class="list-group-item text-right"><span class="pull-left"><strong>Payment</strong></span> {{ $count_finance }}</li>
	          </ul>
	        </div>
	    	<div class="col-sm-9">
	          <ul class="nav nav-tabs" id="myTab">
	          	<li class="active nav-siswa"><a href="#event" data-toggle="tab">Event<span class="badge badge-info">{{ $count_event }}</span></a></li>
	            <li class="nav-siswa"><a href="#task" data-toggle="tab">Task<span class="badge badge-info">{{ $count_assignment_students }}</span></a></li>
	            <li class="nav-siswa"><a href="#payment" data-toggle="tab">Payment<span class="badge badge-info">{{ $count_finance }}</span></a></li>
	            <li class="nav-siswa"><a href="#attendance" data-toggle="tab">Attendance <i class="fa fa-book"></i></a></li>
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
	                      <?php
	                      	$check_task = check_task_student(Auth::user('student')->id, $assignment->assignment_id);
	                      	if($check_task != ''){
	                      		$task = '<a href="#" class="detail">Tugas sudah terupload.</a>';
	                      	} else {
	                      		$task = '<a id="task_student" href="#" class="detail" data-id="'.$assignment->assignment_id.'">Detail.</a>';
	                      	}
	                      ?>
	                      <td>{!! $task !!}</td>
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
										<h4 class="modal-title" id="defaultModalLabel">{{ $finance->title }}</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">
										<table class="table table-striped">
										    <thead>
										      <tr>
										        <th>Fee</th>
										        <th>Total</th>
										        <th>Diskon</th>
										        <th>Ket.</th>
										        <th>Subtotal.</th>
										      </tr>
										    </thead>
										    <tbody>
										<?php
									    	foreach ($finance_detail as $detail_finance) {
									    		foreach ($detail_finance as $key_detail => $detail) {
									    		if($finance->id == $detail->financial_id){
									    			if($detail->discount == 0){
									    				$discount = '-';
									    			} else {
									    				$discount = $detail->discount.'%';
									    			}
									    ?>
										      <tr>
										        <td>{{ $detail->fee }}</td>
										        <td>{{ number_format($detail->total, 0, ',', '.') }}</td>
										        <td>{{ $discount }}</td>
										        <td>{{ $detail->remark }}</td>
										        <td>{{ number_format($detail->subtotal, 0, ',', '.')}}</td>
										      </tr>
												<?php } ?>
												<?php } ?>
											<?php } ?>
										    </tbody>
										  </table>
										<p style="text-align: left;"><b>Keterangan:</b></p>
										<hr>
										<p style="text-align: left;">{{ $finance->remark }}</p>\
										<hr>
										<p style="text-align: left;"><b>Total yang Harus dibayar: </b></p>
										<hr>
										<p style="text-align: left;">Rp. {{ number_format($finance->total_pay, 0, ',', '.') }}</p>
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
	             <div class="tab-pane" id="attendance">
	               <div class="card-body">
						<table class="table table-responsive-lg table-bordered table-striped table-sm mb-0">
							<thead>
								<tr>
									<th>Tanggal</th>
									<th>Kode</th>
									<th>Keterangan</th>
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
									<td>{{ $absence->remark }}</td>
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
	<div class="modal fade" id="upload_task_modal" tabindex="-1" role="dialog" aria-labelledby="formModal1Label" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Silakan Upload File/Tugas anda.</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<h5 id="name_tugas"></h5><br>
					<h5 id="mapel_tugas"></h5><br>
					<h5 id="deskripsi_tugas"></h5>
					<div class="form-group row align-items-center" id="assignment_tugas"></div>
					<div class="form-group row align-items-center">
						<label class="col-sm-3 text-left text-sm-right mb-0">Batas Waktu tugas</label>
						<div class="col-sm-9">
							<h5 id="start_assignment"></h5>
							<h5 id="end_assignment"></h5>
						</div>
					</div>
					<form class="mb-4 form_upload_task_student">
						<input type="hidden" name="students_assignment_id" id="students_assignment_id">
						<input type="hidden" name="students_id" value="{{ Auth::user('student')->id }}">
						<div class="form-group row align-items-center">
							<label class="col-sm-3 text-left text-sm-right mb-0">Keterangan</label>
							<div class="col-sm-9">
								<textarea name="remark" id="remark"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 text-left text-sm-right mb-0">Upload File</label>
							<div class="col-sm-9">
								<input type="file" accept="application/msword, application/pdf, image/png, image/jpg, image/jpeg, application/vnd.ms-excel, application/vnd.ms-powerpoint" required="required" id="assignment_file" name="assignment_file" />		
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
	</div>
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
	<script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('frontend/vendor/popper/umd/popper.min.js') }}"></script>
	<script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('frontend/vendor/common/common.min.js') }}"></script>
	
	<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click', '#task_student', function (e) {
	    var id = $(this).data('id');
	    var APP_URL = {!! json_encode(url('/')) !!}
	    $.ajax({
	      url: APP_URL + "/fetch/"+id,
	      method:'GET',
	      dataType:'json',
	      success:function(data) {
	        $('#name_tugas').html('<strong>Tugas: </strong>'+data.name)
	        $('#mapel_tugas').html('<strong>Mata Pelajaran: </strong>'+data.subject_name)
	        $('#deskripsi_tugas').html('<strong>Deskripsi: </strong>'+data.remark)
	        $('#assignment_tugas').html('<div class="col-sm-9"><a class="link-download" href="'+data.assignment_file+'" target="_blank">Download File</a></div>')
	        $('#start_assignment').html('From   : '+data.start_assignment)
	        $('#end_assignment').html('Until   : '+data.end_assignment)
	        $('input#students_assignment_id').val(id);
	        show_modal_task();
	      }
	    })
	  	e.preventDefault();
		});
	});
	var assignment_id = $('#students_assignment_id').val()
	$(".form_upload_task_student").on('submit',function() {
      $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        },
        url: "{{ route('upload.task.student') }}",
        processData: false,
        contentType: false,
        cache: false,
        data: new FormData($(this)[0]),
        dataType: 'JSON',
        success: function(result) {
          $('.form_upload_task_student')[0].reset();
          $('#upload_task_modal').modal('toggle');
          $('#detail_task').html('<a href="#" class="detail">Tugas sudah terupload.</a>')
          if(result.status=='success'){
            $('#output').html('<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Sukses!</strong> ' +result.msg+'</div>')
            reload_page()
          } else {
          	$('#output').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Kesalahan!</strong> '+result.msg+'</div>')
          	reload_page()
          }
        },
        error: function (result) {
        	$('#upload_task_modal').modal('toggle');
        	var response = JSON.parse(result.responseText)
	          	$.each(response.errors, function (key, value) {
	            $('#output').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Kesalahan!</strong> '+value+'</div>')
          	});
	        reload_page()
        }
      });
      event.preventDefault();
    });

	function show_modal_task() {
		$('#upload_task_modal').modal('show');
	}

	function reload_page() {
		setTimeout(function(){
			location.reload();
		},2000);
	}

	</script>
</body>
</html>