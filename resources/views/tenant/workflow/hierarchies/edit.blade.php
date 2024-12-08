@extends('layouts.tenant.app')
@section('title','Edit Hierarchy')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('hierarchies.index') }}" class="text-muted">Approval Hierarchies</a></li>
	<li class="breadcrumb-item"><a href="{{ route('hierarchies.show',$hierarchy->id) }}" class="text-muted">{{ $hierarchy->name }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Hierarchy
		@endslot
		@slot('buttons')
			<x-tenant.actions.workflow.hierarchy-actions hierarchyId="{{ $hierarchy->id }}"/>
		@endslot
	</x-tenant.page-header>

<!-- form start -->
<form id="myform" action="{{ route('hierarchies.update',$hierarchy->id) }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a href="{{ route('hierarchies.create') }}" class="btn btn-sm btn-light"><i data-lucide="plus"></i> Create</a>
			</div>
			<h5 class="card-title">Hierarchy Info</h5>
				<h6 class="card-subtitle text-muted">Hierarchy Detail Information.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id', $hierarchy->id ) }}" hidden>
					<x-tenant.edit.name 		:value="$hierarchy->name"/>
					<x-tenant.edit.summary 		value="{{ $hierarchy->summary }}"/>
					<tr>
						<th>First Approver :</th>
						<td>
							<select class="form-control" name="approver_id_1" required>
								@foreach ($users as $user)
									<option {{ $user->id == old('approver_id_1',$approver_id_1) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<th>Second Approver :</th>
						<td>
							<select class="form-control" name="approver_id_2">
								{{-- @if ($approver_id_2 == 0)
									<option value="0"><< Second Approver >> </option>
								@endif --}}
								<option value="0"><< Second Approver >> </option>
								@foreach ($users as $user)
									<option {{ $user->id == old('approver_id_2',$approver_id_2) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<th>Third Approver :</th>
						<td>
							<select class="form-control" name="approver_id_3">
								@if ($approver_id_3 == 0)
								@endif
								<option value="0"><< Third Approver >> </option>
								@foreach ($users as $user)
									<option {{ $user->id == old('approver_id_3',$approver_id_3) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<th>Fourth Approver :</th>
						<td>
							<select class="form-control" name="approver_id_4">
								{{-- @if ($approver_id_4 == 0)
								@endif --}}
								<option value="0"><< Fourth Approver >> </option>
								@foreach ($users as $user)
									<option {{ $user->id == old('approver_id_4',$approver_id_4) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<th>Fifth Approver :</th>
						<td>
							<select class="form-control" name="approver_id_5">
								{{-- @if ($approver_id_5 == 0)
								@endif --}}
								<option value="0"><< Fifth Approver >> </option>
								@foreach ($users as $user)
									<option {{ $user->id == old('approver_id_5',$approver_id_5) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<x-tenant.edit.save/>

				</tbody>
			</table>
		</div>
	</div>
</form>

<x-tenant.widgets.back-to-list model="Hierarchy"/>


@endsection

