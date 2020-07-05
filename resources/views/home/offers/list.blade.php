@extends('home.core.app')

@section('content')

<div class="container-fluid mt-5">
	<div class="row">
		<div class="col-12 col-sm-10 offset-sm-1 col-lg-8 offset-lg-2">
			<div class="row">
				@include('home.modules.main_searchbox')
			</div>
			
		</div>
		
		<div class="col-12 col-lg-3 offset-lg-1 mb-5" id="columnLeft">
			
			<button class="btn btn-outline-secondary w-100 mb-3 d-block d-md-none" data-toggle="collapse" data-target="#left-column-content">
			<i class="fas fa-cog 1x"></i> Pokaż opcje
			</button>
			
			<div id="left-column-content" class="collapse show">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title"><i class="fas fa-sitemap"></i> Kategorie</h5>
						<hr />
						
						<p>
							Aktualna: <strong>{{ $categoryCurrent['name'] }}</strong>
						</p>
						
						<hr />
						
						<div class="mt-1">
							<table class="col-12">
								@if (isset($categoryOver) && count($categoryOver) > 0)
								<thead id="categoryBack">
									<tr class="category category-item-back" category="{{ $categoryOver['id'] }}">
										<td class="text-center py-1"><i class="fas fa-level-up-alt fa-1x"></i></td>
										<td>cofnij do <b>{{ $categoryOver['name'] }}</b></td>
									</tr>
								</thead>
								@endif
								<tbody id="categoriesList">
									@foreach ($categoriesSubList as $category)
									<tr class="category category-item" category="{{ $category['id'] }}">
										<td class="text-center"><i class="fas {{ $category['icon'] }} fa-1x"></i></td>
										<td>{{ $category['name'] }}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							
							
						</div>
						
					</div>
				</div>
				
				<div class="card mt-3">
					<div class="card-body">
						<h5 class="card-title"><i class="fas fa-sitemap"></i> Sortuj według</h5>
						<hr />
						
						<div class="sortList">
							<select class="custom-select" id="sortType">
								<option value="1">&nbsp;&nbsp; nazwa od A do Z</option>
								<option value="2">&nbsp;&nbsp; nazwa od Z do A</option>
								<option value="3">&nbsp;&nbsp; od najnowszych</option>
								<option value="4">&nbsp;&nbsp; od najstarszych</option>
								<option value="5">&nbsp;&nbsp; cena rosnąco</option>
								<option value="6">&nbsp;&nbsp; cena malejąco</option>
							</select>
						</div>
					</div>
				</div>
				
				<div class="card mt-3">
					<div class="card-body">
						<h4 class="card-title"><i class="fas fa-filter"></i> Filtry</h4>
						<hr />
						
						<div class="filters">
							
							<div class="">
								<h5><i class="fas fa-money"></i> Cena</h5>
								<div class="row">
									<div class="col-5">
										<input type="number" class="form-control" placeholder="od" id="fl_price1">
									</div>
									<div class="col-2 d-flex flex-column text-center">
										<i class="fas fa-minus fa-1x my-auto"></i>
									</div>
									<div class="col-5">
										<input type="number" class="form-control" placeholder="do" id="fl_price2">
									</div>
								</div>
							</div>
							
							<div id="customFilters"></div>
						</div>
					</div>
				</div>
				
				<div class="mt-3">
					<button type="button" class="btn btn-primary w-100" id="btnFiltersApply">
					<i class="fas fa-check"></i> Zastosuj
					</button>
				</div>
			</div>
		</div>
		
		<div class="col-12 col-lg-7" id="columnRight">
			<div class="card card-body">
				@if (count($offers) == 0)
				<div class="text-center">
					<h4><i class="fas fa-search"></i> Nie znaleziono żadnych ofert!</h4>
				</div>
				@endif
				
				@foreach($offers as $offer)
				
				<div class="row py-3 border-top border-bottom">
					<div class="col-3">
						<a href="{{ route('pageOfferItem', ['id'=> $offer->id,'name'=>$offer->generateURLName()]) }}" class="none">
							<div style="height: 130px;" class="bg-dark w-100 py-1">
								<div class="w-100 h-100 main-tile-image" style="background-image: url('/storage/offers_images/{{ $offer->getFirstImageName() }}')"></div>
							</div>
						</a>
					</div>
					<div class="col-5 d-flex flex-column">
						<a href="{{ route('pageOfferItem', ['id'=> $offer->id,'name'=>$offer->generateURLName()]) }}" class="none">
							<h5>{{ $offer->title }}</h5>
						</a>
						<div class="mt-auto">
							<small><i class="fas fa-map-marker-alt"></i> {{ $offer->getTextLocation() }}</small>
						</div>
					</div>
					<div class="col-4 text-dark text-right">
						<h6>{{ $offer->getTextPrice() }}</h6>
					</div>
				</div>
				
				@endforeach
			</div>
			
			
			<div class="mt-3">
				<ul class="pagination" style="justify-content: center;">
					<li class="page-item" data-page-number="{{ $pageCurrent - 1 }}">
						<a class="page-link" href="#">&laquo;</a>
					</li>
					@for($i = 1 ; $i <= $pageMax ; $i++)
					<li class="page-item {{ $i == $pageCurrent ? 'active' : '' }}" data-page-number="{{ $i }}">
						<a class="page-link" href="#">{{ $i }}</a>
					</li>
					@endfor
					<li class="page-item" data-page-number="{{ $pageCurrent + 1 }}">
						<a class="page-link" href="#">&raquo;</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>


@include('home.modules.auth_login')

<script src="{{ asset('assets/js/utils/search.engine.js') }}" charset="utf-8"></script>
<script src="{{ asset('assets/js/offers/list.js') }}" charset="utf-8"></script>
<script>
	pageMax = parseInt({{ $pageMax }});

	$(document).ready(function () {
		$("#inpSearchDistrict").val( {{ $_GET['locd'] ?? "" }} );
	});
</script>
@endsection