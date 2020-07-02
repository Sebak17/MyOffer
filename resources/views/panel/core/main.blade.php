@extends('home.core.app')

@section('content')

<div class="container-fluid mt-3">
	<div class="row">
		
		<div class="col-12 col-md-3 col-xl-2 offset-xl-1 mb-5">
			<nav class="navbar bg-light">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="http://myshop2.local/panel">
							<i class="fas fa-solar-panel"></i> Panel główny
						</a>
					</li>

					<li class="nav-item w-100"><hr class="border-top"></li>

					<li class="nav-item">
						<a class="nav-link" href="{{ route('pagePanelOfferAdd') }}">
							<i class="fas fa-plus-circle"></i> Dodaj ofertę
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="{{ route('pagePanelOffersList') }}">
							<i class="fas fa-list"></i> Lista moich ofert
						</a>
					</li>

					<li class="nav-item w-100"><hr class="border-top"></li>

					<li class="nav-item">
						<a class="nav-link" href="{{ route('pagePanelFavoritesList') }}">
							<i class="fas fa-star fa-1x"></i> Obserwowane
						</a>
					</li>

					<li class="nav-item w-100"><hr class="border-top"></li>

					<li class="nav-item">
						<a class="nav-link" href="{{ route('pagePanelSettings') }}">
							<i class="fas fa-cog fa-1x"></i> Ustawienia
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route('logout') }}">
							<i class="fas fa-sign-out-alt"></i> Wyloguj się
						</a>
					</li>
				</ul>
			</nav>
			
		</div>
		<div class="col-12 col-md-9 col-xl-8 mt-3">
			@yield('subcontent')
		</div>
	</div>
</div>



@endsection