@extends('layouts.baselayout')

@section('css')
  <!-- common css / default css -->
    <link rel="stylesheet" href="{{ asset('bower_components/uikit/css/uikit.almost-flat.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('templates/css/main.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('templates/css/themes/themes_combined.min.css') }}" media="all">
@endsection

@section('content')
<?php
  if($get_user->name != ''){
    $action = route('user.update', $get_user->id);
    $method = method_field('PATCH');
  } else {
    $action = route('user.store');
    $method = '';
  }
?>
<div class="uk-width-medium-1-1">
  <h4 class="heading_a uk-margin-bottom">Buat Data Pengguna Baru</h4>
  <div class="md-card">
    <div class="md-card-content">
      <ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#tabs_4'}">
        <li class="uk-width-1-2 {{ $tab['data-tab'] }}"><a href="#">List Pengguna</a></li>
        <li class="uk-width-1-2 {{ $tab['form-tab'] }}"><a href="#">Form Pengguna</a></li>
      </ul>
      <ul id="tabs_4" class="uk-switcher uk-margin">
        <li>
          <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="number-order">No.</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Level</th>
                <th>Status</th>
                <th>Terakhir Login</th>
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
                <th>Level</th>
                <th>Status</th>
                <th>Terakhir Login</th>
                <th>Created</th>
                <th>Updated</th>
                <th class="action-order">Action</th>
                <th class="action-order">Sandi</th>
              </tr>
            </tfoot>
            <tbody>
            <?php
            if(!empty($users)){
              foreach($users as $key => $user) {
                if($user->status_admin == 1){
                  $status = '<a href="#" data-uk-tooltip title="Aktif"><i class="material-icons md-36 uk-text-success">&#xE86C;</i></a>';
                } else {
                  $status='<a href="#" data-uk-tooltip title="Tak Aktif"><i class="material-icons  md-36 uk-text-danger">&#xE5C9;</i></a>';
                }
                if($user->level == 1){
                  $level = '<span class="uk-badge uk-badge-primary">Admin</span>';
                } else {
                  $level = '<span class="uk-badge uk-badge-danger">Normal User</span>';
                }
                if($user->updated_date != null){
                  $updated = date('d F Y H:i:s', strtotime($user->updated_date));
                } else {
                  $updated = '-';
                }
            ?>
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{!! $level !!}</td>
                <td>{!! $status !!}</td>
                <td>{{ $user->last_login->diffForHumans() }}</td>
                <td>{{ date('d F Y H:i:s', strtotime($user->created_date)) }}</td>
                <td>{{ $updated }}</td>
                <td>
                  <a href="#" onclick="UIkit.modal.confirm('Apakah kamu yakin akan menghapus data ini?', function(){ event.preventDefault(); document.getElementById('delete-form-<?php echo $key; ?>').submit(); });"><i class="md-icon material-icons">&#xE16C;</i></a>
                  <form id="delete-form-<?php echo $key; ?>" action="{{ route('user.delete', $user) }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <input type="hidden" name="id" value="{{ $user->id }}">
                      <button type="submit">Hapus</button>
                  </form>
                  <a href="#" onclick="UIkit.modal.confirm('Apakah kamu yakin akan mengubah data ini?', function(){ document.location.href='{{ route('user.edit', $user) }}'; });"><i class="md-icon material-icons">&#xE254;</i></a>
                </td>
                <td>
                    <a href="#userID" class="md-btn md-btn2" data-id="{{ $user->id }}" data-uk-modal="{target:'#userID'}"><i class="md-icon material-icons uk-text-danger">&#xE8C6;</i></a>
                </td>
              </tr>
              <?php } ?>
            <?php } ?>
            </tbody>
          </table>
        </li>
        <li>
        <h3 class="heading_a uk-margin-bottom">Buat data baru atau Perbaharui data</h3>
        <form method="POST" name="formuser" action="{{ $action }}" id="form_validation">
          {{ csrf_field() }}
          {{ $method }}
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-2 uk-margin-top">
              <label>Nama</label>
              <br>
              <input type="text" class="md-input label-fixed {{ $errors->has('name') ? 'md-input-danger' : '' }}" name="name" value="{{ $get_user->name ? $get_user->name : old('name') }}" required/>
              <p class="uk-text-danger">{{ $errors->first('name') }}</p>
            </div>
            <div class="uk-width-medium-1-2 uk-margin-top">
              <label>Email</label>
              <br>
              <input type="email" class="md-input label-fixed {{ $errors->has('email') ? 'md-input-danger' : '' }}" name="email" value="{{ $get_user->email ? $get_user->email : old('email') }}" required/>
              <p class="uk-text-danger">{{ $errors->first('email') }}</p>
            </div>
          </div>
          <div class="uk-grid" data-uk-grid-margin>
          <?php if($get_user->id == ''){ ?>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <label>Kata sandi</label>
              <br>
              <input type="password" class="md-input label-fixed {{ $errors->has('password') ? 'md-input-danger' : '' }}" name="password" value="{{ $get_user->password ? $get_user->password : old('password') }}" required/>
              <p class="uk-text-danger">{{ $errors->first('password') }}</p>
            </div>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <div class="parsley-row">
                <label>Level</label>
                <br>
                <select name="level" id="select_demo_5" data-md-selectize data-md-selectize-bottom required>
                <option value="1" @if ($get_user->level === 1) selected @endif>Superadmin</option>
                <option value="2" @if ($get_user->level === 2) selected @endif>Admin/TU</option>
                <option value="3" @if ($get_user->level === 3) selected @endif>Keuangan</option>
              </select>
              </div>
              <p class="uk-text-danger">{{ $errors->first('level') }}</p>
            </div>
            <div class="uk-width-medium-1-3 uk-margin-top">
              <div class="parsley-row">
                <?php
                  $checked= '';
                  if($get_user->status_admin == 1) $checked = 'checked' ;
                ?>
                <input type="checkbox" data-switchery {{ $checked }} data-switchery-size="large" data-switchery-color="#d32f2f" name="status_admin" id="switch_demo_large">
                <label for="switch_demo_large" class="inline-label"><b>Aktifkan Pengguna</b></label>
              </div>
            </div>
            <?php } else { ?>
              <div class="uk-width-medium-1-2 uk-margin-top">
              <div class="parsley-row">
                <label>Level</label>
                <br>
                <select name="level" id="select_demo_5" data-md-selectize data-md-selectize-bottom required>
                <option value="1" @if ($get_user->level === 1) selected @endif>Admin</option>
                <option value="2" @if ($get_user->level === 2) selected @endif>Normal User</option>
              </select>
              </div>
              <p class="uk-text-danger">{{ $errors->first('level') }}</p>
            </div>
            <div class="uk-width-medium-1-2 uk-margin-top">
              <div class="parsley-row">
                <?php
                  $checked= '';
                  if($get_user->status_admin == 1) $checked = 'checked' ;
                ?>
                <input type="checkbox" data-switchery {{ $checked }} data-switchery-size="large" data-switchery-color="#d32f2f" name="status_admin" id="switch_demo_large">
                <label for="switch_demo_large" class="inline-label"><b>Aktifkan Pengguna</b></label>
              </div>
            </div>
            <?php } ?>
          </div>
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1 uk-margin-top">
              <label>Menu Management (Multiple)</label>
              <br>
              <select id="select_menu" name="menu_admin_id[]" multiple required="required">
              <?php
                if($get_user->id != ''){
                  $getmenus = get_all_row_multiple_menu($get_user->id);
                  $selected = "selected";
                } else {
                  $getmenus = select_all_multiple_menu();
                  $selected = "";
                }
              if(!empty($getmenus)){
                foreach ($getmenus as $key => $menu) {
              ?>
                  <option value="{{ $menu->id }}" <?php echo $selected;?>>{{ $menu->name }}</option>
                <?php } ?>
              <?php } ?>
              </select>
            </div>
          </div>
          <div class="uk-width-medium-1-1 uk-margin-top">
           <div class="uk-form-row">
             <span class="uk-input-group-addon"><input type="submit" value="SAVE" class="md-btn md-btn-primary"></span>
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
    <div class="uk-modal" id="userID">
        <div class="uk-modal-dialog">
            <form method="POST" action="{{ route('user.change.password') }}" class="uk-form-stacked">
            <div class="uk-modal-header">
                <h3 class="uk-modal-title">Rubah kata sandi</h3>
            </div>
          {{ csrf_field() }}
          <input type="hidden" id="id" name="id">
            <div class="uk-form-row uk-margin-top">
                <label>Sandi Baru</label>
                <input required type="password" pattern="^\S{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimal kata sandi 8 karakter' : ''); if(this.checkValidity()) form.repassword.pattern = this.value;" class="md-input label-fixed" id="password" name="password">
            </div>
            <div class="uk-text uk-text-danger uk-margin-bottom"><h6><i>*Minimal 8 Karakter</i></h6></div>

            <div class="uk-form-row uk-margin-top">
                <label>Konfirmasi Sandi Baru</label>
                 <input required type="password" pattern="^\S{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Masukkan kata sandi yang sama seperti diatas' : '');" class="md-input label-fixed" id="repassword" name="repassword">
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button type="button" class="md-btn md-btn-flat uk-modal-close">Tutup</button>
                <input type="submit" value="SAVE" class="md-btn md-btn-danger" id="show_preloader_md">
            </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).on("click", ".md-btn2", function () {
            var userID = $(this).data('id');
            $(".uk-modal-dialog #id").val(userID);
        });
    </script>
    <?php $menus = select_all_multiple_menu();?>
    <script type="text/javascript">
    $(function() {
        // advanced selects
        altair_form_adv.adv_selects();
    });
    altair_form_adv = {
        adv_selects: function() {
            $('#select_menu').selectize({
                plugins: {
                    'remove_button': {
                        label: ''
                    }
                },
                options: [
                <?php foreach ($menus as $menu) { ?>
                    {class: 'menu_list', id: {{ $menu->id }}, title: '{{ $menu->name }}'},
                <?php } ?>
                ],
                optgroups: [
                    {value: 'menu_list', label: 'Daftar Menu'}
                ],
                optgroupField: 'class',
                maxItems: null,
                valueField: 'id',
                labelField: 'title',
                searchField: 'title',
                create: false,
                render: {
                    option: function(data, escape) {
                        return  '<div class="option">' +
                                    '<span class="title">' + escape(data.title) + '</span>' +
                                '</div>';
                    },
                    item: function(data, escape) {
                        return '<div class="item"><a href="' + escape(data.url) + '" target="_blank">' + escape(data.title) + '</a></div>';
                    },
                    optgroup_header: function(data, escape) {
                        return '<div class="optgroup-header">' + escape(data.label) + '</div>';
                    }
                },
                onDropdownOpen: function($dropdown) {
                    $dropdown
                        .hide()
                        .velocity('slideDown', {
                            begin: function() {
                                $dropdown.css({'margin-top':'0'})
                            },
                            duration: 200,
                            easing: easing_swiftOut
                        })
                },
                onDropdownClose: function($dropdown) {
                    $dropdown
                        .show()
                        .velocity('slideUp', {
                            complete: function() {
                                $dropdown.css({'margin-top':''})
                            },
                            duration: 200,
                            easing: easing_swiftOut
                        })
                }
            });
        }
    };
    </script>
@endsection