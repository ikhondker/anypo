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

						{{-- <x-landlord.show.my-text     value="{{ $service->summary }}"/> --}}
						<x-landlord.show.my-text     value="{{ $service->name }}" label="Service"/>
						<x-landlord.show.my-date value="{{ $service->start_date }}" label="Start Date"/>
						<x-landlord.show.my-date value="{{ $service->end_date }}" label="End Date"/>
						<x-landlord.show.my-integer   value="{{ $service->account_id }}" label="Account"/>
						<x-landlord.show.my-integer   value="{{ $service->user }}" label="User"/>
						<x-landlord.show.my-integer   value="{{ $service->mnth }}" label="Month"/>
						<x-landlord.show.my-integer   value="{{ $service->gb }}" label="GB"/>
						<x-landlord.show.my-number value="{{  $service->price }}" label="Price (USD)"/>
						<x-landlord.show.my-enable   value="{{ $service->enable }}"/>
						<x-landlord.show.my-enable   value="{{ $service->addon }}" label="Addon?"/>
						<x-landlord.show.my-badge    value="{{ $service->id }}" label="ID"/>

				</div>
				<!-- End Body -->

				<!-- Footer -->
				<div class="card-footer pt-0">
						<div class="d-flex justify-content-end gap-3">
							<a class="btn btn-primary" href="{{ route('users.edit',$service->id) }}">Edit</a>
						</div>
				</div>
				<!-- End Footer -->
		</div>
		<!-- End Card -->


@endsection

