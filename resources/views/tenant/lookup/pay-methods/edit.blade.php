@extends('layouts.app')
@section('title','Edit PayMethod')
@section('breadcrumb','Edit PayMethod')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit PayMethod
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="PayMethod"/>
			<x-tenant.buttons.header.create object="PayMethod"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('pay-methods.update',$payMethod->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">PayMethod Info</h5>
						</div>
						<div class="card-body">

							<x-tenant.edit.id-read-only :value="$payMethod->id"/>
							<x-tenant.edit.name :value="$payMethod->name"/>

							<div class="mb-3">
								<label class="form-label">Number</label>
								<input type="text" class="form-control @error('pay_method_number') is-invalid @enderror"
									name="pay_method_number" id="pay_method_number" placeholder="999-999-999"
									value="{{ old('pay_method_number', $payMethod->name ) }}"
									/>
								@error('pay_method_number')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
							<div class="mb-3">
								<label class="form-label">Currency</label>
								<input type="text" name="currency" id="id" class="form-control" placeholder="USD" value="{{ $payMethod->currency }}" readonly>
							</div>

							<div class="mb-3">
								<label class="form-label">Bank Name</label>
								<input type="text" class="form-control @error('bank_name') is-invalid @enderror"
									name="bank_name" id="bank_name" placeholder="Bank Name"
									value="{{ old('bank_name', $payMethod->bank_name  ) }}"
									/>
								@error('bank_name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">Branch Name</label>
								<input type="text" class="form-control @error('branch_name') is-invalid @enderror"
									name="branch_name" id="branch_name" placeholder="Branch Name"
									value="{{ old('branch_name', $payMethod->branch_name  ) }}"
									/>
								@error('branch_name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
							<x-tenant.edit.start-date :value="date('Y-m-d',strtotime($payMethod->start_date))"/>
							<x-tenant.edit.end-date :value="date('Y-m-d',strtotime($payMethod->end_date))"/>

							<x-tenant.buttons.show.save/>

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

