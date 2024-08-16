@extends('layouts.tenant.app')
@section('title','Oem')
@section('breadcrumb')
	<li class="breadcrumb-item active">OEMs</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			OEM
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Oem"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">

			<x-tenant.card.header-search-export-bar object="Oem"/>

			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-danger">{{ request('term') }}</strong>
				@else
					OEM Lists
				@endif
			</h5>
			<h6 class="card-subtitle text-muted">List of OEM's</h6>
		</div>

		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Enable</th>
						<th>View</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($oems as $oem)
					<tr>
						<td>{{ $oems->firstItem() + $loop->index }}</td>
						<td><a href="{{ route('oems.show',$oem->id) }}"><strong>{{ $oem->name }}</strong></a></td>
						<td><x-tenant.list.my-boolean :value="$oem->enable"/></td>
						<td>
							<a href="{{ route('oems.show',$oem->id) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row pt-3">
				{{ $oems->links() }}
			</div>
			<!-- end pagination -->

		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->




@endsection

