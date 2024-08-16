@extends('layouts.tenant.app')
@section('title','Edit Bank Account')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('bank-accounts.index') }}" class="text-muted">Bank Accounts</a></li>
	<li class="breadcrumb-item"><a href="{{ route('bank-accounts.show',$bankAccount->id) }}" class="text-muted">{{ $bankAccount->ac_name }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Bank Account
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.bank-account-actions id="{{ $bankAccount->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('bank-accounts.update',$bankAccount->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')


		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('bank-accounts.create') }}" class="btn btn-sm btn-light"><i class="fas fa-plus"></i> Create</a>
					<a href="{{ route('bank-accounts.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Edit Bank Account Detail</h5>
							<h6 class="card-subtitle text-muted">Edit Bank Account and other details.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Ac Name</th>
							<td>
								<input type="text" class="form-control @error('ac_name') is-invalid @enderror"
									name="ac_name" id="ac_name" placeholder="Ac Name"
									value="{{ old('ac_name', $bankAccount->ac_name ) }}"
									/>
								@error('ac_name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						<tr>
							<th>Ac Number</th>
							<td>
								<input type="text" class="form-control @error('ac_number') is-invalid @enderror"
									name="ac_number" id="ac_number" placeholder="Ac Number"
									value="{{ old('ac_number', $bankAccount->ac_number ) }}"
									/>
								@error('ac_number')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						<tr>
							<th>Routing Number</th>
							<td>
								<input type="text" class="form-control @error('routing_number') is-invalid @enderror"
									name="routing_number" id="routing_number" placeholder="Routing Number"
									value="{{ old('routing_number', $bankAccount->routing_number ) }}"
									/>
								@error('routing_number')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						<tr>
							<th>Currency <x-tenant.info info="Note: You wont be able to change the currency."/></th>
							<td>
								<input type="text" class="form-control @error('currency') is-invalid @enderror"
									name="currency" id="currency" placeholder="Currency"
									value="{{ old('currency', $bankAccount->currency ) }}"
									readonly/>
							</td>
						</tr>
						<tr>
							<th>Bank Name</th>
							<td>
								<input type="text" class="form-control @error('bank_name') is-invalid @enderror"
								name="bank_name" id="bank_name" placeholder="Bank Name"
								value="{{ old('bank_name', $bankAccount->bank_name ) }}"
								/>
							@error('bank_name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror

							</td>
						</tr>

						<tr>
							<th>Branch Name</th>
							<td>
								<input type="text" class="form-control @error('branch_name') is-invalid @enderror"
								name="branch_name" id="branch_name" placeholder="Ac Number"
								value="{{ old('branch_name', $bankAccount->branch_name ) }}"
								/>
							@error('branch_name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror

							</td>
						</tr>

						<tr>
							<th>Expense GL Code</th>
							<td>
								<input type="text" class="form-control @error('ac_cash') is-invalid @enderror"
									name="ac_cash" id="ac_cash" placeholder="A400001" maxlength="255"
									style="text-transform: uppercase"
									value="{{ old('ac_cash', $bankAccount->ac_cash ) }}"
									required/>
								@error('ac_cash')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						<x-tenant.edit.address1 value="{{ $bankAccount->address1 }}"/>
						<x-tenant.edit.address2 value="{{ $bankAccount->address2 }}"/>
						<x-tenant.edit.city-state-zip city="{{ $bankAccount->city }}" state="{{ $bankAccount->state }}" zip="{{ $bankAccount->zip }}"/>
						<x-tenant.edit.country value="{{ $bankAccount->country }}"/>
                            <x-tenant.edit.save/>
					</tbody>
				</table>
			</div>
		</div>

	</form>
	<!-- /.form end -->

@endsection

