<div class="row">
	<div class="col-12">

		<div class="card">
			<div class="card-header">
				<x-tenant.cards.header-search-export-bar object="DeptBudget"/>
				<h5 class="card-title">
					@if (request('term'))
						Search result for: <strong class="text-danger">{{ request('term') }}</strong>
					@else
						Budget Usages
					@endif
				</h5>
				<h6 class="card-subtitle text-muted">Budget Usages Detail.</h6>
			</div>
			<div class="card-body">
				<table class="table">
					<thead>

						<tr>
							<th>#</th>
							<th>ID</th>
							<th>Dept</th>
							<th>FY</th>
							<th>Date</th>
							<th>Entity</th>
							<th>Document#</th>
							<th>Event</th>
							<th>Project</th>
							<th class="text-end">PR (Booked)</th>
							<th class="text-end">PR (Approved)</th>
							<th class="text-end">PO (Booked)</th>
							<th class="text-end">PO (Approved)</th>
							<th class="text-end">GRS</th>
							<th class="text-end">Payment</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($dbus as $dbu)
						<tr>
							<td>{{ $dbus->firstItem() + $loop->index}}</td>
							<td><a class="text-muted" href="{{ route('dbus.show',$dbu->id) }}"><strong>{{ $dbu->id }}</strong></a></td>
							<td>{{ $dbu->dept->name }}</td>
							<td>{{ $dbu->deptBudget->budget->fy }}</td>
							<td><x-tenant.list.my-date :value="$dbu->created_at"/></td>
							<td>{{ $dbu->entity }}</td>
							<td><x-tenant.list.article-link entity="{{ $dbu->entity }}" :id="$dbu->article_id"/></td>
							<td>{{ $dbu->event }}</td>
							<td><x-tenant.list.project-link id="{{ $dbu->project_id }}" :label="$dbu->project->name"/></td>
							<td class="text-end"><x-tenant.list.my-number :value="$dbu->amount_pr_booked"/></td>
							<td class="text-end"><x-tenant.list.my-number :value="$dbu->amount_pred"/></td>
							<td class="text-end"><x-tenant.list.my-number :value="$dbu->amount_po_booked"/></td>
							<td class="text-end"><x-tenant.list.my-number :value="$dbu->amount_poissued"/></td>
							<td class="text-end"><x-tenant.list.my-number :value="$dbu->amount_grs"/></td>
							<td class="text-end"><x-tenant.list.my-number :value="$dbu->amount_payment"/></td>
							<td>
								<a href="{{ route('dbus.show',$dbu->id) }}" class="btn btn-light"
									data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				<div class="row pt-3">
					{{ $dbus->links() }}
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
