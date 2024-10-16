@extends('layouts.tenant.app')
@section('title','Upload Items')
@section('breadcrumb')
	<li class="breadcrumb-item active">Interface Items</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Upload Items
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.upload-item-actions-index/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<x-tenant.card.header-search-export-bar object="UploadItem"/>
			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-danger">{{ request('term') }}</strong>
				@else
					Upload Item Lists
				@endif
			</h5>
			<h6 class="card-subtitle text-muted">Item Interface Data.</h6>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Code</th>
						<th>Name</th>
						<th>Category</th>
						<th>OEM</th>
						<th>UOM</th>
						<th>Price</th>
						<th>GL Type</th>
						<th>Timestamp</th>
						<th>Uploaded By</th>
						<th>Status</th>
						<th>Error Code</th>
						<th>View</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($upload_items as $upload_item)
					<tr>
						<td>{{ $upload_item->id }}</td>
						<td>{{ $upload_item->item_code }}</td>
						<td><a href="{{ route('upload-items.show',$upload_item->id) }}"><strong>{{ $upload_item->item_name }}</a></strong></td>
						<td>{{ $upload_item->category_name }}</td>
						<td>{{ $upload_item->oem_name }}</td>
						<td>{{ $upload_item->uom_name }}</td>
						<td>{{ $upload_item->price }}</td>
						<td>{{ $upload_item->gl_type_name }}</td>
						<td><x-tenant.list.my-date-time :value="$upload_item->created_at"/></td>
						<td>{{ $upload_item->owner->name }}</td>
						<td>
							@switch($upload_item->status)
								@case(App\Enum\Tenant\InterfaceStatusEnum::DRAFT->value)
									<span class="badge badge-subtle-secondary">{{ $upload_item->status }}</span>
									@break
								@case(App\Enum\Tenant\InterfaceStatusEnum::VALIDATED->value)
									<span class="badge badge-subtle-info">{{ $upload_item->status }}</span>
									@break
								@case(App\Enum\Tenant\InterfaceStatusEnum::ERROR->value)
									<span class="badge badge-subtle-danger">{{ $upload_item->status }}</span>
									@break
								@default
									<span class="badge badge-subtle-success">{{ $upload_item->status }}</span>
							@endswitch
						</td>
						<td><x-tenant.list.my-badge :value="$upload_item->error_code"/></td>
						<td>
							<a href="{{ route('upload-items.show',$upload_item->id) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
							</a>
						</td>

					</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row pt-3">
				{{ $upload_items->links() }}
			</div>
			<!-- end pagination -->

		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->

@endsection

