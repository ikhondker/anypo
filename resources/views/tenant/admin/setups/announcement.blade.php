@extends('layouts.tenant.app')
@section('title',' General Announcement')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('setups.index') }}" class="text-muted">Setup</a></li>
	<li class="breadcrumb-item active">Announcement</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Announcement
		@endslot
		@slot('buttons')
			<x-tenant.actions.admin.setup-actions id="{{ $setup->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('setups.update-notice',$setup->id) }}" method="POST">
		@csrf

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a class="btn btn-sm btn-light" href="{{ route('setups.show', $setup->id ) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Setup</a>
				</div>
				<h5 class="card-title">Announcement </h5>
				<h6 class="card-subtitle text-muted">General Announcement to all user.</h6>
			</div>
			<div class="card-body">
				<div class="mb-3">
					<div class="alert alert-warning" role="alert">
						<div class="alert-icon">
							<i data-lucide="info" class="text-danger"></i>
						</div>
						<div class="alert-message">
							<strong class="">WARNING!</strong> Once enabled, every user will see this message, after login, in their dashboard!
						</div>
					</div>
				</div>

				<div class="mb-3 mt-4">
					<label class="form-label">Announcement Text:</label>
					<textarea class="form-control" name="banner_message" placeholder="Enter Announcement ..." rows="6">{{ old('banner_message', $setup->banner_message) }}</textarea>
					@error('banner_message')
						<div class="text-danger text-xs">{{ $message }}</div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-check m-0">
					<input type="checkbox" class="form-check-input"
						name="banner_show" id="banner_show" @checked($setup->banner_show)/>
					<span class="form-check-label">Display above Announcement?</span>
					</label>
				</div>

				<x-tenant.buttons.show.save/>
			</div>
		</div>

	</form>
	<!-- /.form end -->
@endsection

