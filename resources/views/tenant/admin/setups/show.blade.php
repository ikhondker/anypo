@extends('layouts.tenant.app')
@section('title','View Setup')
@section('breadcrumb')
	{{-- <li class="breadcrumb-item"><a href="{{ route('setups.index') }}">Setup</a></li> --}}
	<li class="breadcrumb-item active">{{ $setup->name }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Setup
		@endslot
		@slot('buttons')
			<x-tenant.actions.setup-actions id="{{ $setup->id }}"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Basic Configurations</h5>
					<h6 class="card-subtitle text-muted">Basic Configuration details.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $setup->name }}"/>
					<x-tenant.show.my-text		value="{{ $setup->tagline }}" label="Tagline"/>
					<x-tenant.show.my-text		value="{{ $setup->admin_user->name }}" label="Admin"/>
					<x-tenant.show.my-boolean	value="{{ $setup->freezed }}" label="Setup freezed"/>
					<x-tenant.show.my-boolean	value="{{ $setup->enable }}"/>

				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Financial Configuration</h5>
					<h6 class="card-subtitle text-muted">Financial Configuration details.</h6>
				</div>
				<div class="card-body">
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">Currency:</span>
						</div>
						<div class="col-sm-9">
							{{ $setup->currency.' - '.$setup->relCurrency->name.' ('.$setup->relCurrency->country.')' }} <x-tenant.info info="Note: You wont be able to change the currency."/>
						</div>
					</div>
					{{-- <x-tenant.show.my-number value="{{ $setup->tax }}" label="Tax %"/>
					<x-tenant.show.my-number value="{{ $setup->vat }}" label="VAT %"/> --}}
				</div>
			</div>


			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Address</h5>
					<h6 class="card-subtitle text-muted">Company Address details.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text value="{{ $setup->address1 }}" label="Address1"/>
					<x-tenant.show.my-text value="{{ $setup->address2 }}" label="Address2"/>
					<x-tenant.show.my-text value="{{ $setup->city.', '.$setup->state.', '.$setup->zip }}" label="City"/>
					<x-tenant.show.my-text value="{{ $setup->country_name->name }}" label="Country"/>
				</div>
			</div>


			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Integration</h5>
					<h6 class="card-subtitle text-muted">GL Integration.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text value="{{ $setup->ac_accrual }}" label="Accrual Account"/>
					<x-tenant.show.my-text value="{{ $setup->ac_liability }}" label="Supplier Liability Account"/>
				</div>
			</div>

		</div>
		<!-- end col-6 -->
		<div class="col-6">


			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Company Logo</h5>
					<h6 class="card-subtitle text-muted">Company Logo (90x90).</h6>
				</div>
				<div class="card-body">
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">&nbsp;</span>
						</div>
						<div class="col-sm-9">
							{{-- <x-tenant.show.logo logo="{{ $setup->logo }}"/> --}}
							<img src="{{ Storage::disk('s3t')->url('logo/'.$setup->logo) }}" alt="{{ $setup->name }}" class="rounded-circle rounded me-2 mb-2" title="{{ $setup->name }}" width="120px">
						</div>
					 </div>
				</div>
			</div>



			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Web Presence</h5>
					<h6 class="card-subtitle text-muted">Web Presence details.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text value="{{ $setup->email }}" label="E-mail"/>
					<x-tenant.show.my-url value="{{ $setup->website }}" label="Website"/>
					<x-tenant.show.my-url value="{{ $setup->facebook }}" label="Facebook"/>
					<x-tenant.show.my-url value="{{ $setup->linkedin }}" label="LinkedIn"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Announcement</h5>
					<h6 class="card-subtitle text-muted">General Announcement configuration.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-boolean	value="{{ $setup->banner_show }}" label="Announcement?"/>
					<x-tenant.show.my-text-area value="{{ $setup->banner_message }}" label="Announcement"/>
					<x-tenant.show.my-text value="{{ $setup->cell }}" label="Cell"/>
				</div>
			</div>

		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->


	<div class="row">
		<div class="col-6">
		</div>
		<!-- end col-6 -->
		<div class="col-6">

		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

	<div class="row">
		<div class="col-6">

		</div>
		<!-- end col-6 -->
		<div class="col-6">
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

@endsection

