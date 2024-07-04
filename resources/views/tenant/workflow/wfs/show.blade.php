@extends('layouts.tenant.app')
@section('title','Workflow Details')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('wfs.index') }}">Workflows</a></li>
	<li class="breadcrumb-item active">{{ $wf->id }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Workflow Details
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Wf"/>
			@can('edit', $wf)
				<x-tenant.buttons.header.edit object="Wf" :id="$wf->id"/>
			@endcan
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a href="{{ route('users.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>  View all</a>
				@if (auth()->user()->isSystem())
					<a class="btn btn-sm btn-danger text-white" href="{{ route('users.edit', 1111) }}"><i class="fas fa-edit"></i> Edit</a>
				 @endif
			</div>
			<h5 class="card-title">Wf Details</h5>
			<h6 class="card-subtitle text-muted">Details of workflow.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-text			value="{{ $wf->entity }}" label="Entity"/>
						<x-tenant.show.article-link 	entity="{{ $wf->entity }}" :id="$wf->article_id"/>
						<x-tenant.show.my-text			value="{{ $wf->relHierarchy->name }}" label="Hierarchy Name"/>
						<x-tenant.show.my-date-time		value="{{ $wf->created_at }}" label="Date"/>
						<x-tenant.show.my-badge			value="{{ $wf->wf_status }}" label="WF Status"/>
						<x-tenant.show.my-badge			value="{{ $wf->auth_status }}" label="Auth Status"/>
						<x-tenant.show.my-text			value="{{ $wf->last_performer->name }}" label="Final Approver"/>
						<x-tenant.show.my-date-time		value="{{ $wf->auth_date }}" label="Auth Date"/>
						<tr>
							<th>&nbsp;</th>
							<td>
								@if (auth()->user()->isSystem())
									<a href="{{ route('wfs.edit',$wf->id) }}" class="text-warning d-inline-block">Edit</a>
								@endif
							</td>
						</tr>
				</tbody>
			</table>
		</div>
	</div>


	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Workflow History</h5>
					<h6 class="card-subtitle text-muted">Workflow History with performer and actions.</h6>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID#</th>
								<th>Approver Name</th>
								<th>Assign Date</th>
								<th>Actions</th>
								<th>Action Date</th>
								<th>Notes</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($wfls as $wfl)
							<tr>
								<td><span class="badge badge-subtle-primary">{{ $wfl->id }}</span></td>
								<td>{{ $wfl->performer->name }}</td>
								<td>{{ $wfl->assign_date }} </td>
								<td>{{ $wfl->action }} </td>
								<td>{{ $wfl->action_date }} </td>
								<td>{!! nl2br($wfl->notes) !!}</td>
							</tr>
							@endforeach
						</tbody>
					</table>

				</div>
			</div>
		</div>
		<!-- end col-6 -->
		<div class="col-6">

		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->



@endsection

