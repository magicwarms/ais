<!-- main header -->
<header id="header_main">
    <div class="header_main_content">
        <nav class="uk-navbar">       
            <!-- main sidebar switch -->
            <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                <span class="sSwitchIcon"></span>
            </a>
            <!-- secondary sidebar switch -->
            <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
                <span class="sSwitchIcon"></span>
            </a>
                <div id="menu_top_dropdown" class="uk-float-left uk-hidden-small">
                    <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
                        <a href="#" class="top_menu_toggle"><i class="material-icons md-24">&#xE8F0;</i></a>
                        <div class="uk-dropdown uk-dropdown-width-3">
                            <div class="uk-grid uk-dropdown-grid">
                                <div class="uk-width-2-3">
                                    <div class="uk-grid uk-grid-width-medium-1-3 uk-margin-bottom uk-text-center">
                                        <a href="page_mailbox.html" class="uk-margin-top">
                                            <i class="material-icons md-36 md-color-light-green-600">&#xE158;</i>
                                            <span class="uk-text-muted uk-display-block">Mailbox</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="uk-width-1-3">
                                    <ul class="uk-nav uk-nav-dropdown uk-panel">
                                        <li class="uk-nav-header">Components</li>
                                        <li><a href="components_accordion.html">Accordions</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            <div class="uk-navbar-flip">
                <ul class="uk-navbar-nav user_actions">
                    <li><a href="#" id="full_screen_toggle" class="user_action_icon uk-visible-large"><i class="material-icons md-24 md-light">&#xE5D0;</i></a></li>
                    <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                        <a href="#" class="user_action_icon"><i class="material-icons md-24 md-light">&#xE7F4;</i><span class="uk-badge">0</span></a>
                        <div class="uk-dropdown uk-dropdown-xlarge">
                            <div class="md-card-content">
                                <ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#header_alerts',animation:'slide-horizontal'}">
                                    <li class="uk-width-1-2 uk-active"><a href="#" class="js-uk-prevent uk-text-small">Messages (1)</a></li>
                                    <li class="uk-width-1-2"><a href="#" class="js-uk-prevent uk-text-small">Alerts (4)</a></li>
                                </ul>
                                <ul id="header_alerts" class="uk-switcher uk-margin">
                                    <li>
                                        <ul class="md-list md-list-addon">
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <span class="md-user-letters md-bg-cyan">do</span>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading"><a href="page_mailbox.html">Eos asperiores.</a></span>
                                                    <span class="uk-text-small uk-text-muted">Voluptatum voluptatem asperiores quas et praesentium quia qui adipisci at fugiat corrupti.</span>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="uk-text-center uk-margin-top uk-margin-small-bottom">
                                            <a href="page_mailbox.html" class="md-btn md-btn-flat md-btn-flat-primary js-uk-prevent">Show All</a>
                                        </div>
                                    </li>
                                    <li>
                                        <ul class="md-list md-list-addon">
                                            <li>
                                                <div class="md-list-addon-element">
                                                    <i class="md-list-addon-icon material-icons uk-text-warning">&#xE8B2;</i>
                                                </div>
                                                <div class="md-list-content">
                                                    <span class="md-list-heading">Voluptatem esse aut.</span>
                                                    <span class="uk-text-small uk-text-muted uk-text-truncate">Magnam eligendi est assumenda rerum quas est sint.</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                        <a href="#" class="user_action_image"><img class="md-user-image" src="{{ asset('templates/img/avatars/avatar_11_tn.png') }}" alt=""></a>
                        <div class="uk-dropdown uk-dropdown-small">
                            <?php
                                if(!empty(Auth::guard('teacher')->user()->id)){
                                    $routes = route('logouts');
                                } else {
                                    $routes = route('logout');
                                }
                            ?>
                            <ul class="uk-nav js-uk-prevent">
                                <li><a href="{{ $routes }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ $routes }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!-- main header end -->

<!-- main sidebar -->
<aside id="sidebar_main">
    <div class="sidebar_main_header">
        <div class="sidebar_logo">
            <a href="" class="sSidebar_hide sidebar_logo_large">
                <img class="logo_regular" src="{{ asset('templates/img/logo_main.png') }}" alt="" height="15" width="71"/>
                <img class="logo_light" src="{{ asset('templates/img/logo_main_white.png') }}" alt="" height="15" width="71"/>
            </a>
            <a href="" class="sSidebar_show sidebar_logo_small">
                <img class="logo_regular" src="{{ asset('templates/img/logo_main_small.png') }}" alt="" height="32" width="32"/>
                <img class="logo_light" src="{{ asset('templates/img/logo_main_small_light.png') }}" alt="" height="32" width="32"/>
            </a>
        </div>
    </div>
    <?php
      $seg1 = strtolower(Request::segment(1));
      $menus = menu_active(1,NULL,1);
      $menuschild = menu_active(NULL,1,1);
    ?>
    <div class="menu_section">
        <ul>

            <?php 
            if(empty(Auth::guard('teacher')->user()->id)){
                foreach ($menus as $val1) {
            ?>
                <li title="{{ $val1->name }}"{!! $seg1 == $val1->function ? ' class="submenu_trigger current_section act_section"' : '' !!}>
                    <a href="#">
                        <span class="menu_icon"><i class="material-icons">{{ $val1->icon }}</i></span>
                        <span class="menu_title">{{ $val1->name }}</span>
                    </a>
                    <ul{!! $seg1 == $val1->function ? ' style="display: block;"' : '' !!}>
                        <?php 
                        foreach ($menuschild as $val2) { 
                            if($val1->id == $val2->parent){
                        ?>
                        <li{!! $seg1 == $val2->function ? ' class="act_item"' : '' !!}><a href="{{ route($val2->function) }}">{{ $val2->name }}</a></li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php } else { ?>
                <li class="{{ request()->is('profile') ? 'current_section' : '' }}" title="Profile">
                    <a href="{{ route('teacher.profile') }}">
                        <span class="menu_icon"><i class="material-icons">&#xE87C;</i></span>
                        <span class="menu_title">Profile</span>
                    </a>
                </li>
                <li title="Tugas Siswa">
                    <a href="#">
                        <span class="menu_icon"><i class="material-icons">&#xE0B9;</i></span>
                        <span class="menu_title">Tugas Siswa</span>
                    </a>
                    <ul>
                        <li class="act_item"><a href="#">Daftar Tugas Siswa</a></li>
                        <li><a href="page_chat_small.html">Chatboxes</a></li>
                    </ul>
                </li>
            <?php } ?>
        </ul>
    </div>
</aside>
<!-- main sidebar end -->