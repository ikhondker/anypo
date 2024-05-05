@extends('layouts.landlord-app')
@section('title', 'Menus')
@section('breadcrumb', 'Menus List')


@section('content')

	<!-- Card -->
	<div class="card">

		<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
			<h5 class="card-header-title">Menu List</h5>
			<a class="btn btn-primary btn-sm" href="{{ route('menus.create') }}">
				<i class="bi bi-plus-square me-1"></i> Create Menu
			</a>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
					<tr>
						<th>Menu Name</th>
						<th>Menu</th>
						<th>Access</th>
						<th>Enable</th>
						<th style="width: 5%;">Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($menus as $menu)
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
										<img class="avatar avatar-sm avatar-circle"
											src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" alt="Logo">
									</div>
									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark" href="{{ route('menus.show', $menu->id) }}">
											<h6 class="text-hover-primary mb-0">
												{{ $menu->raw_route_name }}
											</h6>
										</a>
										<small class="d-block">{{ $menu->route_name }}</small>
									</div>
								</div>
							</td>
							<td>{{ $menu->route_name }} </td>
							<td>{{ $menu->access }} </td>
							<td><x-landlord.list.my-enable :value="$menu->enable" /></td>
							<td>

								<x-landlord.list.actions object="Menu" :id="$menu->id" />
								<a href="{{ route('menus.delete', $menu->id) }}"
									class="text-body sw2-advance" data-entity="Menu"
									data-name="{{ $menu->route_name }}"
									data-status="{{ $menu->enable ? 'Disable' : 'Enable' }}" data-bs-toggle="tooltip"
									data-bs-placement="top" title="{{ $menu->enable ? 'Disable' : 'Enable' }}">
									<i class="bi {{ $menu->enable ? 'bi-bell-slash' : 'bi-bell' }} "
										style="font-size: 1.3rem;"></i>
								</a>


								@if (session('original_user'))
									<a href="{{ route('menus.leave-impersonate') }}" class="me-2"
										data-bs-toggle="tooltip" data-bs-placement="top" title="Leave Impersonate">
										<i class="bi bi-box-arrow-left text-danger" style="font-size: 1.3rem;"></i>
									</a>
								@else
									@can('impersonate', $menu)
										<a href="{{ route('menus.impersonate', $menu->id) }}" class="me-2"
											data-bs-toggle="tooltip" data-bs-placement="top" title="Impersonate">
											<i class="bi bi-box-arrow-right text-success" style="font-size: 1.3rem;"></i>
										</a>
									@endcan
								@endif

								{{-- <a class="text-body" href="javascript:;" data-bs-toggle="tooltip" data-bs-placement="top" title="Locked">
									<i class="bi-lock-fill" style="font-size: 1.5rem;"></i>
									<i class="bi bi-eye" style="font-size: 1.5rem;"></i>
								</a> --}}
							</td>
						</tr>
					@endforeach


				</tbody>
			</table>
		</div>
		<!-- End Table -->

		<!-- card-body -->
		<div class="card-body">
			<!-- pagination -->
			{{ $menus->links() }}
			<!--/. pagination -->
		</div>
		<!-- /. card-body -->

	</div>
	<!-- End Card -->

	

@endsection
