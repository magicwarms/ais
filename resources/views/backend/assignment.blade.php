@extends('layouts.baselayout')

@section('css')
	<!-- common css / default css -->
    <link rel="stylesheet" href="{{ asset('bower_components/uikit/css/uikit.almost-flat.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('templates/css/main.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('templates/css/custom-admin.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('templates/css/themes/themes_combined.min.css') }}" media="all">
@endsection

@section('content')
<div class="uk-width-medium-1-1">
	<h4 class="heading_a uk-margin-bottom">Buat Data Tugas Siswa Baru</h4>
	<div class="md-card">
	  <div class="md-card-content">
	    <ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#tabs_4'}">
        <li class="uk-width-1-2" id="list-tab"><a href="#" class="list_assignment">List Tugas Siswa</a></li>
        <li class="uk-width-1-2" id="form-tab"><a href="#" class="form_assignment">Form Tugas Siswa</a></li>
	    </ul>
	    <ul id="tabs_4" class="uk-switcher uk-margin">
	      <li>
	        <table id="data_table" class="uk-table" cellspacing="0" width="100%">
	          <thead>
	            <tr>
	              <th class="number-order">No.</th>
                <th>File Tugas</th>
                <th>Judul</th>
                <th>Kelas</th>
                <th>Mata Pelajaran</th>
                <th>Mulai</th>
                <th>Akhir</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Created</th>
                <th>Updated</th>
                <th class="action-order">Action</th>
	            </tr>
	          </thead>
	          <tfoot>
	            <tr>
	              <th class="number-order">No.</th>
                <th>File Tugas</th>
                <th>Judul</th>
                <th>Kelas</th>
                <th>Mata Pelajaran</th>
                <th>Mulai</th>
                <th>Akhir</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Created</th>
                <th>Updated</th>
                <th class="action-order">Action</th>
	            </tr>
	          </tfoot>
	          <tbody></tbody>
          </table>
        </li>
				<li>
        <h3 class="heading_a uk-margin-bottom">Buat data baru atau Perbaharui data</h3>
        <form class="form_input_assignment" name="formassignment" id="form_validation" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id">
          <input type="hidden" name="method" id="method" value="POST">
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
              <div class="md-card">
                <div class="md-card-content" id="file_assignment">
                    <input type="file" id="assignment_file" class="md-input" name="assignment_file" accept="application/msword, application/pdf, image/png, image/jpg, image/jpeg, application/vnd.ms-excel, application/vnd.ms-powerpoint">
                    <p class="uk-text-danger uk-text-italic">Maksimal File 2MB</p>
                </div>
              </div>
            </div>
          </div>
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <label>Judul Tugas</label>
              <br>
              <input type="text" class="md-input label-fixed" name="name" id="name" required/>
            </div>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <label>Kelas</label>
              <br>
              {{ Form::select('class_id', $classes, null, array('class' =>'md-input', 'placeholder' => 'Pilih Kelas', 'id' => 'class_id','required')) }}
            </div>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <label>Mata Pelajaran</label>
              <br>
              {{ Form::select('subjects_id', $subjects, null, array('class' =>'md-input', 'placeholder' => 'Pilih Mata Pelajaran', 'id' => 'subjects_id','required')) }}
            </div>
          </div>
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <div class="uk-input-group">
                  <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                  <label for="uk_dp_start">Mulai Tugas</label>
                  <input class="md-input start_assignment" name="start_assignment" type="text" id="uk_dp_start">
              </div>
            </div>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <div class="uk-input-group">
                  <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                  <label for="uk_dp_end">Habis Tugas</label>
                  <input class="md-input end_assignment" name="end_assignment" type="text" id="uk_dp_end">
              </div>
            </div>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <div class="parsley-row">
                <input class="status_assignment" type="checkbox" name="status">
                <label for="switch_demo_large" class="inline-label"><b>Aktifkan Tugas</b></label>
              </div>
            </div>
          </div>
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
              <label>Keterangan</label>
              <br>
              <textarea cols="30" rows="4" name="remark" id="remark" class="md-input label-fixed"></textarea>
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
    <!--  forms advanced functions -->
    <script src="{{ asset('bower_components/ion.rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('templates/js/pages/forms_advanced.min.js') }}"></script>
    <script type="text/javascript">
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
                url:  "{{ route('teacher.assignment.show') }}",
                data: { '_token' : '{{ csrf_token() }}'},
                type: 'POST',
            },
            columns: [
                { data: 'DT_Row_Index', searchable: false, "width": "15px", "className": "text-center"},
                { data: 'assignment_file'},
                { data: 'name'},
                { data: 'class_name'},
                { data: 'subjects_name'},
                { data: 'start_assignment'},
                { data: 'end_assignment'},
                { data: 'remark'},
                { data: 'status'},
                { data: 'created_date'},
                { data: 'updated_date'},
                { data: 'action', name: 'action', orderable: false, searchable: false, "width": "25px", "className": "text-center" },
            ],
        });

        $(".form_input_assignment").on('submit',function() {
          var method = $('input#method').val();
          var url_action;
          if(method == 'POST'){
            url_action = "{{ route('teacher.assignment.store') }}";
          } else {
            url_action = "{{ route('teacher.assignment.update') }}";
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
              $("#file_assignment").html('<input type="file" id="assignment_file" class="md-input" name="assignment_file" accept="application/msword, application/pdf, image/png, image/jpg, image/jpeg, application/vnd.ms-excel, application/vnd.ms-powerpoint">')
              $('input#method').val('POST');
              $('.form_input_assignment')[0].reset();
              $('#data_table').DataTable().ajax.reload();
              altair_helpers.content_preloader_hide();
              $("#form-tab").removeClass("uk-active")
              $('.list_assignment')[0].click();
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
              url: APP_URL + "/assignment/edit/"+id,
              method:'GET',
              dataType:'json',
              beforeSend: function(){
                altair_helpers.content_preloader_show('md');
              },
              success:function(data) {
                $('input#method').val('PUT');
                $("#form-tab").addClass("uk-active");
                $('.form_assignment')[0].click();
                $("#list-tab").removeClass("uk-active");
                $('#input_submit_type').html('<input id="update_item" type="submit" value="UPDATE" class="md-btn md-btn-primary">');
                if(data.assignment_file != ''){
                  $("#file_assignment").html('<div class="uk-margin-bottom uk-text-center uk-position-relative"><a href="#" class="uk-modal-close uk-close uk-close-alt uk-position-absolute" onclick="delete_assignment_file_teacher('+id+')"></a><a href="'+data.assignment_file+'" target="_blank"><i class="material-icons md-24">content_copy</i>Filename: "'+data.name+'"</a></div>')
                } else {
                  $("#file_assignment").html('<input type="file" id="assignment_file" class="md-input" name="assignment_file" accept="application/msword, application/pdf, image/png, image/jpg, image/jpeg, application/vnd.ms-excel, application/vnd.ms-powerpoint">')
                }
                $('input#id').val(id);
                $('input#name').val(data.name);
                $('select#class_id').val(data.class_id);
                $('select#subjects_id').val(data.subjects_id);
                $('textarea#address').val(data.address);
                $('.start_assignment').val(data.start_assignment);
                $('.end_assignment').val(data.end_assignment);
                $('textarea#remark').val(data.remark);
                $('input#assignment_file').val(data.assignment_file);
                $('.status_assignment')[0].checked = data.status;
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
            url: "{{ route('teacher.assignment.delete') }}",
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
      function delete_assignment_file_teacher(assignment_id){
        var APP_URL = {!! json_encode(url('/')) !!}
        $.ajax({
            method: 'GET',
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}'
            },
            url: APP_URL + "/assignment/delete_file_assignment/"+assignment_id,
            dataType: 'JSON',
            cache: false,
            beforeSend: function(){
                altair_helpers.content_preloader_show('md');
            },
            success: function(result) {
                $('#data_table').DataTable().ajax.reload();
                $("#file_assignment").html('<input type="file" id="assignment_file" class="md-input" name="assignment_file" accept="application/msword, application/pdf, image/png, image/jpg, image/jpeg, application/vnd.ms-excel, application/vnd.ms-powerpoint">')
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