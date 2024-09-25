@extends('layouts.landlord.app')
@section('title','Configuration')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('configs.index') }}" class="text-muted">Configuration</a></li>
	<li class="breadcrumb-item active">{{ $config->name }}</li>
@endsection


@section('content')
	<h1 class="h3 mb-3">Configuration Overview</h1>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="{{ route('configs.edit', $config->id) }}" class="btn btn-sm btn-light"><i class="fas fa-edit"></i>Edit</a>
					</div>
					<h5 class="card-title">Configuration Overview</h5>
					<h6 class="card-subtitle text-muted">Detail Information of your Configuration.</h6>
				</div>
				<div class="card-body">
					<div class="row g-0">
						<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
							<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="100" height="100" class="rounded-circle mt-2" alt="{{ $config->name }}" title="{{ $config->name }}">
						</div>
						<div class="col-sm-9 col-xl-12 col-xxl-9">
							{{-- <strong>{{ $config->primaryProduct->name }}</strong> --}}
							<div class="mb-1">
								<span class="card-subtitle">Name:
								<strong>{{ $config->name }}</strong></span>
							</div>
							<div class="mb-1">
								<span class="card-subtitle">Tagline:
									<strong>{{ $config->tagline }}</strong></span>
							</div>
							<div class="mb-1">
								<span class="card-subtitle">Currency:
								<strong>{{ $config->currency }}</strong></span>
							</div>
						
						</div>
					</div>
					<div class="row pt-5">
						<div class="col-md-6">
							<div class="table-responsive">
								<table class="table table-sm mb-0">
									<tbody>
										<x-landlord.show.my-text value="{{ $config->name }}" label="Name" />
											<x-landlord.show.my-text value="{{ $config->tagline }}" label="Tagline" />
											<x-landlord.show.my-text value="{{ $config->currency }}" label="Current" />
											<x-landlord.show.my-text value="{{ $config->address1 }}" label="Address1" />
											<x-landlord.show.my-text value="{{ $config->address2 }}" label="Address2" />
											<x-landlord.show.my-text value="{{ $config->city.', '.$config->state.', '.$config->zip }}" label="City-State-Zip" />
											<x-landlord.show.my-text value="{{ $config->relCountry->name }}" label="Country" />
											<x-landlord.show.my-text value="{{ $config->cell }}" label="Cell" />
											<x-landlord.show.my-text value="{{ $config->email }}" label="Email" />
											<x-landlord.show.my-url value="{{ $config->website }}" label="Website" />
											<x-landlord.show.my-url value="{{ $config->facebook }}" label="Facebook" />
											<x-landlord.show.my-url value="{{ $config->linkedin }}" label="LinkedIn" />
									</tbody>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="table-responsive">
								<table class="table table-sm mb-0">
									<tbody>
										
									

										<x-landlord.show.my-number value="{{ $config->discount_pc_3 }}" label="3 Months Discount %"/>
										<x-landlord.show.my-number value="{{ $config->discount_pc_6 }}" label="6 Months Discount %"/>
										<x-landlord.show.my-number value="{{ $config->discount_pc_12 }}" label="12 Months Discount %"/>
										<x-landlord.show.my-number value="{{ $config->discount_pc_24 }}" label="24 Months Discount %"/>
				
										<x-landlord.show.my-integer value="{{ $config->days_gen_bill }}" label="Gen Invoice Before"/>
										<x-landlord.show.my-integer value="{{ $config->days_due }}" label="Mark config as due after"/>
										<x-landlord.show.my-integer value="{{ $config->days_pastdue }}" label="Mark config as past due after"/>
										<x-landlord.show.my-integer value="{{ $config->days_archive }}" label="Mark config for archive after"/>
										<x-landlord.show.my-integer value="{{ $config->days_addon_free }}" label="Days Addon Free"/>
				
										<x-landlord.show.my-enable	value="{{ $config->maintenance }}" label="Maintenance ?"/>
										<x-landlord.show.my-date-time	value="{{ $config->maintenance_start_time }}" label="Start"/>
										<x-landlord.show.my-date-time	value="{{ $config->maintenance_end_time }}" label="End"/>
										<x-landlord.show.my-enable	value="{{ $config->banner }}" label="Banner?"/>
										<x-landlord.show.my-text	value="{{ $config->banner_message }}" label="Banner"/>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

