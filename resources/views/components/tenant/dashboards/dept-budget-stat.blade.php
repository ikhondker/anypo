<div class="row">
	<div class="col-md-6 col-xxl-3 d-flex">
		<div class="card flex-fill">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">{{ $deptBudget->dept->name }} : Budget {{ $deptBudget->budget->fy}}</h5>
					</div>
					<div class="col-auto">
						<div class="stat stat-sm">
							<i class="align-middle" data-feather="activity"></i>
						</div>
					</div>
				</div>
				<span class="h1 d-inline-block mt-1 mb-3">{{ $_setup->currency}} {{ number_format($deptBudget->amount) }} </span>
				<div class="mb-0">
					<span class="badge badge-soft-success me-2">FY{{ $deptBudget->budget->fy }}</span>
					<span class="text-muted"> {{ $deptBudget->budget->name }} [{{ strtoupper($deptBudget->dept->name) }}]</span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-xxl-3 d-flex">
		<div class="card flex-fill">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">PO Issued</h5>
					</div>
					<div class="col-auto">
						<div class="stat stat-sm">
							<i class="align-middle" data-feather="shopping-bag"></i>
						</div>
					</div>
				</div>
				
				<span class="h1 d-inline-block mt-1 mb-3">{{ $_setup->currency}} {{ number_format( $deptBudget->amount_po) }}</span>
				<div class="mb-0">
					<span class="badge badge-soft-success me-2">{{ number_format($deptBudget->amount_pod / ($deptBudget->amount == 0 ? 1 :  $deptBudget->amount) * 100,2) }}%</span>
					<span class="text-muted"> budget Utilized</span>
					<span class="badge badge-soft-success me-2"> {{ $deptBudget->count_po }} </span>
					<span class="text-muted"> PO Issued</span>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-xxl-3 d-flex">
		<div class="card flex-fill">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">Invoice Received</h5>
					</div>

					<div class="col-auto">
						<div class="stat stat-sm">
							<i class="align-middle" data-feather="shopping-cart"></i>
						</div>
					</div>
				</div>
				<span class="h1 d-inline-block mt-1 mb-3">{{ $_setup->currency}} {{ number_format( $deptBudget->amount_invoice) }}</span>
				<div class="mb-0">
					<span class="badge badge-soft-success me-2">{{ number_format($deptBudget->amount_invoice / ($deptBudget->amount == 0 ? 1 :  $deptBudget->amount) * 100,2) }}%</span>
					<span class="text-muted"> budget Utilized</span>
					<span class="badge badge-soft-success me-2"> {{ $deptBudget->count_invoice }} </span>
					<span class="text-muted"> Invoice Posted</span>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-6 col-xxl-3 d-flex">
		<div class="card flex-fill">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">Payment</h5>
					</div>

					<div class="col-auto">
						<div class="stat stat-sm">
							<i class="align-middle" data-feather="activity"></i>
						</div>
					</div>
				</div>
				<span class="h1 d-inline-block mt-1 mb-3">{{ $_setup->currency}} {{ number_format( $deptBudget->amount_payment) }}</span>
				<div class="mb-0">
					<span class="badge badge-soft-success me-2">{{ number_format($deptBudget->amount_payment / ($deptBudget->amount == 0 ? 1 :  $deptBudget->amount) * 100,2) }}%</span>
					<span class="text-muted"> budget Utilized</span>
					<span class="badge badge-soft-success me-2"> {{ $deptBudget->count_payment }} </span>
					<span class="text-muted"> Payment Made</span>

				</div>

			</div>
		</div>
	</div>
</div>
