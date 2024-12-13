@extends('layouts.landlord.app')
@section('title','Users')
@section('breadcrumb')
	<li class="breadcrumb-item active">Users</li>
@endsection

@section('content')

	<x-landlord.page-header>
		@slot('title')
			All Users
		@endslot
		@slot('buttons')
				<a href="{{ route('users.create') }}" class="btn btn-primary me-1"><i data-lucide="plus"></i> New User</a>
				<x-landlord.actions.account-actions/>
		@endslot
	</x-landlord.page-header>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('users.index') }}" method="GET" role="search">
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
								Search result for: <strong class="text-info">{{ request('term') }}</strong>
							@endif
					</form>
					<!--/. form -->
				</div>
				<div class="col-md-6 col-xl-8">

					<div class="text-sm-end">
						<a href="{{ route('users.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						<a href="{{ route('users.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a>
					</div>
				</div>
			</div>

			<table class="table w-100">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Email</th>
						<th>Account</th>
						<th>Role</th>
						<th>Enable?</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
						<tr>
							<td>
								<img src="{{ Storage::disk('s3l')->url('avatar/'.$user->avatar) }}" width="32" height="32" class="rounded-circle my-n1" alt="{{ $user->name }}" title="{{ $user->name }}">
							</td>
							<td>
								<a href="{{ route('users.show', $user->id) }}">
									<strong>{{ $user->name }}</strong>
								</a>
							</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->account->name }}</td>
							<td>
								@if ($user->role == UserRoleEnum::USER)
									<span class="badge badge-subtle-info">{{ $user->role }}</span>
								@elseif ($user->role == UserRoleEnum::ADMIN)
									<span class="badge badge-subtle-danger">{{ $user->role }}</span>
								@else
									<span class="badge badge-subtle-warning">{{ $user->role }}</span>
								@endif
							</td>
							<td><x-landlord.list.my-enable :value="$user->enable"/></td>
							<td>
								<a href="{{ route('users.show',$user->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View"><i data-lucide="eye"></i> View</a>
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


