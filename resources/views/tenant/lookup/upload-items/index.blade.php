@extends('layouts.app')
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
			<a href="{{ route('upload-items.import') }}" class="btn btn-primary float-end me-2 sweet-alert2-advance"
				data-entity="" data-name="Import Process" data-status="Run"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Validate">
				<i class="fas fa-plus"></i> 4. Import</a>

			<a href="{{ route('upload-items.check') }}" class="btn btn-primary float-end me-2 sweet-alert2-advance"
				data-entity="" data-name="Validation Process" data-status="Run"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Validate">
				<i class="fas fa-plus"></i> 3. Validate</a>
			<a href="{{ route('upload-items.create') }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-circle-up"></i> 2. Upload File</a>
			<a href="{{ asset('downloads/anypo-bulk-item-upload-template-v1.xlsx') }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-circle-down"></i> 1. Download Template</a>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="UploadItem"/>
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
								<th>Error Code</th>
								<th>Timestamp</th>
								<th>Uploaded By</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($upload_items as $upload_item)
							<tr>
								<td>{{ $upload_item->id }}</td>
								<td>{{ $upload_item->item_code }}</td>
								<td><a class="text-info" href="{{ route('upload-items.show',$upload_item->id) }}">{{ $upload_item->item_name }}</a></td>
								<td>{{ $upload_item->category_name }}</td>
								<td>{{ $upload_item->oem_name }}</td>
								<td>{{ $upload_item->uom_name }}</td>
								<td>{{ $upload_item->price }}</td>
								<td>{{ $upload_item->gl_type_name }}</td>
								<td><x-tenant.list.my-badge :value="$upload_item->error_code"/></td>
								<td><x-tenant.list.my-date-time :value="$upload_item->created_at"/></td>
								<td>{{ $upload_item->owner->name }}</td>
								<td>
									@switch($upload_item->status)
										@case(App\Enum\InterfaceStatusEnum::DRAFT->value)
											<span class="badge bg-success">{{ $upload_item->status }}</span>
											@break
										@case(App\Enum\InterfaceStatusEnum::VALIDATED->value)
											<span class="badge bg-info">{{ $upload_item->status }}</span>
											@break
										@case(App\Enum\InterfaceStatusEnum::ERROR->value)
											<span class="badge bg-danger">{{ $upload_item->status }}</span>
											@break
										@default
											<span class="badge bg-success">{{ $upload_item->status }}</span>
									@endswitch

								</td>
								<td class="table-action">
									<x-tenant.list.actions object="UploadItem" :id="$upload_item->id"/>
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

		</div>
		 <!-- end col -->
	</div>
	 <!-- end row -->

	 @include('tenant.includes.js.sweet-alert2-advance')

@endsection

