@extends('layouts.app')
@section('title','PayMethod')
@section('breadcrumb','Create PayMethod')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create PayMethod
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="PayMethod"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('pay-methods.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">PayMethod Info</h5>
					</div>
					<div class="card-body">
						
						<x-tenant.create.name/>
					   
						

						<div class="mb-3">
							<label class="form-label">Number</label>
							<input type="text" class="form-control @error('pay_method_number') is-invalid @enderror" 
								name="pay_method_number" id="pay_method_number" placeholder="999-999-999"     
								value="{{ old('pay_method_number', '') }}"
								/>
							@error('pay_method_number')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
						
						<div class="mb-3">
							<label class="form-label">Currency</label>
							<select class="form-control" name="currency" required>
								<option value=""><< Currency >> </option>
								@foreach ($currencies as $currency)
									<option value="{{ $currency->currency }}" {{ $currency->currency == old('currency') ? 'selected' : '' }} >{{ $currency->currency }} </option>
								@endforeach
							</select>
							@error('currency')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Bank Name</label>
							<input type="text" class="form-control @error('bank_name') is-invalid @enderror" 
								name="bank_name" id="bank_name" placeholder="Bank Name"     
								value="{{ old('bank_name','' ) }}"
								/>
							@error('bank_name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Branch Name</label>
							<input type="text" class="form-control @error('branch_name') is-invalid @enderror" 
								name="branch_name" id="branch_name" placeholder="Branch Name"     
								value="{{ old('branch_name', '' ) }}"
								/>
							@error('branch_name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<x-tenant.create.start-date/>
						<x-tenant.create.end-date/>

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