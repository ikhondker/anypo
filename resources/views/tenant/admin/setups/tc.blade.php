@extends('layouts.app')
@section('title',' PO Terms and Conditions')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('setups.index') }}">Setup</a></li>
	<li class="breadcrumb-item active">PO Terms and Conditions</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			PO Terms and Conditions
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('setups.update-tc',$setup->id) }}" method="POST">
		@csrf

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Terms and Conditions </h5>
							<h6 class="card-subtitle text-muted">General Terms and Conditions for All Purchase Order.</h6>
						</div>
						<div class="card-body">
							<div class="mb-3">
							</div>

							<div class="mb-3">
								<label class="form-label">Terms and Conditions Text:</label>
								<textarea class="form-control" name="tc"  placeholder="Enter Terms and Conditions ..." rows="6">{{ old('tc', $setup->tc) }}</textarea>
								@error('banner_message')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
						
							<x-tenant.buttons.show.save/>
						</div>
					</div>
					
				</div>
				<div class="col-6">
				</div>
			</div>

			<!-- end row -->
	</form>
	<!-- /.form end -->
@endsection

