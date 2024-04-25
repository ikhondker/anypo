<div class="row">

	
	

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
	

{{-- 
	<div class="col-md-6 col-xxl-3 d-flex">
		<div class="card flex-fill">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">Approved Requisition</h5>
					</div>
					<div class="col-auto">
						<div class="stat stat-sm">
							<i class="align-middle" data-feather="shopping-bag"></i>
						</div>
					</div>
				</div>
				
				<span class="h1 d-inline-block mt-1">{{ $count_approved }}</span>
			</div>
		</div>
	</div> --}}

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
	

	{{-- <div class="col-md-6 col-xxl-3 d-flex">
		<div class="card flex-fill">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">In-Approval Requisition</h5>
					</div>

					<div class="col-auto">
						<div class="stat stat-sm">
							<i class="align-middle" data-feather="shopping-cart"></i>
						</div>
					</div>
				</div>
				<span class="h1 d-inline-block mt-1">{{ $count_inprocess }}</span>
			</div>
		</div>
	</div> --}}
	
	{{-- <div class="col-md-6 col-xxl-3 d-flex">
		<div class="card flex-fill">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">Draft Requisition</h5>
					</div>

					<div class="col-auto">
						<div class="stat stat-sm">
							<i class="align-middle" data-feather="activity"></i>
						</div>
					</div>
				</div>
				<span class="h1 d-inline-block mt-1">{{ $count_draft }}</span>
			</div>
		</div>
	</div> --}}

	<div class="col-12 col-sm-6 col-xxl-3 d-flex">
		<div class="card flex-fill">
			<div class="card-body py-4">
				<div class="d-flex align-items-start">
					<div class="flex-grow-1">
						<h3 class="mb-2">{{ $count_draft }} </h3>
						<p class="mb-2">Draft Requisition</p>
						<div class="mb-0">
							<span class="badge badge-soft-success me-2"> {{ $_setup->currency }} </span>
							<span class="text-muted"> {{ number_format($sum_draft, 2, '.', ',') }}</span>
						</div>
					</div>
					<div class="d-inline-block ms-3">
						<div class="stat">
							<i class="align-middle text-success" data-feather="edit"></i>
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
						<h3 class="mb-2">{{ $count_total }} </h3>
						<p class="mb-2">Total Requisition</p>
						<div class="mb-0">
							<span class="badge badge-soft-success me-2"> {{ $_setup->currency }} </span>
							<span class="text-muted"> {{ number_format($sum_total, 2, '.', ',') }}</span>
						</div>
					</div>
					<div class="d-inline-block ms-3">
						<div class="stat">
							<i class="align-middle text-success" data-feather="database"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
