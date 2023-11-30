@extends('layouts.landlord-app')
@section('title','Account')
@section('breadcrumb','View Account')

@section('content')

<!-- Card -->
<div class="card">
	<div class="card-header border-bottom">
		<h4 class="card-header-title">Billing Account Info</h4>
	</div>

	<!-- Body -->
	<div class="card-body">
		<!-- Form -->
		<div class="row mb-4">
			<label class="col-sm-3 col-form-label form-label">Logo</label>

			<div class="col-sm-9">
				<!-- Media -->
				
				<div class="d-flex align-items-center">
					<!-- Avatar -->
					<label class="avatar avatar-xl avatar-circle" for="avatarUploader">
							<img id="avatarImg" class="avatar-img" src="{{ url(config('bo.DIR_LOGO').$account->logo) }}" alt="{{ $account->name }}" title="{{ $account->name }}">
					</label>
					<div class="d-grid d-sm-flex gap-2 ms-4">

					</div>
					<!-- End Avatar -->
				</div>
				<!-- End Media -->
			</div>
		</div>
		<!-- End Form -->

		{{-- <x-landlord.show.my-badge value="{{ $account->id }}" label="ID" /> --}}
		<x-landlord.show.my-badge value="{{ $account->site.'.'.config('bo.LANDLORD_DOMAIN') }}" label="Site" />
		<x-landlord.show.my-text value="{{ $account->name }}" />
		<x-landlord.show.my-badge value="{{ $account->status->name }}" badge="{{ $account->status->badge }}" label="Status" />
		<x-landlord.show.my-text value="{{ $account->tagline }}" label="Tagline" />
		<x-landlord.show.my-text value="{{ $account->email }}" label="E-mail" />
		<x-landlord.show.my-text value="{{ $account->cell }}" label="Cell" />

		<x-landlord.show.my-number value="{{ $account->price }}" label="Monthly Subscription ($)" />
		<x-landlord.show.my-date value="{{ $account->start_date }}" label="Start" />
		<x-landlord.show.my-date value="{{ $account->end_date }}" label="End" />

		
		<x-landlord.show.my-integer value="{{ $account->user }}" label="Allowed User:" />
		<x-landlord.show.my-integer value="{{ $account->gb }}" label="Allowed GB:" />
		{{-- <x-landlord.show.my-integer value="{{ $account->mnth }}" label="mnth:" /> --}}
		{{-- <x-landlord.show.my-integer value="{{ $account->user_count }}" label="User Count:" />
		<x-landlord.show.my-integer value="{{ $account->service_count }}" label="Service Count" /> --}}

		<x-landlord.show.my-date-time value="{{$account->created_at }}" label="Created At" />
		<x-landlord.show.my-text value="{{ $account->address1 }}" label="Address1" />
		<x-landlord.show.my-text value="{{ $account->address2 }}" label="Address2" />
		<x-landlord.show.my-text value="{{ $account->city.', '.$account->state.', '.$account->zip  }}" label="City-State-Zip" />
		<x-landlord.show.my-text value="{{ $account->relCountry->name }}" label="Country" />
		<x-landlord.show.my-url value="{{ $account->website }}" label="Website" />
		<x-landlord.show.my-url value="{{ $account->facebook }}" label="Facebook" />
		<x-landlord.show.my-url value="{{ $account->linkedin }}" label="LinkedIn" />
		

	</div>
	<!-- End Body -->


	<!-- Footer -->
	<div class="card-footer pt-0">
		<div class="d-flex justify-content-end gap-3">
			<a class="btn btn-primary" href="{{ route('accounts.edit',$account->id) }}">Edit</a>
		</div>
	</div>
	<!-- End Footer -->
</div>
<!-- End Card -->

@endsection