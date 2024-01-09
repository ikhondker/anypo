@extends('layouts.app')
@section('title','Prl')

@section('content')

	<x-tenant.page-header>
		@slot('title')
		Prl
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Prl"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-10">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Prl"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Requisition  Lines Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>PO</th>
								<th>Item</th>
								<th>Summary</th>
								<th>Qty</th>
								<th>Price</th>
								<th>Amount</th>
								<th>Enable</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($prls as $prl)
							<tr>
								<td>{{ $prl->id }}</td>
								<td>{{ $prl->pr_id }}</td>
								<td>{{ $prl->item_id }}</td>
								<td>{{ $prl->summary }}</td>
								<td>{{ $prl->qty }}</td>
								<td>{{ $prl->price }}</td>
								<td>{{ $prl->amount }}</td>
								<td><x-tenant.list.my-boolean :value="$prl->enable"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="Prl" :id="$prl->id" :show="false"/>
									<a href="{{ route('prls.destroy',$prl->id) }}" class="me-2 modal-boolean-advance"
										data-entity="Prl" data-name="{{ $prl->name }}" data-status="{{ ($prl->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($prl->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-feather="{{ ($prl->enable ? 'bell-off' : 'bell') }}"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $prls->links() }}
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

	 @include('tenant.includes.modal-boolean-advance')

@endsection

