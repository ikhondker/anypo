@extends('layouts.app')
@section('title','Edit Hierarchy')
@section('breadcrumb','Edit Hierarchy')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Hierarchy
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="Hierarchy"/>
			<x-tenant.buttons.header.create object="Hierarchy"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('hierarchies.update',$hierarchy->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-6">

					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Hierarchy Info</h5>
							<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
						</div>
						<div class="card-body">
							<form>
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">ID</label>
									<div class="col-sm-10">
										<input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id', $hierarchy->id ) }}" readonly>
									</div>
								</div>
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">Hierarchy Name</label>
									<div class="col-sm-10">
										<input type="text" class="form-control @error('name') is-invalid @enderror"
										name="name" id="name" placeholder="Hierarchy Name"
										value="{{ old('name', $hierarchy->name ) }}"
										/>
										@error('name')
											<div class="text-danger text-xs">{{ $message }}</div>
										@enderror
									</div>
								</div>
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">First Approver</label>
									<div class="col-sm-10">
										<select class="form-control" name="approver_id_1" required>
											@foreach ($users as $user)
												<option {{ $user->id == old('approver_id_1',$approver_id_1) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} </option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">Second Approver</label>
									<div class="col-sm-10">
										<select class="form-control" name="approver_id_2">
											@foreach ($users as $user)
												<option {{ $user->id == old('approver_id_2',$approver_id_2) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} </option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">Third Approver</label>
									<div class="col-sm-10">
										<select class="form-control" name="approver_id_3">
											@foreach ($users as $user)
												<option {{ $user->id == old('approver_id_3',$approver_id_3) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} </option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">Fourth Approver</label>
									<div class="col-sm-10">
										<select class="form-control" name="approver_id_4">
											@if ($approver_id_4 == 0)
												<option value=""><< Fourth Approver >> </option>
											@endif
											@foreach ($users as $user)
												<option {{ $user->id == old('approver_id_4',$approver_id_4) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} </option>
											@endforeach
										</select>
									</div>
								</div>


								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">Fifth Approver</label>
									<div class="col-sm-10">
										<select class="form-control" name="approver_id_5">
											@if ($approver_id_5 == 0)
												<option value=""><< Fifth Approver >> </option>
											@endif
											@foreach ($users as $user)
												<option {{ $user->id == old('approver_id_5',$approver_id_5) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} </option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="mb-3 row">
									<div class="col-sm-10 ml-sm-auto">
										<x-tenant.widgets.submit/>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>
				<!-- end col-6 -->

				<div class="col-6">
					<div class="card">

					</div>
				</div>
				<!-- end col-6 -->
			</div>


	</form>
	<!-- /.form end -->
@endsection

