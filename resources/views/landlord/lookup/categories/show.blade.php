@extends('layouts.landlord.app')
@section('title','Users')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('categories.index') }}" class="text-muted">Category</a></li>
	<li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection


@section('content')

	<h1 class="h3 mb-3">View Category</h1>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="{{ route('categories.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
						@if (auth()->user()->isSystem())
						<a class="btn btn-sm btn-danger text-white" href="{{ route('categories.edit', $category->id) }}"><i class="fas fa-edit"></i> Edit</a>

						@endif
					</div>
					<h5 class="card-title">View Category</h5>
					<h6 class="card-subtitle text-muted">View details of a category.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-landlord.show.my-text	value="{{ $category->name }}" label="Category"/>
							<x-landlord.show.my-enable	value="{{ $category->enable }}"/>
							<x-landlord.show.my-badge	value="{{ $category->id }}" label="ID"/>
							<x-landlord.show.my-date	value="{{ $category->created_at }}" label="Created At:"/>
							<x-landlord.show.my-content	value="{{ $category->notes }}" label="Notes"/>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


@endsection


