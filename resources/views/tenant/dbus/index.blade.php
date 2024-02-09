@extends('layouts.app')
@section('title','Dept Budget Usages')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Department Budget Usages [{{ ($_setup->currency ) }}]
		@endslot
		@slot('buttons')
			{{-- <x-tenant.buttons.header.create object="Dbu"/> --}}
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="DeptBudget"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Department Budget Usages
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							{{-- id dept_budget_id entity article_id event amount amount_pr_booked amount_pr_issued amount_po_booked amount_po_issued amount_grs amount_payment notes deleted_at created_by created_at updated_by updated_at --}}

							<tr>
								<th>#</th>
								<th>ID</th>
								<th>Dept</th>

								<th>FY</th>
								<th>Date</th>
								<th>Entity</th>
								<th>Article</th>
								<th>Event</th>
								<th>Project</th>
								<th class="text-end">PR Booked</th>
								<th class="text-end">PR Approved</th>
								<th class="text-end">PO Booked</th>
								<th class="text-end">PO Issued</th>
								<th class="text-end">GRS</th>
								<th class="text-end">Payment</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($dbus as $dbu)
							<tr>
								<td>{{ $dbus->firstItem() + $loop->index}}</td>
								<td><a class="text-info" href="{{ route('dbus.show',$dbu->id) }}">{{ $dbu->id  }}</a></td>
								<td>{{ $dbu->dept->name }}</td>
								<td>{{ $dbu->deptBudget->budget->fy }}</td>
								{{-- <td>aa</td> --}}
								<td><x-tenant.list.my-date :value="$dbu->created_at"/></td>
								<td>{{ $dbu->entity }}</td>
								<td>{{ $dbu->article_id}}</td>
								<td>{{ $dbu->event }}</td>
								<td>{{ $dbu->project->name }}</td>
								<td class="text-end"><x-tenant.list.my-number :value="$dbu->amount_pr_booked"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dbu->amount_pr_issued"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dbu->amount_po_booked"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dbu->amount_po_issued"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dbu->amount_grs"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dbu->amount_payment"/></td>

								<td class="table-action">
									<x-tenant.list.actions object="Dbu" :id="$dbu->id"/>
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

	 @include('tenant.includes.modal-boolean-advance')

@endsection

