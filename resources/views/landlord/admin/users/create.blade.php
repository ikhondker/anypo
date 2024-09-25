@extends('layouts.landlord.app')
@section('title','User')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="text-muted">Users</a></li>
	<li class="breadcrumb-item active">Create User</li>
@endsection


@section('content')

	<a href="{{ route('users.index') }}" class="btn btn-primary float-end mt-n1 "><i class="fas fa-list"></i> View All</a>
	<h1 class="h3 mb-3">Create User</h1>

	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Create User</h5>
			<h6 class="card-subtitle text-muted">Create New User.</h6>

		</div>
		<div class="card-body">

			<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
				@csrf

				<table class="table table-sm my-2">
					<tbody>
						<x-landlord.create.name/>
						<x-landlord.create.email/>
						<x-landlord.create.cell/>
						@if (auth()->user()->isAdmin())
							<tr>
								<th>Role :</th>
								<td>
									<div class="form-check align-items-center">
										<input id="admin" type="checkbox" class="form-check-input" value="user-role" name="admin">
										<label class="form-check-label text-small" for="customControlInline">Make this person an Admin</label>
										<span class="d-block small text-danger">Be careful! This user will be able to perform all admin activities for this account.</span>
									</div>
								</td>
							</tr>
						@endif
					</tbody>
				</table>
				<x-landlord.create.save/>
			</form>
		</div>
	</div>

@endsection



