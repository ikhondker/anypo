@extends('layouts.tenant.app')
@section('title','Exports')

@section('breadcrumb')
	<li class="breadcrumb-item active">Exports</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Exports List (SYSTEM)
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create model="Export"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.card.header-search-export-bar model="Export"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-info">{{ request('term') }}</strong>
						@else
							Exports List (SYSTEM)
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">Lists of available exports and brief description.</h6>
				</div>

				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Entity</th>
								<th>Name</th>
								<th>Run Count</th>
								<th>Access</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Enable?</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>


							@foreach ($exports as $export)
							<tr>
								<td>{{ $exports->firstItem() + $loop->index }}</td>
								<td>{{ $export->entity }}</td>
								<td>{{ $export->name }}</td>
								<td>{{ $export->run_count }}</td>
								<td>{{ $export->access }}</td>
								<td><x-tenant.list.my-boolean :value="$export->start_date"/></td>
								<td><x-tenant.list.my-boolean :value="$export->end_date"/></td>
								<td><x-tenant.list.my-boolean :value="$export->enable"/></td>
								<td class="table-action">
									<a href="{{ route('exports.show',$export->entity) }}" class="btn btn-light"
										data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View
									</a>
									<a href="{{ route('exports.edit',$export->entity) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
										<i class="align-middle" data-lucide="edit"></i></a>
									<a href="{{ route('exports.destroy', $export->entity) }}" class="me-2 sw2-advance"
										data-entity="Export" data-name="{{ $export->name }}" data-status="{{ ($export->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($export->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-lucide="{{ ($export->enable ? 'bell-off' : 'bell') }}"></i>
									</a>
                                    <a href="{{ route('exports.'.Str::lower($export->entity).'') }}" class="btn btn-light"
										data-bs-toggle="tooltip" data-bs-placement="top" title="View"> <i data-lucide="download-cloud"></i> Run Export
									</a>
								</td>
							</tr>
							@endforeach

						</tbody>
					</table>

					<div class="row pt-3">

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


@endsection

