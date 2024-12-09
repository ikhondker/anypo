@extends('layouts.landlord.app')
@section('title','View Service')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('services.index') }}" class="text-muted">Services</a></li>
	<li class="breadcrumb-item active">{{ $service->name }}</li>
@endsection


@section('content')

	<a href="{{ route('services.index') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-list"></i> View all</a>
	<h1 class="h3 mb-3">Service Overview</h1>

			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						@if (auth()->user()->isSystem())
						<a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-danger text-white"><i data-lucide="edit"></i> Edit Service</a>
						@endif
					</div>
					<h5 class="card-title">Service Overview</h5>
					<h6 class="card-subtitle text-muted">Detail Information of a Service.</h6>
				</div>
				<div class="card-body">
					<div class="row g-0">
						<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
							<img src="{{ Storage::disk('s3l')->url('logo/'.$account->logo) }}" width="100" height="100" class="rounded-circle mt-2" alt="{{ $account->name }}" title="{{ $account->name }}">
						</div>
						<div class="col-sm-9 col-xl-12 col-xxl-9">
							{{-- <strong>{{ $account->primaryProduct->name }}</strong> --}}
							<div class="mb-1">
								<span class="card-subtitle">Your plan:
								<strong>{{ $account->primaryProduct->name }}</strong></span>
							</div>
							<div class="mb-1">
								<span class="card-subtitle">Subscription:
									<span class="badge badge-subtle-primary">{{ $account->price }}USD/mo</span>
							</div>
							<div class="mb-1">
								<span class="card-subtitle">Account Name:
								<strong>{{ $account->name }}</strong></span>
							</div>
							<div class="mb-1">
								<span class="card-subtitle">URL:
								<strong>{{ $account->site.'.'.config('app.domain') }}</strong></span>
							</div>
						</div>
					</div>
					<div class="row pt-5">
						<div class="col-md-6">
							<div class="table-responsive">
								<table class="table table-sm mb-0">
									<tbody>
										<x-landlord.show.my-text	value="{{ $service->name }}" label="Service"/>
										<x-landlord.show.my-date	value="{{ $service->start_date }}" label="Start Date"/>
										<x-landlord.show.my-integer	value="{{ $service->user }}" label="User"/>

									</tbody>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="table-responsive">
								<table class="table table-sm mb-0">
									<tbody>
										<x-landlord.show.my-number	value="{{ $service->price }}" label="Price/MO (USD)"/>
											<x-landlord.show.my-enable	value="{{ $service->enable }}"/>
											<x-landlord.show.my-enable	value="{{ $service->addon }}" label="Addon?"/>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>


@endsection

