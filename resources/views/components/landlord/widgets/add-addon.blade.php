@if ($account->id != '' )

	@php
		$diff = now()->diffInDays($account->end_date);
		if ($diff <= $_config->days_addon_free) {
			$needToPay = false;
		} else {
			$needToPay = true;
		}
	@endphp

		<!-- Card Grid -->
		<div class="container content-space-2">

			<div class="row justify-content-center mb-4">
				<div class="col-10 mb-4 mb-md-5 mb-lg-0">
					<!-- Card -->
						<div class="card card-lg card-transition h-100 text-center">
							<div class="card-body">
								<span class="text-cap text-muted">Additional User</span>
								<h2 class="text-info">Need More User? Buy </h2>
								<p class="card-text text-body small">Will be added immediately to your Account {{ $account->name }}.</p>
							</div>
						</div>
				</div>
			</div>

			<div class="row justify-content-center">
				@foreach ($addons as $addon)
					<div class="col-md-6 col-lg-5 mb-4 mb-md-5 mb-lg-0">
						<!-- Card -->
							<div class="card card-lg card-transition h-100 text-center">
								<div class="card-body">
									<div class="mb-4">
										@if ($addon->addon_type == 'user')
											<i class="lucide-xxl text-info" data-lucide="user-plus"></i>
										@else
											<i class="lucide-xxl text-info" data-lucide="user-plus"></i>
										@endif
									</div>
									<h3 class="card-title">{{ $addon->name }}</h3>
									<h4 class="card-title text-info"> <del class="text-danger">{{ number_format($addon->list_price, 2) }}$</del> {{ number_format($addon->price, 2) }}$/mo</h4>
									<p class="card-text text-body small">Your Next billing date {{ strtoupper(date('d-M-Y', strtotime($account->end_date))) }}</p>
									@if ($needToPay)
										<p class="card-text text-body">You will need to pay prorated for {{ $diff}} days </br>
											i.e. <del class="text-danger">{{ number_format($addon->list_price/30 * $diff, 2) }}$</del> <strong>{{ number_format($addon->price/30 * $diff, 2) }}$ </strong> for current billing period.
										</p>
									@else
										<p class="card-text text-body">Will be added to your account immediately. </br>Will be charged from next billing cycle.</p>
									@endif
								</div>
								<div class="card-footer pt-0">
										<a href="{{ route('akk.process-addon', ['account_id' => $account->id, 'addon_id' => $addon->id]) }}"
											class="btn btn-primary sw2-advance"
											data-entity="Add-On" data-name="{{ $addon->name }}"
											data-status="BUY" data-bs-toggle="tooltip"
											data-bs-placement="top" title="Add-on"><i data-lucide="shopping-cart"></i>
											Buy Now
										</a>
								</div>
							</div>

						<!-- End Card -->
					</div>
					<!-- End Col -->
				@endforeach
				{{-- <span class="small text-center mt-2">Note: Once added, Add-ons can not be removed or deactivated.</span> --}}
			</div>
			<!-- End Row -->
		</div>
		<!-- End Card Grid -->
	@endif
