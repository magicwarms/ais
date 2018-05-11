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
			<div class="row photo">
				<div class="col-md-2">
					<?php
						if(!empty(Auth::guard('student')->user()->photo_file)) {
			              $photo_file = asset('storage/'.Auth::guard('student')->user()->photo_file);
			            } else {
			              $photo_file = asset('frontend/img/photo.png');
			            }
					?>
					<img src="{{ $photo_file }}" alt="{{ Auth::guard('parent')->user()->name }}">
				</div>
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
	            <li class="list-group-item text-right"><span class="pull-left"><strong>Class</strong></span> playgroup</li>
	            <li class="list-group-item text-right"><span class="pull-left"><strong>Last seen</strong></span> {{ Auth::guard('parent')->user()->last_login->diffForHumans() }}</li>
	          </ul>
	          <ul class="list-group">
	            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
	            <li class="list-group-item text-right"><span class="pull-left"><strong>Task</strong></span> 125</li>
	            <li class="list-group-item text-right"><span class="pull-left"><strong>Payment</strong></span> 13</li>
	          </ul>
	          
	        </div><!--/col-3-->
	    	<div class="col-sm-9">
	          
	          <ul class="nav nav-tabs" id="myTab">
	          	<li class="active nav-siswa"><a href="#event" data-toggle="tab">Event<span class="badge badge-info">4</span></a></li>
	            <li class="active nav-siswa"><a href="#payment" data-toggle="tab">Payment<span class="badge badge-info">4</span></a></li>
	            <li class="nav-siswa"><a href="#history_payment" data-toggle="tab">History Payment<span class="badge badge-info">4</span></a></li>
	            <li class="nav-siswa"><a href="#attendance" data-toggle="tab">Attendance<span class="badge badge-info">4</span></a></li>
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
	            <div class="tab-pane" id="payment">
	               <h2></h2>
	               <ul class="list-group">
	                  <!-- <li class="list-group-item text-muted">Payment</li> -->
	                  <li class="list-group-item text-right">
	                  	<a href="#" class="pull-left" data-toggle="modal" data-target="#defaultModal1"><strong>Pembayaran SPP</strong><button style="    border: none;
					    border-radius: inherit;
					    padding: 5px 21px;
					    margin-left: 0px;
					    background: none;
					    outline: none;">Klik detail...</button></a> 
	                  	<button class="btn btn-primary" data-toggle="modal" data-target="#formModal1">
							Konfirmasi
						</button>
						<div class="modal fade" id="defaultModal1" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="defaultModalLabel">Deskripsi Lengkap</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">
										<p style="text-align: left;">Anda diharuskan membayar uang SPP sebesar Rp.200.000 sebelum tanggal yang telah ditentukan oleh pihak sekolah yaitu tanggal 18/12/2018.
										Jika anda telah membayar uang SSP silakan konfirmasi bukti pembayaran anda dengan mengklik tombol konfirmasi dan mengisi data serta mengirimkan bukti transfer.</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="formModal1" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="formModalLabel">Konfirmasi Pembayaran</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">
										<form id="demo-form" class="mb-4" novalidate="novalidate">
											<h5 class="form-list">Silakan isi form bukti pembayaran berikut : </h5>
											<div class="form-group row align-items-center">
												<div class="col-sm-9">
													<input type="text" name="name" class="form-control" placeholder="Nama orang tua..." required/>
												</div>
											</div>
											<div class="form-group row align-items-center">
												
												<div class="col-sm-9">
													<input type="text" name="name" class="form-control" placeholder="Nama siswa..." required/>
												</div>
											</div>
											<div class="form-group row align-items-center">
												<div class="col-sm-9">
													<input type="text" name="number" class="form-control" placeholder="Total yang harus dibayar..." />
												</div>
											</div>
											<div class="form-group row align-items-center">
												<div class="col-lg-6">
													<div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="input-append">
															<input type="file" />
														</div>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-sm-9">
													<textarea rows="5" class="form-control" placeholder="Keterangan..." required></textarea>
												</div>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary">Send</button>
									</div>
								</div>
							</div>
						</div>
					  </li>
	                  <li class="list-group-item text-right">
	                  	<a href="#" class="pull-left" data-toggle="modal" data-target="#defaultModal2"><strong>Perlengkapan Sekolah</strong> <button style="    border: none;
					    border-radius: inherit;
					    padding: 5px 21px;
					    margin-left: 0px;
					    background: none;
					    outline: none;">Klik detail...</button></a> 
	                  	<button class="btn btn-primary" data-toggle="modal" data-target="#formModal2">
							Konfirmasi
						</button>
						<div class="modal fade" id="defaultModal2" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="defaultModalLabel">Deskripsi Lengkap</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body ul-li" style="text-align: left;">
										<p>Anda diharuskan membayar uang perlengkapan sekolah sebesar Rp.200.000 sebelum tanggal yang telah ditentukan oleh pihak sekolah yaitu tanggal 18/12/2018.
										<br>dimana rinciannya sebagai berikut:</p>
										<ul>
											<li>Baju Sekolah : Rp.100.000</li>
											<li>Uang Buku 	 : Rp.50.000</li>
											<li>Uang Gedung  : Rp.50.000</li>
										</ul>
										<p>Jika anda telah membayar uang SSP silakan konfirmasi bukti pembayaran anda dengan mengklik tombol konfirmasi dan mengisi data serta mengirimkan bukti transfer.</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="formModal2" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="formModalLabel">Konfirmasi Pembayaran</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">
										<form id="demo-form" class="mb-4" novalidate="novalidate">
											<h5 class="form-list">Silakan isi form bukti pembayaran berikut : </h5>
											<div class="form-group row align-items-center">
												<div class="col-sm-9">
													<input type="text" name="name" class="form-control" placeholder="Nama orang tua..." required/>
												</div>
											</div>
											<div class="form-group row align-items-center">
												<div class="col-sm-9">
													<input type="text" name="name" class="form-control" placeholder="Nama siswa..." required/>
												</div>
											</div>
											<div class="form-group row align-items-center">
												<div class="col-sm-9">
													<input type="text" name="number" class="form-control" placeholder="Total yang harus dibayar..." />
												</div>
											</div>
											<div class="form-group row align-items-center">
												<div class="col-lg-6">
													<div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="input-append">
															<input type="file" />
														</div>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-sm-9">
													<textarea rows="5" class="form-control" placeholder="Keterangan..." required></textarea>
												</div>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary">Send</button>
									</div>
								</div>
							</div>
						</div>
					  </li>
					  <li class="list-group-item text-right">
	                  	<a href="#" class="pull-left" data-toggle="modal" data-target="#defaultModal1"><strong>Pembayaran SPP</strong></a> 
	                  	<button class="btn btn-primary" data-toggle="modal" data-target="#formModal1">
							Konfirmasi
						</button>
						<div class="modal fade" id="defaultModal1" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="defaultModalLabel">Deskripsi Lengkap</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">
										<p style="text-align: left;">Anda diharuskan membayar uang SPP sebesar Rp.200.000 sebelum tanggal yang telah ditentukan oleh pihak sekolah yaitu tanggal 18/12/2018.
										Jika anda telah membayar uang SSP silakan konfirmasi bukti pembayaran anda dengan mengklik tombol konfirmasi dan mengisi data serta mengirimkan bukti transfer.</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="formModal1" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="formModalLabel">Konfirmasi Pembayaran</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">
										<form id="demo-form" class="mb-4" novalidate="novalidate">
											<h5 class="form-list">Silakan isi form bukti pembayaran berikut : </h5>
											<div class="form-group row align-items-center">
												<div class="col-sm-9">
													<input type="text" name="name" class="form-control" placeholder="Nama orang tua..." required/>
												</div>
											</div>
											<div class="form-group row align-items-center">
												<div class="col-sm-9">
													<input type="text" name="name" class="form-control" placeholder="Nama siswa..." required/>
												</div>
											</div>
											<div class="form-group row align-items-center">
												<div class="col-sm-9">
													<input type="text" name="number" class="form-control" placeholder="Total yang harus dibayar..." />
												</div>
											</div>
											<div class="form-group row align-items-center">
												<div class="col-lg-6">
													<div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="input-append">
															<input type="file" />
														</div>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-sm-9">
													<textarea rows="5" class="form-control" placeholder="Keterangan..." required></textarea>
												</div>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary">Send</button>
									</div>
								</div>
							</div>
						</div>
					  </li>
	                  <li class="list-group-item text-right">
	                  	<a href="#" class="pull-left" data-toggle="modal" data-target="#defaultModal3"><strong>Perlengkapan Sekolah</strong></a> 
	                  	<button class="btn btn-primary" data-toggle="modal" data-target="#formModal3">
							Konfirmasi
						</button>
						<div class="modal fade" id="defaultModal3" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="defaultModalLabel">Deskripsi Lengkap</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body ul-li" style="text-align: left;">
										<p>Anda diharuskan membayar uang perlengkapan sekolah sebesar Rp.200.000 sebelum tanggal yang telah ditentukan oleh pihak sekolah yaitu tanggal 18/12/2018.
										<br>dimana rinciannya sebagai berikut:</p>
										<ul>
											<li>Baju Sekolah : Rp.100.000</li>
											<li>Uang Buku 	 : Rp.50.000</li>
											<li>Uang Gedung  : Rp.50.000</li>
										</ul>
										<p>Jika anda telah membayar uang SSP silakan konfirmasi bukti pembayaran anda dengan mengklik tombol konfirmasi dan mengisi data serta mengirimkan bukti transfer.</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="formModal3" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="formModalLabel">Konfirmasi Pembayaran</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">
										<form id="demo-form" class="mb-4" novalidate="novalidate">
											<h5 class="form-list">Silakan isi form bukti pembayaran berikut : </h5>
											<div class="form-group row align-items-center">
												<div class="col-sm-9">
													<input type="text" name="name" class="form-control" placeholder="Nama orang tua..." required/>
												</div>
											</div>
											<div class="form-group row align-items-center">
												
												<div class="col-sm-9">
													<input type="text" name="name" class="form-control" placeholder="Nama siswa..." required/>
												</div>
											</div>
											<div class="form-group row align-items-center">
												<div class="col-sm-9">
													<input type="text" name="number" class="form-control" placeholder="Total yang harus dibayar..." />
												</div>
											</div>
											<div class="form-group row align-items-center">
												<div class="col-lg-6">
													<div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="input-append">
															<input type="file" />
														</div>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-sm-9">
													<textarea rows="5" class="form-control" placeholder="Keterangan..." required></textarea>
												</div>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary">Send</button>
									</div>
								</div>
							</div>
						</div>
					  </li>
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
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Hesty Purwadinata</td>
												<td class="text-left">Damar</td>
												<td class="text-left">Rp.350.000</td>
												<td class="text-left">12/07/2018</td>
												<td class="text-left">Pembayaran SPP</td>
												<td class="text-left">Complete</td>
											</tr>
											<tr>
												<td>Dian Sasongko</td>
												<td class="text-left">Wulan</td>
												<td class="text-left">Rp.350.000</td>
												<td class="text-left">12/07/2018</td>
												<td class="text-left">Perlengkapan Sekolah</td>
												<td class="text-left">Complete</td>
											</tr>
											<tr>
												<td>Rian Nurmanto</td>
												<td class="text-left">Damar</td>
												<td class="text-left">Rp.350.000</td>
												<td class="text-left">12/07/2018</td>
												<td class="text-left">Pembayaran SPP</td>
												<td class="text-left">Complete</td>
											</tr>
											<tr>
												<td>Rian Nurmanto</td>
												<td class="text-left">Wulan</td>
												<td class="text-left">Rp.350.000</td>
												<td class="text-left">12/07/2018</td>
												<td class="text-left">Perlengkapan Sekolah</td>
												<td class="text-left">Complete</td>
											</tr>
											<tr>
												<td>Rian Nurmanto</td>
												<td class="text-left">Damar</td>
												<td class="text-left">Rp.350.000</td>
												<td class="text-left">12/07/2018</td>
												<td class="text-left">Pembayaran SPP</td>
												<td class="text-left">Complete</td>
											</tr>
											<tr>
												<td>Rian Nurmanto</td>
												<td class="text-left">Wulan</td>
												<td class="text-left">Rp.350.000</td>
												<td class="text-left">12/07/2018</td>
												<td class="text-left">Keperluan Sekolah</td>
												<td class="text-left">Complete</td>
											</tr>
											<tr>
												<td>Rian Nurmanto</td>
												<td class="text-left">Damar</td>
												<td class="text-left">Rp.350.000</td>
												<td class="text-left">12/07/2018</td>
												<td class="text-left">Keperluan Sekolah</td>
												<td class="text-left">Complete</td>			
											</tr>
											<tr>
												<td>Rian Nurmanto</td>
												<td class="text-left">Wulan</td>
												<td class="text-left">Rp.350.000</td>
												<td class="text-left">12/07/2018</td>
												<td class="text-left">Pembayaran SPP</td>
												<td class="text-left">Complete</td>
											</tr>
											<tr>
												<td>Rian Nurmanto</td>
												<td class="text-left">Damar</td>
												<td class="text-left">Rp.350.000</td>
												<td class="text-left">12/07/2018</td>
												<td class="text-left">Keperluan Sekolah</td>
												<td class="text-left">Complete</td>						
											</tr>
											<tr>
												<td>Rian Nurmanto</td>
												<td class="text-left">Wulan</td>
												<td class="text-left">Rp.350.000</td>
												<td class="text-left">12/07/2018</td>
												<td class="text-left">Pembayaran SPP</td>
												<td class="text-left">Complete</td>			
											</tr>
											<tr>
												<td>Rian Nurmanto</td>
												<td class="text-left">Damar</td>
												<td class="text-left">Rp.350.000</td>
												<td class="text-left">12/07/2018</td>
												<td class="text-left">Keperluan Sekolah</td>
												<td class="text-left">Complete</td>
											</tr>
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
									<th>Kriswanto</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>01/03/2018</td>
									<td><span class="badge badge-dark">Sakit</span></td>
								</tr>
								<tr>
									<td>02/031028</td>
									<td><i class="fa fa-check"></i></td>
								</tr>
								<tr>
									<td>03/031028</td>
									<td><i class="fa fa-check"></i></td>
								</tr>
								<tr>
									<td>04/031028</td>
									<td><i class="fa fa-check"></i></td>
								</tr>
								<tr>
									<td>05/031028</td>
									<td><i class="fa fa-check"></i></td>
								</tr>
								<tr>
									<td>06/031028</td>
									<td><span class="badge badge-danger">Tanpa keterangan</span></td>
								</tr>
								<tr>
									<td>07/031028</td>
									<td><span class="badge badge-info">Izin</span></td>
								</tr>
								<tr>
									<td>08/031028</td>
									<td><i class="fa fa-check"></i></td>
								</tr>
								<tr>
									<td>09/031028</td>
									<td><i class="fa fa-check"></i></td>
								</tr>
								<tr>
									<td>03/031028</td>
									<td><i class="fa fa-check"></i></td>
								</tr>
								<tr>
									<td>10/031028</td>
									<td><i class="fa fa-check"></i></td>
								</tr>
							</tbody>
						</table>
					</div>
	             </div><!--/tab-pane-->
	             <div class="tab-pane" id="settings">
                  <hr>
                  <form class="form" action="##" method="post" id="registrationForm">
                      <div class="form-group">
                          <div class="col-xs-6">
                              <label for="first_name"><h4>Reset Password</h4></label>
                              <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name" title="enter your first name if any.">
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="col-xs-6">
                            <label for="last_name"><h4>Retype Password </h4></label>
                              <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name if any.">
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
<script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/pagination.js') }}"></script>
</body>
</html>