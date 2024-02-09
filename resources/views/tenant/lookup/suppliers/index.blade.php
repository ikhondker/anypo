@extends('layouts.app')
@section('title','Supplier')

@section('content')

	<x-tenant.page-header>
		@slot('title')
		Supplier
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Supplier"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-8">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Supplier"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Supplier Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Contact Person</th>
								<th>Cell</th>
								<th>Enable</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($suppliers as $supplier)
							<tr>
								<td>{{ $suppliers->firstItem() + $loop->index }}</td>
								<td><a class="text-info" href="{{ route('suppliers.show',$supplier->id) }}">{{ $supplier->name }}</a></td>
								<td>{{ $supplier->contact_person }}</td>
								<td>{{ $supplier->cell }}</td>
								<td><x-tenant.list.my-boolean :value="$supplier->enable"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="Supplier" :id="$supplier->id"/>
									<a href="{{ route('suppliers.destroy',$supplier->id) }}" class="me-2 modal-boolean-advance"
										data-entity="Supplier" data-name="{{ $supplier->name }}" data-status="{{ ($supplier->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($supplier->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-feather="{{ ($supplier->enable ? 'bell-off' : 'bell') }}"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $suppliers->links() }}
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

