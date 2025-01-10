@extends('layouts.tenant.app')
@section('title','UOM')
@section('breadcrumb')
	<li class="breadcrumb-item active">UoM's</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			UOM
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create model="Uom"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<x-tenant.card.header-search-export-bar model="Uom"/>
			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-info">{{ request('term') }}</strong>
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
						<th>Enable?</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($uoms as $uom)
					<tr>
						<td>{{ $uoms->firstItem() + $loop->index}}</td>
						<td><a href="{{ route('uoms.show',$uom->id) }}"><strong>{{ $uom->name }}</strong></a>
						<td>{{ number_format($uom->conversion, 4) }}</td>
                        <td><span class="badge rounded-pill badge-subtle-{{  $uom->uom_class->bg_color }}">{{  $uom->uom_class->name  }}</span></td>
						<td><x-tenant.list.my-boolean :value="$uom->default"/></td>
						<td><x-tenant.list.my-boolean :value="$uom->enable"/></td>
						<td>
							<a href="{{ route('uoms.show',$uom->id) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View
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

@endsection

