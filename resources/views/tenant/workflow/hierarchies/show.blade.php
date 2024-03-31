@extends('layouts.app')
@section('title','Hierarchy')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('hierarchies.index') }}">Approval Hierarchies</a></li>
	<li class="breadcrumb-item active">{{ $hierarchy->name }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Hierarchy
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Hierarchy"/>
			<x-tenant.buttons.header.create object="Hierarchy"/>
			<x-tenant.buttons.header.edit object="Hierarchy" :id="$hierarchy->id"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Hierarchy Name:  {{ $hierarchy->name }}</h5>
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
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($hierarchyls as $hierarchyl)
							<tr>
								<td><span class="badge bg-primary-light">{{ $loop->iteration }}</span></td>
								<td>{{ $hierarchyl->approver->name }}</td>
								<td>{{ $hierarchyl->approver->designation->name }} </td>
								<td>{{ $hierarchyl->approver->dept->name }} </td>
								<td>{{ $hierarchyl->approver->email }} </td>
								<td class="table-action">
									{{-- <a class="btn btn-info" href="{{ route('hierarchy_details.edit',$hierarchy_detail->id) }}">Edit (TBD)</a>
									<a class="btn btn-danger" href="{{ route('hierarchy_details.show',$hierarchy_detail->id) }}">Enable (TBD)</a> --}}
								</td>
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

