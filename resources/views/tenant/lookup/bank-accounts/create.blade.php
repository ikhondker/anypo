@extends('layouts.tenant.app')
@section('title','Create Bank Account')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('bank-accounts.index') }}" class="text-muted">Bank Accounts</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Bank Account
		@endslot
		@slot('buttons')

		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('bank-accounts.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('bank-accounts.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Create new Bank Account </h5>
						<h6 class="card-subtitle text-muted">Create newBank Account with details.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>

						<tr>
							<th>Account Name</th>
							<td>
								<input type="text" class="form-control @error('ac_name') is-invalid @enderror"
									name="ac_name" id="ac_name" placeholder="Ac Name"
									value="{{ old('ac_name', '' ) }}"
									required/>
								@error('ac_name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</td>
						</tr>


						<tr>
							<th>Account Number</th>
							<td>
								<input type="text" class="form-control @error('ac_number') is-invalid @enderror"
								name="ac_number" id="ac_number" placeholder="Ac Number"
								value="{{ old('ac_number', '' ) }}"
								required/>
							@error('ac_number')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<tr>
							<th>Routing Number</th>
							<td>
								<input type="text" class="form-control @error('routing_number') is-invalid @enderror"
								name="routing_number" id="routing_number" placeholder="99999999"
								value="{{ old('routing_number', '' ) }}"
								required/>
							@error('routing_number')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<tr>
							<th>Bank Name</th>
							<td>
								<input type="text" class="form-control @error('bank_name') is-invalid @enderror"
								name="bank_name" id="bank_name" placeholder="Bank Name"
								value="{{ old('bank_name', '' ) }}"
								required/>
							@error('bank_name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<tr>
							<th>Branch Name</th>
							<td>
								<input type="text" class="form-control @error('branch_name') is-invalid @enderror"
								name="branch_name" id="branch_name" placeholder="Branch Name"
								value="{{ old('branch_name', '' ) }}"
								required/>
							@error('branch_name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<x-tenant.create.currency/>
						<tr>
							<th>Cash GL Code</th>
							<td>
								<input type="text" class="form-control @error('ac_cash') is-invalid @enderror"
								name="ac_cash" id="ac_cash" placeholder="A400001" maxlength="25"
								style="text-transform: uppercase"
								value="{{ old('ac_cash', 'A400001' ) }}"
								required/>
							@error('ac_cash')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<x-tenant.create.address1 />
						<x-tenant.create.address2 />
						<x-tenant.create.city-state-zip/>
						<x-tenant.create.country/>
						<x-tenant.create.save/>
					</tbody>
				</table>
			</div>
		</div>


	</form>
	<!-- /.form end -->

@endsection
