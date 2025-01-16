@extends('layouts.tenant.app')
@section('title','Item Master')

@section('breadcrumb')
	<li class="breadcrumb-item active">Item Master</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Items
		@endslot
		@slot('buttons')
			@can('create', App\Models\Tenant\Lookup\Item::class)
				<x-tenant.buttons.header.create model="Item"/>
			@endcan
		@endslot
	</x-tenant.page-header>

	<x-tenant.dashboards.item-counts/>


	<div class="card">
		<div class="card-header">
			<x-tenant.card.header-search-export-bar model="Item"/>

			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-info">{{ request('term') }}</strong>
				@else
					Item Lists
				@endif
			</h5>
			<h6 class="card-subtitle text-muted">List of Items.</h6>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Code</th>
						<th>Name</th>
						<th>Category</th>
						<th>UOM</th>
						<th>OEM</th>
						<th class="text-end">Price</th>
						<th>GL Type</th>
						<th>Enable?</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($items as $item)
					<tr>
						<td>{{ $item->id }}</td>
						<td>{{ $item->code }}</td>
						<td><a href="{{ route('items.show',$item->id) }}"><strong>{{ $item->name }}</strong></a></td>
						<td><span class="badge rounded-pill badge-subtle-{{ $item->item_category->bg_color }}">{{$item->item_category->name }}</span></td>
						<td><span class="badge rounded-pill badge-subtle-{{  $item->uom->bg_color }}">{{  $item->uom->name }}</span></td>
						<td>{{ $item->oem->name }}</td>
						<td class="text-end"><x-tenant.list.my-number :value="$item->price"/></td>
						<td>{{ $item->glType->name }}</td>
						<td><x-tenant.list.my-boolean :value="$item->enable"/></td>
						<td>
							<a href="{{ route('items.show',$item->id) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View
							</a>
						</td>

					</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row pt-3">
				{{ $items->links() }}
			</div>
			<!-- end pagination -->

		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->


@endsection

