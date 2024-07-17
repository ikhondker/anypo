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
								<th>POLID</th>
								<th>PO#</th>
								<th>Item ID</th>
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
								<td>{{ $prl->item_description }}</td>
								<td class="text-end"><x-tenant.list.my-number :value="$prl->qty"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$prl->price"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$prl->sub_total"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$prl->tax"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$prl->gst"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$prl->amount"/></td>
								<td><x-tenant.list.my-boolean :value="$prl->enable"/></td>
								<td>
									<a href="{{ route('prls.show',$prl->id) }}" class="btn btn-light"
										data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
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




@endsection

