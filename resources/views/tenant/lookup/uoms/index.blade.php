@extends('layouts.app')
@section('title','UOM')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			UOM
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Uom"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Uom"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							UOM Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of Unit of Measure (UOM).</h6>
				</div>

				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>UoM Name</th>
								<th>Conversion</th>
								<th>UoM Class</th>
								<th>Class Default</th>
								<th>Enable</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($uoms as $uom)
							<tr>
								<td>{{ $uoms->firstItem() + $loop->index}}</td>
								<td>{{ $uom->name }}</td>
								<td>{{ number_format($uom->conversion, 4)  }}</td>
								<td>{{ $uom->uom_class->name }}</td>
								<td><x-tenant.list.my-boolean :value="$uom->default"/></td>
								<td><x-tenant.list.my-boolean :value="$uom->enable"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="Uom" :id="$uom->id" :show="false"/>
									<a href="{{ route('uoms.destroy',$uom->id) }}" class="me-2 sweet-alert2-advance"
										data-entity="Uom" data-name="{{ $uom->name }}" data-status="{{ ($uom->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($uom->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-feather="{{ ($uom->enable ? 'bell-off' : 'bell') }}"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $uoms->links() }}
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

