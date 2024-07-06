<div class="row">
	<div class="col-12">

		<div class="card">
			<div class="card-header">
				<a href="{{ route('pos.create') }}" class="btn btn-primary float-end me-2"><i data-lucide="plus-square"></i> Create Purchase Order</a>

				<h5 class="card-title">
					{{ $card_header }}
				</h5>
				<h6 class="card-subtitle text-muted">List of Purchase Orders.</h6>
			</div>
			<div class="card-body">

				<!-- ========== INCLUDE ========== -->
				@include('tenant.includes.po.po-lists-table')
				<!-- ========== INCLUDE ========== -->

			</div>
			<!-- end card-body -->
		</div>
		<!-- end card -->

	</div>
	 <!-- end col -->
</div>
 <!-- end row -->
