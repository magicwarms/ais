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
	<h4 class="heading_a uk-margin-bottom">Beri Nilai Tugas Siswa</h4>
	<div class="md-card">
	  <div class="md-card-content">
	    <ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#tabs_4'}">
        <li class="uk-width-1-1" id="list-tab"><a href="#" class="list_score">List Nilai/Tugas Siswa</a></li>
	    </ul>
	    <ul id="tabs_4" class="uk-switcher uk-margin">
	      <li>
	        <table id="data_table" class="uk-table" cellspacing="0" width="100%">
	          <thead>
	            <tr>
	              <th class="number-order">No.</th>
                <th>File Tugas</th>
                <th>Judul Tugas</th>
                <th>Kelas</th>
                <th>MaPel</th>
                <th>Siswa</th>
                <th>Ket.</th>
                <th>Nilai</th>
                <th>Created</th>
                <th>Updated</th>
                <th class="action-order">Action</th>
	            </tr>
	          </thead>
	          <tfoot>
	            <tr>
                <th class="number-order">No.</th>
                <th>File Tugas</th>
                <th>Judul Tugas</th>
                <th>Kelas</th>
                <th>MaPel</th>
                <th>Siswa</th>
                <th>Ket.</th>
                <th>Nilai</th>
                <th>Created</th>
                <th>Updated</th>
                <th class="action-order">Action</th>
              </tr>
	          </tfoot>
	          <tbody></tbody>
          </table>
        </li>
	 		</ul>
		</div>
	</div>
</div>
<div class="uk-modal" id="input_score">
  <div class="uk-modal-dialog" style="width: 1000px">
      <form class="uk-form-stacked form_upload_score" enctype="multipart/form-data" id="form_validation">
      <div class="uk-modal-header">
          <h3 class="uk-modal-title">Beri nilai tugas</h3>
      </div>
      <input type="hidden" name="_method" id="method" value="PUT">
      <input type="hidden" id="id" name="id">
      <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-medium-1-1">
          <div class="md-card">
            <div class="md-card-content" id="file_assignment"></div>
          </div>
        </div>
      </div>
      <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-medium-1-1">
          <label>Keterangan</label>
          <br>
          <textarea id="remark" cols="30" rows="4" class="md-input label-fixed"></textarea>
        </div>
      </div>
      <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-medium-1-1">
          <label>Nilai</label>
          <br>
          <input type="number" name="score" required="required" id="score" class="md-input label-fixed">
        </div>
      </div>
      <div class="uk-modal-footer uk-text-right">
          <button type="button" class="md-btn md-btn-wave waves-effect waves-button uk-modal-close uk-modal-close">Tutup</button>
          <input type="submit" value="UPDATE" class="md-btn md-btn-danger" id="show_preloader_md">
      </div>
      </form>
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
                url:  "{{ route('assignment.show.score') }}",
                data: { '_token' : '{{ csrf_token() }}'},
                type: 'POST',
            },
            columns: [
                { data: 'DT_Row_Index', searchable: false, "width": "15px", "className": "text-center"},
                { data: 'assignment_file'},
                { data: 'name'},
                { data: 'class_name'},
                { data: 'subjects_name'},
                { data: 'student_name'},
                { data: 'remark'},
                { data: 'score'},
                { data: 'created_date'},
                { data: 'updated_date'},
                { data: 'action', name: 'action', orderable: false, searchable: false, "width": "25px", "className": "text-center" },
            ],
        });

        $(document).on('click', '.edit_data', function (e) {
          var id = $(this).data('id');
          var APP_URL = {!! json_encode(url('/')) !!}
          $.ajax({
            url: APP_URL + "/assignment/edit_score_upload/"+id,
            method:'GET',
            dataType:'json',
            beforeSend: function(){
              altair_helpers.content_preloader_show('md');
            },
            success:function(data) {
              $("#file_assignment").html(data.assignment_file)
              $('input#id').val(id);
              $('textarea#remark').val(data.remark);
              show_modal_score();
              altair_helpers.content_preloader_hide();
            }
          })
          e.preventDefault(); 
        });

        $(".form_upload_score").on('submit',function() {
          $.ajax({
            type: 'PUT',
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            url: "{{ route('assignment.update.score') }}",
            data: $(this).serialize(),
            dataType: 'JSON',
            beforeSend: function(){
                altair_helpers.content_preloader_show('md');
            },
            success: function(result) {
              hide_modal_score();
              $('#data_table').DataTable().ajax.reload();
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
      });
      function show_modal_score() {
        UIkit.modal("#input_score").show();
      }
      function hide_modal_score() {
        UIkit.modal("#input_score").hide();
      }
    </script>
@endsection