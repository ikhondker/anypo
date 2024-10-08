@extends('layouts.tenant.app')
@section('title','Dept Budget Usages')

@section('breadcrumb')
	<li class="breadcrumb-item active">Budget Usages</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Budget Usages [{{ ($_setup->currency ) }}]
		@endslot
		@slot('buttons')
			{{-- <x-tenant.buttons.header.create object="Dbu"/> --}}
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.card.header-search-export-bar object="Dbu"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Budget Usages
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">Budget Usages Record for all Departments.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>ID</th>
								<th>Budget</th>
								<th>Dept</th>
								<th>Date</th>
								<th>Linked Document</th>
								<th>Event</th>
								<th>Project</th>
								<th class="text-end">PR</th>
								<th class="text-end">PO</th>
								<th class="text-end">GRS</th>
								<th class="text-end">Invoice</th>
								<th class="text-end">Payment</th>
								<th>View</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($dbus as $dbu)
							<tr>
								<td>{{ $dbus->firstItem() + $loop->index }}</td>
								<td><a href="{{ route('dbus.show',$dbu->id) }}"><strong>{{ $dbu->id }}</strong></a></td>
								<td>{{ $dbu->deptBudget->budget->name }}</td>
								<td>{{ $dbu->dept->name }}</td>
								<td><x-tenant.list.my-date :value="$dbu->created_at"/></td>
								<td><x-tenant.list.article-link entity="{{ $dbu->entity }}" :id="$dbu->article_id"/></td>
								<td><span class="badge badge-subtle-primary">{{ $dbu->event }}</span></td>
								<td><x-tenant.list.project-link id="{{ $dbu->project_id }}" :label="$dbu->project->code"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dbu->amount_pr_booked + $dbu->amount_pr"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dbu->amount_po_booked + $dbu->amount_po"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dbu->amount_grs"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dbu->amount_invoice"/></td>
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



@endsection

