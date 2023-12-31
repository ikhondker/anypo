@extends('layouts.app')
@section('title','Workflows')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Wf
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Wf"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-8">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Wf"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Workflow Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Article ID</th>
								<th>Entity</th>
								<th>Hierarchy</th>
								<th>WF Status</th>
								<th>Auth Status</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($wfs as $wf)
							<tr>
								<td>{{ $wf->id }}</td>
								<td>{{ $wf->article_id }}</td>
								<td>{{ $wf->entity }}</td>
								<td>{{ $wf->relHierarchy->name }}</td>
								<td><x-tenant.list.my-badge :value="$wf->wf_status"/></td>
								<td><x-tenant.list.my-badge :value="$wf->auth_status"/></td>
								<td><x-tenant.list.my-date-time :value="$wf->created_at"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="Wf" :id="$wf->id" :edit="false" :show="true"/>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $wfs->links() }}
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

