<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="{{ app()->getLocale() }}"> <!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Andhana Utama">

    <link rel="icon" type="image/png" href="{{ asset('templates/img/favicon-16x16.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ asset('templates/img/favicon-32x32.png') }}" sizes="32x32">

    <title>{{ config('app.name') }}</title>

    <!-- matchMedia polyfill for testing media queries in JS -->
    <!--[if lte IE 9]>
        <script type="text/javascript" src="{{ asset('bower_components/matchMedia/matchMedia.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/matchMedia/matchMedia.addListener.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('templates/css/ie.css') }}" media="all">
    <![endif]-->

</head>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe">