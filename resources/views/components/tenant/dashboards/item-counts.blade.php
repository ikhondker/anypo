<div class="row">
	<div class="col-md-6 col-xxl-3 d-flex">
		<div class="card illustration flex-fill">
			<div class="card-body p-0 d-flex flex-fill">
				<div class="row g-0 w-100">
					<div class="col-6">
						<div class="illustration-text p-3 m-1">
							<h4 class="illustration-text">Welcome Back, {{ auth()->user()->name }}!</h4>
							<p class="mb-0">Items</p>
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
	<div class="col-md-6 col-xxl-3 d-flex">
		<div class="card flex-fill">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">Total Items</h5>
					</div>

					<div class="col-auto">
						<div class="stat stat-sm">
							<i class="align-middle" data-lucide="database"></i>
						</div>
					</div>
				</div>

				<span class="h1 d-inline-block mt-1">{{ $count_total }}</span>

			</div>
		</div>
	</div>
	<div class="col-md-6 col-xxl-3 d-flex">
		<div class="card flex-fill">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">Active Items</h5>
					</div>
					<div class="col-auto">
						<div class="stat stat-sm">
							<i class="align-middle" data-lucide="bell"></i>
						</div>
					</div>
				</div>

				<span class="h1 d-inline-block mt-1">{{ $count_enable }}</span>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-xxl-3 d-flex">
		<div class="card flex-fill">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">Inactive Items</h5>
					</div>

					<div class="col-auto">
						<div class="stat stat-sm">
							<i class="align-middle text-danger" data-lucide="bell-off"></i>
						</div>
					</div>
				</div>
				<span class="h1 d-inline-block mt-1">{{ $count_disable }}</span>
			</div>
		</div>
	</div>

</div>
