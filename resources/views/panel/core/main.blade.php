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
			
			<!-- <div class="page-header">
				<h2><i class="fas fa-receipt"></i> Lista zamówień</h2>
			</div>
			
			<hr>
			
			<div class="card card-body">
				<div class="row">
					<div class="col-12">
						
						
						<table class="table table-stripped">
							<thead>
								<tr>
									<th><i class="fas fa-list-ol"></i> Numer zamówienia</th>
									<th><i class="fas fa-calendar-alt"></i> Data złożenia</th>
									<th class="d-none d-sm-table-cell"><i class="fas fa-shopping-cart"></i> Ilość produktów</th>
									<th><i class="fas fa-eye"></i> Status</th>
									<th><i class="fas fa-dollar-sign"></i> Koszt</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-center">
										<a href="http://myshop2.local/zamowienie/1">
											<h4>
											<span class="badge badge-primary">1</span>
											</h4>
										</a>
									</td>
									<td>2020-02-29 22:50:31</td>
									<td class="d-none d-sm-table-cell">3</td>
									<td><strong>Zapłacone</strong></td>
									<td>3062.99 zł</td>
								</tr>
							</tbody>
						</table>
					</div>
					
				</div>
			</div> -->
			@yield('subcontent')
		</div>
	</div>
</div>



@endsection