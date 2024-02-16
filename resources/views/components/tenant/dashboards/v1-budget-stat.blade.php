
<div class="row">
	<div class="col-md-6 col-xxl-3 d-flex">
		<div class="card flex-fill">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">Budget Utilization (YTD)</h5>
					</div>
					<div class="col-auto">
						<div class="stat stat-sm">
							<i class="align-middle" data-feather="activity"></i>
						</div>
					</div>
				</div>
				<span class="h1 d-inline-block mt-1 mb-3">{{ number_format($budget_used_pc,2) }}%</span>
				<div class="mb-0">
					<span class="badge badge-soft-success me-2">{{ number_format($budget_amount,2) }}</span>
					<span class="text-muted"> total budget for FY{{ date('Y') }}. Utilized {{ $budget_po_issued }}</span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-xxl-3 d-flex">
		<div class="card flex-fill">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">PO Issued USD (YTD) (TODO)</h5>
					</div>
					<div class="col-auto">
						<div class="stat stat-sm">
							<i class="align-middle" data-feather="shopping-bag"></i>
						</div>
					</div>
				</div>
				<span class="h1 d-inline-block mt-1 mb-3">$ {{ number_format($po_sum,2) }}</span>
				<div class="mb-0">
					<span class="badge badge-soft-success me-2">{{ $po_count }}</span>
					<span class="text-muted"> PO issued in FY23</span>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-xxl-3 d-flex">
		<div class="card flex-fill">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">PR Approved (USD) (YTD)</h5>
					</div>

					<div class="col-auto">
						<div class="stat stat-sm">
							<i class="align-middle" data-feather="shopping-cart"></i>
						</div>
					</div>
				</div>
				<span class="h1 d-inline-block mt-1 mb-3">$ {{ number_format($pr_sum,2) }}</span>
				<div class="mb-0">
					<span class="badge badge-soft-success me-2">{{ $pr_count }}</span>
					<span class="text-muted"> PR issued in FY23</span>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-6 col-xxl-3 d-flex">
		<div class="card flex-fill">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">Payment (YTD) TODO</h5>
					</div>

					<div class="col-auto">
						<div class="stat stat-sm">
							<i class="align-middle" data-feather="activity"></i>
						</div>
					</div>
				</div>
				<span class="h1 d-inline-block mt-1 mb-3">{{ number_format($po_sum,2) }}</span>
				<div class="mb-0">
					<span class="text-muted">In Last 30 Days</span>
				</div>
			</div>
		</div>
	</div>
</div>
