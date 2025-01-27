@extends('layouts.tenant.app')
@section('title','Purchase Requisitions')
@section('breadcrumb')
	<li class="breadcrumb-item active">Requisitions</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Purchase Requisitions
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create model="Pr" label="Requisition"/>
			<x-tenant.actions.pr-actions-index/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.dashboards.pr-counts/>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					{{-- <x-tenant.card.header-search-export-xls entity="pr"/> --}}
					<div class="card-actions float-end">
						<form action="{{ route( 'prs.index') }}" method="GET" role="search">
							<div class="btn-toolbar" role="toolbar" aria-label="Toolbar">
								<div class="btn-group me-2" role="group" aria-label="First group">
									<input type="text" class="form-control form-control-sm" minlength=3 name="term" placeholder="Search..." value="{{ old('term', request('term') ) }}" id="term" required>
									<div class="btn-group btn-group-lg">
										<button type="submit" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Search"><i class="align-middle" data-lucide="search"></i></button>
										<a href="{{ route('prs.index') }}" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
											<i class="align-middle" data-lucide="refresh-cw"></i>
										</a>
											<a href="{{ route( 'exports.pr') }}" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
												<i class="align-middle" data-lucide="download-cloud"></i>
											</a>
									</div>
								</div>
							</div>
						</form>
					</div>


					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-info">{{ request('term') }}</strong>
						@else
							Requisition Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of Purchase Requisitions.</h6>
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



@endsection

