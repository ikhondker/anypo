<div class="card">
	<div class="card-header">

        @if (auth()->user()->isBuyer())
		    <a href="{{ route('pos.create') }}" class="btn btn-primary float-end me-2"><i data-lucide="plus-square"></i> Create Purchase order</a>
		@endif
        {{-- <a href="{{ route('prs.create') }}" class="btn btn-primary float-end me-2"><i data-lucide="plus-square"></i> Create Requisition</a> --}}
		<h5 class="card-title">
			Approved Requisitions - Pending for PO
		</h5>
		<h6 class="card-subtitle text-muted">PO Pending Purchase Requisitions.	</h6>
	</div>
	<div class="card-body">

		<!-- ========== INCLUDE ========== -->
		@include('tenant.includes.pr.pr-lists-table')
		<!-- ========== INCLUDE ========== -->

	</div>
	<!-- end card-body -->
</div>
<!-- end card -->
