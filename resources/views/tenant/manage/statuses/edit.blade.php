@extends('layouts.tenant.app')
@section('title','Edit Status')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('statuses.index') }}" class="text-muted">Statues</a></li>
	<li class="breadcrumb-item active">{{ $status->name }}</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Status
		@endslot
		@slot('buttons')
			<x-tenant.actions.manage.status-actions code="{{ $status->code }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('statuses.update',$status->code) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('statuses.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Status Detail</h5>
							<h6 class="card-subtitle text-muted">Edit Status Details.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Code</th>
							<td>
								<input type="text" class="form-control @error('code') is-invalid @enderror"
									code="code" id="code" placeholder="code"
									value="{{ old('code', $status->code ) }}"
									required readonly/>
								@error('code')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						<tr>
							<th>Name</th>
							<td>
								<input type="text" class="form-control @error('name') is-invalid @enderror"
									name="name" id="name" placeholder="Name"
									value="{{ old('name', $status->name ) }}"
									required/>
								@error('name')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						<tr>
							<th>Badge</th>
							<td>
								<input type="text" class="form-control @error('badge') is-invalid @enderror"
								name="badge" id="badge" placeholder="Route Name"
								value="{{ old('badge', $status->badge ) }}"
								required/>
							@error('badge')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<x-tenant.edit.save/>
					</tbody>
				</table>
			</div>
		</div>


	</form>
	<!-- /.form end -->
@endsection

