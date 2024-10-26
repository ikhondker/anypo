<div class="row">
    <div class="col-md-6 col-xxl-6 d-flex">
		<div class="card flex-fill">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">Approved Requisition</h5>
					</div>
					<div class="col-auto">
						<div class="stat stat-sm">
							<i class="align-middle" data-lucide="check-circle"></i>
						</div>
					</div>
				</div>
				<span class="h1 d-inline-block mt-1 mb-3">{{ $_setup->currency}} {{ number_format( $deptBudget->amount_pr) }}</span>
				<div class="mb-0">
					<span class="badge badge-subtle-success">{{ number_format($deptBudget->amount_pr / ($deptBudget->amount == 0 ? 1 : $deptBudget->amount) * 100,2) }}%</span>
					<span class="text-muted">budget Utilized</span>
					<span class="badge badge-subtle-success">{{ $deptBudget->count_pr }}</span>
					<span class="text-muted">PR Issued</span>
				</div>
			</div>
		</div>
	</div>

    <div class="col-md-6 col-xxl-6 d-flex">
		<div class="card flex-fill">
			<div class="card-body">
				<div class="row">
					<div class="col mt-0">
						<h5 class="card-title">In-Process Requisition</h5>
					</div>
					<div class="col-auto">
						<div class="stat stat-sm">
							<i class="align-middle" data-lucide="check-circle"></i>
						</div>
					</div>
				</div>
				<span class="h1 d-inline-block mt-1 mb-3">{{ $_setup->currency}} {{ number_format( $deptBudget->amount_pr_booked) }}</span>
				<div class="mb-0">
					<span class="badge badge-subtle-success">{{ number_format($deptBudget->amount_pr_booked / ($deptBudget->amount == 0 ? 1 : $deptBudget->amount) * 100,2) }}%</span>
					<span class="text-muted">budget Utilized</span>
					<span class="badge badge-subtle-success">{{ $deptBudget->count_pr_booked }}</span>
					<span class="text-muted">PR Booked</span>
				</div>
			</div>
		</div>
	</div>
</div>
