<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<a class="navbar-brand" href="/">
		<img src="{{ asset('assets/img/icons/favicon2-96x96.png') }}" height="40px" alt="Logo">
		{{ config('app.name') }}
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menuMav" aria-controls="menuMav" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	
	<div class="collapse navbar-collapse" id="menuMav">
		
		<ul class="navbar-nav nav align-items-center justify-content-end ml-auto">
			@auth('web')
			<li class="nav-item mr-5">
				<a class="none text-white iconrotate90" href=""><i class="fas fa-plus"></i> Dodaj ogłoszenie</a>
			</li>
			<li class="nav-item dropdown mr-5">
				<button class="btn btn-secondary dropdown-toggle" type="button" id="navbardrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="far fa-user-circle"></i> {{ Auth::user()->email }} &nbsp;<i class="fas fa-arrow-down"></i>
				</button>
				
				<div class="dropdown-menu" aria-labelledby="navbardrop">

					<a class="dropdown-item" href="{{ route('home') }}">
						<i class="fas fa-box-open"></i> Moje ogłoszenia
					</a>

					<div class="dropdown-divider"></div>

					<a class="dropdown-item" href="{{ route('home') }}">
						<i class="fas fa-star"></i> Obserwowane
					</a>

					<div class="dropdown-divider"></div>

					<a class="dropdown-item" href="{{ route('logout') }}">
						<i class="fas fa-cog"></i> Ustawienia
					</a>

					<a class="dropdown-item" href="{{ route('logout') }}">
						<i class="fas fa-sign-out-alt"></i> Wyloguj się
					</a>
				</div>
			</li>
			
			@else
			<li class="nav-item mt-2">
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalAuthLogin"><i class="fas fa-sign-in-alt"></i> Zaloguj</button>
				<a class="none" href="{{ route('page_auth_register') }}">
					<button type="button" class="btn btn-info"><i class="fas fa-globe-europe"></i> Zarejestruj</button>
				</a>
			</li>
			@endif
		</ul>
	</div>
</nav>