@extends('layouts.landlord-app')
@section('title','Generate Invoice')
@section('breadcrumb','Generate Invoice')

@section('content')

	<!-- Card -->
	<div class="card">
		<form name="myForm" id="myForm" action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data">
			@csrf

			<div class="card-header d-flex justify-content-between align-items-center border-bottom">
				<h5 class="card-header-title">Generate Invoice & Pay </h5>
				{{-- <button class="btn btn-primary btn-sm sw2" type="submit" id="submit" name="submit"><i class="bi bi-gear"></i> Generate</button> --}}
			</div>

			<!-- Body -->
			<div class="card-body">

				<!-- Form -->
				<div class="row">
					<label for="plan" class="col-sm-3 col-form-label form-label">Current Plan:</label>
					<div class="col-sm-9">
						<p class="h4 text-info mt-2">{{ $account->primaryProduct->name }}</p>
					</div>
				</div>
				<!-- End Form -->

				<!-- Form -->
				<div class="row">
					<label for="price" class="col-sm-3 col-form-label form-label">Current Subscription:</label>
					<div class="col-sm-9">
						<p class="mt-2">{{ number_format($account->price,2) }} USD/Month</p>
					</div>
				</div>
				<!-- End Form -->

				<!-- Form -->
				<div class="row mb-4">
					<label for="title" class="col-sm-3 col-form-label form-label">Period to Generate Invoice:</label>
					<div class="col-sm-9">
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
							<div class="small text-muted">{{ $config->discount_pc_3 }}% Discount .</div>
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
							<div class="small text-muted">{{ $config->discount_pc_6 }}% Discount .</div>
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
							<div class="small text-muted">{{ $config->discount_pc_12 }}% Discount .</div>
						</div>
					</div>
				</div>
				<!-- End Form -->

			</div>
			<!-- End Body -->

			<!-- Footer -->
			<div class="card-footer pt-0">
				<div class="d-flex justify-content-end gap-3">
				<a class="btn btn-secondary" href="{{ url()->previous() }}"><i class="bi bi-x-circle"></i> Cancel</a>
				<button type="submit" id="btn-submit" name="btn-submit" class="btn btn-primary"><i class="bi bi-gear"></i> Generate</button>

				</div>
			</div>
			<!-- End Footer -->

		</form>
	</div>
	<!-- End Card -->

	<script type="module">
		$(function() {
		const $myForm = $('#myForm')
			.on('submit', function(e) {
			e.preventDefault();
			Swal.fire({
				title: 'Confirmation?',
				text: "Are you sure, you want to Generate Invoice and proceed?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3F80EA',
				cancelButtonColor: '#d9534f',
				confirmButtonText: 'Yes, confirmed!',
			}).then(function(result) {
				if (result.value) {
				setTimeout(function() {
					$myForm[0].submit()
				}, 1000); // submit the DOM form
				}
			});
			});
		});
	</script>

@endsection

