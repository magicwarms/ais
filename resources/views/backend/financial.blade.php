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
	<h4 class="heading_a uk-margin-bottom">Buat Data Pembayaran Baru</h4>
	<div class="md-card">
	  <div class="md-card-content">
	    <ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#tabs_4'}">
	      <li class="uk-width-1-2" id="list-tab"><a href="#" class="list_finance">List Pembayaran</a></li>
	      <li class="uk-width-1-2" id="form-tab"><a href="#" class="form_finance">Form Pembayaran</a></li>
	    </ul>
	    <ul id="tabs_4" class="uk-switcher uk-margin">
	      <li>
	        <table id="data_table" class="uk-table" cellspacing="0" width="100%">
	          <thead>
	            <tr>
	              <th class="number-order">No.</th>
                <th>Kelas</th>
	              <th>Siswa</th>
                <th>Judul</th>
                <th>Jumlah Dibayar</th>
                <th>Keterangan</th>
                <th>Created</th>
	              <th>Updated</th>
	              <th class="action-order">Action</th>
	            </tr>
	          </thead>
	          <tfoot>
	            <tr>
	              <th class="number-order">No.</th>
                <th>Kelas</th>
                <th>Siswa</th>
                <th>Judul</th>
                <th>Jumlah Dibayar</th>
                <th>Keterangan</th>
                <th>Created</th>
                <th>Updated</th>
                <th class="action-order">Action</th>
	            </tr>
	          </tfoot>
	          <tbody></tbody>
          </table>
        </li>
				<li id="form_id">
        <h3 class="heading_a uk-margin-bottom">Buat data baru atau Perbaharui data</h3>
        <form class="form_input_finance" name="formfinance" id="form_validation">
          <input type="hidden" name="id" id="id">
          <input type="hidden" name="_method" id="method" value="POST">
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <label>Kelas</label>
              <br>
              {{ Form::select('class_id', $classes, null, array('class' =>'md-input', 'placeholder' => 'Pilih Kelas', 'id' => 'class_id','required')) }}
            </div>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <div class="parsley-row">
                <label>Siswa</label>
                <br>
                <select class="md-input" name="students_id" id="students_id" required>
                <option value=""  selected="selected" disabled="disabled">Pilih Kelas dulu</option>
              </select>
              </div>
            </div>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <label>Judul</label>
              <br>
              <input type="text" id="title" class="md-input label-fixed" name="title" required/>
            </div>
          </div>
          
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1 multi-field-wrapper">
              <button style="min-width: 49px !important; margin-left: 17px !important; padding-bottom: 10px;" type="button" class="md-btn md-btn-primary add-field"><i class="material-icons md-24">&#xE146;</i></button>
              <div class="multi-fields">
                <div class="uk-grid multi-field" data-uk-grid-margin>
                  <div style="width: 10%" class="uk-width-medium-1-6 uk-margin-top">
                    <div class="uk-input-group mt-m">
                      <span class="uk-input-group-addon remove-field">
                        <button type="button" style="min-width:1px; padding-bottom: 10px;" class="md-btn md-btn-danger"><i class="material-icons md-24">&#xE872;</i></button>
                      </span>
                    </div>
                  </div>
                  <div class="uk-width-medium-1-6 uk-margin-top">
                    <div class="uk-input-group ">
                      <label class="uk-form-label"><b>Pembayaran/Fee</b></label>
                      <label for="fee"></label>
                      <input type="text" class="md-input fee_class" name="fee[]" id="fee">
                    </div>
                  </div>
                  <div class="uk-width-medium-1-6 uk-margin-top">
                    <div class="uk-input-group">
                      <label class="uk-form-label"><b>Total</b></label>
                      <label for="total"></label>
                      <input type="number" class="md-input total_class" name="total[]" id="total">
                    </div>
                  </div>
                  <div class="uk-width-medium-1-6 uk-margin-top">
                    <div class="uk-input-group">
                      <label class="uk-form-label"><b>Diskon</b></label>
                      <label for="discount"></label>
                      <input type="text" class="md-input discount_class" name="discount[]" id="discount" onchange="hitungdiscount()">
                    </div>
                  </div>
                  <div class="uk-width-medium-1-6 uk-margin-top">
                    <div class="uk-input-group">
                      <label class="uk-form-label"><b>Keterangan</b></label>
                      <label for="remark_detail"></label>
                      <input type="text" class="md-input remark_detail_class" name="remark_detail[]" id="remark_detail">
                    </div>
                  </div>
                  <div class="uk-width-medium-1-6 uk-margin-top">
                    <div class="uk-input-group">
                      <label class="uk-form-label"><b>Sub Total</b></label>
                      <label for="subtotal"></label>
                      <input type="number" class="md-input subtotal_class" name="subtotal[]" id="subtotal">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1 uk-margin-top">
              <label>Keterangan</label>
              <br>
              <textarea id="remark" cols="30" rows="4" class="md-input label-fixed" name="remark"></textarea>
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
        var APP_URL = {!! json_encode(url('/')) !!}
        $("#class_id").change(function (){
          altair_helpers.content_preloader_show('md');
          get_students($(this).val(),'');
          altair_helpers.content_preloader_hide(); 
        });
        reset_field();
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
                url:  "{{ route('finance.show') }}",
                data: { '_token' : '{{ csrf_token() }}'},
                type: 'POST',
            },
            columns: [
                { data: 'DT_Row_Index', searchable: false, "width": "15px", "className": "text-center"},
                { data: 'students_name'},
                { data: 'class_name'},
                { data: 'title'},
                { data: 'total_pay'},
                { data: 'remark'},
                { data: 'created_date'},
                { data: 'updated_date'},
                { data: 'action', name: 'action', orderable: false, searchable: false, "width": "25px", "className": "text-center" },
            ],
        });

        $(".form_input_finance").on('submit',function() {
          var method = $('input#method').val();
          var url_action;
          if(method == 'POST'){
            url_action = "{{ route('finance.store') }}";
          } else {
            url_action = "{{ route('finance.update') }}";
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
              $('.form_input_finance')[0].reset();
              $('#data_table').DataTable().ajax.reload();
              altair_helpers.content_preloader_hide();
              $("#form-tab").removeClass("uk-active")
              $('.list_finance')[0].click();
              $("#list-tab").addClass("uk-active")
              reset_field();
              if(result.status=='success'){
                UIkit.notify({
                  message: result.msg,
                  status: 'success',
                  timeout: 8000,
                  pos: 'top-center'
                });
              } else {
                UIkit.notify({
                  message: result.msg,
                  status: 'danger',
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

        $(document).on('click', '.edit_data', function (e) {
          var id = $(this).data('id');
          UIkit.modal.confirm("Apakah kamu yakin akan mengubah data ini?", function(){
            $.ajax({
              url: APP_URL + "/finance/edit/"+id,
              method:'GET',
              dataType:'json',
              beforeSend: function(){
                altair_helpers.content_preloader_show('md');
              },
              success:function(data) {
                $('input#method').val('PUT');
                $("#form-tab").addClass("uk-active");
                $('.form_finance')[0].click();
                $("#list-tab").removeClass("uk-active");
                $('#input_submit_type').html('<input id="update_item" type="submit" value="UPDATE" class="md-btn md-btn-danger">');
                $('input#id').val(id);
                $('select#students_id').val(data.students_id);
                $('select#class_id').val(data.class_id);
                $('input#title').val(data.title);
                $('textarea#remark').val(data.remark);
                $('input#total_pay').val(data.total_pay);
                get_students(data.class_id,data.students_id);
                reset_field();
                $.each(data.finance_detail, function( index, value ) {
                    if(index>0) {
                      add_field();
                    }
                    $('input.fee_class:eq('+index+')').val(value.fee);
                    $('input.total_class:eq('+index+')').val(value.total);
                    $('input.discount_class:eq('+index+')').val(value.discount);
                    $('input.subtotal_class:eq('+index+')').val(value.subtotal);
                    $('input.remark_detail_class:eq('+index+')').val(value.remark);
                });
                altair_helpers.content_preloader_hide();
              }
            }) 
          });
          e.preventDefault(); 
        });
      });
      
      function reset_field(){
        $(".multi-field").each(function(e,i){
          var idx = $("div.multi-field").index(this);
          if(idx > 0) {
            $(this).remove();
          }
        });
      }
      function add_field() {
        var wrapper = $('.multi-fields');
        $('.multi-field:first-child').clone(true).appendTo(wrapper);
      }
      function delete_data(id){
        UIkit.modal.confirm("Apakah kamu yakin akan menghapus data ini?", function(){  
          $.ajax({
            method: 'DELETE',
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}'
            },
            url: "{{ route('finance.delete') }}",
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
      $('.multi-field-wrapper').each(function() {
          var $wrapper = $('.multi-fields', this);
          $(".add-field", $(this)).click(function(e) {
              $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
          });
          $('.multi-field .remove-field ', $wrapper).click(function() {
              if ($('.multi-field', $wrapper).length > 1)
                  $(this).parents('.multi-field').remove();
          });
      });

      $('input#discount').keyup(function($event) {
        var idx = $(".discount_class").index(this);
        hitungdiscount(idx);
      });
      $('input#total').keyup(function($event) {
        var idx1 = $(".total_class").index(this);
        hitungdiscount(idx1);
      });
      function hitungdiscount(parent_index) {
        var subtotal_id = $('.subtotal_class:eq('+parent_index+')');
        var discount = $('.discount_class:eq('+parent_index+')').val() || 0;
        var total = $('.total_class:eq('+parent_index+')').val() || 0;
        var discounting = parseFloat(discount)/100;
        var total_after_discount = discounting * parseFloat(total);
        var subtotal = parseFloat(total) - parseFloat(total_after_discount);
        subtotal_id.val(Math.round(subtotal));
      }
    function get_students(id, selected) {
      var APP_URL = {!! json_encode(url('/')) !!}
      var select = $('select#students_id');
        $.ajax({
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            url: APP_URL + "/student/getstudents/"+id,
            success: function (data) {
                select.prop('disabled', false);
                select.empty();
                if(data != ''){
                  $.each(data, function(key, val) {
                    select.append($('<option>', {
                        value: val.id,
                        text : val.name
                    }));
                  });
                } else {
                  select.append($('<option>', {
                      value: '',
                      text : 'Maaf, data siswa tidak tersedia.'
                  }));
                }
              if(selected != '') {
                  select.val(selected);
              }
            }
        });
    }
    </script>
@endsection