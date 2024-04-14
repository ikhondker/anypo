@if ($account->id != '' )
		<!-- Card Grid -->
		<div class="container content-space-2">
			
			<div class="row justify-content-center mb-4">
				<div class="col-8 mb-4 mb-md-5 mb-lg-0">
					<!-- Card -->
						<div class="card card-lg card-transition h-100 text-center">
							<div class="card-body">
								<span class="text-cap text-muted">Additional User</span>
								<h2 class="text-info">Need More User? Buy </h2>
								<p class="card-text text-body small">Will be added immediately to your Account {{ $account->name }} [#{{ $account_id }}] 
								</p>
							</div>			
						</div>
				</div>
			</div>

			<div class="row justify-content-center">

				@foreach ($addons as $addon)
					<div class="col-md-6 col-lg-4 mb-4 mb-md-5 mb-lg-0">
						<!-- Card -->
							<div class="card card-lg card-transition h-100 text-center">
								<div class="card-body">
									<div class="mb-4">
										@if ($addon->addon_type =='user')
											<i class="bi bi-people text-info" style="font-size: 4.3rem;"></i>
										@else
											<i class="bi bi-floppy text-info" style="font-size: 4.3rem;"></i>
										@endif		
									</div>
									<h3 class="card-title">{{ $addon->name }}</h3>
									<h4 class="card-title text-info"> <del class="text-danger">{{ $addon->price }}</del> {{ $addon->list_price }}$/mo</h4>
									{{-- <p class="card-text text-body"></p> --}}
									<p class="card-text text-body small">Next billing date {{ strtoupper(date('d-M-Y', strtotime($account->end_date))) }}</p>
								</div>
								<div class="card-footer pt-0">
										<a href="{{ route('accounts.add-addon', ['account_id' => $account->id, 'addon_id' => $addon->id]) }}"
											class="btn btn-primary sw2-advance"
											data-entity="Add-On" data-name="{{ $addon->name }}"
											data-status="BUY" data-bs-toggle="tooltip"
											data-bs-placement="top" title="Add-on">
											Buy Now
										</a>
								</div>
							</div>
						
						<!-- End Card -->
					</div>
					<!-- End Col -->  
				@endforeach
				<span class="small text-center mt-2">Note: Once added, Add-ons can not be removed or deactivated.</span>
			</div>
			<!-- End Row -->
		</div>
		<!-- End Card Grid -->
	@endif
	