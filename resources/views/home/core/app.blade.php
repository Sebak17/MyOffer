<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>{{ config('app.name') }}</title>

		<meta name="author" content="SitePoint">
		<meta name="description" content="The HTML5 Herald">

		<meta name="csrf-token" content="{{ csrf_token() }}">
		
		<link rel="icon" type="image/png" href="{{ asset('assets/img/icons/favicon-32x32.png') }}">

        <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}" >
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-4.5.0.min.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
		
		<script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}" charset="utf-8"></script>
		<script src="{{ asset('assets/js/bootstrap-4.5.0.min.js') }}" charset="utf-8"></script>

		<script src="{{ asset('assets/js/utils.js') }}" charset="utf-8"></script>

	</head>
	
	<body>

		@include('home.core.menu')

		@yield('content')

		@include('home.core.footer')


		@yield('javascipts')

	</body>
</html>