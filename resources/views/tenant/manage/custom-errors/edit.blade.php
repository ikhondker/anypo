@extends('layouts.app')
@section('title','Edit Custom Error')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('custom-errors.index') }}">Custom Errors</a></li>
	<li class="breadcrumb-item active">{{ $customError->code }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Custom Error
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="CustomError"/>
			<x-tenant.buttons.header.create object="CustomError"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('custom-errors.update',$customError->code) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Edit Custom Error Detail</h5>
							<h6 class="card-subtitle text-muted">Edit Custom Error and other details.</h6>
						</div>
						<div class="card-body">

							<div class="mb-3">
								<label class="form-label">CODE</label>
								<input type="text" class="form-control @error('code') is-invalid @enderror"
									name="code" id="code" placeholder="EXXX"
									style="text-transform: uppercase"
									value="{{ old('code', $customError->code ) }}"
									/>
								@error('code')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">Entity</label>
								<input type="text" class="form-control @error('entity') is-invalid @enderror"
									name="entity" id="entity" placeholder="Ac Number"
									value="{{ old('entity', $customError->entity ) }}"
									/>
								@error('entity')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">Message</label>
								<input type="text" class="form-control @error('message') is-invalid @enderror"
									name="message" id="message" placeholder="Routing Number"
									value="{{ old('message', $customError->message ) }}"
									/>
								@error('message')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							

							<x-tenant.buttons.show.save/>

						</div>
					</div>
				</div>
				<!-- end col-6 -->
			</div>


	</form>
	<!-- /.form end -->
@endsection

