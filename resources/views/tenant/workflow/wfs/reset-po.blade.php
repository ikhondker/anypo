@extends('layouts.app')
@section('title','Reset PO Workflow')
@section('breadcrumb','Reset PO Workflow')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Reset PO Workflow
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('wfs.wf-reset-po') }}" method="POST">
		@csrf

		<div class="row">
			<div class="col-6">
				
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Reset PO Workflow</h5>
						<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
					</div>
					<div class="card-body">

						<div class="mb-3">
							<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								<div class="alert-icon">
									<i data-feather="alert-triangle" class="text-danger"></i>
								</div>
								<div class="alert-message">
									<strong>Note: </strong> You can only reset PO workflow which are in IN-POOCESS or ERROR status.
								</div>
							</div>

							<div class="mb-3 mt-4 row">
								<label class="col-form-label col-sm-2 text-sm-right">PO Number</label>
								<div class="col-sm-10">
									<input type="text" class="form-control @error('po_id') is-invalid @enderror"
									name="po_id" id="po_id" placeholder="0000"
									value="{{ old('po_id', '' ) }}"
									required/>
									@error('po_id')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<x-tenant.widgets.submit/>
						</div>
						
					</div>
				</div>
			</div>
			<!-- end col-6 -->
			<div class="col-6">

			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->

	</form>
	<!-- /.form end -->

@endsection