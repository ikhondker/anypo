@extends('layouts.app')
@section('title',' General Notice')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('setups.index') }}">Setup</a></li>
	<li class="breadcrumb-item active">Announcement</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Announcement
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('setups.update-notice',$setup->id) }}" method="POST">
		@csrf

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Announcement </h5>
							<h6 class="card-subtitle text-muted">General Announcement to all user.</h6>
						</div>
						<div class="card-body">
							<div class="mb-3">
							
								<div class="alert alert-warning alert-outline" role="alert">
									<div class="alert-icon">
										<i class="far fa-fw fa-bell"></i>
									</div>
									<div class="alert-message text-warning">
										<strong class="text-warning">WARNING!</strong> Once enabled, this message will be displayed to every user after login, in their dashboard!
									</div>
								</div>
							</div>

							<div class="mb-3">
								<label class="form-label">Announcement Text:</label>
								<textarea class="form-control" name="banner_message"  placeholder="Enter Announcement ..." rows="3">{{ old('banner_message', $setup->banner_message) }}</textarea>
								@error('banner_message')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
						
							<div class="mb-3">
								<label class="form-check m-0">
								<input type="checkbox" class="form-check-input"
									name="banner_show" id="banner_show"  @checked($setup->banner_show)/>
								<span class="form-check-label text-danger">Display above Announcement?</span>
								</label>
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

