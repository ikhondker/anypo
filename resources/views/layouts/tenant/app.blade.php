<!DOCTYPE html>
<!--
	HOW TO USE:
	data-layout: fluid (default), boxed
	data-sidebar-theme: dark (default), colored, light
	data-sidebar-position: left (default), right
	data-sidebar-behavior: sticky (default), fixed, compact
-->
<html lang="en"
	data-bs-theme="light"
	data-layout="fluid"
	data-sidebar-theme="dark"
	data-sidebar-position="left"
	data-sidebar-behavior="fixed">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="ANYPO.NET - Control Expenses ">
	<meta name="author" content="Iqbal H Khondker">

	<!-- Title -->
	<title>@yield('title', 'ANYPO.NET')</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">

	<link rel="canonical" href="https://www.anypo.net/404" />

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

	<!-- CSS Front Template -->
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('css/tenant.css') }}">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">

				<div class="sidebar-brand">
					@auth
						<a class="" href="{{ route('home') }}">
							<img src="{{ Storage::disk('s3t')->url('logo/'.$_setup->logo) }}" width="90px" height="90px" class="rounded-circle rounded" alt="{{ $_setup->name }}"/>
							<h4 class="text-info">{{ $_setup->name}}</h4>
						</a>
						<a class="" href="{{ route('users.profile') }}">
							<h6 class="text-muted">[{{ Str::limit(auth()->user()->name, 25, '...') }}]</h6>
						</a>
						{{-- <p class="small text-muted m-0 p-0">{{ auth()->user()->email }}</p> --}}
					@endauth
					@guest
						<img src="{{ Storage::disk('s3t')->url('logo/logo.png') }}" width="90px" height="90px" class="rounded-circle rounded me-2 mb-2" alt="{{ $_setup->name }}"/>
						<h4 class="text-info">{{ env('APP_NAME') }}</h4>
						<h6 class="text-danger">Guest!</h6>
					@endguest
				</div>

				<!-- ========== SIDEBAR ========== -->
				@include('tenant.includes.sidebar')
				<!-- ========== END SIDEBAR ========== -->

			</div>
		</nav>
		<div class="main">
            @if ($_setup->demo)
				<x-tenant.alerts.warning message="This is a Demo Instance" />
			@endif

			<nav class="navbar navbar-expand navbar-bg">
				<a class="sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<form class="d-none d-sm-inline-block">
					<div class="input-group input-group-navbar">
						<input type="text" class="form-control" placeholder="Search PO…" aria-label="Search">
						<button class="btn" type="button">
							<i class="align-middle" data-lucide="search"></i>
						</button>
					</div>
				</form>

				<ul class="navbar-nav">
					<li class="nav-item px-2 dropdown d-none d-sm-inline-block">
						<a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Menu
						</a>
						<div class="dropdown-menu dropdown-menu-start dropdown-mega" aria-labelledby="servicesDropdown">
							<div class="d-md-flex align-items-start justify-content-start">
								<div class="dropdown-mega-list">
									<div class="dropdown-header"><strong>Transactions</strong></div>
									<a class="dropdown-item" href="{{ route('prs.create') }}"><i class="align-middle" data-lucide="plus-circle"></i> Create Requisitions</a>

									@can('create', App\Models\Tenant\Po::class)
										<a class="dropdown-item" href="{{ route('pos.create') }}"><i class="align-middle" data-lucide="plus-circle"></i> Create Purchase Orders</a>
									@endcan
									@can('create', App\Models\Tenant\Lookup\Item::class)
										<a class="dropdown-item" href="{{ route('items.create') }}"><i class="align-middle" data-lucide="plus-circle"></i> Create Item</a>
									@endcan
									@can('create', App\Models\Tenant\Lookup\Supplier::class)
										<a class="dropdown-item" href="{{ route('suppliers.create') }}"><i class="align-middle" data-lucide="plus-circle"></i> Create Supplier</a>
									@endcan
									@can('create', App\Models\Tenant\Lookup\Project::class)
										<a class="dropdown-item" href="{{ route('projects.create') }}"><i class="align-middle" data-lucide="plus-circle"></i> Create Project</a>
									@endcan
									@can('create', App\Models\Tenant\Admin\User::class)
										<a class="dropdown-item" href="{{ route('users.create') }}"><i class="align-middle" data-lucide="plus-circle"></i> Create User</a>
									@endcan
								</div>
								<div class="dropdown-mega-list">
									<div class="dropdown-header"><strong>Listing</strong></div>
									<a class="dropdown-item" href="{{ route('prs.index') }}"><i class="align-middle" data-lucide="list"></i> View Requisitions</a>
									@can('viewAny', App\Models\Tenant\Po::class)
										<a class="dropdown-item" href="{{ route('pos.index') }}"><i class="align-middle" data-lucide="list"></i> View Purchase Orders</a>
									@endcan
									<a class="dropdown-item" href="{{ route('receipts.index') }}"><i class="align-middle" data-lucide="list"></i> View Receipts*</a>
									<a class="dropdown-item" href="{{ route('invoices.index') }}"><i class="align-middle" data-lucide="list"></i> View Invoices*</a>
									<a class="dropdown-item" href="{{ route('payments.index') }}"><i class="align-middle" data-lucide="list"></i> View Payments*</a>
								</div>
							</div>
						</div>
					</li>
				</ul>

				@auth

				@endauth
				@guest
					<span class="text-secondary">Welcome, Guest</span>
				@endguest

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">

						<li class="nav-item dropdown">
							<a class="nav-flag dropdown-toggle" href="#" id="languageDropdown" data-bs-toggle="dropdown">
								<img src="{{ Storage::disk('s3t')->url('img/flags/'. Str::lower($_setup->country).'.png') }}" alt="{{ $_setup->country }}" />
							</a>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle text-body" data-lucide="message-circle"></i>
									<span class="indicator">{{ $_tenant_count_unread_notifications }}</span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
								<div class="dropdown-menu-header">
									<div class="position-relative">
										{{ $_tenant_count_unread_notifications }} New Notification
									</div>
								</div>
								<div class="list-group">
									@auth
										@foreach($_tenant_notifications as $notification)
											<a href="{{ route('notifications.show', $notification->id) }}" class="list-group-item">
												<div class="row g-0 align-items-center">
													<div class="col-2">
														<img src="{{ Storage::disk('s3t')->url('avatar/avatar.png') }}" class="avatar img-fluid rounded-circle" alt="{{ $notification->data['from'] }}">
													</div>
													<div class="col-10 ps-2">
														<div class="text-dark">{{ $notification->data['from'] }}</div>
														<div class="text-muted small mt-1">{{ $notification->data['subject'] }}</div>
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

						<li class="nav-item nav-theme-toggle dropdown">
							<a class="nav-icon js-theme-toggle" href="#">
								<div class="position-relative">
									<i class="align-middle text-body nav-theme-toggle-light" data-lucide="sun"></i>
									<i class="align-middle text-body nav-theme-toggle-dark" data-lucide="moon"></i>
								</div>
							</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
								<i class="align-middle" data-lucide="settings"></i>
							</a>
							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								@auth
									<img src="{{ Storage::disk('s3t')->url('avatar/'.auth()->user()->avatar) }}" class="img-fluid rounded-circle me-1 mt-n2 mb-n2" alt="{{ auth()->user()->name }}" width="40" height="40"/>
									<span class="text-dark">{{ Str::limit(auth()->user()->name, 25, '...') }}</span>
								@endauth
								@guest
									<img src="{{ Storage::disk('s3t')->url('avatar/avatar.png') }}" class="img-fluid rounded-circle me-1 mt-n2 mb-n2" alt="Guest" width="40" height="40"/> <span>{{ auth()->user()->name }}</span>
									<span class="text-dark">Guest</span>
								@endguest
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								@auth
									<a class="dropdown-item" href="{{ route('users.profile') }}"><i class="align-middle me-1" data-lucide="user"></i> {{ Str::limit(auth()->user()->name, 18, '...') }}</a>
									<a class="dropdown-item" href="{{ route('users.profile-password') }}"><i class="align-middle me-1" data-lucide="key"></i> Change Password</a>
								@endauth
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ route('dashboards.index') }}"><i class="align-middle me-1" data-lucide="pie-chart"></i> Dashboard</a>
								<a class="dropdown-item" href="{{ route('notifications.index') }}"><i class="align-middle me-1" data-lucide="message-square"></i> Notifications</a>
								<a class="dropdown-item" href="{{ route('help') }}"> <i class="align-middle me-1" data-lucide="help-circle"></i> Help</a>
								<a class="dropdown-item" href="{{ route('tickets.create') }}"><i class="align-middle me-1" data-lucide="message-circle"></i> Support</a>
								<a class="dropdown-item" href="{{ route('logout') }}"><i class="align-middle text-danger me-1" data-lucide="power"></i> Sign out</a>
								@if (auth()->user()->isSystem())
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('users.switch') }}"><i class="align-middle text-danger me-1" data-lucide="user"></i> Switch User </a>
								@endif
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<!-- BEGIN TENANT NOTICE -->
					<div class="row justify-start">
						<div class="col-12">
							@if ($_setup->banner_show && ($_setup->banner_message <> '') )
								<div class="alert alert-danger alert-outline alert-dismissible" role="alert">
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									<div class="alert-icon">
										<i data-feather="alert-triangle"></i>
									</div>
									<div class="alert-message text-danger px-4">
										<strong class="text-danger">ANNOUNCEMENT!</strong> {!! nl2br($_setup->banner_message) !!}
									</div>
								</div>
							@endif

							@if (session('success'))
								<x-tenant.alerts.success message="{{ session('success') }}"/>
							@endif
							@if (session('error') || $errors->any())
								<x-tenant.alerts.error message="{{ session('error') }}"/>
							@endif

						</div>
					</div>
					<!-- END TENANT NOTICE -->

					{{-- <h1 class="h3 mb-3">Blank Page</h1> --}}

					@if ($_setup->freezed)
						<!-- breadcrumb -->
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item">
									<a href="{{ route('home') }}" class="text-muted"><i class="align-top text-muted" data-lucide="home"></i> Home</a>
								</li>
								@yield('breadcrumb')
							</ol>
						</nav>
						<!-- /.breadcrumb -->

						{{-- If tenant is enable --}}
						@if ($_setup->enable)
							<!-- content -->
							@yield('content')
							<!-- /.content -->
						@else
							<x-tenant.alerts.error message="This site is disable! You can not access it. Please contact your admin or create a support ticket via {{ config('app.url') }}." />
						@endif
					@else
						@if (auth()->user()->isAdmin() || auth()->user()->isSystem() )
							<!-- content -->
							@include('tenant.admin.setups.initial')
							<!-- /.content -->
						@else
							<x-tenant.alerts.error message="Initial setup not done. Only admin can perform the initial setup."/>
						@endif
					@endif

					{{-- <div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Empty card</h5>
								</div>
								<div class="card-body">
								</div>
							</div>
						</div>
					</div> --}}

				</div>
			</main>
			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
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
									Welcome Guest. Please <a class="list-inline-item" href="{{ route('login') }}" class="text-primary">Login</a> here.
								@endguest
							</ul>
						</div>
						<div class="col-6 text-end">
							<p class="mb-0">
								@if ( (auth()->user()->role->value == UserRoleEnum::SYSTEM->value))
									<a class="text-muted" href="http://localhost:8080/phpmyadmin/index.php?route=/database/structure&db=tenant{{ tenant('id') }}" target="_blank"> {{ tenant('id') }}</a> |
									<a class="text-muted" href="{{ route('tables.index') }}" target="_blank">Tables</a> |
									<a class="text-muted" href="{{ route('cps.ui') }}" target="_blank">UI</a> |
									Laravel v{{ app()->version() }} (PHP v{{ phpversion() }})
								@endif
								<script>document.write(new Date().getFullYear())</script> © <a href="https://anypo.net/" target="_blank" class="text-reset">{{ env('APP_NAME') }}</a></p>
							</p>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>


</body>

</html>
