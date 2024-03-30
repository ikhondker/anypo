@extends('layouts.app')
@section('title','Create Custom Error')
@section('breadcrumb','Create Custom Error')

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

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Create new Custom Error </h5>
						<h6 class="card-subtitle text-muted">Create new  Custom Error with details.</h6>
					</div>
					<div class="card-body">

						<div class="mb-3">
							<label class="form-label">Code</label>
							<input type="text" class="form-control @error('code') is-invalid @enderror"
								name="code" id="code" placeholder="EXXXX"
								style="text-transform: uppercase"
								value="{{ old('code', '' ) }}"
								required/>
							@error('code')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Entity</label>
							<input type="text" class="form-control @error('entity') is-invalid @enderror"
								name="entity" id="entity" placeholder="Entity"
								value="{{ old('entity', '' ) }}"
								required/>
							@error('entity')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Message</label>
							<input type="text" class="form-control @error('message') is-invalid @enderror"
								name="message" id="message" placeholder="Sample Message"
								value="{{ old('message', '' ) }}"
								required/>
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
		<!-- end row -->

	</form>
	<!-- /.form end -->

@endsection