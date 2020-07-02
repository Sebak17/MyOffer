@extends('panel.core.main')

@section('subcontent')
<div class="page-header">
    <h2><i class="far fa-heart"></i> Ulubione produkty</h2>
</div>

<hr>

<div class="row">
    @if(empty($offers))
    <div class="col-12 text-center">
        <h3>
        Nie znaleziono żadnych ulubionych produktów!
        </h3>
    </div>
    <div class="col-12 text-center">
        <img src="https://i.imgur.com/WfZ2pj3.gif" style="width: 20%;">
    </div>
    @endif
    
    @foreach($offers as $offer)
    <div class="col-6 col-lg-3 mb-3">
        <a href="{{ route('pageOfferItem', ['id'=> $offer->id,'name'=>$offer->generateURLName()]) }}" class="none">
            <div class="card">
                <div style="height: 180px;" class="bg-dark w-100 py-1 img-thumbnail">
                    <div class="w-100 h-100 main-tile-image" style="background-image: url('/storage/offers_images/{{ $offer->getFirstImageName() }}')"></div>
                </div>
                
                <div class="card-body">
                    <h3 class="card-title">{{ $offer->getTextPrice() }}</h3>
                    <h5 class="card-subtitle text-muted">{{ $offer->title }}</h5>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

@endsection