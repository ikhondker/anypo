@extends('layouts.app')
@section('title','Category')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Category
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Category"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-6">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Category"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Category Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Enable</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($categories as $category)
							<tr>
								<td>{{ $category->id }}</td>
								<td>{{ $category->name }}</td>
								<td><x-tenant.list.my-boolean :value="$category->enable"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="Category" :id="$category->id" :show="false"/>
									<a href="{{ route('categories.destroy',$category->id) }}" class="me-2 modal-boolean-advance"
										data-entity="Category" data-name="{{ $category->name }}" data-status="{{ ($category->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($category->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle {{ ($category->enable ? 'text-muted' : 'text-success') }}" data-feather="{{ ($category->enable ? 'bell-off' : 'bell') }}"></i>
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

		</div>
		 <!-- end col -->
	</div>
	 <!-- end row -->

	 @include('tenant.includes.modal-boolean-advance')

@endsection

