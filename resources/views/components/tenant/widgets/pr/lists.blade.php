<div class="row">
	<div class="col-12">

		<div class="card">
			<div class="card-header">
				<a href="{{ route('prs.create') }}" class="btn btn-primary float-end me-2"><i data-feather="plus-square"></i> Create Requisition</a>
				<a href="{{ route('prs.index') }}" class="btn btn-primary float-end me-2"><i data-feather="list"></i> All Requisitions</a>
				<h5 class="card-title">
					{{ $card_header }}
				</h5>
				<h6 class="card-subtitle text-muted">{{ $card_header }}</h6>
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>PR#</th>
							<th>Summary</th>
							<th>Date</th>
							<th>Requestor</th>
							<th>Dept</th>
							<th>Currency</th>
							
							<th class="text-end">Amount</th>
							<th>Approval</th> 
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($prs as $pr)
						<tr>
							<td>{{ $pr->id }}</td>
							<td><a class="text-info" href="{{ route('prs.show',$pr->id) }}">{{ $pr->summary }}</a></td>
							<td><x-tenant.list.my-date :value="$pr->pr_date"/></td>
							<td>{{ $pr->requestor->name }}</td>
							<td>{{ $pr->dept->name }}</td>
							<td>{{ $pr->currency }}</td>
							<td class="text-end"><x-tenant.list.my-number :value="$pr->amount"/></td>
							<td><x-tenant.list.my-badge :value="$pr->auth_status"/></td>
							<td><x-tenant.list.my-badge :value="$pr->status"/></td>
							<td class="table-action">
								<x-tenant.list.actions object="Pr" :id="$pr->id"/>
								<a href="{{ route('reports.pr',$pr->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Print">
									<i class="align-middle" data-feather="printer"></i></a>

								<a href="{{ route('prs.destroy', $pr->id) }}" class="me-2 modal-boolean-advance" 
									data-entity="Pr" data-name="{{ $pr->id }}" data-status="Delete"
									data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
									<i class="align-middle text-muted" data-feather="trash-2"></i>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				<div class="row pt-3">
				
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