@extends('layouts.landlord.app')
@section('title', 'All Users')
@section('breadcrumb')
	<li class="breadcrumb-item active">All Users</li>
@endsection


@section('content')

	<a href="{{ route('users.create') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New User</a>
	<h1 class="h3 mb-3">All Users</h1>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('users.all') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-user-search"
								minlength=3 name="term"
								value="{{ old('term', request('term')) }}" id="term"
								placeholder="Search users…" required>
							<button class="btn" type="submit">
								<i data-lucide="search"></i>
							</button>

						</div>
							@if (request('term'))
								Search result for: <strong class="text-danger">{{ request('term') }}</strong>
							@endif
					</form>
					<!--/. form -->
				</div>
				<div class="col-md-6 col-xl-8">

					<div class="text-sm-end">
						<a href="{{ route('users.all') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						<a href="{{ route('users.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a>
					</div>
				</div>
			</div>

			<table id="datatables-orders" class="table w-100">
				<thead>
					<tr>

						<th>#</th>
						<th>Name</th>
						<th>Email</th>
						<th>Account</th>
						<th>Role</th>
						<th>Verified</th>
						<th>Seeded</th>
						<th>Enable</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('avatar/'.$user->avatar) }}" width="32" height="32" class="rounded-circle my-n1" alt="{{ $user->name }}" title="{{ $user->name }}">
							</td>
							<td> <a href="{{ route('users.show', $user->id) }}">
								<strong>{{ $user->name }}</strong>
							</a>
							</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->account->name }} </td>
							<td>
								@if ($user->role == UserRoleEnum::USER)
									<span class="badge badge-subtle-info">{{ $user->role }}</span>
								@elseif ($user->role == UserRoleEnum::ADMIN)
									<span class="badge badge-subtle-danger">{{ $user->role }}</span>
								@else
									<span class="badge badge-subtle-warning">{{ $user->role }}</span>
								@endif
							</td>
							<td>
								<span class="badge {{ ( ($user->email_verified_at == '') ? 'badge-subtle-danger' : 'badge-subtle-success') }}">{{ (($user->email_verified_at == '') ? 'No' : 'Yes') }}</span>
							</td>
							<td>
								<span class="badge {{ ($user->seeded ? 'badge-subtle-danger' : 'badge-subtle-success') }} ">{{ ($user->seeded ? 'Yes' : 'No') }}</span>
							</td>
							<td><x-landlord.list.my-enable :value="$user->enable"/></td>
							<td>
								<a href="{{ route('users.show',$user->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View">View</a>

									@if (session('original_user'))
										{{-- <a href="{{ route('users.leave-impersonate') }}" class="me-2"
											data-bs-toggle="tooltip" data-bs-placement="top" title="Leave Impersonate">
											<i data-lucide="log-out" class="text-danger"></i>
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
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row mb-3">
				{{ $users->links() }}
			</div>

		</div>
	</div>


@endsection
