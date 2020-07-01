@extends('panel.core.main')

@section('subcontent')
<div class="page-header">
	<h2><i class="fas fa-list-ol"></i> Moje oferty</h2>
</div>

<hr>

<div class="alert d-none" id="alertOffersList"></div>

<div class="card card-body">
	<div class="table-responsive">
		<table class="table table-stripped">
			<thead>
				<tr>
					<th></th>
					<th>Tytuł</th>
					<th>Cena</th>
					<th>Status</th>
					<th>Opcje</th>
				</tr>
			</thead>
			<tbody>
				@foreach($offers as $offer)
				<tr>
					<td class="align-middle" style="width: 200px; height: 150px;">
						<img class="img-thumbnail"  src="/storage/offers_images/{{ $offer->getFirstImageName() }}" alt="">
					</td>
					<td class="align-middle">{{ $offer->title }}</td>
					<td class="align-middle"><strong>{{ $offer->getTextPrice() }}</strong></td>
					<td class="align-middle">{{ $offer->getTextStatus() }}</td>
					<td class="align-middle">
						<a href="{{ route('pageOfferItem', ['id'=> $offer->id,'name'=>$offer->generateURLName()]) }}" class="none">
							<button class="btn btn-primary btn-sm mt-2"><i class="fas fa-eye"></i></button>
						</a>
						<a href="#" class="none">
							<button class="btn btn-success btn-sm mt-2"><i class="fas fa-edit"></i></button>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection