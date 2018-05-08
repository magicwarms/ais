<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="{{ app()->getLocale() }}"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" type="image/png" href="{{ asset('templates/img/favicon-16x16.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ asset('templates/img/favicon-32x32.png') }}" sizes="32x32">

    <title>{{ config('app.name') }}</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    <link rel="stylesheet" href="{{ asset('bower_components/uikit/css/uikit.almost-flat.min.css') }}"/>

    <!-- altair admin login page -->
    <link rel="stylesheet" href="{{ asset('templates/css/login_page.min.css') }}" />

</head>
<body class="login_page login_page_v2">

    <div class="uk-container uk-container-center">
        <div class="md-card">
            <div class="md-card-content padding-reset">
                <div class="uk-grid uk-grid-collapse">
                    <div class="uk-width-large-2-3 uk-hidden-medium uk-hidden-small">
                        <div class="login_page_info uk-height-1-1" style="background-image: url('{{ asset('templates/img/others/sabri-tuzcu-331970.jpg') }}')">
                            <div class="info_content">
                                <h1 class="heading_b">Login Page Header</h1>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aut culpa cumque eaque earum error esse exercitationem fuga, fugiat harum perferendis praesentium quasi qui, repellendus sapiente, suscipit totam! Eaque, excepturi!
                                <p>
                                    <a class="md-btn md-btn-success md-btn-small md-btn-wave" href="javascript:void(0)">More info</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-large-1-3 uk-width-medium-2-3 uk-container-center">
                        <div class="login_page_forms">
                            <div id="login_card">
                                <div id="login_form">
                                    <div class="login_heading">
                                        <div class="user_avatar"></div>
                                    </div>
                                    @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                    <div class="uk-alert uk-alert-warning" data-uk-alert>
                                        <a href="#" class="uk-alert-close uk-close"></a>
                                        {{ $error }}
                                    </div>
                                        @endforeach
                                    @endif
                                    @if(session('warning'))
                                    <div class="uk-alert uk-alert-warning" data-uk-alert>
                                        <a href="#" class="uk-alert-close uk-close"></a>
                                        <h4>Peringatan!</h4>
                                        {{ session('warning') }}
                                    </div>
                                    @endif
                                    @if(session('success'))
                                    <div class="uk-alert uk-alert-success" data-uk-alert>
                                        <a href="#" class="uk-alert-close uk-close"></a>
                                        <h4>Sukses!</h4>
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                    @if(session('info'))
                                    <div class="uk-alert uk-alert-info" data-uk-alert>
                                        <a href="#" class="uk-alert-close uk-close"></a>
                                        <h4>Info!</h4>
                                        {{ session('info') }}
                                    </div>
                                    @endif
                                    <form method="POST" action="{{ route('user.login') }}">
                                        {{ csrf_field() }}
                                        <div class="uk-form-row">
                                            <label>email</label>
                                            <input class="md-input" type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required value="{{ old('email') }}" />
                                        </div>
                                        @if($errors->has('email'))
                                            <p class="uk-text-danger">{{ $errors->first('email') }}</p>
                                        @endif
                                        <div class="uk-form-row">
                                            <label for="login_password">Password</label>
                                            <input class="md-input" type="password" pattern="^\S{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimal 8 Karakter' : '');" name="password" required />
                                        </div>
                                        @if($errors->has('password'))
                                            <p class="uk-text-danger">{{ $errors->first('password') }}</p>
                                        @endif
                                        <div class="uk-margin-medium-top">
                                            <input type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large" value="Sign In">
                                        </div>
                                        <div class="uk-grid uk-grid-width-1-1 uk-grid-small uk-margin-top" data-uk-grid-margin>
                                            <div>
                                                <a href="{{ route('login.teacher') }}" class="md-btn md-btn-block md-btn-facebook" data-uk-tooltip="{pos:'bottom'}" title="Login Guru"><i class="material-icons uk-margin-remove">supervisor_account</i></a>
                                            </div>
                                        </div>
                                        <div class="uk-margin-top">
                                            <a href="#" id="login_help_show" class="uk-float-right">Butuh Bantuan?</a>
                                            <span class="icheck-inline">
                                                <input type="checkbox" name="remember" data-md-icheck {{ old('remember') ? 'checked' : '' }} />
                                                <label for="login_page_stay_signed" class="inline-label">Tetap masuk</label>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <div class="uk-position-relative" id="login_help" style="display: none">
                                    <button type="button" class="uk-position-top-right uk-close uk-margin-right back_to_login"></button>
                                    <h2 class="heading_b uk-text-success">Tidak bisa login?</h2>
                                    <p>Ini info buat anda untuk bisa masuk ke akun anda secepat mungkin.</p>
                                    <p>Pertama, cobalah hal yang paling mudah: jika Anda mengingat kata sandi Anda tetapi tidak berfungsi, pastikan bahwa Caps Lock dimatikan, dan nama pengguna Anda dieja dengan benar, lalu coba lagi.</p>
                                    <p>Jika password kamu tidak berfungsi juga, sudah waktunya <a href="#" id="password_reset_show">Reset kata sandi kamu</a>.</p>
                                </div>
                                <div id="login_password_reset" style="display: none">
                                    <button type="button" class="uk-position-top-right uk-close uk-margin-right back_to_login"></button>
                                    <h2 class="heading_a uk-margin-large-bottom">Reset password</h2>
                                    <form>
                                        <div class="uk-form-row">
                                            <label for="login_email_reset">Your email address</label>
                                            <input class="md-input" type="text" id="login_email_reset" name="login_email_reset" />
                                        </div>
                                        <div class="uk-margin-medium-top">
                                            <a href="index.html" class="md-btn md-btn-primary md-btn-block">Reset password</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- common functions -->
    <script src="{{ asset('templates/js/common.min.js') }}"></script>
    <!-- uikit functions -->
    <script src="{{ asset('templates/js/uikit_custom.min.js') }}"></script>
    <!-- altair core functions -->
    <script src="{{ asset('templates/js/altair_admin_common.min.js') }}"></script>

    <!-- altair login page functions -->
    <script src="{{ asset('templates/js/pages/login.min.js') }}"></script>

</body>
</html>