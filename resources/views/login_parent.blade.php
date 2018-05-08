<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>Orang Tua - {{ config('app.name') }}</title>
  	<meta name="description" content="Australian Intercultural School made by Andhana &amp; Kriswanto">
    <meta name="keywords" content="australian intercultural school education">
    <meta name="author" content="Andhana Utama">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  	<link rel="icon" type="image/x-icon" href="{{ asset('frontend/img/logo.png') }}">
  	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Candal|Alegreya+Sans">
  	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/font-awesome.min.css') }}">
  	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
  	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/imagehover.min.css') }}">
  	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
  	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/animate.css') }}">
  	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/custom.css') }}">
  	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/jquery.easy_slides.css') }}">
</head>

<body id="login" class="text-center">
	<form class="form-signin" action="{{ route('process_signin_parent') }}" method="POST">
      <img class="mb-4" src="{{ asset('frontend/img/logo1.png') }}" alt="" width="100" height="100">
      <h1 class="h3 mb-3 font-weight-normal">ORANG TUA</h1>
      {{ csrf_field() }}
      <label class="sr-only">No. Handphone</label>
      <input type="number" class="form-control" placeholder="Nomor Handphone" name="phone" required="required" autofocus="autofocus">
      <label class="sr-only">Password</label>
      <input type="password" class="form-control" placeholder="Password" required="required" name="password">
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <!-- <a class="login" href="#">forgot your password ?</a> -->
  </form>
</body>
</html>