@extends('layouts.tenant.app')
@section('title','Category')
@section('breadcrumb')
	<li class="breadcrumb-item active">Categories</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Item Category
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Category"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<x-tenant.card.header-search-export-bar object="Category"/>
			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-danger">{{ request('term') }}</strong>
				@else
					Item Category Lists
				@endif
			</h5>
			<h6 class="card-subtitle text-muted">List of Item Category.</h6>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Enable</th>
						<th>View</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($itemCategories as $itemCategory)
					<tr>
						<td>{{ $itemCategories->firstItem() + $loop->index }}</td>
						<td><a href="{{ route('item-categories.show',$itemCategory->id) }}"><strong>{{ $itemCategory->name }}</strong></a>
						<td><x-tenant.list.my-boolean :value="$itemCategory->enable"/></td>
						<td>
							<a href="{{ route('item-categories.show',$itemCategory->id) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row pt-3">
				{{ $itemCategories->links() }}
			</div>
			<!-- end pagination -->

		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->

@endsection

