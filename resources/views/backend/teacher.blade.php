@extends('layouts.baselayout')

@section('css')
	<!-- common css / default css -->
    <link rel="stylesheet" href="{{ asset('bower_components/uikit/css/uikit.almost-flat.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('templates/css/main.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('templates/css/themes/themes_combined.min.css') }}" media="all">
@endsection

@section('content')
<div class="uk-width-medium-1-1">
	<h4 class="heading_a uk-margin-bottom">Buat Data Guru Baru</h4>
	<div class="md-card">
	  <div class="md-card-content">
	    <ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#tabs_4'}">
        <li class="uk-width-1-2" id="list-tab"><a href="#" class="list_teacher">List Guru</a></li>
        <li class="uk-width-1-2" id="form-tab"><a href="#" class="form_teacher">Form Guru</a></li>
	    </ul>
	    <ul id="tabs_4" class="uk-switcher uk-margin">
	      <li>
	        <table id="data_table" class="uk-table" cellspacing="0" width="100%">
	          <thead>
	            <tr>
	              <th class="number-order">No.</th>
                <th>Profile</th>
                <th>Nama</th>
	              <th>Kode</th>
                <th>Alamat</th>
	              <th>Edukasi</th>
                <th>Status</th>
                <th>Created</th>
	              <th>Updated</th>
                <th class="action-order">Action</th>
	              <th class="action-order">Sandi</th>
	            </tr>
	          </thead>
	          <tfoot>
	            <tr>
	              <th class="number-order">No.</th>
                <th>Profile</th>
                <th>Nama</th>
                <th>Kode</th>
                <th>Alamat</th>
                <th>Edukasi</th>
                <th>Status</th>
                <th>Created</th>
                <th>Updated</th>
                <th class="action-order">Action</th>
                <th class="action-order">Sandi</th>
	            </tr>
	          </tfoot>
	          <tbody></tbody>
          </table>
        </li>
				<li>
        <h3 class="heading_a uk-margin-bottom">Buat data baru atau Perbaharui data</h3>
        <form class="form_input_teacher" name="formteacher" id="form_validation" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id">
          <input type="hidden" name="method" id="method" value="POST">
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
              <div class="md-card">
                <div class="md-card-content" id="profile_picture_teacher">
                    <input type="file" id="photo_file" class="md-input" name="photo_file" accept="image/png, image/jpg, image/jpeg">
                </div>
              </div>
            </div>
          </div>
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-4 uk-margin-top">
              <label>Nama Guru</label>
              <br>
              <input type="text" class="md-input label-fixed" name="name" id="name" required/>
            </div>
            <div class="uk-width-medium-1-4 uk-margin-top">
              <label>Kode</label>
              <br>
              <input type="text" class="md-input label-fixed" name="code" id="code" required/>
            </div>
            <div class="uk-width-medium-1-4 uk-margin-top">
              <div class="uk-input-group">
                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                <label for="birthday">Tanggal Lahir</label>
                <br>
                <input class="md-input" type="text" name="birthday" id="birthday" data-uk-datepicker="{pos:'bottom', format:'DD.MM.YYYY'}">
              </div>
            </div>
            <div class="uk-width-medium-1-4 uk-margin-top">
              <div id="teacher_password">
              <label>Kata sandi</label>
              <br>
              <input type="password" class="md-input label-fixed" name="password" id="password" required/>
              </div>
            </div>
          </div>
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <label>Kelamin</label>
              <br>
              <select id="gender" name="gender" class="md-input" required="required">
                  <option value="" disabled="disabled">Pilih Jenis Kelamin</option>
                  <option value="1">Laki-laki</option>
                  <option value="2">Perempuan</option>
              </select>
            </div>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <label>Edukasi</label>
              <br>
              <input type="text" class="md-input label-fixed" name="education" id="education" required/>
            </div>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <div class="parsley-row">
                <input class="status_teacher" type="checkbox" name="status">
                <label for="switch_demo_large" class="inline-label"><b>Aktifkan Guru</b></label>
              </div>
            </div>
          </div>
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
              <label>Alamat</label>
              <br>
              <textarea cols="30" rows="4" name="address" id="address" class="md-input label-fixed"></textarea>
            </div>
          </div>
          <div class="uk-width-medium-1-1 uk-margin-top">
           <div class="uk-form-row">
             <span class="uk-input-group-addon" id="input_submit_type">
              <input id="save_item" type="submit" value="SAVE" class="md-btn md-btn-primary">
             </span>
           </div>
          </div>
				</form>
				</li>
	 		</ul>
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
    <!-- parsley (validation) -->
    <script>
    // load parsley config (altair_admin_common.js)
    altair_forms.parsley_validation_config();
    </script>
    <script src="{{ asset('bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <!--  forms validation functions -->
    <script src="{{ asset('templates/js/pages/forms_validation.min.js') }}"></script>
    <script src="{{ asset('templates/js/pages/components_preloaders.min.js') }}"></script>
    <!-- MODAL RESET PASSWORD USER -->
    <div class="uk-modal" id="teacherID">
        <div class="uk-modal-dialog">
            <form method="POST" class="uk-form-stacked form-change-password">
            <div class="uk-modal-header">
                <h3 class="uk-modal-title">Rubah kata sandi</h3>
            </div>
          <input type="hidden" id="teacher_id" name="id">
            <div class="uk-form-row uk-margin-top">
                <label>Sandi Baru</label>
                <input required type="password" pattern="^\S{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimal kata sandi 8 karakter' : ''); if(this.checkValidity()) form.repassword.pattern = this.value;" class="md-input label-fixed" id="password_change" name="password">
            </div>
            <div class="uk-text uk-text-danger uk-margin-bottom"><h6><i>*Minimal 8 Karakter</i></h6></div>
            <div class="uk-form-row uk-margin-top">
                <label>Konfirmasi Sandi Baru</label>
                 <input required type="password" pattern="^\S{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Masukkan kata sandi yang sama seperti diatas' : '');" class="md-input label-fixed" id="repassword" name="repassword">
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button type="button" class="md-btn md-btn-flat uk-modal-close">Tutup</button>
                <input type="submit" value="SAVE" class="md-btn md-btn-danger change_password" id="show_preloader_md">
            </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).on("click", ".md-btn2", function () {
            var teacherID = $(this).data('id');
            $("#teacher_id").val(teacherID);
        });
        $(".change_password").click(function(event) {
          $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            url: "{{ route('teacher.change.password') }}",
            data: $('.form-change-password').serialize(),
            dataType: 'JSON',
            cache: false,
            beforeSend: function(){
                altair_helpers.content_preloader_show('md');
            },
            success: function(result) {
              $('.form-change-password')[0].reset();
              $('#data_table').DataTable().ajax.reload();
              hide_modal_form_password();
              altair_helpers.content_preloader_hide();
              if(result.status=='success'){
                UIkit.notify({
                  message: result.msg,
                  status: 'success',
                  timeout: 8000,
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
        function hide_modal_form_password() {
            UIkit.modal("#teacherID").hide();
        }
        $(document).ready(function(){
        var dt = $('#data_table').DataTable({
            orderCellsTop: true,
            responsive: true,
            processing: true,
            serverside: true,
            scrollX: true,
            searching: true,
            "autoWidth": true,
            lengthMenu: [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
            ajax: {
                url:  "{{ route('teacher.show') }}",
                data: { '_token' : '{{ csrf_token() }}'},
                type: 'POST',
            },
            columns: [
                { data: 'DT_Row_Index', searchable: false, "width": "15px", "className": "text-center"},
                { data: 'photo_file'},
                { data: 'name'},
                { data: 'code'},
                { data: 'address'},
                { data: 'education'},
                { data: 'status'},
                { data: 'created_date'},
                { data: 'updated_date'},
                { data: 'action', name: 'action', orderable: false, searchable: false, "width": "25px", "className": "text-center" },
                { data: 'sandi', name: 'sandi', orderable: false, searchable: false, "width": "25px", "className": "text-center" },
            ],
        });

        $(".form_input_teacher").on('submit',function() {
          var method = $('input#method').val();
          var url_action;
          if(method == 'POST'){
            url_action = "{{ route('teacher.store') }}";
          } else {
            url_action = "{{ route('teacher.update') }}";
          }
          $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            url: url_action,
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData($(this)[0]),
            dataType: 'JSON',
            beforeSend: function(){
                altair_helpers.content_preloader_show('md');
            },
            success: function(result) {
              $('input#id').val('');
              $('#input_submit_type').html('<input id="save_item" type="submit" value="SAVE" class="md-btn md-btn-primary">');
              $("#profile_picture_teacher").html('<input type="file" id="photo_file" class="md-input" name="photo_file" accept="image/png, image/jpg, image/jpeg">')
              $('input#method').val('POST');
              $("#teacher_password").show();
              $('.form_input_teacher')[0].reset();
              $('#data_table').DataTable().ajax.reload();
              altair_helpers.content_preloader_hide();
              $("#form-tab").removeClass("uk-active")
              $('.list_teacher')[0].click();
              $("#list-tab").addClass("uk-active")
              if(result.status=='success'){
                UIkit.notify({
                  message: result.msg,
                  status: 'success',
                  timeout: 8000,
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

        $(document).on('click', '.edit_data', function (e) {
          var id = $(this).data('id');
          UIkit.modal.confirm("Apakah kamu yakin akan mengubah data ini?", function(){
            var APP_URL = {!! json_encode(url('/')) !!}
            $.ajax({
              url: APP_URL + "/teacher/edit/"+id,
              method:'GET',
              dataType:'json',
              beforeSend: function(){
                altair_helpers.content_preloader_show('md');
              },
              success:function(data) {
                $('input#method').val('PUT');
                $("#form-tab").addClass("uk-active");
                $('.form_teacher')[0].click();
                $("#list-tab").removeClass("uk-active");
                $('#input_submit_type').html('<input id="update_item" type="submit" value="UPDATE" class="md-btn md-btn-primary">');
                $("#teacher_password").hide();
                if(data.photo_file != ''){
                  $("#profile_picture_teacher").html('<div class="uk-margin-bottom uk-text-center uk-position-relative"><a href="#" class="uk-modal-close uk-close uk-close-alt uk-position-absolute" onclick="delete_photo_file_teacher('+id+')"></a><img src="storage/'+data.photo_file+'" alt="'+data.name+'" class="img_medium"/></div>')
                } else {
                  $("#profile_picture_teacher").html('<input type="file" id="photo_file" class="md-input" name="photo_file" accept="image/png, image/jpg, image/jpeg">')
                }
                $('input#name').val(data.name);
                $('textarea#address').val(data.address);
                $('input#birthday').val(data.birthday);
                $('input#id').val(id);
                $('input#code').val(data.code);
                $('select#gender').val(data.gender);
                $('input#education').val(data.education);
                $('input#photo_file').val(data.photo_file);
                $('.status_teacher')[0].checked = data.status;
                altair_helpers.content_preloader_hide();
              }
            }) 
          });
          e.preventDefault(); 
        });
      });
      function delete_data(id){
        UIkit.modal.confirm("Apakah kamu yakin akan menghapus data ini?", function(){  
          $.ajax({
            method: 'DELETE',
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}'
            },
            url: "{{ route('teacher.delete') }}",
            dataType: 'JSON',
            cache: false,
            data: {id: id},
            beforeSend: function(){
                altair_helpers.content_preloader_show('md');
            },
            success: function(result) {
              $('#data_table').DataTable().ajax.reload();
              altair_helpers.content_preloader_hide();
              if(result.status=='success'){
                UIkit.notify({
                    message: result.msg,
                    status: 'success',
                    timeout: 8000,
                    pos: 'top-center'
                });
              } else  {
                UIkit.notify({
                    message: result.msg,
                    status: 'danger',
                    timeout: 8000,
                    pos: 'top-center'
                });
              }
            }
          });
        });
      }
      function delete_photo_file_teacher(teacher_id){
        var APP_URL = {!! json_encode(url('/')) !!}
        $.ajax({
            method: 'GET',
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}'
            },
            url: APP_URL + "/teacher/delete_profile_picture/"+teacher_id,
            dataType: 'JSON',
            cache: false,
            beforeSend: function(){
                altair_helpers.content_preloader_show('md');
            },
            success: function(result) {
                $('#data_table').DataTable().ajax.reload();
                $("#profile_picture_teacher").html('<input type="file" id="photo_file" class="md-input" name="photo_file" accept="image/png, image/jpg, image/jpeg">')
                altair_helpers.content_preloader_hide();
                if(result.status=='success'){
                    UIkit.notify({
                        message: result.msg,
                        status: 'success',
                        timeout: 8000,
                        pos: 'top-center'
                    });
                } else  {
                    UIkit.notify({
                        message: result.msg,
                        status: 'danger',
                        timeout: 8000,
                        pos: 'top-center'
                    });
                }
            }
        });
      }
    </script>
@endsection