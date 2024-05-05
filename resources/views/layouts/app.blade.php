<!DOCTYPE html>
{{-- <html lang="en"> --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="ANYPO.NET - Control Expenses ">
	<meta name="author" content="Iqbal H Khondker">

	<title>@yield('title', 'ANYPO.NET')</title>
	<link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" >

	<!-- CSRF Token TODO CHECK-->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Scripts -->
	@vite(['resources/sass/app.scss', 'resources/js/app.js'])
	
	<!-- Choose your preferred color scheme -->
	<link href="{{ asset('css/light.css') }}" rel="stylesheet">
	{{-- <link rel="stylesheet" href="{{ Storage::disk('s3t')->url('css/light.css') }}"> --}}

	<!-- Custom style -->
	<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
	{{-- <link rel="stylesheet" href="{{ Storage::disk('s3t')->url('css/custom.css') }}"> --}}
	{{-- <script src="{{ asset('js/custom.js') }} "></script> --}}
	{{-- <link rel="stylesheet" href="{{ Storage::disk('s3t')->url('js/custom.js') }}"> --}}

	{{-- @livewireStyles --}}

</head>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="{{ route('home') }}">
					@auth
						<img src="{{ Storage::disk('s3t')->url('logo/'.$_setup->logo) }}" width="90px" height="90px" class="rounded-circle rounded me-2 mb-2" alt="{{ $_setup->name }}"/>
						<h4 class="text-info">{{ $_setup->name}}</h4>
						<h6 class="text-muted">[{{ Str::limit(auth()->user()->name, 25, '...') }}]</h6>
					@endauth
					@guest
						<img src="{{ Storage::disk('s3t')->url('logo/logo.png') }}" width="90px" height="90px" class="rounded-circle rounded me-2 mb-2" alt="{{ $_setup->name }}"/>
						<h4 class="text-info">{{ env('APP_NAME') }}</h4>
						<h6 class="text-danger">Guest!</h6>
					@endguest
					{{-- {{ $_node_name }}	{{ $_route_name }} --}}
					{{-- <img src="/logo/{{ $_setup->logo }}" width="70px" height="70px" class="" alt="{{ $_setup->name }}"/><br> --}}
					{{-- <span class="text-sm align-middle text-primary">{{ $_setup->name}}</span> --}}
					{{-- <span class="text-sm align-middle text-muted"><small>CONTROL EXPENSES</small></span><br> --}}
					{{-- <span class="text-sm align-middle text-muted"><small>[{{ $_node_name }}][ {{ $_route_name }}]</small></span> --}}
				</a>



				{{-- @include('tenant.includes.sidebar') --}}
				{{-- case GUEST		= 'guest';		// was used in EventLog. TODO
				case USER		= 'user';		// Landlord + Tenant
				 case BUYER		= 'buyer';
				// TODO Deletes
				case MANAGER	= 'manager';	// for Future in Tenant when unit within Dept is enabled
				case HOD		= 'hod';
				case CXO		= 'cxo';
				case ADMIN		= 'admin';		// Landlord + Tenant, customer admin, 
				
				// Bellow back office roles. They have by default customer admin access
				case SUPPORT	= 'support';	// Landlord + Tenant
				case SUPERVISOR	= 'supervisor';	// Landlord +
				 case DEVELOPER	= 'developer';	// Landlord
				case ACCOUNTS	= 'accounts';	// Landlord
				case SYSTEM		= 'system';		// Landlord + Tenant, ack-office --}}

				@include('tenant.includes.sidebar')

				{{-- <div class="sidebar-cta">
					<div class="sidebar-cta-content">
						<strong class="d-inline-block mb-2">Monthly Sales Report</strong>
						<div class="mb-3 text-sm">
							Your monthly sales report is ready for download!
						</div>

						<div class="d-grid">
							<a href="https://themes.getbootstrap.com/product/appstack-responsive-admin-template/" class="btn btn-primary" target="_blank">Download</a>
						</div>
					</div>
				</div> --}}
				<div class="fixed-bottom text-sm pb-2 ps-4" >
					<span class="text-center">© {{ env('APP_NAME') }} v{{ env('APP_VERSION') }}</span>
				</div>

			</div>
		</nav>
		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle">
					{{-- <i class="hamburger align-self-center"></i> --}}
					{{-- <i class="align-middle" data-feather="layout"></i>  --}}
					{{-- <i class="fas fa-plus fa-2xl align-self-center"></i> --}}
					{{-- <i class="fa-solid fa-bars-staggered"></i> --}}
					{{-- <i class="fa-solid fa-expand"></i> --}}
					{{-- <i class="fa-solid fa-arrows-left-right-to-line"></i> --}}
					{{-- <i class="fa-solid fa-up-right-and-down-left-from-center"></i> --}}
					<i class="hamburger align-self-center fa-2xl align-self-center text-muted"></i>
				</a>

				{{-- <form class="d-none d-sm-inline-block">
					<div class="input-group input-group-navbar">
						<input type="text" class="form-control" placeholder="Search projects…" aria-label="Search">
						<button class="btn" type="button">
							<i class="align-middle" data-feather="search"></i>
						</button>
					</div>
				</form> --}}

				<ul class="navbar-nav">
					<li class="nav-item px-2 dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Quick Menu
						</a>
						<div class="dropdown-menu dropdown-menu-start dropdown-mega" aria-labelledby="servicesDropdown">
							<div class="d-md-flex align-items-start justify-content-start">
								<div class="dropdown-mega-list">
									<div class="dropdown-header">Transaction</div>
									<a class="dropdown-item" href="{{ route('prs.create') }}">Create Requisitions</a>

									@can('create', App\Models\Tenant\Po::class)
										<a class="dropdown-item" href="{{ route('pos.create') }}">Create Purchase Orders</a>
									@endcan
									@can('create', App\Models\Tenant\Lookup\Items::class)
										<a class="dropdown-item" href="{{ route('items.create') }}">Create Item</a>
									@endcan
									@can('create', App\Models\Tenant\Lookup\Supplier::class)
										<a class="dropdown-item" href="{{ route('suppliers.create') }}">Create Supplier</a>
									@endcan
									@can('create', App\Models\Tenant\Lookup\Project::class)
										<a class="dropdown-item" href="{{ route('projects.create') }}">Create Project</a>
									@endcan
									@can('create', App\Models\Tenant\Admin\User::class)
										<a class="dropdown-item" href="{{ route('users.create') }}">Create User</a>
									@endcan
								</div>
								<div class="dropdown-mega-list">
									<div class="dropdown-header">Listing</div>
									<a class="dropdown-item" href="{{ route('prs.index') }}">View Requisitions</a>
									@can('viewAny', App\Models\Tenant\Po::class)
										<a class="dropdown-item" href="{{ route('pos.index') }}">View Purchase Orders</a>
									@endcan
									<a class="dropdown-item" href="{{ route('receipts.index') }}">View Receipts*</a>
									<a class="dropdown-item" href="{{ route('invoices.index') }}">View Invoices*</a>
									<a class="dropdown-item" href="{{ route('payments.index') }}">View Payments*</a>
								</div>
							</div>
						</div>
					</li>
				</ul>
				@auth
					{{-- <img src="{{ Storage::disk('s3t')->url('logo/'.$_setup->logo) }}" class="avatar img-fluid rounded-circle me-1" alt="{{ $_setup->name }}" />
					<span class="h3 text-info m-2">{{ $_setup->name}}</span> --}}
					{{-- <span class="text-dark">{{ $_setup->name}},{{ $_setup->address1 }}, {{ $_setup->city.', '.$_setup->state.', '.$_setup->zip  }} {{ $_setup->country }}</span> --}}
				@endauth
				@guest
					<span class="text-secondary">Welcome, Guest</span>
				@endguest


				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">

						<a class="nav-flag dropdown-toggle" href="#" id="languageDropdown" data-bs-toggle="no-dropdown">
							<img src="{{ Storage::disk('s3t')->url('img/flags/'. Str::lower($_setup->country).'.png') }}" alt="{{ $_setup->country }}" />
						</a>

						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
										<i class="align-middle" data-feather="bell"></i>
									<span class="indicator"> {{ $_count_unread_notifications }} </span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
								<div class="dropdown-menu-header">
									<div class="position-relative">
										{{ $_count_unread_notifications }} New Notification
									</div>
								</div>
								<div class="list-group">
									@auth
										@foreach($_notifications as $notification)
											<a href="{{ route('notifications.show', $notification->id) }}" class="list-group-item">
												<div class="row g-0 align-items-center">
													<div class="col-2">
														<img src="{{ Storage::disk('s3t')->url('avatar/avatar.png') }}" class="avatar img-fluid rounded-circle" alt="{{ $notification->data['from'] }}">
													</div>
													<div class="col-10 ps-2">
														<div class="text-dark">{{ $notification->data['from'] }}</div>
														<div class="text-muted small mt-1">{{ $notification->data['subject']  }}</div>
														<div class="text-muted small mt-1">{{ $notification->created_at->diffForHumans() }}</div>
													</div>
												</div>
											</a>
											@if($loop->iteration > 5)
												@break
											@endif
										@endforeach
									@endauth
								</div>
								<div class="dropdown-menu-footer">
									<a href="{{ route('notifications.index') }}" class="text-muted">Show all Notifications</a>
								</div>
							</div>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>
							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								@auth
									<img src="{{ Storage::disk('s3t')->url('avatar/'.auth()->user()->avatar) }}" class="avatar img-fluid rounded-circle me-1" alt="{{ auth()->user()->name }}"/>
									<span class="text-dark">{{ Str::limit(auth()->user()->name, 25, '...') }}</span>
									{{-- @if ( auth()->user()->avatar == "")
										<img src="{{ url($_avatar_dir . 'avatar.png') }}" class="avatar img-fluid rounded-circle me-1" alt="{{ auth()->user()->name }}"/>
									@else --}}
										{{-- <img src="{{ url($_avatar_dir . auth()->user()->avatar) }}" class="avatar img-fluid rounded-circle me-1" alt="{{ auth()->user()->name }}"/> --}}
									{{-- @endif --}}
								@endauth
									@guest
									{{-- <img src="{{asset('img/avatar.png')}}" class="avatar img-fluid rounded-circle me-1" alt="Guest" />  --}}
									<img src="{{ Storage::disk('s3t')->url('avatar/avatar.png') }}" class="avatar img-fluid rounded-circle me-1" alt="Guest" />
									<span class="text-dark">Guest</span>
								@endguest
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								@auth
									<a class="dropdown-item" href="{{ route('users.profile') }}"><i class="align-middle me-1" data-feather="user"></i> {{ Str::limit(auth()->user()->name, 18, '...') }}</a>
									<a class="dropdown-item" href="{{ route('users.profile-password') }}"><i class="align-middle me-1" data-feather="key"></i> Change Password</a>
								@endauth

								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ route('dashboards.index') }}"><i class="align-middle me-1" data-feather="pie-chart"></i> Dashboard</a>
								<a class="dropdown-item" href="{{ route('notifications.index') }}"><i class="align-middle me-1" data-feather="bell-off"></i> Notifications</a>
								<a class="dropdown-item" href="{{ route('help') }}"> <i class="align-middle me-1" data-feather="help-circle"></i> Help</a>
								<a class="dropdown-item" href="{{ route('tickets.create')  }}"><i class="align-middle me-1" data-feather="message-square"></i> Support</a>
								<a class="dropdown-item" href="{{ route('logout') }}"><i class="align-middle text-danger me-1" data-feather="power"></i> Sign out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<div class="row justify-start">
						<div class="col-12">

							<!-- Show Tenant Notice -->
							@if ($_setup->show_banner && ($_setup->banner_message <> '') )

								<div class="alert alert-danger alert-outline alert-dismissible" role="alert">
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									<div class="alert-icon">
										<i class="far fa-fw fa-bell"></i>
									</div>
									<div class="alert-message text-danger">
										<strong class="text-danger">ANNOUNCEMENT!</strong> {{ $_setup->banner_message}}
									</div>
								</div>
							@endif

							
							@if (session('success'))
								<x-tenant.alert.success message="{{ session('success') }}"/>
							@endif
							@if (session('error') || $errors->any())
								<x-tenant.alert.error message="{{ session('error') }}"/>
							@endif
							<!-- Form Validation Error Message Box -->
							{{-- @if ($errors->any())
								<x-alert.error/>
							@endif --}}
						</div>
					</div>
					{{-- <h1 class="h3 mb-3">Blank Page</h1> --}}

					@if ($_setup->freezed)
						<!-- breadcrumb -->	
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><i class="align-top text-muted" data-feather="home"></i><a href="{{ route('home') }}"> Home</a></li>
								@yield('breadcrumb')
								{{-- 
									<li class="breadcrumb-item"><a href="#">Library</a></li>
									<li class="breadcrumb-item active">Data</li> 
									--}}
							</ol>
						</nav>
						<!-- /.breadcrumb -->
					<!-- content -->
				
						@yield('content')
						<!-- /.content -->
					@else
						<!-- content -->
						@include('tenant.admin.setups.initial')
						<!-- /.content -->
					@endif
				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-8 text-start">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="{{ route('tickets.create') }}">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="{{ route('help') }}">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="{{ route('privacy') }}">Privacy Policy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="{{ route('tos') }}">Terms of Service</a>
								</li>

								@guest
									Welcome Guest. Please  <a class="list-inline-item" href="{{ route('login') }}" class="text-primary">Login</a> here.
								@endguest


							</ul>
						</div>
						<div class="col-4 text-end">
							<p class="mb-0">
								Laravel v{{ app()->version() }} (PHP v{{ phpversion() }}) 
								<script>document.write(new Date().getFullYear())</script> © <a href="https://anypo.net/" target="_blank" class="text-reset">{{ env('APP_NAME') }}</a>.</p>
							</p>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	
	{{-- Dont Switch --}}
	<script src="{{ asset('js/app.js') }}"></script>
	{{-- <script src="{{ Storage::disk('s3t')->url('js/app.js') }}"></script> --}}
	<!-- Only call `feather.replace` once on each page -->
	
	{{-- @livewireScripts --}}
</body>

</html>