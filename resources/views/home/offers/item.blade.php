@extends('home.core.app')

@section('content')

<div class="container mt-5">
	<div class="row">
		@include('home.modules.main_searchbox')
		
		<div class="col-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
				<li class="breadcrumb-item"><a href="#">Library</a></li>
				<li class="breadcrumb-item active">Data</li>
			</ol>
		</div>
		
		<div class="col-12 mb-2">
			<hr>
		</div>
		
		<div class="col-12 col-lg-8 mb-3">
			<div class="w-100 text-center mb-3 bg-dark">
				<img src="https://picsum.photos/600/400" alt="">
			</div>
			
			<div class="card card-body mb-3">
				<h4>TITLESDANA39O A39O82HN A43290</h4>
				<h2 class="text-muted">{{ rand(0, 10000) / 100 }} zł</h2>
			</div>
			
			<div class="card card-body mb-3">
				<h5><i class="fas fa-clipboard-list"></i> Opis</h5>
			</div>
			
			<div class="card card-body">
				<p class="mb-0">
					Dodano: <strong>{{ date('H:i:s d-m-Y', time()) }}</strong>
				</p>
			</div>
		</div>
		
		<div class="col-12 col-lg-4">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title"><i class="fas fa-user"></i> Użytkownik</h5>
					<div class="w-100 text-center">
						<img class="avatar rounded-circle" src="https://i.pravatar.cc/300"/>
					</div>
					
					<div class="w-100 text-center mt-2">
						<h6>John</h6>
					</div>
					
					<div class="row">
						<div class="col-12 col-sm-6 mb-2">
							<button class="btn btn-primary btn-block" id="btnActionPhone">Pokaż telefon</button>
						</div>
						
						<div class="col-12 col-sm-6 mb-2">
							<button class="btn btn-primary btn-block" id="btnActionEmail">Napisz</button>
						</div>
					</div>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item" id="itemListPhone" style="display: none;"><i class="fas fa-phone"></i> +48 111 222 333</li>
					<li class="list-group-item" id="itemListEmail" style="display: none;"><i class="fas fa-envelope"></i> mail@mail.mail</li>
				</ul>
			</div>
			
			<div class="card card-body mt-3">
				<h5 class="card-title"><i class="fas fa-map-marker-alt"></i> Lokalizacja</h5>
				
				<div id="mapid" style="height: 180px;"></div>
			</div>
		</div>
	</div>
</div>


@if(!Auth::user())
@include('home.modules.auth_login')
@endif

<script src="{{ asset('assets/js/utils/search.engine.js') }}" charset="utf-8"></script>
<script src="{{ asset('assets/js/offers/item.js') }}" charset="utf-8"></script>
@endsection