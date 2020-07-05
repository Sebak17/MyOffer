@extends('home.core.app')

@section('content')

<div class="container mt-5">
	<div class="row">
		@include('home.modules.main_searchbox')
		
		<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mb-3">
			<div class="card text-white bg-danger mb-3">
				<div class="card-body text-center">
					<h4 class="card-title">Nie znaleziono oferty!</h4>
				</div>
			</div>
		</div>
	</div>
</div>


@include('home.modules.auth_login')

<script src="{{ asset('assets/js/utils/search.engine.js') }}" charset="utf-8"></script>
<script>
	$(document).ready(function () {
		$("footer").addClass('fixed-bottom');
	});
</script>
@endsection