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
	<h4 class="heading_a uk-margin-bottom">Buat Data Absen Baru</h4>
	<div class="md-card">
	  <div class="md-card-content">

      <div class="uk-grid" data-uk-grid-margin>
          <div class="uk-width-medium-1-4">
              {{ Form::select('class_id', $classes, null, array('class' => 'md-input', 'data-uk-tooltip' => '{pos:"top"}', 'title' => 'Pilih Kelas', 'id' => 'class_id')) }}
          </div>
          <div class="uk-width-medium-1-4">
              <input class="md-input" name="start_date" type="text" id="start_date" data-uk-datepicker="{format:'DD.MM.YYYY'}" value="{{ date('d.m.Y') }}">
          </div>
          <div class="uk-width-medium-1-4">
              <input class="md-input" name="end_date" type="text" id="end_date" data-uk-datepicker="{format:'DD.MM.YYYY'}" value="{{ date('d.m.Y') }}">
          </div>
      </div>

      <br>
	    <ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#tabs_4'}">
	      <li class="uk-width-1-2" id="list-tab"><a href="#" class="list_absen">List Absen</a></li>
	      <li class="uk-width-1-2" id="form-tab"><a href="#" class="form_absen">Form Absen</a></li>
	    </ul>
	    <ul id="tabs_4" class="uk-switcher uk-margin">
	      <li>
          <div class="dt_tableExport_wrapper"></div>
	        <table id="dt_tableExport_wrapper" class="uk-table" cellspacing="0" width="100%">
	          <thead>
	            <tr>
	              <th class="number-order">No.</th>
	              <th>Siswa</th>
	              <th>Kelas</th>
                <th>Absen</th>
                <th>Keterangan</th>
                <th>Tanggal Absen</th>
	              <th>Updated</th>
	              <th class="action-order">Action</th>
	            </tr>
	          </thead>
	          <tfoot>
	            <tr>
	              <th class="number-order">No.</th>
                <th>Siswa</th>
                <th>Kelas</th>
                <th>Absen</th>
                <th>Keterangan</th>
                <th>Tanggal Absen</th>
                <th>Updated</th>
                <th class="action-order">Action</th>
	            </tr>
	          </tfoot>
	          <tbody></tbody>
          </table>
        </li>
				<li id="form_id">
        <h3 class="heading_a uk-margin-bottom">Buat data baru atau Perbaharui data</h3>
        <form class="form_input_absen" name="formabsen" id="form_validation">
          <input type="hidden" name="id" id="id">
          <input type="hidden" name="_method" id="method" value="POST">
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-2 uk-margin-top">
              <label>Siswa</label>
              <br>
              {{ Form::select('students_id', $students, null, array('class' =>'md-input', 'placeholder' => 'Pilih Siswa', 'id' => 'students_id','required')) }}
            </div>
            <div class="uk-width-medium-1-2 uk-margin-top">
              <label>Absen</label>
              <br>
              <select id="code" name="code" class="md-input" required="required">
                  <option value="" disabled="disabled">Pilih Absen</option>
                  <option value="1">Sakit</option>
                  <option value="2">Izin</option>
                  <option value="3">Tanpa Keterangan</option>
              </select>
            </div>
          </div>
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
              <label>Keterangan</label>
              <br>
              <textarea id="remark" cols="30" rows="4" name="remark" class="md-input label-fixed"></textarea>
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
    <script src="{{ asset('bower_components/datatables-buttons/js/dataTables.buttons.js') }}"></script>
    <script src="{{ asset('templates/js/custom/datatables/buttons.uikit.js') }}"></script>
    <script src="{{ asset('bower_components/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('bower_components/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('bower_components/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('bower_components/datatables-buttons/js/buttons.colVis.js') }}"></script>
    <script src="{{ asset('bower_components/datatables-buttons/js/buttons.html5.js') }}"></script>
    <script src="{{ asset('bower_components/datatables-buttons/js/buttons.print.js') }}"></script>
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
    <script type="text/javascript">
      $(document).ready(function(){
        var APP_URL = {!! json_encode(url('/')) !!}
        var class_id   = $('#class_id').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var dt = $('#dt_tableExport_wrapper').DataTable({
            orderCellsTop: true,
            responsive: true,
            processing: true,
            serverside: true,
            scrollX: true,
            searching: false,
            "autoWidth": true,
            paging: false,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    pageSize: 'A4',
                    exportOptions: {
                      columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
                {
                    extend: 'pdf',
                    orientation: 'potrait',
                    pageSize: 'A4',
                    exportOptions: {
                      columns: [ 0, 1, 2, 3, 4, 5 ]
                    }
                },
            ],
            lengthMenu: [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
            ajax: {
                url:  APP_URL + "/absence/show/"+1+"/"+start_date+"/"+end_date,
                data: { '_token' : '{{ csrf_token() }}'},
                type: 'POST',
            },
            columns: [
                { data: 'DT_Row_Index', searchable: false, "width": "15px", "className": "text-center"},
                { data: 'students_name'},
                { data: 'class_name'},
                { data: 'code'},
                { data: 'remark'},
                { data: 'absent_date'},
                { data: 'updated_date'},
                { data: 'action', name: 'action', orderable: false, searchable: false, "width": "25px", "className": "text-center" },
            ],
        });

        $('#class_id, #start_date, #end_date').change(function(event) {
           altair_helpers.content_preloader_show('md');
           var class_id   = $('#class_id').val();
           var start_date = $('#start_date').val();
           var end_date = $('#end_date').val();
           dt.ajax.url(APP_URL + "/absence/show/"+class_id+"/"+start_date+"/"+end_date).load();
           altair_helpers.content_preloader_hide();
        });

        $(".form_input_absen").on('submit',function() {
          var method = $('input#method').val();
          var url_action;
          if(method == 'POST'){
            url_action = "{{ route('absence.store') }}";
          } else {
            url_action = "{{ route('absence.update') }}";
          }
          $.ajax({
            type: method,
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            url: url_action,
            data: $(this).serialize(),
            dataType: 'JSON',
            cache: false,
            beforeSend: function(){
                altair_helpers.content_preloader_show('md');
            },
            success: function(result) {
              $('input#id').val('');
              $('#input_submit_type').html('<input id="save_item" type="submit" value="SAVE" class="md-btn md-btn-primary">');
              $('input#method').val('POST');
              $('.form_input_absen')[0].reset();
              $('#dt_tableExport_wrapper').DataTable().ajax.reload();
              altair_helpers.content_preloader_hide();
              $("#form-tab").removeClass("uk-active")
              $('.list_absen')[0].click();
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
              url: APP_URL + "/absence/edit/"+id,
              method:'GET',
              dataType:'json',
              beforeSend: function(){
                altair_helpers.content_preloader_show('md');
              },
              success:function(data) {
                $('input#method').val('PUT');
                $("#form-tab").addClass("uk-active");
                $('.form_absen')[0].click();
                $("#list-tab").removeClass("uk-active");
                $('#input_submit_type').html('<input id="update_item" type="submit" value="UPDATE" class="md-btn md-btn-danger">');
                $('input#id').val(id);
                $('select#students_id').val(data.students_id);
                $('select#code').val(data.code);
                $('textarea#remark').val(data.remark);
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
            url: "{{ route('absence.delete') }}",
            dataType: 'JSON',
            cache: false,
            data: {id: id},
            beforeSend: function(){
                altair_helpers.content_preloader_show('md');
            },
            success: function(result) {
              $('#dt_tableExport_wrapper').DataTable().ajax.reload();
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
    </script>
@endsection