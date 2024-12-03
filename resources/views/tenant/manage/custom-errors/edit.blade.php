@extends('layouts.tenant.app')
@section('title','Edit Custom Error')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('custom-errors.index') }}" class="text-muted">Custom Errors</a></li>
	<li class="breadcrumb-item active">{{ $customError->code }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Custom Error
		@endslot
		@slot('buttons')
			<x-tenant.actions.manage.custom-error-actions code="{{ $customError->code }}"/>
			<x-tenant.buttons.header.lists model="CustomError"/>
			<x-tenant.buttons.header.create model="CustomError"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('custom-errors.update',$customError->code) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')


		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('custom-errors.create') }}" class="btn btn-sm btn-light"><i data-lucide="plus"></i>Create</a>
					<a href="{{ route('custom-errors.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Edit Custom Error Detail</h5>
							<h6 class="card-subtitle text-muted">Edit Custom Error and other details.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.edit.code :value="$customError->code"/>
						<tr>
							<th>Entity</th>
							<td>
								<input type="text" class="form-control @error('entity') is-invalid @enderror"
								name="entity" id="entity" placeholder="Ac Number"
								value="{{ old('entity', $customError->entity ) }}"
								/>
							@error('entity')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<tr>
							<th>Message</th>
							<td>
								<input type="text" class="form-control @error('message') is-invalid @enderror"
								name="message" id="message" placeholder="Routing Number"
								value="{{ old('message', $customError->message ) }}"
								/>
							@error('message')
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

