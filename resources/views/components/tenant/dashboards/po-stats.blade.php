
<div class="row">

	<div class="col-12 col-sm-6 col-xxl-3 d-flex">
		<div class="card flex-fill">
			<div class="card-body py-4">
				<div class="d-flex align-items-start">
					<div class="flex-grow-1">
						<h3 class="mb-2"> {{ number_format($po->amount, 2, '.', ',') }} </h3>
						<p class="mb-2">PO Amount [{{ $_setup->currency }}]</p>
						<div class="mb-0">
							<span class="badge badge-subtle-success me-2"> {{ $po->currency }} </span>
							@if ($_setup->currency <> $po->currency )	
								<span class="text-muted"> {{ number_format($po->fc_amount, 2, '.', ',') }}</span>
							@endif 
						</div>
					</div>
					<div class="d-inline-block ms-3">
						<div class="stat">
							<i class="align-middle text-success" data-lucide="check-circle"></i>
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
						<h3 class="mb-2"> {{ number_format($po->fc_amount_grs, 2, '.', ',') }} </h3>
						<p class="mb-2">GRS Amount </p>
						<div class="mb-0">
							<span class="badge badge-subtle-success me-2">{{ $_setup->currency }} </span>
						</div>
					</div>
					<div class="d-inline-block ms-3">
						<div class="stat">
							<i class="align-middle text-success" data-lucide="check-circle"></i>
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
						<h3 class="mb-2"> {{ number_format($po->fc_amount_invoice, 2, '.', ',') }} </h3>
						<p class="mb-2">Invoice Amount </p>
						<div class="mb-0">
							<span class="badge badge-subtle-success me-2">{{ $_setup->currency }} </span>
						</div>
					</div>
					<div class="d-inline-block ms-3">
						<div class="stat">
							<i class="align-middle text-success" data-lucide="check-circle"></i>
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
						<h3 class="mb-2"> {{ number_format($po->fc_amount_paid, 2, '.', ',') }} </h3>
						<p class="mb-2">Payment Amount </p>
						<div class="mb-0">
							<span class="badge badge-subtle-success me-2">{{ $_setup->currency }} </span>
						</div>
					</div>
					<div class="d-inline-block ms-3">
						<div class="stat">
							<i class="align-middle text-success" data-lucide="check-circle"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
