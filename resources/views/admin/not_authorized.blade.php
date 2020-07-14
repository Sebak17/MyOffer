<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name') }} | Admin | Logowanie</title>
	
	<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	
	<link rel="stylesheet" href="{{ asset('assets/plugins/admin-lte/adminlte.min.css') }}">
	
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


	<link rel="icon" type="image/png" href="{{ asset('assets/img/icons/favicon-32x32.png') }}">
  </head>
  
  <body class="login-page">
	<div class="container">
	  <div class="row">
		<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3">
		  <div class="card card-body bg-danger text-center">
			<h2 class="mb-0">
				<i class="fas fa-times"></i> Nie jesteś zalogowany!
			</h2>
		  </div>
		</div>
	  </div>
	</div>
	
	<script>
		window.onload = function () {
			setTimeout(function(){
				window.location.href = "{{ route('pageAdminSignIn') }}";
			}, 1500);
		}
	</script>

  </body>
</html>