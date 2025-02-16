@extends('layouts.tenant.app')
@section('title','Accounting Headers')

@section('breadcrumb')
	<li class="breadcrumb-item active">Accounting Headers</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Accounting Headers
		@endslot
		@slot('buttons')
			<x-tenant.actions.ae.aeh-actions/>
		@endslot
	</x-tenant.page-header>


	<div class="card">
		<div class="card-header">

			<div class="card-actions float-end">
				<form action="{{ route('aehs.index') }}" method="GET" role="search">
					<div class="btn-toolbar" role="toolbar" aria-label="Toolbar">
						<div class="btn-group me-2" role="group" aria-label="First group">
							<input type="date" class="datepicker form-control @error('start_date') is-invalid @enderror"
								name="start_date" id="start_date" placeholder=""
								value="{{ old('start_date', date('Y-m-01') ) }}"
								required/>
							<input type="date" class="form-control @error('end_date') is-invalid @enderror"
								name="end_date" id="end_date" placeholder=""
								value="{{ old('end_date', date('Y-m-d') ) }}"
								required/>
							<button type="submit" name="action" value="search" class="btn btn-info me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Search..."> <i class="align-middle" data-lucide="search"></i></button>
							<a href="{{ route( 'aehs.index') }}" class="btn btn-info text-white me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
								<i class="align-middle" data-lucide="refresh-cw"></i>
							</a>
							<button type="submit" name="action" value="export" class="btn btn-info me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
								<i class="align-middle" data-lucide="download-cloud"></i>
							</button>

						</div>
					</div>
				</form>
			</div>


			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-info">{{ request('term') }}</strong>
				@else
					Accounting Headers
				@endif
			</h5>
			<h6 class="card-subtitle text-muted">List of Generated Accounting Headers</h6>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Entity</th>
						<th>Event</th>
						<th>Date</th>
						<th>Description</th>
						<th class="text-end">Dr</th>
						<th class="text-end">Cr</th>
						<th>Currency</th>
						<th>PO#</th>
						<th>Reference</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($aehs as $aeh)
					<tr>
						<td><a href="{{ route('aehs.show',$aeh->id) }}"><strong>{{ $aeh->id }}</strong></a></td>
						<td><span class="badge badge-subtle-primary">{{ $aeh->source_entity }}</span></td>
						<td>
								@if ($aeh->event->value == App\Enum\Tenant\AehEventEnum::CANCEL->value)
									<span class="badge badge-subtle-danger">{{ $aeh->event }}</span>
								@else
									<span class="badge badge-subtle-success">{{ $aeh->event }}</span>
								@endif
						</td>
						<td><x-tenant.list.my-date :value="$aeh->accounting_date"/></td>
						<td>{{ $aeh->description }}</td>
						<td class="text-end"><x-tenant.list.my-number :value="$aeh->fc_dr_amount"/></td>
						<td class="text-end"><x-tenant.list.my-number :value="$aeh->fc_cr_amount"/></td>
						<td>{{ $aeh->fc_currency }}</td>
						<td><x-tenant.common.link-po id="{{ $aeh->po_id }}"/></td>
						<td>{{ $aeh->reference_no }}</td>
						<td>
							<a href="{{ route('aehs.show',$aeh->id) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row pt-3">
				{{ $aehs->links() }}
			</div>
			<!-- end pagination -->

		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->


@endsection

