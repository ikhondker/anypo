<div class="row">
	<div class="col-12">

		<div class="card">
			<div class="card-header">
				<a href="{{ route('prs.create') }}" class="btn btn-primary float-end me-2"><i data-lucide="plus-square"></i> Create Requisition</a>
				<h5 class="card-title">
					Requisitions (Recent 5)
				</h5>
				<h6 class="card-subtitle text-muted">List of Purchase Requisitions.	</h6>
			</div>
			<div class="card-body">

				<!-- ========== INCLUDE ========== -->
				@include('tenant.includes.pr.pr-lists-table')
				<!-- ========== INCLUDE ========== -->

			</div>
			<!-- end card-body -->
		</div>
		<!-- end card -->

	</div>
	 <!-- end col -->
</div>
 <!-- end row -->
