
@php
use App\Models\Tenant\Admin\Setup;
use App\Models\Tenant\Lookup\Currency;
$currencies = Currency::All();
$setup = Setup::first();

@endphp

<x-tenant.page-header>
		@slot('title')
			First time Setup
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('setups.freeze',$setup->id) }}" method="POST">
		@csrf
		

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Currency Setup </h5>
							<h6 class="card-subtitle text-muted">Default Functional Currency setup.</h6>

						</div>
						<div class="card-body">
							<div class="mb-3">
								
								<div class="alert alert-warning alert-dismissible" role="alert">
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									<div class="alert-icon">
										<i data-feather="alert-triangle" class="text-danger"></i>
									</div>
									<div class="alert-message">
										<strong>Note: </strong> Please note you wont be able to change this currency setting once you have saved! 
										Your budget and all financial summary reporting will be in this currency.
									</div>
								</div>

							</div>

							<div class="mb-3">
								<label class="form-label">Currency</label>
								<select class="form-control" name="currency">
									@foreach ($currencies as $currency)
										<option {{ $currency->currency == old('currency',$setup->currency) ? 'selected' : '' }} value="{{ $currency->currency }}">{{ $currency->currency." -".$currency->name." (".$currency->country.")" }} </option>
									@endforeach
								</select>
							</div>
					
							<div class="mb-3 float-end">
								<button type="submit" id="submit" name="submit" class="btn btn-primary"><i data-feather="save"></i> Freeze Setup</button>
							</div>
							
						</div>
					</div>
					
				</div>
				<div class="col-6">
				</div>
			</div>

			<!-- end row -->
	</form>
	<!-- /.form end -->

