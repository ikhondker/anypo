@extends('layouts.app')
@section('title','Edit Bank Account')
@section('breadcrumb','Edit Bank Account')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Bank Account
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="BankAccount"/>
			<x-tenant.buttons.header.create object="BankAccount"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('bank-accounts.update',$bankAccount->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Bank Account Info</h5>
						</div>
						<div class="card-body">

							<div class="mb-3">
								<label class="form-label">Ac Name</label>
								<input type="text" class="form-control @error('ac_name') is-invalid @enderror"
									name="ac_name" id="ac_name" placeholder="Ac Name"
									value="{{ old('ac_name', $bankAccount->ac_name ) }}"
									/>
								@error('ac_name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							
							<div class="mb-3">
								<label class="form-label">Ac Number</label>
								<input type="text" class="form-control @error('ac_number') is-invalid @enderror"
									name="ac_number" id="ac_number" placeholder="Ac Number"
									value="{{ old('ac_number', $bankAccount->ac_number ) }}"
									/>
								@error('ac_number')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>


							<div class="mb-3">
								<label class="form-label">Bank Name</label>
								<input type="text" class="form-control @error('bank_name') is-invalid @enderror"
									name="bank_name" id="bank_name" placeholder="Bank Name"
									value="{{ old('bank_name', $bankAccount->bank_name ) }}"
									/>
								@error('bank_name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">Branch Name</label>
								<input type="text" class="form-control @error('branch_name') is-invalid @enderror"
									name="branch_name" id="branch_name" placeholder="Ac Number"
									value="{{ old('branch_name', $bankAccount->branch_name ) }}"
									/>
								@error('branch_name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<x-tenant.widgets.submit/>

						</div>
					</div>
				</div>
				<!-- end col-6 -->

				<div class="col-6">
					<div class="card">

					</div>
				</div>
				<!-- end col-6 -->
			</div>


	</form>
	<!-- /.form end -->
@endsection
