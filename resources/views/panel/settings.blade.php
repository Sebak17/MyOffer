@extends('panel.core.main')

@section('subcontent')
<div class="page-header">
	<h2><i class="fas fa-tools"></i> Ustawienia</h2>
</div>

<hr>

<div class="row">
	<div class="col-12 mb-3">

		<div class="alert d-none" id="alertAvatarChange"></div>

		<div class="card card-body">
			<div class="row">
				<div class="col-sm-3">
					<div class="w-100 text-center">
						<div class="avatar rounded-circle bg-dark mx-auto main-tile-image" style="width: 140px; height: 140px; background-image: url('{{ Auth::user()->getAvatarURL() }}')"></div>
						<br>
						<input type="file" class="d-none" id="inpUserAvatar" accept="image/x-png,image/jpeg">
						<button class="btn btn-outline-info mt-3 mx-auto" id="btnUploadAvatar" data-placement="top" data-content="">Zmień awatar</button>
					</div>
				</div>
				<div class="col-sm-9">
					<h4>{{ Auth::user()->email }}</h4>
					
					<p>Data utworzenia konta: <strong>{{ Auth::user()->created_at->format('d-m-Y H:i:s') }}</strong></p>
				</div>
			</div>
			
		</div>
	</div>
	
	<div class="col-6 col-sm-6 col-lg-4">
		<div class="card card-body">
			<legend><i class="fas fa-user-edit"></i> Zmień dane</legend>
			<hr />
			
			<div class="alert d-none" id="alertChangePersonal"></div>
			
			<div class="form-group">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-address-card"></i></span>
					</div>
					<input id="inpChanePersonalFirstname" type="text" placeholder="Podaj imię" class="form-control" value="">
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-phone"></i></span>
					</div>
					<input id="inpChanePersonalPhone" type="number" placeholder="Podaj numer telefonu" class="form-control" value="">
				</div>
			</div>
			
			<div class="form-group">
				<button type="button" id="btnChangePersonal" class="btn btn-primary float-right">Zmień dane <i class="fas fa-arrow-up"></i></button>
			</div>
		</div>
	</div>
	<div class="col-6 col-sm-6 col-lg-4">
		<div class="card card-body">
			<legend><i class="fas fa-key"></i> Zmień hasło</legend>
			<hr />
			
			<div class="alert d-none" id="alertChangePassword"></div>
			
			<div class="form-group">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-key"></i></span>
					</div>
					<input id="inpChangePasswordOld" type="password" placeholder="Podaj stare hasło" class="form-control">
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-key"></i></span>
					</div>
					<input id="inpChangePasswordNew1" type="password" placeholder="Podaj nowe hasło" class="form-control">
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-key"></i></span>
					</div>
					<input id="inpChangePasswordNew2" type="password" placeholder="Powtórz nowe hasło" class="form-control">
				</div>
			</div>
			
			<div class="form-group">
				<button type="button" id="btnChangePassword" class="btn btn-primary float-right">Zmień hasło <i class="fas fa-arrow-up"></i></button>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('assets/js/panel/settings.js') }}" charset="utf-8"></script>
@endsection