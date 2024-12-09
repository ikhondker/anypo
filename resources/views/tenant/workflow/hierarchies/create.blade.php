@extends('layouts.tenant.app')
@section('title','Hierarchy')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('hierarchies.index') }}" class="text-muted">Approval Hierarchies</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Hierarchy
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="Hierarchy"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('hierarchies.store') }}" method="POST">
		@csrf



		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">

				</div>

				<h5 class="card-title">Create Hierarchy</h5>
				<h6 class="card-subtitle text-muted">Create New Apporval Hierarchy.</h6>
			</div>
			<div class="card-body">

				<table class="table table-sm my-2">
					<tbody>

						<x-tenant.create.name/>
						<x-tenant.create.summary/>
						<tr>
							<th>First Approver :</th>
							<td>
								<select class="form-control" name="approver_id_1" required>
									<option value="0"><< First Approver >> </option>
									@foreach ($users as $user)
										<option value="{{ $user->id }}" {{ $user->id == old('user_id') ? 'selected' : '' }} >{{ $user->name }}</option>
									@endforeach
								</select>
								@error('approver_id_1')
									<div class="small text-danger">{{ $message }}</div>
								@enderror

							</td>
						</tr>
						<tr>
							<th>Second Approver :</th>
							<td>
								<select class="form-control" name="approver_id_2">
									<option value="0"><< Second Approver >> </option>
									@foreach ($users as $user)
										<option value="{{ $user->id }}" {{ $user->id == old('user_id') ? 'selected' : '' }} >{{ $user->name }}</option>
									@endforeach
								</select>
								@error('approver_id_2')
									<div class="small text-danger">{{ $message }}</div>
								@enderror

							</td>
						</tr>
						<tr>
							<th>Third Approver :</th>
							<td>
								<select class="form-control" name="approver_id_3">
									<option value="0"><< Third Approver >> </option>
									@foreach ($users as $user)
										<option value="{{ $user->id }}" {{ $user->id == old('user_id') ? 'selected' : '' }} >{{ $user->name }}</option>
									@endforeach
								</select>
								@error('approver_id_3')
									<div class="small text-danger">{{ $message }}</div>
								@enderror

							</td>
						</tr>
						<tr>
							<th>Fourth Approver :</th>
							<td>
								<select class="form-control" name="approver_id_4">
									<option value="0"><< Fourth Approver >> </option>
									@foreach ($users as $user)
										<option value="{{ $user->id }}" {{ $user->id == old('user_id') ? 'selected' : '' }} >{{ $user->name }}</option>
									@endforeach
								</select>
								@error('approver_id_4')
									<div class="small text-danger">{{ $message }}</div>
								@enderror

							</td>
						</tr>
						<tr>
							<th>Fifth Approver :</th>
							<td>
								<select class="form-control" name="approver_id_5">
									<option value=""><< Fifth Approver >> </option>
									@foreach ($users as $user)
										<option value="{{ $user->id }}" {{ $user->id == old('user_id') ? 'selected' : '' }} >{{ $user->name }}</option>
									@endforeach
								</select>
								@error('user_id')
									<div class="small text-danger">{{ $message }}</div>
								@enderror

							</td>
						</tr>


						<x-tenant.create.save/>

					</tbody>
				</table>

			</div>
		</div>


	</form>
	<!-- /.form end -->

@endsection
