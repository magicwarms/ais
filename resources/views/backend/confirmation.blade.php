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
	<h4 class="heading_a uk-margin-bottom">Daftar Konfirmasi Pembayaran</h4>
	<div class="md-card">
	  <div class="md-card-content">
	    <ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#tabs_4'}">
	      <li class="uk-width-1-2" id="list-tab"><a href="#" class="list_confirmation">List Konfirmasi</a></li>
	      <li class="uk-width-1-2" id="form-tab"><a href="#" class="form_confirmation">Form Konfirmasi</a></li>
	    </ul>
	    <ul id="tabs_4" class="uk-switcher uk-margin">
	      <li>
	        <table id="data_table" class="uk-table" cellspacing="0" width="100%">
	          <thead>
	            <tr>
	              <th class="number-order">No.</th>
	              <th>Pembayaran</th>
                <th>Orang Tua</th>
                <th>Anak</th>
	              <th>Status</th>
                <th>Created</th>
	              <th>Updated</th>
	              <th class="action-order">Action</th>
	            </tr>
	          </thead>
	          <tfoot>
	            <tr>
	              <th class="number-order">No.</th>
                <th>Pembayaran</th>
                <th>Orang Tua</th>
                <th>Anak</th>
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
        Pembayaran yang sudah terbayar
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
    <div class="uk-modal" id="confirmID">
        <div class="uk-modal-dialog" >
            <form method="POST" class="uk-form-stacked form_data_confirmation" id="form_validation">
            <div class="uk-modal-header" id="header_confirmation"></div>
            {{ csrf_field() }}
            <input type="hidden" name="_method" id="method" value="PUT">
            <input type="hidden" id="id" name="id">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-4 uk-margin-top">
                  <label>Pembayaran</label>
                  <br>
                  <input type="text" id="financial_name" class="md-input label-fixed" required readonly="readonly" />
                </div>
                <div class="uk-width-medium-1-4 uk-margin-top">
                  <label>Orang Tua</label>
                  <br>
                  <input type="text" id="parents_name" class="md-input label-fixed" required readonly="readonly"/>
                </div>
                <div class="uk-width-medium-1-4 uk-margin-top">
                  <label>Total Pembayaran</label>
                  <br>
                  <input type="text" id="total_pay" class="md-input label-fixed" required/>
                </div>
                <div class="uk-width-medium-1-4 uk-margin-top">
                  <label>Anak</label>
                  <br>
                  <input type="text" id="students_name" class="md-input label-fixed" required/>
                </div>
            </div>
            <div class="uk-grid" data-uk-grid-margin>
              <div class="uk-width-medium-1-2 uk-margin-top">
                <label>Bukti Pembayaran</label>
                <br>
                <div class="uk-margin-bottom uk-text-center uk-position-relative" id="confirm_file"></div>
              </div>
              <div class="uk-width-medium-1-2 uk-margin-top">
                <label>Keterangan</label>
                <br>
                <textarea id="remark" cols="30" rows="4" class="md-input label-fixed"></textarea>
              </div>
            </div>
            <div class="uk-grid" data-uk-grid-margin>
              <div class="uk-width-medium-1-2 uk-margin-top">
                  <label>Status</label>
                  <br>
                  <span class="icheck-inline uk-margin-top">
                      <input type="radio" name="status" id="status" data-md-icheck value="2"/>
                      <label for="status" class="inline-label">COMPLETED</label>
                  </span>
              </div>
              <div class="uk-width-medium-1-2 uk-margin-top">
                  <br>
                  <span class="icheck-inline uk-margin-top">
                      <input type="radio" name="status" id="status" data-md-icheck value="3"/>
                      <label for="status" class="inline-label">REJECT</label>
                  </span>
              </div>
            </div>
            <div class="uk-grid" data-uk-grid-margin>
              <div class="uk-width-medium-1-1">
                <label>Keterangan admin</label>
                <br>
                <textarea id="remark_admin" cols="30" rows="4" name="remark_admin" class="md-input label-fixed"></textarea>
              </div>
            </div>
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-1 uk-margin-top">
                    <div id="output"></div>
                </div>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button type="button" class="md-btn md-btn-flat uk-modal-close">Tutup</button>
                <input type="submit" value="SIMPAN" class="md-btn md-btn-danger" id="show_preloader_md">
            </div>
            </form>
        </div>
    </div>
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
                url:  "{{ route('confirmation.show') }}",
                data: { '_token' : '{{ csrf_token() }}'},
                type: 'POST',
            },
            columns: [
                { data: 'DT_Row_Index', searchable: false, "width": "15px", "className": "text-center"},
                { data: 'title'},
                { data: 'parents_name'},
                { data: 'students_name'},
                { data: 'status', name: 'status'},
                { data: 'created_date'},
                { data: 'updated_date'},
                { data: 'action', name: 'action', orderable: false, searchable: false, "width": "25px", "className": "text-center" },
            ],
        });

        $(".form_data_confirmation").on('submit',function(event) {
          $.ajax({
            type: 'PUT',
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            url: "{{ route('confirmation.update') }}",
            data: $(this).serialize(),
            dataType: 'JSON',
            cache: false,
            beforeSend: function(){
                altair_helpers.content_preloader_show('md');
            },
            success: function(result) {
              hide_modal_confirm();
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
              $.each(response, function (key, value) {
                $('#output').html('<div class="uk-alert uk-alert-danger" data-uk-alert><a href="#" class="uk-alert-close uk-close"></a>'+value+'</div>')
              });
              altair_helpers.content_preloader_hide();
            }
          });
          event.preventDefault();
        });

      });

      $(document).on('click', '#view_data_confirm', function (e) {
          var id = $(this).data('id');
          var APP_URL = {!! json_encode(url('/')) !!}
          $.ajax({
            url: APP_URL + "/confirmation/view_confirm/"+id,
            method:'GET',
            dataType:'json',
            beforeSend: function(){
              altair_helpers.content_preloader_show('md');
            },
            success:function(data) {
              $('input#id').val(id);
              $('input#financial_name').val(data.title).prop('readonly', true);
              $('input#parents_name').val(data.parents_name).prop('readonly', true);
              $('input#students_name').val(data.students_name).prop('readonly', true);
              $('#confirm_file').html('<a href="storage/'+data.confirm_file+'" target="_blank"><i class="material-icons md-36">content_copy</i><br>Filename: '+data.title+'</a>');
              $('textarea#remark').val(data.remark).prop('readonly', true);
              $('input#total_pay').val(data.total_pay).prop('readonly', true);
              $('textarea#remark_admin').val(data.remark_admin);
              $('#header_confirmation').html('<h3 class="uk-modal-title">Konfirmasi Pembayaran - '+data.title +'</h3>');
              show_modal_confirm();
              altair_helpers.content_preloader_hide();
            }
          })
        e.preventDefault();
      });
      function show_modal_confirm() {
            UIkit.modal("#confirmID").show();
        }

        function hide_modal_confirm() {
            UIkit.modal("#confirmID").hide();
        }
    </script>
@endsection