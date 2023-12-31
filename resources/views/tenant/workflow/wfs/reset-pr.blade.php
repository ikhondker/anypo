@extends('layouts.app')
@section('title','Reset PR Workflow')
@section('breadcrumb','Reset PR Workflow')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Reset PR Workflow
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('wfs.deletewfpr') }}" method="POST">
		@csrf

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Reset PR Workflow</h5>
						<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
					</div>
					<div class="card-body">
						
						<div class="mb-3">
							<p class="text-danger text-small">You can only reset PR workflow which are in in-PROCESS status.</p>
							<label class="form-label">PR Number</label>
							<input type="text" class="form-control @error('pr_id') is-invalid @enderror" 
								name="pr_id" id="pr_id" placeholder="0000"     
								value="{{ old('pr_id', '' ) }}"
								required/>
							@error('pr_id')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
						
						<x-tenant.widgets.submit/>
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