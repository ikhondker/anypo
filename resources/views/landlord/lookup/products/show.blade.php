@extends('layouts.landlord.app')
@section('title','View Product')
@section('breadcrumb','View Product')

@section('content')

	<!-- Card -->
	<div class="card">
		<div class="card-header border-bottom">
		<h4 class="card-header-title">Product Info</h4>
		</div>

		<!-- Body -->
		<div class="card-body">
			<x-landlord.show.my-text	value="{{ $product->name }}" label="Product"/>
			<x-landlord.show.my-enable	value="{{ $product->enable }}"/>
			<x-landlord.show.my-badge	value="{{ $product->id }}" label="ID"/>
			<x-landlord.show.my-date	value="{{ $product->created_at }}" label="Created At:"/>
			<x-landlord.show.my-date	value="{{ $product->start_date }}" label="Start Date"/>
			<x-landlord.show.my-date	value="{{ $product->end_date }}" label="End Date"/>
			<x-landlord.show.my-number	value="{{ $product->price }}" label="Price"/>

		</div>
		<!-- End Body -->

		<!-- Footer -->
		<div class="card-footer pt-0">
		<div class="d-flex justify-content-end gap-3">
			<a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
		</div>
		</div>
		<!-- End Footer -->
	</div>
	<!-- End Card -->



@endsection
