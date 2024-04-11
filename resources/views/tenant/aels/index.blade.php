@extends('layouts.app')
@section('title','Accounting')

@section('breadcrumb')
	<li class="breadcrumb-item active">Accounting Entries</li>
@endsection

@section('content')

	{{-- <nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="dashboard-default.html">Home</a></li>
			<li class="breadcrumb-item"><a href="#">Library</a></li>
			<li class="breadcrumb-item active">Data</li>
		</ol>
	</nav> --}}

	<x-tenant.page-header>
		@slot('title')
		Accounting Entries
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Ael"/>
		@endslot
	</x-tenant.page-header>


	<div class="row">
		<div class="col-12">
		

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Ael"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
						Accounting  Entries
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of Generated Ael Entries</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Entity</th>
								<th>Event</th>
								<th>Date</th>
								<th>Account</th>
								<th>Line</th>
								<th class="text-end">Dr</th>
								<th class="text-end">Cr</th>
								<th>Currency</th>
								<th>PO#</th>
								<th>Reference</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($aels as $ael)
							<tr>
								<td><a class="text-info" href="{{ route('aels.show',$ael->id) }}">{{ $ael->id }}</a></td>
								<td>{{ $ael->entity }}</td>
								<td>{{ $ael->event }}</td>
								<td><x-tenant.list.my-date :value="$ael->accounting_date"/></td>
								<td>{{ $ael->ac_code }}</td>
								<td>{{ $ael->line_description }}</td>
								<td class="text-end"><x-tenant.list.my-number :value="$ael->fc_dr_amount"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$ael->fc_cr_amount"/></td>
								<td>{{ $ael->fc_currency }}</td>
								<td><x-tenant.common.link-po id="{{ $ael->po_id }}"/></td>
								<td>{{ $ael->reference }}</td>
								<td class="table-action">
									<x-tenant.list.actions object="Ael" :id="$ael->id" :edit="false"/>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $aels->links() }}
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

	@include('shared.includes.js.sw2-advance')
	
@endsection

