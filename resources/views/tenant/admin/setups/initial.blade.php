@php
	use App\Models\Tenant\Admin\Setup;
	use App\Models\Tenant\Lookup\Currency;
	$currencies = Currency::All();
	use App\Models\Tenant\Lookup\Country;
	$countries = Country::All();
	$setup = Setup::first();

	// TODO Check breadcrumb
@endphp

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><i class="align-top text-muted" data-lucide="home"></i><a href="{{ route('home') }}" class="text-muted"> Home</a></li>
		<li class="breadcrumb-item active">Initial Setup</li>
	</ol>
</nav>

	<x-tenant.page-header>
		@slot('title')
			Application Setup
		@endslot
		@slot('buttons')
			
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('setups.freeze',$setup->id) }}" method="POST">
		@csrf

		<div class="alert alert-warning" role="alert">
			<div class="alert-icon">
				<i data-lucide="alert-triangle" class="text-warning"></i>
			</div>
			<div class="alert-message">
				<strong>Note: </strong> You wont be able to change the default currency once Freezed! Budget and all financial summary reporting will be in this currency.
			</div>
		</div>

		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Application Setup</h5>
				<h6 class="card-subtitle text-muted">Required configuration to setup the Application.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Default Currency :</th>
							<td>
								<select class="form-control" name="currency">
									@foreach ($currencies as $currency)
										<option {{ $currency->currency == old('currency',$setup->currency) ? 'selected' : '' }} value="{{ $currency->currency }}">{{ $currency->currency." -".$currency->name." (".$currency->country.")" }} </option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<th>Country X:</th>
							<td>
								<select class="form-control" name="country" required>
									<option value=""><< Country >> </option>
									@foreach ($countries as $country)
										<option {{ $country->country == old('country',$setup->country) ? 'selected' : '' }} value="{{ $country->country }}">{{ $country->name }} </option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<td>
								<div class="float-end">
									<a class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Logout" href="{{route('logout') }}"><i data-lucide="x-circle"></i> Cancel</a>
									<button type="submit" id="submit" name="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Save"><i data-lucide="lock"></i> Freeze Setup</button>
								</div>
							</td>
						</tr>
						
					</tbody>
				</table>

				
			</div>
		</div>

	</form>
	<!-- /.form end -->

