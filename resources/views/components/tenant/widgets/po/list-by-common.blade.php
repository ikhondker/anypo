<div class="row">
	<div class="col-12">

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<div class="btn-toolbar" role="toolbar" aria-label="Toolbar">
						<a href="{{ route('pos.export-for-supplier',$id) }}" class="btn btn-info text-white me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
							<i class="align-middle" data-feather="download-cloud"></i> 
						</a>
					</div>
				</div>
				<h5 class="card-title">
						Purchase Order Lists
				</h5>
				<h6 class="card-subtitle text-muted">List of Purchase Orders.</h6>
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>PO#</th>
							<th>Summary</th>
							<th>Date</th>
							<th>Supplier</th>
							<th>Dept</th>
							<th>Project</th>
							<th>Currency</th>
							<th class="text-end">PO Amount</th>
							<th class="text-end">GRS Amount</th>
							<th class="text-end">Invoice Amount</th>
							<th class="text-end">Paid Amount</th>
							<th>Approval</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($pos as $po)
						<tr>
							<td>{{ $po->id }}</td>
							<td><a class="text-info" href="{{ route('pos.show',$po->id) }}">{{ $po->summary }}</a></td>
							<td><x-tenant.list.my-date :value="$po->po_date"/></td>
							<td>{{ $po->supplier->name }}</td>
							<td>{{ $po->dept->name }}</td>
							<td>{{ $po->project->name }}</td>
							<td>{{ $po->currency }}</td>
							<td class="text-end"><x-tenant.list.my-number :value="$po->amount"/></td>
							<td class="text-end"><x-tenant.list.my-number :value="$po->amount_grs"/></td>
							<td class="text-end"><x-tenant.list.my-number :value="$po->amount_invoice"/></td>
							<td class="text-end"><x-tenant.list.my-number :value="$po->amount_paid"/></td>

							<td><span class="badge {{ $po->auth_status_badge->badge }}">{{ $po->auth_status_badge->name}}</span></td>
							<td class="table-action">
								<a href="{{ route('pos.show',$po->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
									<i class="align-middle" data-feather="eye"></i></a>

								<a href="{{ route('pos.invoice',$po->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Invoices">
									<i class="align-middle" data-feather="layout"></i></a>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				<div class="row pt-3">
					{{ $pos->links() }}
				</div>
			</div>
			<!-- end card-body -->
		</div>
		<!-- end card -->

	</div>
	 <!-- end col -->
</div>
 <!-- end row -->