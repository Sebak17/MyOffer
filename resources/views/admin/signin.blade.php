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
		<div class="login-box">
			<div class="login-logo">
				<a href="{{ route('home') }}"><b>{{ config('app.name') }}</b></a>
			</div>
			<div class="card">
				<div class="card-body login-card-body">
					<p class="login-box-msg">Zaloguj się do panelu</p>
					
					<fieldset>
						<div id="alertAuthLogin" class="alert d-none"></div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-envelope"></i></span>
							</div>
							<input id="inpAuthLogin" type="text" placeholder="Podaj login" class="form-control">
						</div>

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input id="inpAuthPassword" type="password" placeholder="Podaj hasło" class="form-control">
						</div>

						<div class="row">
							<div class="col-8">
								<div class="">
									<input type="checkbox" id="remember">
									<label for="remember">
										Zapamiętaj mnie
									</label>
								</div>
							</div>
							<div class="col-4">
								<button type="submit" class="btn btn-primary btn-block" id="btnAuthLogin"><i class="fas fa-sign-in-alt"></i> Zaloguj</button>
							</div>
						</div>
					</fieldset>
				</div>
			</div>
		</div>
		
		<script src="{{ asset('assets/js/addons/jquery-3.4.1.min.js') }}" charset="utf-8"></script>
		
		<script src="{{ asset('assets/plugins/admin-lte/bootstrap.bundle.min.js') }}" charset="utf-8"></script>
		<script src="{{ asset('assets/plugins/admin-lte/adminlte.min.js') }}" charset="utf-8"></script>

		<script src="{{ asset('assets/js/utils.js') }}" charset="utf-8"></script>
		<script src="{{ asset('assets/js/admin/signin.js') }}" charset="utf-8"></script>
	</body>
</html>