@extends('layouts.landlord.app')
@section('title','View Product')
@section('breadcrumb','View Product')

@section('content')

	<h1 class="h3 mb-3">View Product</h1>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="{{ route('products.index') }}" class="btn btn-sm btn-light"><i class="fas fa-edit"></i>  View all</a>
						@if (auth()->user()->isSystem())
						<a class="btn btn-sm btn-danger text-white" href="{{ route('products.edit', $product->id) }}"><i class="fas fa-edit"></i> Edit</a>

						@endif
					</div>
					<h5 class="card-title">View Product</h5>
					<h6 class="card-subtitle text-muted">View details of a Product.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-landlord.show.my-text	value="{{ $product->name }}" label="Product"/>
							<x-landlord.show.my-enable	value="{{ $product->enable }}"/>
							<x-landlord.show.my-badge	value="{{ $product->id }}" label="ID"/>
							<x-landlord.show.my-date	value="{{ $product->created_at }}" label="Created At"/>
							<x-landlord.show.my-number	value="{{ $product->price }}" label="Price"/>
							<x-landlord.show.my-content	value="{{ $product->notes }}" label="Notes"/>
							<x-landlord.show.my-integer	value="{{ $product->sold_qty }}" label="Sold Qty"/>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

@endsection
