@extends('layouts.tenant.app')
@section('title','PR/PO Category')
@section('breadcrumb')
	<li class="breadcrumb-item active">Categories</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			PR/PO Category
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create model="Category"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<x-tenant.card.header-search-export-bar model="Category"/>
			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-info">{{ request('term') }}</strong>
				@else
					PR/PO Category Lists
				@endif
			</h5>
			<h6 class="card-subtitle text-muted">List of PR/PO Category.</h6>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Enable?</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($categories as $category)
					<tr>
						<td>{{ $categories->firstItem() + $loop->index }}</td>
						<td><a href="{{ route('categories.show',$category->id) }}"><strong>{{ $category->name }}</strong></a>
						<td><x-tenant.list.my-boolean :value="$category->enable"/></td>
						<td>
							<a href="{{ route('categories.show',$category->id) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row pt-3">
				{{ $categories->links() }}
			</div>
			<!-- end pagination -->

		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->

@endsection


