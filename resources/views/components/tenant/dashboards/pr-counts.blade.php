<div class="row">
	
	<div class="col-md-6 col-xxl-3 d-flex">
		<div class="card illustration flex-fill">
			<div class="card-body p-0 d-flex flex-fill">
				<div class="row g-0 w-100">
					<div class="col-6">
						<div class="illustration-text p-3 m-1">
							<h4 class="illustration-text">Welcome Back, {{ auth()->user()->name }}!</h4>
							<p class="mb-0">Requisition Listing</p>
						</div>
					</div>
					<div class="col-6 align-self-end text-end">
						{{-- <img src="{{asset('img/illustrations/customer-support.png')}}" width="100px" height="100px" alt="Social" class="img-fluid illustration-img"> --}}
						<img src="{{ Storage::disk('s3t')->url('img/illustrations/customer-support.png') }}" width="100px" height="100px" alt="Social" class="img-fluid illustration-img">
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 col-sm-6 col-xxl-3 d-flex">
		<div class="card flex-fill">
			<div class="card-body py-4">
				<div class="d-flex align-items-start">
					<div class="flex-grow-1">
						<h3 class="mb-2">{{ $count_approved }} </h3>
						<p class="mb-2">Approved Requisition</p>
						<div class="mb-0">
							<span class="badge badge-soft-success me-2"> {{ $_setup->currency }} </span>
							<span class="text-muted"> {{ number_format($sum_approved, 2, '.', ',') }}</span>
						</div>
					</div>
					<div class="d-inline-block ms-3">
						<div class="stat">
							<i class="align-middle text-success" data-feather="check-circle"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	<div class="col-12 col-sm-6 col-xxl-3 d-flex">
		<div class="card flex-fill">
			<div class="card-body py-4">
				<div class="d-flex align-items-start">
					<div class="flex-grow-1">
						<h3 class="mb-2">{{ $count_converted }} </h3>
						<p class="mb-2">Converted to PO</p>
						<div class="mb-0">
							<span class="badge badge-soft-success me-2"> {{ $_setup->currency }} </span>
							<span class="text-muted"> {{ number_format($sum_converted, 2, '.', ',') }}</span>
						</div>
					</div>
					<div class="d-inline-block ms-3">
						<div class="stat">
							<i class="align-middle text-success" data-feather="x-circle"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="col-12 col-sm-6 col-xxl-3 d-flex">
		<div class="card flex-fill">
			<div class="card-body py-4">
				<div class="d-flex align-items-start">
					<div class="flex-grow-1">
						<h3 class="mb-2">{{ $count_inprocess }} </h3>
						<p class="mb-2">In-Process Requisition</p>
						<div class="mb-0">
							<span class="badge badge-soft-success me-2"> {{ $_setup->currency }} </span>
							<span class="text-muted"> {{ number_format($sum_inprocess, 2, '.', ',') }}</span>
						</div>
					</div>
					<div class="d-inline-block ms-3">
						<div class="stat">
							<i class="align-middle text-success" data-feather="clock"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	

</div>
