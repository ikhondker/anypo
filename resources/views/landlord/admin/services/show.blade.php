@extends('layouts.landlord-app')
@section('title','View Service')
@section('breadcrumb','View Service')

@section('content')

		<!-- Card -->
		<div class="card">
				<div class="card-header border-bottom">
						<h4 class="card-header-title">Service Details</h4>
				</div>

				<!-- Body -->
				<div class="card-body">

					<!-- Form -->
					<div class="row mb-4">
						<label class="col-sm-3 col-form-label form-label">Logo :</label>

						<div class="col-sm-9">

							<!-- Media -->
							<div class="d-flex align-items-center">
								<!-- Avatar -->
								<label class="avatar avatar-xxl avatar-circle" for="avatarUploader">
									{{-- <img id="avatarImg" class="avatar-img" src="{{ Storage::disk('s3la')->url($user->avatar) }}" alt="{{ $user->name }}" title="{{ $user->name }}"> --}}
									<img id="avatarImg" class="avatar-img" src="{{ Storage::disk('s3ll')->url($service->account->logo) }}" alt="{{ $service->account->name }}" title="{{ $service->account->name }}">
								</label>
								<div class="d-grid d-sm-flex gap-2 ms-4">

								</div>
								<!-- End Avatar -->
							</div>
							<!-- End Media -->

						</div>
					</div>
					<!-- End Form -->

					{{-- <x-landlord.show.my-text	value="{{ $service->summary }}"/> --}}
					<x-landlord.show.my-text	value="{{ $service->name }}" label="Service"/>
					<x-landlord.show.my-date	value="{{ $service->start_date }}" label="Start Date"/>
					<x-landlord.show.my-date	value="{{ $service->end_date }}" label="End Date"/>
					<x-landlord.show.my-text	value="{{ $service->account_id }}" label="Account"/>
					<x-landlord.show.my-integer	value="{{ $service->mnth }}" label="Month"/>
					<x-landlord.show.my-integer	value="{{ $service->user }}" label="User"/>
					<x-landlord.show.my-integer	value="{{ $service->gb }}" label="GB"/>
					<x-landlord.show.my-number	value="{{ $service->price }}" label="Price/Mo (USD)"/>
					<x-landlord.show.my-enable	value="{{ $service->enable }}"/>
					<x-landlord.show.my-enable	value="{{ $service->addon }}" label="Addon?"/>
				</div>
				<!-- End Body -->


				@if (auth()->user()->isSeeded())
					<!-- Footer -->
					<div class="card-footer pt-0">
							<div class="d-flex justify-content-end gap-3">
								<a class="btn btn-primary" href="{{ route('services.edit',$service->id) }}">Edit</a>
							</div>
					</div>
					<!-- End Footer -->
				@endif 
		</div>
		<!-- End Card -->


@endsection

