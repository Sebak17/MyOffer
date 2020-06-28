@extends('home.core.app')

@section('content')

<div class="container mt-5">
	<div class="row">
		@include('home.modules.main_searchbox')
		
		<div class="col-12 text-center">
			<h2>Kategorie</h2>
			
			
			<div class="row mt-3 justify-content-center align-items-center">
				@for ($i = 1; $i <= 10; $i++)
				<div class="col-4 col-md-3 col-lg-2 mb-3">
					<a href="{{ route('pageOffersList') . '?cat=' .$i }}" class="none">
						<div class="card card-body main-tile">
							<i class="fab fa-accessible-icon fa-3x"></i>
							<p class="lead">Kategoria {{ $i }}</p>
						</div>
					</a>
				</div>
				@endfor
			</div>
		</div>
		
		<div class="col-12 my-3">
			<hr>
		</div>
		
		<div class="col-12 text-center">
			<h2>Ostatnio przeglądane</h2>
			
			
			<div class="row mt-3 justify-content-center ">
				@foreach ($offersHistory as $offer)
				<div class="col-6 col-sm-4 col-md-3 mb-3">
					<a href="{{ route('pageOfferItem', ['id'=> $offer->id,'name'=>$offer->generateURLName()]) }}" class="none">
						<div class="card main-tile h-100">
							<div style="height: 200px;" class="bg-dark w-100 py-4">
								<img class="img-fluid" src="/storage/offers_images/{{ $offer->images->first()->name }}">
							</div>
							<div class="card-body text-left">
								<h6 class="card-subtitle mb-2">{{ $offer->title }}</h6>
								<p class="lead">{{ $offer->getTextPrice() }}</p>
								<p><small><i class="fas fa-map-marker-alt"></i> {{ $offer->location }}</small></p>
							</div>
						</div>
					</a>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>


@if(!Auth::user())
@include('home.modules.auth_login')
@endif

<script src="{{ asset('assets/js/main/home.js') }}" charset="utf-8"></script>
<script src="{{ asset('assets/js/utils/search.engine.js') }}" charset="utf-8"></script>


@endsection