
<div class="row">
	<div class="col-md-6 col-xxl-3 d-flex">
		<div class="card flex-fill">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">Budget {{ $budget->fy}} ({{ $_setup->currency}})</h5>
					</div>
					<div class="col-auto">
						<div class="stat stat-sm">
							<i class="align-middle" data-feather="activity"></i>
						</div>
					</div>
				</div>
				<span class="h1 d-inline-block mt-1 mb-3">{{ number_format($budget->amount) }}</span>
				<div class="mb-0">
					<span class="badge badge-soft-success me-2">FY{{ $budget->fy }}</span>
					<span class="text-muted"> {{ $budget->name }}</span>
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
				<span class="h1 d-inline-block mt-1 mb-3">{{ $_setup->currency}} {{ number_format( $budget->amount_po_issued) }}</span>
				<div class="mb-0">
					<span class="badge badge-soft-success me-2">{{ number_format($budget->amount_po_issued / $budget->amount * 100,2) }}%</span>
					<span class="text-muted"> budget Utilized</span>
					<span class="badge badge-soft-success me-2"> {{ $budget->count_po }} </span>
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
				<span class="h1 d-inline-block mt-1 mb-3">{{ $_setup->currency}} {{ number_format( $budget->amount_invoice) }}</span>
				<div class="mb-0">
					<span class="badge badge-soft-success me-2">{{ number_format($budget->amount_invoice / $budget->amount * 100,2) }}%</span>
					<span class="text-muted"> budget Utilized</span>
					<span class="badge badge-soft-success me-2"> {{ $budget->count_invoice }} </span>
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
				<span class="h1 d-inline-block mt-1 mb-3">{{ $_setup->currency}} {{ number_format( $budget->amount_payment) }}</span>
				<div class="mb-0">
					<span class="badge badge-soft-success me-2">{{ number_format($budget->amount_payment / $budget->amount * 100,2) }}%</span>
					<span class="text-muted"> budget Utilized</span>
					<span class="badge badge-soft-success me-2"> {{ $budget->count_payment }} </span>
					<span class="text-muted"> Payment Made</span>
				</div>

			</div>
		</div>
	</div>
</div>
