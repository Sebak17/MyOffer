@extends('home.core.app')

@section('content')

<div class="container mt-5">
	<div class="row">
		<div class="col-12">
			<div class="input-group mb-3">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Czego szukasz?">

					<select class="form-control">
						<option value="0" class="d-none" selected>Lokalizacja</option>
						<option value="1">Dolnośląskie</option>
						<option value="2">Kujawsko-Pomorskie</option>
						<option value="3">Lubelskie</option>
						<option value="4">Lubuskie</option>
						<option value="5">Łódzkie</option>
						<option value="6">Małopolskie</option>
						<option value="7">Mazowieckie</option>
						<option value="8">Opolskie</option>
						<option value="9">Podkarpackie</option>
						<option value="10">Podlaskie</option>
						<option value="11">Pomorskie</option>
						<option value="12">Śląskie</option>
						<option value="13">Świętokrzyskie</option>
						<option value="14">Warmińsko-Mazurskie</option>
						<option value="15">Wielkopolskie</option>
						<option value="16">Zachodniopomorskie</option>
					</select>
					<span class="input-group-append">
						<button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Szukaj</button>
					</span>
				</div>
			</div>
		</div>

		<div class="col-12 my-3">
			<hr>
		</div>

		<div class="col-12 text-center">
			<h2>Kategorie</h2>


			<div class="row mt-3">
				@for ($i = 0; $i < 10; $i++)
    				<div class="col-4 col-sm-3 col-md-2 mb-3">
    					<div class="card card-body">
    						<i class="fab fa-accessible-icon fa-3x"></i>
    						<p class="lead">Kategoria {{ $i }}</p>
    					</div>
    				</div>
				@endfor
			</div>
		</div>
	</div>
</div>


@if(!Auth::user())
@include('home.modules.auth_login')
@endif

@endsection