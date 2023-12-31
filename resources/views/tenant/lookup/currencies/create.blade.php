@extends('layouts.app')
@section('title','Currency')
@section('breadcrumb','Create Currency')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Currency
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="Currency"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('currencies.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Currency Info</h5>
					</div>
					<div class="card-body">
						

						<div class="mb-3">
							<label class="form-label">Currency Code</label>
							<input type="text" class="form-control @error('currency') is-invalid @enderror" 
								name="currency" id="currency" placeholder="XXX"
								style="text-transform: uppercase" 
								value="{{ old('currency', '' ) }}"
								required/>
							@error('currency')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Currency Name</label>
							<input type="text" class="form-control @error('name') is-invalid @enderror" 
								name="name" id="name" placeholder="Currency Name"     
								value="{{ old('name', '' ) }}"
								required/>
							@error('name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
						
						<x-tenant.widgets.submit/>
						
					</div>
				</div>
			</div>
			<!-- end col-6 -->
			<div class="col-6">
				
			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->

	</form>
	<!-- /.form end -->

@endsection