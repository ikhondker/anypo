@extends('layouts.tenant.app')
@section('title','Users')
@section('breadcrumb')
	<li class="breadcrumb-item active">Users</li>
@endsection

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
		$count_total	= User::TenantAll()->count();
		$count_active	= User::Tenant()->count();
		$count_inactive	= User::TenantInactive()->count();
		$count_admin	= User::TenantAdmin()->count();
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
								<i class="align-middle" data-lucide="database"></i>
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
								<i class="align-middle" data-lucide="bell"></i>
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
								<i class="align-middle" data-lucide="bell-off"></i>
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
								<i class="align-middle" data-lucide="activity"></i>
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
					<x-tenant.card.header-search-export-bar object="User"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							User Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of Users.</h6>
				</div>

				<div class="card-body">
					<table class="table w-100">
						<thead>
							<tr>
								<th class="align-middle">Lead</th>
								<th class="align-middle">Email</th>
								<th class="align-middle">Role</th>
								<th class="align-middle">Title</th>
								<th class="align-middle">Dept</th>
								<th class="align-middle">Enable</th>
								<th class="align-middle">View</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $user)
							<tr>
								<td>
									{{-- <x-tenant.list.my-avatar :avatar="$user->avatar"/> --}}
									{{-- <img src="{{ url("tenant\\".tenant('id')."\\".config('akk.DIR_AVATAR') . $user->avatar) }}" width="48" height="48" class="rounded-circle me-2" alt="Avatar">		 --}}
									<img src="{{ Storage::disk('s3t')->url('avatar/'.$user->avatar) }}" width="48" height="48" class="rounded-circle me-2" alt="Avatar">
									<a href="{{ route('users.show',$user->id) }}"><strong>{{ $user->name }}</strong></a>
									@if ( (auth()->user()->role->value == UserRoleEnum::SYSTEM->value) && $user->seeded )
										<span class="text-danger"> (*)</span>
									@endif
								</td>
								<td>{{ $user->email }}</td>
								<td>
									@if ($user->isAdmin())
										<span class="badge badge-subtle-danger">{{ $user->role }}</span>
									@else
										<span class="badge badge-subtle-success">{{ $user->role }}</span>
									@endif
								</td>
								<td>{{ $user->designation->name }}</td>
								<td>{{ $user->dept->name }}</td>

								<td><x-tenant.list.my-boolean :value="$user->enable"/></td>
								<td>
									<a href="{{ route('users.show',$user->id) }}" class="btn btn-light"
										data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
									</a>

									@if(session('original_user'))
										{{-- <a wire:ignore href="{{ route('users.leave-impersonate') }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Leave Impersonate">
											<i class="align-middle text-success" data-lucide="log-in"></i>
										</a> --}}
									@else
										@can('impersonate', $user)
											@if (! $user->isSeeded() )
												<a href="{{ route('users.impersonate',$user->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
												data-bs-placement="top" title="Impersonate"><i data-lucide="log-in" class="text-danger"></i></a>
											@else
												@if (auth()->user()->isSystem())
													<a href="{{ route('users.impersonate',$user->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
														data-bs-placement="top" title="Impersonate"><i data-lucide="log-in" class="text-danger"></i></a>
												@endif
											@endif
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



@endsection

