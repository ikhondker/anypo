@extends('layouts.tenant.app')
@section('title','Upload Items')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('upload-items.index') }}" class="text-muted">Interface Items</a></li>
	<li class="breadcrumb-item active">Upload</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Upload Items
		@endslot
		@slot('buttons')
			
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('upload-items.store') }}" method="POST" enctype="multipart/form-data">
		@csrf


				<div class="card">
					<div class="card-header">
						<div class="card-actions float-end">
							<a href="{{ route('upload-items.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
						</div>
					<h5 class="card-title">Upload Items</h5>
					<h6 class="card-subtitle text-muted">Upload data file to create Item by interface.</h6>
					</div>
					<div class="card-body">

						<div class="alert alert-warning alert-outline" role="alert">
							<div class="alert-icon">
								<i data-lucide="alert-triangle" class=""></i>
							</div>
							<div class="alert-message text-warning">
								<strong class="text-warning">WARNING!</strong> Uploading new data will purge any previous non-uploaded data!
							</div>
						</div>

						<div class="mb-3">
							<label class="form-label w-100">Bulk Item Upload</label>
							<input type="file"
							name="file_to_upload" id="file_to_upload"
								accept=".xlsx" placeholder="file_to_upload"/>
								<small class="form-text text-muted">Select the file to upload.</small>
							@error('file_to_upload')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<x-tenant.buttons.show.save/>
					</div>
				</div>


	</form>
	<!-- /.form end -->

@endsection
