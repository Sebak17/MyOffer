@extends('home.core.app')

@section('content')

<div class="container mt-5">
	<div class="row">
		
		<div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
			<div class="card card-body">
				<legend><i class="fas fa-user-plus"></i> Rejestracja</legend>
				<hr>

				<div class="alert" id="alertSignUp"></div>
				
				<fieldset>
					<div id="registerStep1">
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-at"></i></span>
								</div>
								<input id="inpRegisterEmail" type="text" placeholder="Podaj email" class="form-control" value="">
							</div>
						</div>
						
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
								<input id="inpRegisterPassword1" type="password" placeholder="Podaj hasło" class="form-control" value="">
							</div>
						</div>
						
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
								<input id="inpRegisterPassword2" type="password" placeholder="Powtórz hasło" class="form-control" value="">
							</div>
						</div>
					</div>
					
					<div id="registerStep2">
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-address-card"></i></span>
								</div>
								<input id="inpRegisterFirstname" type="text" placeholder="Podaj imię" class="form-control" value="">
							</div>
						</div>
						
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
								</div>
								<input id="inpRegisterPhone" type="text" placeholder="Podaj numer telefonu" class="form-control" value="">
							</div>
						</div>
					</div>
					
					<div id="registerStepProcessing">
						<div class="card text-white bg-warning mb-3">
							<div class="card-body text-center">
								<h4 class="card-title">Przetwarzanie danych...</h4>
								<p><i class="fas fa-cog fa-spin fa-4x"></i></p>
							</div>
						</div>
					</div>
					
					<div id="registerStepSuccess">
						<div class="card text-white bg-success mb-3">
							<div class="card-body text-center">
								<h4 class="card-title">Zarejestrowano pomyślnie!</h4>
								<h5 class="card-subtitle" id="msgBoxSuccess"></h5>
							</div>
						</div>
					</div>
					
					<div id="registerStepError">
						<div class="card text-white bg-danger mb-3">
							<div class="card-body text-center">
								<h4 class="card-title">Wystąpił błąd podczas rejestracji!</h4>
								<h5 class="card-subtitle" id="msgBoxError"></h5>
							</div>
						</div>
					</div>
				</fieldset>
				
				<hr>
				
				<div class="form-group">
					
					<button type="button" id="btnBack" class="btn btn-warning float-left"><i class="fas fa-arrow-left"></i> Wróć</button>
					<button type="button" id="btnNext" class="btn btn-primary float-right">Dalej <i class="fas fa-arrow-right"></i></button>
				</div>
			</div>
		</div>
		
	</div>
</div>


@if(!Auth::user())
@include('home.modules.auth_login')
@endif

<script src="{{ asset('assets/js/validation.js') }}" charset="utf-8"></script>
<script src="{{ asset('assets/js/auth/signup.js') }}" charset="utf-8"></script>
@endsection