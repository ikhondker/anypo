@extends('layouts.landlord.app')
@section('title','Invoice')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('invoices.index') }}" class="text-muted">Invoice</a></li>
	<li class="breadcrumb-item active">Create Invoice</li>
@endsection

@section('content')

	<h1 class="h3 mb-3">Create Service Invoice</h1>

	<!-- form start -->
	<form action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Create and Post Service Invoice</h5>
					<h6 class="card-subtitle text-muted">Create Service Invoice. Need to post to notify subscriber.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<tr>
								<th width="20%">Summary :</th>
								<td>
									<input type="text" class="form-control @error('summary') is-invalid @enderror"
									name="summary" id="summary" placeholder="Invoice summary"
									value="{{ old('summary', '' ) }}"
									required/>
								@error('summary')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
								</td>
							</tr>
							<tr>
								<th>Invoice Type :</th>
								<td>
									<!-- Checkbox -->
									<div class="form-check mb-3">
										<input type="radio" id="formRadio1" class="form-check-input" name="invoice_type" value="{{ App\Enum\Landlord\InvoiceTypeEnum::SETUP->value }}">
										<label class="form-check-label" for="formRadio1">
											<strong>SETUP</strong>
										</label>
									</div>
									<!-- End Checkbox -->

									<!-- Checkbox -->
									<div class="form-check mb-3">
										<input type="radio" id="formRadio2" class="form-check-input" checked name="invoice_type" value="{{ App\Enum\Landlord\InvoiceTypeEnum::SUPPORT->value }}">
										<label class="form-check-label" for="formRadio2">
											<strong>SUPPORT</strong>
										</label>
									</div>
									<!-- End Checkbox -->

									<!-- Checkbox -->
									<div class="form-check mb-3">
										<input type="radio" id="formRadio3" class="form-check-input" name="invoice_type" value="{{ App\Enum\Landlord\InvoiceTypeEnum::AMC->value }}">
										<label class="form-check-label" for="formRadio3">
											<strong>AMC</strong>
										</label>
									</div>
									<!-- End Checkbox -->
								</td>
							</tr>

							<tr>
								<th>Invoice Date :</th>
								<td>
									<input type="text" class="form-control"
									name="dsp_date" id="dsp_date" value="{{ date_format(now(),"d-M-Y H:i:s"); }}"
									readonly/>
								</td>
							</tr>
							<tr>
								<th>Department :</th>
								<td>
									<select class="form-control select2" data-toggle="select2" name="account_id" required>
										<option value=""><< Account >> </option>
										@foreach ($accounts as $account)
											<option value="{{ $account->id }}" {{ $account->id == old('account_id') ? 'selected' : '' }} >{{ $account->name }}</option>
										@endforeach
									</select>
									@error('account_id')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr>
							<tr>
								<th width="20%">Hour</th>
								<td>
									<input type="number" class="form-control @error('qty') is-invalid @enderror"
									{{-- data-mask="000,000,000.00" data-reverse="true" --}}
									{{-- data-inputmask="'mask': '9,999,999.99'" --}}
									style="text-align: right;" min="1" step="0.01" max="999999.99"
									name="qty" id="qty" placeholder="0.00"
									value="{{ old('qty','0.00') }}"
									required>
								@error('qty')
										<div class="small text-danger">{{ $message }}</div>
								@enderror
								</td>
							</tr>
							{{-- <tr>
								<th>Notes</th>
								<td>
									<textarea class="form-control" name="notes" placeholder="Enter ..." rows="3">{{ old('notes', 'Enter ...') }}</textarea>
									@error('notes')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr> --}}
							{{-- <x-tenant.attachment.create /> --}}
							<tr>
								<th>Requestor</th>
								<td>
									<input type="text" class="form-control"
									name="requestor" id="requestor"
									value="{{ auth()->user()->name }}"
									readonly/>
								</td>
							</tr>

                            <x-landlord.edit.save/>

						</tbody>
					</table>
				</div>
			</div>

		</form>
		<!-- /.form end -->

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Create Invoice</h5>
			<h6 class="card-subtitle text-muted">Create New Invoice.</h6>
		</div>
		<div class="card-body">
			<form id="myForm" action="{{ route('invoices.store') }}" method="POST">
				@csrf

				<table class="table table-sm my-2">
					<tbody>
						<x-landlord.create.name/>
					</tbody>
				</table>
				<button class="confirm-delete btn btn-danger">User Delete</button>
			</form>


		</div>
	</div>

	<script type="module">
		$(function() {
			const $myForm = $('#myForm')
				.on('submit', function(e) {
				e.preventDefault();
				Swal.fire({

					title: '<h2>Confirmation?</h2>',
					//title: "<strong>HTML <u>example</u></strong>",
					text: "Are you sure, you want to do this?",
					icon: 'question',
					iconColor: '#d9534f',
					showCancelButton: true,
					confirmButtonText: 'Yes, confirmed!',
					//footer: "aaaaaaaaaaaaa",
					//title: 'Are you sure?',
					//text: "You won't be able to revert this!",
					//showCancelButton: true,
					//confirmButtonText: 'Yes, delete it!',
					//cancelButtonText: 'No, cancel!',
					customClass: {
						confirmButton: 'btn btn-primary m-1',
						cancelButton: 'btn btn-secondary m-1'
					},

					buttonsStyling: false
				}).then(function(result) {
					if (result.value) {
					// Swal.fire({
					// 	icon: 'success',
					// 	title: 'Deleted!',
					// 	text: '',
					// 	customClass: {
					// 	confirmButton: 'btn btn-success'
					// 	}
					// });
					setTimeout(function() {
						$myForm[0].submit()
					}, 2000); // submit the DOM form
					}
				});
				});
			});

	</script>
@endsection

