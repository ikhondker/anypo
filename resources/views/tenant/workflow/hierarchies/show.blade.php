@extends('layouts.tenant.app')
@section('title','Hierarchy')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('hierarchies.index') }}">Approval Hierarchies</a></li>
	<li class="breadcrumb-item active">{{ $hierarchy->name }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Approval Hierarchy
		@endslot
		@slot('buttons')
          			<x-tenant.actions.hierarchy-actions id="{{ $hierarchy->id }}"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a href="{{ route('hierarchies.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>  View all</a>
			</div>
			<h5 class="card-title">Hierarchy : {{ $hierarchy->name }}</h5>
			<h6 class="card-subtitle text-muted">Details of a approval hierarchy.</h6>
		</div>
		<div class="card-body">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Approver Name</th>
						<th>Title</th>
						<th>Dept</th>
						<th>Email</th>
						<th>User Active</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($hierarchyls as $hierarchyl)
					<tr>
						<td><span class="badge badge-subtle-primary">{{ $loop->iteration }}</span></td>
						<td>{{ $hierarchyl->approver->name }}</td>
						<td>{{ $hierarchyl->approver->designation->name }} </td>
						<td>{{ $hierarchyl->approver->dept->name }} </td>
						<td>{{ $hierarchyl->approver->email }} </td>
						<td><x-tenant.list.my-boolean :value="$hierarchyl->approver->enable"/></td>

					</tr>
					@endforeach
				</tbody>
			</table>

		</div>
	</div>

@endsection

