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
	<h4 class="heading_a uk-margin-bottom">Buat Data Orang Tua Baru</h4>
	<div class="md-card">
	  <div class="md-card-content">
	    <ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#tabs_4'}">
	     <li class="uk-width-1-2" id="list-tab"><a href="#" class="list_parent">List Orang Tua</a></li>
        <li class="uk-width-1-2" id="form-tab"><a href="#" class="form_parent">Form Orang Tua</a></li>
      </ul>
	    <ul id="tabs_4" class="uk-switcher uk-margin">
	      <li>
	        <table id="data_table" class="uk-table" cellspacing="0" width="100%">
	          <thead>
	            <tr>
	              <th class="number-order">No.</th>
                <th>Nama</th>
                <th>Email</th>
	              <th>Telepon</th>
                <th>Alamat</th>
	              <th>Kelamin</th>
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
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Kelamin</th>
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
        <form class="form_input_parent" name="formparent" id="form_validation">
          <input type="hidden" name="id" id="id">
          <input type="hidden" name="_method" id="method" value="POST">
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-6 uk-margin-top">
              <label>Nama Orang Tua</label>
              <br>
              <input type="text" id="name" class="md-input label-fixed" name="name" required/>
            </div>
            <div class="uk-width-medium-1-6 uk-margin-top">
              <label>Email</label>
              <br>
              <input type="email" id="email" class="md-input label-fixed" name="email" required/>
            </div>
            <div class="uk-width-medium-1-6 uk-margin-top">
              <label>No. Telepon</label>
              <br>
              <input type="text" id="phone" class="md-input label-fixed" name="phone" required placeholder="081234567890" />
            </div>
            <div class="uk-width-medium-1-6 uk-margin-top">
              <label>Kelamin</label>
              <br>
              <select id="gender" name="gender" class="md-input">
                  <option value="" disabled="disabled">Pilih Jenis Kelamin</option>
                  <option value="1">Laki-laki</option>
                  <option value="2">Perempuan</option>
              </select>
            </div>
            <div class="uk-width-medium-1-6 uk-margin-top">
              <div class="parsley-row">
                <input class="status_parent" type="checkbox" name="status">
                <label for="switch_demo_large" class="inline-label"><b>Aktifkan Orang Tua</b></label>
              </div>
            </div>
            <div class="uk-width-medium-1-6 uk-margin-top">
              <div id="parent_password">
              <label>Kata sandi</label>
              <br>
              <input type="password" class="md-input label-fixed" name="password" id="password" required/>
              </div>
            </div>
          </div>
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
              <label>Alamat Orang tua</label>
              <br>
              <textarea id="address" cols="30" rows="4" name="address" class="md-input label-fixed"></textarea>
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
    <!-- MODAL RESET PASSWORD USER -->
    <div class="uk-modal" id="parentID">
        <div class="uk-modal-dialog">
            <form method="POST" class="uk-form-stacked form-change-password">
            <div class="uk-modal-header">
                <h3 class="uk-modal-title">Rubah kata sandi</h3>
            </div>
          <input type="hidden" id="parent_id" name="id">
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
            var parentID = $(this).data('id');
            $("#parent_id").val(parentID);
        });
        $(".change_password").click(function(event) {
          $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            url: "{{ route('parent.change.password') }}",
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
            UIkit.modal("#parentID").hide();
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
            'pagingType': 'full_numbers_no_ellipses',
            ajax: {
                url:  "{{ route('parent.show') }}",
                data: { '_token' : '{{ csrf_token() }}'},
                type: 'POST',
            },
            columns: [
                { data: 'DT_Row_Index', searchable: false, "width": "15px", "className": "text-center"},
                { data: 'name'},
                { data: 'email'},
                { data: 'gender'},
                { data: 'phone'},
                { data: 'address'},
                { data: 'status'},
                { data: 'created_date'},
                { data: 'updated_date'},
                { data: 'action', name: 'action', orderable: false, searchable: false, "width": "25px", "className": "text-center" },
                { data: 'sandi', name: 'sandi', orderable: false, searchable: false, "width": "25px", "className": "text-center" },
            ],
        });

        $(".form_input_parent").on('submit',function() {
          var method = $('input#method').val();
          var url_action;
          if(method == 'POST'){
            url_action = "{{ route('parent.store') }}";
          } else {
            url_action = "{{ route('parent.update') }}";
          }
          $.ajax({
            type: method,
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            url: url_action,
            cache: false,
            data: $(this).serialize(),
            dataType: 'JSON',
            beforeSend: function(){
                altair_helpers.content_preloader_show('md');
            },
            success: function(result) {
               $('input#id').val('');
              $('#input_submit_type').html('<input id="save_item" type="submit" value="SAVE" class="md-btn md-btn-primary">');
              $('input#method').val('POST');
              $("#parent_password").show();
              $('.form_input_parent')[0].reset();
              $('#data_table').DataTable().ajax.reload();
              altair_helpers.content_preloader_hide();
              $("#form-tab").removeClass("uk-active")
              $('.list_parent')[0].click();
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
              url: APP_URL + "/parent/edit/"+id,
              method:'GET',
              dataType:'json',
              beforeSend: function(){
                altair_helpers.content_preloader_show('md');
              },
              success:function(data) {
                $('input#method').val('PUT');
                $("#form-tab").addClass("uk-active");
                $('.form_parent')[0].click();
                $("#list-tab").removeClass("uk-active");
                $('#input_submit_type').html('<input id="update_item" type="submit" value="UPDATE" class="md-btn md-btn-danger">');
                $("#parent_password").hide();
                $('input#name').val(data.name);
                $('input#email').val(data.email);
                $('input#phone').val(data.phone);
                $('textarea#address').val(data.address);
                $('select#gender').val(data.gender);
                $('input#id').val(id);
                $('.status_parent')[0].checked = data.status;
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
            url: "{{ route('parent.delete') }}",
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