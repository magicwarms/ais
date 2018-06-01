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
	<h4 class="heading_a uk-margin-bottom">Buat Data Event Baru</h4>
	<div class="md-card">
	  <div class="md-card-content">
	    <ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#tabs_4'}">
        <li class="uk-width-1-2" id="list-tab"><a href="#" class="list_event">List Event</a></li>
        <li class="uk-width-1-2" id="form-tab"><a href="#" class="form_event">Form Event</a></li>
	    </ul>
	    <ul id="tabs_4" class="uk-switcher uk-margin">
	      <li>
	        <table id="data_table" class="uk-table" cellspacing="0" width="100%">
	          <thead>
	            <tr>
	              <th class="number-order">No.</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Mulai</th>
	              <th>Akhir</th>
                <th>Deskripsi</th>
                <th>Created</th>
	              <th>Updated</th>
                <th class="action-order">Action</th>
	            </tr>
	          </thead>
	          <tfoot>
	            <tr>
	              <th class="number-order">No.</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Mulai</th>
                <th>Akhir</th>
                <th>Deskripsi</th>
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
        <form class="form_input_event" name="formevent" id="form_validation" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id">
          <input type="hidden" name="method" id="method" value="POST">
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
              <div class="md-card">
                <div class="md-card-content" id="file_event">
                    <input type="file" id="event_file" class="md-input" name="event_file" accept="image/png, image/jpg, image/jpeg">
                </div>
              </div>
            </div>
          </div>
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <label>Judul</label>
              <br>
              <input type="text" class="md-input label-fixed" name="title" id="title" required/>
            </div>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <div class="uk-input-group">
                  <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                  <label for="uk_dp_start">Mulai</label>
                  <input class="md-input start_event" name="start_event" type="text" id="uk_dp_start">
              </div>
            </div>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <div class="uk-input-group">
                  <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                  <label for="uk_dp_end">Habis</label>
                  <input class="md-input end_event" name="end_event" type="text" id="uk_dp_end">
              </div>
            </div>
          </div>
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
              <label>Deskripsi</label>
              <br>
              <textarea cols="30" rows="4" name="description" id="description" class="md-input label-fixed"></textarea>
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
            lengthMenu: [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],\
            'pagingType': 'full_numbers_no_ellipses',
            ajax: {
                url:  "{{ route('event.show') }}",
                data: { '_token' : '{{ csrf_token() }}'},
                type: 'POST',
            },
            columns: [
                { data: 'DT_Row_Index', searchable: false, "width": "15px", "className": "text-center"},
                { data: 'event_file'},
                { data: 'title'},
                { data: 'start_event'},
                { data: 'end_event'},
                { data: 'description'},
                { data: 'created_date'},
                { data: 'updated_date'},
                { data: 'action', name: 'action', orderable: false, searchable: false, "width": "25px", "className": "text-center" },
            ],
        });

        $(".form_input_event").on('submit',function() {
          var method = $('input#method').val();
          var url_action;
          if(method == 'POST'){
            url_action = "{{ route('event.store') }}";
          } else {
            url_action = "{{ route('event.update') }}";
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
              $("#file_event").html('<input type="file" id="event_file" class="md-input" name="event_file" accept="image/png, image/jpg, image/jpeg">')
              $('input#method').val('POST');
              $('.form_input_event')[0].reset();
              $('#data_table').DataTable().ajax.reload();
              altair_helpers.content_preloader_hide();
              $("#form-tab").removeClass("uk-active")
              $('.list_event')[0].click();
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
              url: APP_URL + "/event/edit/"+id,
              method:'GET',
              dataType:'json',
              beforeSend: function(){
                altair_helpers.content_preloader_show('md');
              },
              success:function(data) {
                $('input#method').val('PUT');
                $("#form-tab").addClass("uk-active");
                $('.form_event')[0].click();
                $("#list-tab").removeClass("uk-active");
                $('#input_submit_type').html('<input id="update_item" type="submit" value="UPDATE" class="md-btn md-btn-primary">');
                if(data.event_file != ''){
                  $("#file_event").html('<div class="uk-margin-bottom uk-text-center uk-position-relative"><a href="#" class="uk-modal-close uk-close uk-close-alt uk-position-absolute" onclick="delete_file_event('+id+')"></a><img src="storage/'+data.event_file+'" alt="'+data.title+'" class="img_medium"/></div>')
                } else {
                  $("#file_event").html('<input type="file" id="event_file" class="md-input" name="event_file" accept="image/png, image/jpg, image/jpeg">')
                }
                $('input#title').val(data.title);
                $('textarea#description').val(data.description);
                $('.start_event').val(data.start_event);
                $('.end_event').val(data.end_event);
                $('input#id').val(id);
                $('input#event_file').val(data.event_file);
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
            url: "{{ route('event.delete') }}",
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
      function delete_file_event(event_id){
        var APP_URL = {!! json_encode(url('/')) !!}
        $.ajax({
            method: 'GET',
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}'
            },
            url: APP_URL + "/event/delete_file_event/"+event_id,
            dataType: 'JSON',
            cache: false,
            beforeSend: function(){
                altair_helpers.content_preloader_show('md');
            },
            success: function(result) {
                $('#data_table').DataTable().ajax.reload();
                $("#file_event").html('<input type="file" id="event_file" class="md-input" name="event_file" accept="image/png, image/jpg, image/jpeg">')
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