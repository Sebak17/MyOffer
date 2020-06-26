@extends('panel.core.main')

@section('subcontent')
<div class="page-header">
	<h2><i class="fas fa-plus-circle"></i> Dodaj ofertę</h2>
</div>

<hr>

<div class="alert d-none" id="alertOfferAdd"></div>

<div class="card card-body">
	<fieldset>
		<div class="form-group row">
			<label for="inpOfferTitle" class="col-sm-2 col-form-label"><i class="fas fa-tag"></i> Tytuł</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="inpOfferTitle" placeholder="Podaj tytuł oferty">
				<small id="inpOfferTitleSub" class="form-text text-muted text-right"></small>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="inpOfferPrice" class="col-sm-2 col-form-label"><i class="fas fa-hand-holding-usd"></i> Cena</label>
			<div class="col-sm-10">
				<input type="number" class="form-control" id="inpOfferPrice" placeholder="Podaj koszt oferty">
			</div>
		</div>
		
		<div class="form-group row">
			<label for="inpOfferCategory" class="col-sm-2 col-form-label"><i class="fas fa-th-large"></i> Kategoria</label>
			<div class="col-sm-10">
				<div class="input-group mb-3">
					<input id="inpOfferCategory" type="text" class="form-control" value="Wybierz kategorie" readonly="">
					<div class="input-group-append">
						<button class="btn btn-secondary" id="btnSelectCategory"><i class="fas fa-zoom"></i> Wybierz</button>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group row">
			<label for="inpOfferLocation" class="col-sm-2 col-form-label"><i class="fas fa-map-marker-alt"></i> Lokalizacja</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="inpOfferLocation" placeholder="Podaj miejsce oferty">
			</div>
		</div>
		
		<div class="form-group row">
			<label for="inpOfferDescription" class="col-sm-2 col-form-label"><i class="fas fa-align-justify"></i> Opis</label>
			<div class="col-sm-10">
				<textarea class="form-control" id="inpOfferDescription" rows="3" placeholder="Podaj opis oferty"></textarea>
				<small id="inpOfferDescriptionSub" class="form-text text-muted text-right"></small>
			</div>
		</div>
		
		<hr>
		
		<div class="row">
			<div class="col-12 mb-4">
				<h5 class="float-left"><i class="fas fa-image"></i> Zdjęcia</h5>
				<button id="btnUploadImages" class="btn btn-success float-right"><i class="fas fa-plus"></i> Dodaj zdjęcie</button>
				
				<input type="file" class="d-none" id="inpOfferImages" accept="image/x-png,image/jpeg" multiple>
			</div>
			
			<div id="imagesList" class="col-12 row"></div>
			
		</div>
		
		<hr>
		
		<div class="w-100 text-right">
			<button class="btn btn-primary iconrotate90" id="btnAddOffer"><i class="fas fa-plus"></i> Zamieść</button>
		</div>
		
	</fieldset>
</div>


<div class="modal fade" id="modalCategorySelect">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Wybierz kategorie</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			
			<div class="modal-body">
				<div></div>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('assets/js/panel/offers.add.js') }}" charset="utf-8"></script>
@endsection