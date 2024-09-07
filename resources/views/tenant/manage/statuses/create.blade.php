@extends('layouts.tenant.app')
@section('title','Status')
@section('breadcrumb','Create Status')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('statuses.index') }}" class="text-muted">Statuses</a></li>
	<li class="breadcrumb-item active">Create Status</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Status
		@endslot
		@slot('buttons')

		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('statuses.store') }}" method="POST" enctype="multipart/form-data">
		@csrf


		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('depts.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Create Status</h5>
				<h6 class="card-subtitle text-muted">Create new Status.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.create.name/>
						<x-tenant.create.code/>
						<tr>
							<th>Badge</th>
							<td>
								<input type="text" class="form-control @error('badge') is-invalid @enderror"
								name="badge" id="badge" placeholder="badge"
								value="{{ old('badge', '' ) }}"
								required/>
							@error('badge')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
							</td>
						</tr>

						<x-tenant.create.save/>

					</tbody>
				</table>
			</div>
		</div>

	</form>
	<!-- /.form end -->

@endsection
