@extends('layouts.app')
@section('title','Users')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Users
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="User"/>
		@endslot
	</x-tenant.page-header>
	
	@php
		use App\Models\User;
		$count_total    = User::TenantAll()->count();
		$count_active   = User::Tenant()->count();
		$count_inactive = User::TenantInactive()->count();
		$count_admin    = User::TenantAdmin()->count();
	@endphp

	<div class="row">
		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body">
					<div class="row">
						<div class="col mt-0">
							<h5 class="card-title">Total User</h5>
						</div>

						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-feather="activity"></i>
							</div>
						</div>
					</div>
					<span class="h1 d-inline-block mt-1">{{ $count_total }}</span>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body">
					<div class="row">
						<div class="col mt-0">
							<h5 class="card-title">Active User</h5>
						</div>
						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-feather="shopping-bag"></i>
							</div>
						</div>
					</div>

					<span class="h1 d-inline-block mt-1">{{ $count_active }}</span>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body">
					<div class="row">
						<div class="col mt-0">
							<h5 class="card-title">Inactive User</h5>
						</div>

						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-feather="shopping-cart"></i>
							</div>
						</div>
					</div>
					<span class="h1 d-inline-block mt-1">{{ $count_inactive }}</span>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body">
					<div class="row">
						<div class="col mt-0">
							<h5 class="card-title">Admin User</h5>
						</div>

						<div class="col-auto">
							<div class="stat stat-sm">
								<i class="align-middle" data-feather="activity"></i>
							</div>
						</div>
					</div>
					<span class="h1 d-inline-block mt-1">{{ $count_admin }}</span>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="User"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							User Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
				</div>

				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>Lead</th>
								<th>Email</th>
								<th>Title</th>
								<th>Cell No</th>
								<th>Dept</th>
								<th>Role</th>
								<th>Enable</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $user)
							<tr>
								<td>
									{{-- <x-tenant.list.my-avatar :avatar="$user->avatar"/> --}}
									{{-- <img src="{{ url("tenant\\".tenant('id')."\\".config('akk.DIR_AVATAR') . $user->avatar) }}" width="48" height="48" class="rounded-circle me-2" alt="Avatar">		 --}}
									<img src="{{ Storage::disk('s3ta')->url($user->avatar) }}" width="48" height="48" class="rounded-circle me-2" alt="Avatar">
									<a class="text-info" href="{{ route('users.show',$user->id) }}">{{ $user->name }}</a>
									@if ( (auth()->user()->role->value == UserRoleEnum::SYSTEM->value) && $user->seeded )
										<span class="text-danger"> (*)</span>
									@endif
								</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->designation_name->name }}</td>
								<td>{{ $user->cell }}</td>
								<td>{{ $user->dept_name->name }}</td>
								<td><x-tenant.list.my-badge :value="$user->role"/></td>
								<td><x-tenant.list.my-boolean :value="$user->enable"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="User" :id="$user->id"/>
									<a href="{{ route('users.destroy',$user->id) }}" class="me-2 modal-boolean-advance"
										data-entity="User" data-name="{{ $user->name }}" data-status="{{ ($user->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($user->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-feather="{{ ($user->enable ? 'bell-off' : 'bell') }}"></i></a>

									@if(session('original_user'))
										<a wire:ignore href="{{ route('users.leave-impersonate') }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Leave Impersonate">
											<i class="align-middle text-success" data-feather="log-in"></i>
										</a>
									@else
										@can('impersonate',$user)
											<a wire:ignore href="{{ route('users.impersonate',$user->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Impersonate">
												<i class="align-middle text-danger" data-feather="log-out"></i>
											</a>
										@endcan
									@endif

									{{-- <a href="{{ route('users.impersonate', $user->id) }}" class="btn btn-warning btn-sm">Impersonate</a>
									@if(session('original_user'))
										<a href="{{ route('users.leave-impersonate') }}" class="btn btn-outline-light me-2">Leave Impersonation</a>
									@endif --}}
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $users->links() }}
					</div>
					<!-- end pagination -->

				</div>
				<!-- end card-body -->
			</div>
			<!-- end card -->

		</div>
		 <!-- end col -->
	</div>
	 <!-- end row -->

	 @include('tenant.includes.modal-boolean-advance')

@endsection

