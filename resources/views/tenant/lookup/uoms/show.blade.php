@extends('layouts.tenant.app')
@section('title','View UoM')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('uoms.index') }}" class="text-muted">UoM's</a></li>
	<li class="breadcrumb-item active">{{ $uom->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View UoM
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.uom-actions uomId="{{ $uom->id }}"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a class="btn btn-sm btn-light" href="{{ route('uoms.edit', $uom->id ) }}"><i class="fas fa-edit"></i> Edit</a>
				<a class="btn btn-sm btn-light" href="{{ route('uoms.index') }}" ><i class="fas fa-list"></i> View all</a>
			</div>
			<h5 class="card-title">UoM Detail</h5>
			<h6 class="card-subtitle text-muted">UoM detail Information.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-text		value="{{ $uom->name }}"/>
						<tr>
							<th>Conversion:</th>
							<td>{{ number_format($uom->conversion, 4) }}</td>
						</tr>

						<tr>
							<th>Class Name:</th>
							<td>{{ $uom->uom_class->name }}</td>
						</tr>

					<x-tenant.show.my-boolean	value="{{ $uom->default }}" label="Class Default"/>
					<x-tenant.show.my-boolean	value="{{ $uom->enable }}"/>
					<x-tenant.show.my-created-at value="{{ $uom->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $uom->created_at }}"/>
				</tbody>
			</table>
		</div>
	</div>

@endsection

