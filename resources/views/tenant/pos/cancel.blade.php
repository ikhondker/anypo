@extends('layouts.app')
@section('title','Cancel Approved Requisition')
@section('breadcrumb','Cancel Approved Requisition')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Cancel Requisition
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('prs.cancel') }}" method="POST">
		@csrf

		<div class="row">
			<div class="col-6">
				
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Cancel Requisition</h5>
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
									<strong>Note: </strong> You can only cancel APPROVED requisitions which are not been converted to PO yet.
								</div>
							</div>

							<div class="mb-3 mt-4 row">
								<label class="col-form-label col-sm-2 text-sm-right">PR Number</label>
								<div class="col-sm-10">
									<input type="text" class="form-control @error('pr_id') is-invalid @enderror"
									name="pr_id" id="pr_id" placeholder="0000"
									value="{{ old('pr_id', '' ) }}"
									required/>
									@error('pr_id')
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