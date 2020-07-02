@extends('home.core.app')

@section('content')

<div class="container mt-5" data-id="{{ $offer->id }}">
	<div class="row">
		@include('home.modules.main_searchbox')
		
		<div class="col-12">
			<ol class="breadcrumb">
				{!! $categoryPath !!}
			</ol>
		</div>
		
		<div class="col-12 mb-2">
			<hr>
		</div>

		@if (isset($owner) && $owner)
		<div class="col-12">
			@if($offer->status == 'VERIFICATION')
			<div class="alert alert-warning text-center"><i class="fas fa-circle-notch fa-spin"></i> Trwa weryfikacja oferty...</div>
			@elseif($offer->status == 'BANNED')
			<div class="alert alert-danger text-center"><i class="fas fa-exclamation-circle"></i> Oferta jest zablokowana!</div>
			@elseif($offer->status == 'INVISIBLE')
			<div class="alert alert-warning text-center"><i class="fas fa-eye-slash"></i> Oferta jest niewidoczna!</div>
			@endif
		</div>
		@endif
		
		<div class="col-12 col-lg-8 mb-3">
			<div class="w-100 text-center mb-3 bg-dark" >
				<div id="carouselMain" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						@for($i =0 ; $i < count($offer->images) ; $i++)
						<li data-target="#carouselMain" data-slide-to="{{ $i }}" {{ $i == 0 ? 'class="active"' : '' }} ></li>
						@endfor
					</ol>
					<div class="carousel-inner">
						@for($i =0 ; $i < count($offer->images) ; $i++)
						<div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
							<img src="/storage/offers_images/{{ $offer->images->get($i)->name }}" class="d-block w-100">
						</div>
						@endfor
					</div>
					<a class="carousel-control-prev" href="#carouselMain" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselMain" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
			
			<div class="card card-body mb-3">
				<h4><i class="fa{{ ($isFavorite ? 's' : 'r') }} fa-star" id="btnFavouriteStatus" data-is-favourite="{{ $isFavorite }}"></i> {{ $offer->title }}</h4>
				<h2 class="text-muted">{{ $offer->getTextPrice() }}</h2>
			</div>
			
			<div class="card card-body mb-3">
				<h5><i class="fas fa-clipboard-list"></i> Opis</h5>
				<pre style="white-space:pre-wrap; font-family: auto;">{{ $offer->description }}</pre>
			</div>
			
			<div class="card card-body">
				<p class="mb-0">
					Dodano: <strong>{{ $offer->created_at->format('d-m-Y H:i:s') }}</strong>
				</p>
			</div>
		</div>
		
		<div class="col-12 col-lg-4">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title"><i class="fas fa-user"></i> Użytkownik</h5>
					<div class="w-100 text-center">
						<div class="avatar rounded-circle bg-dark mx-auto main-tile-image" style="width: 140px; height: 140px; background-image: url('{{ Auth::user()->getAvatarURL() }}')"></div>
					</div>
					
					<div class="w-100 text-center mt-2">
						<h6>{{ $offer->user->personal->firstname }}</h6>
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
					<li class="list-group-item" id="itemListPhone" style="display: none;"><i class="fas fa-phone"></i> +48 {{ $offer->user->personal->phoneNumber }}</li>
					<li class="list-group-item" id="itemListEmail" style="display: none;"><i class="fas fa-envelope"></i> {{ $offer->user->email }}</li>
				</ul>
			</div>
			
			<div class="card card-body mt-3">
				<h5 class="card-title"><i class="fas fa-map-marker-alt"></i> Lokalizacja</h5>
				
				<p>{{ $offer->location }}</p>
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