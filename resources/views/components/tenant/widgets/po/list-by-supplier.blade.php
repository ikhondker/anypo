<div class="card">
	<div class="card-header">
		<div class="card-actions float-end">
			<div class="btn-toolbar" role="toolbar" aria-label="Toolbar">
				<a href="{{ route('exports.po-for-supplier',$id) }}" class="btn btn-info text-white me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
					<i class="align-middle" data-lucide="download-cloud"></i>
				</a>
			</div>
		</div>
		<h5 class="card-title">
			Purchase Order Lists
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
