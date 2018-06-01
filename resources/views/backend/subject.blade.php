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
	<h4 class="heading_a uk-margin-bottom">Buat Data Mata Pelajaran Baru</h4>
	<div class="md-card">
	  <div class="md-card-content">
	    <ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#tabs_4'}">
	      <li class="uk-width-1-2" id="list-tab"><a href="#" class="list_subject">List Mata Pelajaran</a></li>
	      <li class="uk-width-1-2" id="form-tab"><a href="#" class="form_subject">Form Mata Pelajaran</a></li>
	    </ul>
	    <ul id="tabs_4" class="uk-switcher uk-margin">
	      <li>
	        <table id="data_table" class="uk-table" cellspacing="0" width="100%">
	          <thead>
	            <tr>
	              <th class="number-order">No.</th>
	              <th>Nama</th>
	              <th>Kode</th>
                <th>Status</th>
                <th>Created</th>
	              <th>Updated</th>
	              <th class="action-order">Action</th>
	            </tr>
	          </thead>
	          <tfoot>
	            <tr>
	              <th class="number-order">No.</th>
                <th>Nama</th>
                <th>Kode</th>
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
        <form class="form_input_subject" name="formsubject" id="form_validation">
          <input type="hidden" name="id" id="id">
          <input type="hidden" name="_method" id="method" value="POST">
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <label>Nama</label>
              <br>
              <input type="text" id="name" class="md-input label-fixed" name="name" required/>
            </div>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <label>Kode</label>
              <br>
              <input type="text" id="code" class="md-input label-fixed" name="code" required/>
            </div>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <div class="parsley-row">
                <input class="status_subject" type="checkbox" name="status">
                <label for="switch_demo_large" class="inline-label"><b>Aktifkan Mata Pelajaran</b></label>
              </div>
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
    <script src="{{ asset('templates/js/pages/full_numbers_no_ellipses.js') }}"></script>
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
        var dt = $('#data_table').DataTable({
            orderCellsTop: true,
            responsive: true,
            processing: true,
            serverside: true,
            scrollX: true,
            searching: true,
            "autoWidth": true,
            lengthMenu: [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
            'pagingType': 'full_numbers_no_ellipses',
            ajax: {
                url:  "{{ route('subject.show') }}",
                data: { '_token' : '{{ csrf_token() }}'},
                type: 'POST',
            },
            columns: [
                { data: 'DT_Row_Index', searchable: false, "width": "15px", "className": "text-center"},
                { data: 'name'},
                { data: 'code'},
                { data: 'status'},
                { data: 'created_date'},
                { data: 'updated_date'},
                { data: 'action', name: 'action', orderable: false, searchable: false, "width": "25px", "className": "text-center" },
            ],
        });

        $(".form_input_subject").on('submit',function() {
          var method = $('input#method').val();
          var url_action;
          if(method == 'POST'){
            url_action = "{{ route('subject.store') }}";
          } else {
            url_action = "{{ route('subject.update') }}";
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
              $('.form_input_subject')[0].reset();
              $('#data_table').DataTable().ajax.reload();
              altair_helpers.content_preloader_hide();
              $("#form-tab").removeClass("uk-active")
              $('.list_subject')[0].click();
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
              url: APP_URL + "/subject/edit/"+id,
              method:'GET',
              dataType:'json',
              beforeSend: function(){
                altair_helpers.content_preloader_show('md');
              },
              success:function(data) {
                $('input#method').val('PUT');
                $("#form-tab").addClass("uk-active");
                $('.form_subject')[0].click();
                $("#list-tab").removeClass("uk-active");
                $('#input_submit_type').html('<input id="update_item" type="submit" value="UPDATE" class="md-btn md-btn-danger">');
                $('input#name').val(data.name);
                $('input#id').val(id);
                $('input#code').val(data.code);
                $('.status_subject')[0].checked = data.status;
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
            url: "{{ route('subject.delete') }}",
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
    </script>
@endsection