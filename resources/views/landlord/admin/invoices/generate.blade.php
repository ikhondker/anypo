@extends('layouts.landlord.app')
@section('title','Generate Invoice')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('invoices.index') }}" class="text-muted">Invoices</a></li>
	<li class="breadcrumb-item active">Generate</li>
@endsection

@section('content')

	<h1 class="h3 mb-3">Generate Invoice & Pay</h1>
	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Generate Invoice & Pay</h5>
			{{-- <h6 class="card-subtitle text-muted">Generate Invoice & Pay.</h6> --}}
		</div>
		<div class="card-body">
			<form id="myForm" action="{{ route('invoices.store') }}" method="POST">
				@csrf

				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Current Plan :</th>
							<td><strong>{{ $account->primaryProduct->name }}</strong></td>
						</tr>
						<tr>
							<th>Current Subscription :</th>
							<td><strong>{{ number_format($account->price,2) }} USD/Month</strong></td>
						</tr>
						<tr>
							<th>Period to Generate Invoice :</th>
							<td>
								<!-- Checkbox -->
								<div class="form-check mb-3">
									<input type="radio" id="formRadio1" class="form-check-input" name="period" value="1">
									<label class="form-check-label" for="formRadio1">
										<strong>1 Months </strong> <br>
										{{ number_format($account->price,2,'.') }}USD</label>
								</div>
								<!-- End Checkbox -->

								<!-- Checkbox -->
								<div class="form-check mb-3">
									<input type="radio" id="formRadio1" class="form-check-input" checked name="period" value="3">
									<label class="form-check-label" for="formRadio1">
										<strong>3 Months</strong><br>
										<del class="text-danger">{{ number_format($account->price * 3, 2) }} USD</del>
										{{ number_format(3 * $account->price * (100-$config->discount_pc_3)/100, 2) }} USD
									</label>
									<div class="small text-muted">{{ $config->discount_pc_3 }}% discount .</div>
								</div>
								<!-- End Checkbox -->

								<!-- Checkbox -->
								<div class="form-check mb-3">
									<input type="radio" id="formRadio2" class="form-check-input" name="period" value="6">
									<label class="form-check-label" for="formRadio2">
										<strong>6 Months</strong><br>
										<del class="text-danger">{{ number_format($account->price * 6, 2) }} USD</del>
										{{ number_format(6 * $account->price * (100-$config->discount_pc_6)/100, 2) }} USD
									</label>
									<div class="small text-muted">{{ $config->discount_pc_6 }}% discount .</div>
								</div>
								<!-- End Checkbox -->

								<!-- Checkbox -->
								<div class="form-check mb-3">
									<input type="radio" id="formRadio4" class="form-check-input" name="period" value="12">
									<label class="form-check-label" for="formRadio4">
										<strong>12 Months</strong><br>
										<del class="text-danger">{{ number_format($account->price * 12, 2) }} USD</del>
										{{ number_format(12 * $account->price * (100 - $config->discount_pc_12)/100, 2) }} USD
									</label>
									<div class="small text-muted">{{ $config->discount_pc_12 }}% discount .</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>

				<div class="mb-3 float-end">
					<a class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel" href="{{ url()->previous() }}"><i class="fas fa-times"></i></i> Cancel</a>
					<button class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Generate"><i class="fas fa-dollar-sign"></i> Generate</button>
				</div>
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
					text: "Are you sure, you want to do this?",
					icon: 'question',
					iconColor: '#d9534f',
					showCancelButton: true,
					confirmButtonText: 'Yes, confirmed!',
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
					}, 2000); 		// submit the DOM form
					}
				});
				});
			});

	</script>

@endsection

