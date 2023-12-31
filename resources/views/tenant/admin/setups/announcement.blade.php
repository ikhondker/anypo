@extends('layouts.app')
@section('title',' General Notice')
@section('breadcrumb',' General Notice')

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
	<form action="{{ route('setups.updatenotice',$setup->id) }}" method="POST">
		@csrf
		

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Announcement </h5>
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
									name="show_banner" id="show_banner"  @checked($setup->show_banner)/>
								<span class="form-check-label text-danger">Display above Announcement?</span>
								</label>
							</div>

							<x-tenant.widgets.submit/>
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

