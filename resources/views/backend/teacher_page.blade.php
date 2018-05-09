@extends('layouts.baselayout')

@section('css')
	<!-- common css / default css -->
    <link rel="stylesheet" href="{{ asset('bower_components/uikit/css/uikit.almost-flat.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('templates/css/main.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('templates/css/themes/themes_combined.min.css') }}" media="all">
@endsection

@section('content')
<div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
    <div class="uk-width-large-1-1">
        <div class="md-card">
            <div class="user_heading">
                <div class="user_heading_avatar">
                	<?php 
                		if(!empty($teacher->photo_file)) {
			              $photo_file = asset('storage/'.$teacher->photo_file);
			            } else {
			              $photo_file = asset('storage/no-image-available.png');
			            }
                	?>
                    <div class="thumbnail">
                        <img src="{{ $photo_file }}" alt="{{ $teacher->education }}"/>
                    </div>
                </div>
                <div class="user_heading_content">
                    <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate">{{ $teacher->name }}</span><span class="sub-heading">{{ $teacher->education }}</span></h2>
                    <ul class="user_stats">
                        <li>
                            <h4 class="heading_a">2391 <span class="sub-heading">Tugas</span></h4>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="user_content">
                <ul id="user_profile_tabs" class="uk-tab" data-uk-tab="{connect:'#user_profile_tabs_content', animation:'slide-horizontal'}" data-uk-sticky="{ top: 48, media: 960 }">
                    <li class="uk-active"><a href="#">Profile</a></li>
                    <li><a href="#">Tugas</a></li>
                </ul>
                <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                    <li>
                        <div class="uk-grid uk-margin-medium-top uk-margin-large-bottom" data-uk-grid-margin>
                            <div class="uk-width-large-1-2">
                                <h4 class="heading_c uk-margin-small-bottom">Contact Info</h4>
                                <ul class="md-list md-list-addon">
                                    <li>
                                        <div class="md-list-addon-element">
                                            <i class="md-list-addon-icon material-icons">&#xE158;</i>
                                        </div>
                                        <div class="md-list-content">
                                            <span class="md-list-heading">Nomor Induk</span>
                                            <span class="uk-text-small uk-text-muted">{{ $teacher->code }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-addon-element">
                                            <i class="md-list-addon-icon material-icons">perm_phone_msg</i>
                                        </div>
                                        <div class="md-list-content">
                                            <span class="md-list-heading">Handphone</span>
                                            <span class="uk-text-small uk-text-muted">{{ $teacher->phone }}</span>
                                        </div>
                                    </li>
                                    <li>
                                    	<?php
                                    		$gender = $teacher->gender;
                                    		if($gender == 1){
								                $gender = 'Laki-laki';
								            } else {
								                $gender= 'Perempuan';
								            }
                                    	?>
                                        <div class="md-list-addon-element">
                                        	<i class="md-list-addon-icon material-icons">face</i>
                                        </div>
                                        <div class="md-list-content">
                                            <span class="md-list-heading">Kelamin</span>
                                            {!! $gender !!}
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-addon-element">
                                            <i class="md-list-addon-icon material-icons">cast_for_education</i>
                                        </div>
                                        <div class="md-list-content">
                                            <span class="md-list-heading">Edukasi</span>
                                            <span class="uk-text-small uk-text-muted">{{ $teacher->education }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="uk-width-large-1-2">
                                <h4 class="heading_c uk-margin-small-bottom">My groups</h4>
                                <ul class="md-list">
                                    <li>
                                        <div class="md-list-content">
                                            <span class="md-list-heading"><a href="#">Cloud Computing</a></span>
                                            <span class="uk-text-small uk-text-muted">104 Members</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-content">
                                            <span class="md-list-heading"><a href="#">Account Manager Group</a></span>
                                            <span class="uk-text-small uk-text-muted">229 Members</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-content">
                                            <span class="md-list-heading"><a href="#">Digital Marketing</a></span>
                                            <span class="uk-text-small uk-text-muted">35 Members</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-content">
                                            <span class="md-list-heading"><a href="#">HR Professionals Association - Human Resources</a></span>
                                            <span class="uk-text-small uk-text-muted">262 Members</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <ul class="md-list">
                            <li>
                                <div class="md-list-content">
                                    <span class="md-list-heading"><a href="#">Eum impedit maxime commodi nemo.</a></span>
                                    <div class="uk-margin-small-top">
                                    <span class="uk-margin-right">
                                        <i class="material-icons">&#xE192;</i> <span class="uk-text-muted uk-text-small">28 Jan 2018</span>
                                    </span>
                                    <span class="uk-margin-right">
                                        <i class="material-icons">&#xE0B9;</i> <span class="uk-text-muted uk-text-small">9</span>
                                    </span>
                                    <span class="uk-margin-right">
                                        <i class="material-icons">&#xE417;</i> <span class="uk-text-muted uk-text-small">191</span>
                                    </span>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </li>
                </ul>
            </div>
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
@endsection