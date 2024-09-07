@extends('layouts.tenant.app')
@section('title',' PO Terms and Conditions')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('setups.index') }}" class="text-muted">Setup</a></li>
	<li class="breadcrumb-item active">PO Terms and Conditions</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			PO Terms and Conditions
		@endslot
		@slot('buttons')
			<x-tenant.actions.admin.setup-actions setupId="{{ $setup->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('setups.update-tc',$setup->id) }}" method="POST">
		@csrf
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a class="btn btn-sm btn-light" href="{{ route('setups.edit', $setup->id ) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Setup</a>
				</div>
				<h5 class="card-title">Terms and Conditions </h5>
				<h6 class="card-subtitle text-muted">General Terms and Conditions for All Purchase Order.</h6>
			</div>
			<div class="card-body">
				<div class="mb-3">
				</div>

				<div class="mb-3">
					<label class="form-label">Terms and Conditions Text:</label>
					<textarea class="form-control" name="tc" placeholder="Enter Terms and Conditions ..." rows="10">{{ old('tc', $setup->tc) }}</textarea>
					@error('banner_message')
						<div class="small text-danger">{{ $message }}</div>
					@enderror
				</div>

				<x-tenant.edit.save/>
			</div>
		</div>

	</form>
	<!-- /.form end -->
@endsection

