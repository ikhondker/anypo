@extends('layouts.landlord-app')
@section('title', 'All Users')
@section('breadcrumb', 'All Users')


@section('content')

	<!-- Card -->
	<div class="card">

		<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
			<h5 class="card-header-title">
				@if (request('term'))
					Search result for: <strong class="text-danger">{{ request('term') }}</strong>
				@else
					All Users 
				@endif
			</h5>
			{{-- <a class="btn btn-primary btn-sm" href="{{ route('users.create') }}">
				<i class="bi bi-plus-square me-1"></i> Create User
			</a> --}}
			<div class="card-actions float-end">
				<!-- form -->
				<form action="{{ route('users.all') }}" method="GET" role="search">

					<div class="btn-group" role="group" aria-label="First group">

						<input type="text" class="form-control form-control-sm" minlength=3 name="term"
							placeholder="Search..." value="{{ old('term', request('term')) }}" id="term" required>

						<button type="submit" class="btn btn-info me-1" data-bs-toggle="tooltip" data-bs-placement="top"
							title="Search..."><i class="bi bi-search"></i></button>

						<a href="{{ route('users.all') }}" class="btn btn-info me-1" data-bs-toggle="tooltip"
							data-bs-placement="top" title="Reload">
							<i class="bi bi-arrow-repeat"></i>
						</a>

						<a href="{{ route('users.export') }}" class="btn btn-info me-1" data-bs-toggle="tooltip"
							data-bs-placement="top" title="Download">
							<i class="bi bi-arrow-down-circle"></i>
						</a>

					</div>
					<a class="btn btn-primary" href="{{ route('users.create') }}">
						<i class="bi bi-plus-circle"></i> Create User
					</a>
				</form>
				<!--/. form -->
			</div>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
					<tr>
						<th>User Name</th>
						<th>Account</th>
						<th>Role</th>
						<th>Enable</th>
						<th style="width: 5%;">Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($users as $user)
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
										{{-- <img class="avatar avatar-sm avatar-circle" src="{{ url($_avatar_dir.$user->avatar) }}" alt="{{ $user->name }}" title="{{ $user->name }}"> --}}
										<img class="avatar avatar-sm avatar-circle" src="{{ Storage::disk('s3l')->url('avatar/'.$user->avatar) }}" alt="{{ $user->name }}" title="{{ $user->name }}">
									</div>
									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark" href="{{ route('users.show', $user->id) }}">
											<h6 class="text-hover-primary mb-0">
												{{ $user->name }}
												@if (is_null($user->email_verified_at) || !$user->enable)
													<i class="bi bi-check-circle-fill text-danger" style="font-size: 1rem;"
														data-bs-toggle="tooltip" data-bs-placement="top"
														title="Unverified or Disabled User"></i>
												@else
													<i class="bi bi-check-circle-fill text-muted" style="font-size: 1rem;"
														data-bs-toggle="tooltip" data-bs-placement="top"
														title="Verified user"></i>
												@endif
											</h6>
										</a>
										<small class="d-block">{{ $user->email }}</small>
									</div>
								</div>
							</td>
							<td>{{ $user->account->name }} </td>
							<td>
								@if ($user->role == UserRoleEnum::USER)
									<span class="badge bg-info">{{ $user->role }}</span>
								@elseif ($user->role == UserRoleEnum::ADMIN)
									<span class="badge bg-danger">{{ $user->role }}</span>
								@else
									<span class="badge bg-warning">{{ $user->role }}</span>
								@endif
							</td>
							<td><x-landlord.list.my-enable :value="$user->enable" /></td>
							<td>

								<x-landlord.list.actions object="User" :id="$user->id" />
								<a href="{{ route('users.destroy', $user->id) }}"
									class="text-body sw2-advance" data-entity="User"
									data-name="{{ $user->name }}"
									data-status="{{ $user->enable ? 'Disable' : 'Enable' }}" data-bs-toggle="tooltip"
									data-bs-placement="top" title="{{ $user->enable ? 'Disable' : 'Enable' }}">
									<i class="bi {{ $user->enable ? 'bi-bell-slash' : 'bi-bell' }} "
										style="font-size: 1.3rem;"></i>
								</a>


								@if (session('original_user'))
									<a href="{{ route('users.leave-impersonate') }}" class="me-2"
										data-bs-toggle="tooltip" data-bs-placement="top" title="Leave Impersonate">
										<i class="bi bi-box-arrow-left text-danger" style="font-size: 1.3rem;"></i>
									</a>
								@else
									@can('impersonate', $user)
										@if ($user->id > 1008 )
											<a href="{{ route('users.impersonate', $user->id) }}" class="me-2"
												data-bs-toggle="tooltip" data-bs-placement="top" title="Impersonate">
												<i class="bi bi-box-arrow-right text-success" style="font-size: 1.3rem;"></i>
											</a>
										@endif
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
			{{ $users->links() }}
			<!--/. pagination -->
		</div>
		<!-- /. card-body -->

	</div>
	<!-- End Card -->

	@include('shared.includes.js.sw2-advance')

@endsection
