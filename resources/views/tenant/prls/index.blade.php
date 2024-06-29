@extends('layouts.tenant.app')
@section('title','Requisition Lines Lists')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Requisition Lines Lists (SYSTEM)
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Prl"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Prl"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Requisition Lines Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of Requisition Lines.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>PO</th>
								<th>Item</th>
								<th>Summary</th>
								<th class="text-end">Qty</th>
								<th class="text-end">Price</th>
								<th class="text-end">Sub Total</th>
								<th class="text-end">Tax</th>
								<th class="text-end">GST</th>
								<th class="text-end">Amount</th>
	
								<th>Enable</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($prls as $prl)
							<tr>
								<td>{{ $prl->id }}</td>
								<td>{{ $prl->pr_id }}</td>
								<td>{{ $prl->item_id }}</td>
								<td>{{ $prl->summary }}</td>
								<td class="text-end"><x-tenant.list.my-number :value="$prl->qty"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$prl->price"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$prl->sub_total"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$prl->tax"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$prl->gst"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$prl->amount"/></td>
								<td><x-tenant.list.my-boolean :value="$prl->enable"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="Prl" :id="$prl->id" :show="false"/>
									<a href="{{ route('prls.destroy',$prl->id) }}" class="me-2 sw2-advance"
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

	 

@endsection

