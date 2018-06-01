@extends('layouts.baselayout')

@section('css')
	<!-- common css / default css -->
    <link rel="stylesheet" href="{{ asset('bower_components/uikit/css/uikit.almost-flat.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('templates/css/main.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('templates/css/custom-admin.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('templates/css/themes/themes_combined.min.css') }}" media="all">
@endsection

@section('content')
<div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
    <div class="uk-width-large-1-1">
        <div class="md-card">
            <div class="user_heading">
                <div class="user_heading_avatar">
                	<?php 
                		if(!empty($teacher->photo_file)) {
			              $photo_file = asset('storage/'.$teacher->photo_file);
			            } else {
			              $photo_file = asset('storage/no-image-available.png');
			            }
                	?>
                    <div class="thumbnail">
                        <img src="{{ $photo_file }}" alt="{{ $teacher->education }}"/>
                    </div>
                </div>
                <div class="user_heading_content">
                    <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate">{{ $teacher->name }}</span><span class="sub-heading">{{ $teacher->education }}</span></h2>
                    <ul class="user_stats">
                        <li>
                            <h4 class="heading_a">{{ $count_assignment }} <span class="sub-heading">Tugas</span></h4>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="user_content">
                <ul id="user_profile_tabs" class="uk-tab" data-uk-tab="{connect:'#user_profile_tabs_content', animation:'slide-horizontal'}" data-uk-sticky="{ top: 48, media: 960 }">
                    <li class="uk-active"><a href="#">Profile</a></li>
                    <li><a href="#">Tugas</a></li>
                    <li><a href="#">Ganti Kata Sandi</a></li>
                </ul>
                <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                    <li>
                        <div class="uk-grid uk-margin-medium-top uk-margin-large-bottom" data-uk-grid-margin>
                            <div class="uk-width-large-1-2">
                                <h4 class="heading_c uk-margin-small-bottom">Contact Info</h4>
                                <ul class="md-list md-list-addon">
                                    <li>
                                        <div class="md-list-addon-element">
                                            <i class="md-list-addon-icon material-icons">&#xE158;</i>
                                        </div>
                                        <div class="md-list-content">
                                            <span class="md-list-heading">Nomor Induk</span>
                                            <span class="uk-text-small uk-text-muted">{{ $teacher->code }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-addon-element">
                                            <i class="md-list-addon-icon material-icons">perm_phone_msg</i>
                                        </div>
                                        <div class="md-list-content">
                                            <span class="md-list-heading">Alamat</span>
                                            <span class="uk-text-small uk-text-muted">{{ $teacher->address }}</span>
                                        </div>
                                    </li>
                                    <li>
                                    	<?php
                                    		$gender = $teacher->gender;
                                    		if($gender == 1){
            								                $gender = 'Laki-laki';
            								            } else {
            								                $gender= 'Perempuan';
            								            }
                                    	?>
                                        <div class="md-list-addon-element">
                                        	<i class="md-list-addon-icon material-icons">face</i>
                                        </div>
                                        <div class="md-list-content">
                                            <span class="md-list-heading">Kelamin</span>
                                            {!! $gender !!}
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-addon-element">
                                            <i class="md-list-addon-icon material-icons">cast_for_education</i>
                                        </div>
                                        <div class="md-list-content">
                                            <span class="md-list-heading">Edukasi</span>
                                            <span class="uk-text-small uk-text-muted">{{ $teacher->education }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="uk-width-large-1-2">
                                <h4 class="heading_c uk-margin-small-bottom">Jadwal Mengajar</h4>
                                <table id="data_table" class="uk-table" cellspacing="0" width="100%">
                                  <thead>
                                    <tr>
                                      <th class="number-order">No.</th>
                                      <th>Mata Pelajaran</th>
                                      <th>Waktu</th>
                                    </tr>
                                  </thead>
                                  <tfoot>
                                    <tr>
                                      <th class="number-order">No.</th>
                                      <th>Mata Pelajaran</th>
                                      <th>Waktu</th>
                                    </tr>
                                  </tfoot>
                                  <tbody>
                                  <?php 
                                    if(!empty($schedule_teacher)){
                                      foreach ($schedule_teacher as $key => $schedule) {
                                  ?>
                                    <tr>
                                      <td>{{ $key+1 }}</td>
                                      <td>{{ $schedule->subject_name }}</td>
                                      <td>{{ $schedule->subject_day_time }}</td>
                                    </tr>
                                      <?php } ?>
                                    <?php } ?>
                                  </tbody>
                                </table>
                            </div>
                        </div>
                    </li>
                    <li>
                        <ul class="md-list">
                        @foreach($assignment_students as $assignment)
                            <li>
                                <div class="md-list-content">
                                    <span class="md-list-heading"><a href="{{ asset($assignment->assignment_file) }}" target="_blank">{{ $assignment->name }}.</a></span>
                                    <div class="uk-margin-small-top">
                                        <span class="uk-margin-right">
                                            <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">Mulai tugas {{ date('d F Y', strtotime($assignment->start_assignment)) }}</span>
                                        </span>
                                        <span class="uk-margin-right">
                                            <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">Akhir tugas {{ date('d F Y', strtotime($assignment->end_assignment)) }}</span>
                                        </span>
                                        <span class="uk-margin-right">
                                            <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">{{ $assignment->class_name }}</span>
                                        </span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    </li>
                    <li>
                        <ul class="md-list">
                            <li>
                                <div class="md-list-content">
                                <form class="form_input_password" method="POST" name="formpassword" id="form_validation">
                                  <input type="hidden" name="_method" id="method" value="POST">
                                  <input type="hidden" name="id" id="id" value="{{ \Auth::user('teacher')->id }}">
                                  <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-2 uk-margin-top">
                                      <label>Kata sandi</label>
                                      <br>
                                      <input type="password" name="password" pattern="^\S{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimal kata sandi 8 karakter' : ''); if(this.checkValidity()) form.repassword.pattern = this.value;" class="md-input label-fixed" id="password" required="required"/>
                                    </div>
                                    <div class="uk-width-medium-1-2 uk-margin-top">
                                      <label>Konfirmasi Kata sandi</label>
                                      <br>
                                       <input required type="password" name="repassword" pattern="^\S{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Masukkan kata sandi yang sama seperti diatas' : '');" class="md-input label-fixed" id="repassword" required="required">
                                    </div>
                                  </div>
                                  <div class="uk-width-medium-1-1 uk-margin-top">
                                   <div class="uk-form-row">
                                     <span class="uk-input-group-addon" id="input_submit_type">
                                      <input id="save_item" type="submit" value="SAVE" class="md-btn md-btn-primary change_password">
                                     </span>
                                   </div>
                                  </div>
                                </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- common functions -->
<script src="{{ asset('templates/js/common.min.js') }}"></script>
<!-- uikit functions -->
<script src="{{ asset('templates/js/uikit_custom.min.js') }}"></script>
<!-- altair common functions/helpers -->
<script src="{{ asset('templates/js/altair_admin_common.min.js') }}"></script>
<!-- datatable -->
<script src="{{ asset('bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('templates/js/custom/datatables/datatables.uikit.min.js') }}"></script>
<script src="{{ asset('templates/js/pages/plugins_datatables.min.js') }}"></script>
<!-- page specific plugins -->
<script src="{{ asset('templates/js/pages/full_numbers_no_ellipses.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#data_table').DataTable({
          'pagingType': 'full_numbers_no_ellipses',
        });
    });
    $(".change_password").click(function(event) {
      $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        },
        url: "{{ route('teachers.change.password') }}",
        data: $('.form_input_password').serialize(),
        dataType: 'JSON',
        cache: false,
        beforeSend: function(){
            altair_helpers.content_preloader_show('md');
        },
        success: function(result) {
          $('.form_input_password')[0].reset();
          altair_helpers.content_preloader_hide();
          if(result.status=='success'){
            UIkit.notify({
              message: result.msg,
              status: result.status,
              timeout: 8000,
              pos: 'top-center'
            });
          } else {
            UIkit.notify({
              message: result.msg,
              status: result.status,
              timeout: 10000,
              pos: 'top-center'
            });
          }
        },
        error: function (result) {
          var response = JSON.parse(result.responseText)
          $.each(response.errors, function (key, value) {
              UIkit.notify({
              message: value,
              status: 'warning',
              timeout: 10000,
              pos: 'top-center'
            });
          });
          altair_helpers.content_preloader_hide();
        }
      });
      event.preventDefault(); 
    });
</script>
@endsection