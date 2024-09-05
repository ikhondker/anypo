@extends('layouts.tenant.app')
@section('title','Create Custom Error')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('custom-errors.index') }}" class="text-muted">Custom Errors</a></li>
	<li class="breadcrumb-item active">Create CustomError</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Custom Error
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="CustomError"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('custom-errors.store') }}" method="POST" enctype="multipart/form-data">
		@csrf


		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('custom-errors.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Create new Custom Error </h5>
				<h6 class="card-subtitle text-muted">Create new Custom Error with details.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.create.code/>

						<tr>
							<th>Entity</th>
							<td>
								<input type="text" class="form-control @error('entity') is-invalid @enderror"
								name="entity" id="entity" placeholder="Entity"
								value="{{ old('entity', '' ) }}"
								required/>
							@error('entity')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</td>
						</tr>


						<tr>
							<th>Message</th>
							<td>
								<input type="text" class="form-control @error('message') is-invalid @enderror"
								name="message" id="message" placeholder="Sample Message"
								value="{{ old('message', '' ) }}"
								required/>
							@error('message')
								<div class="text-danger text-xs">{{ $message }}</div>
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
