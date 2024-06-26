@extends('layouts.tenant.app')
@section('title','Edit Hierarchy')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('hierarchies.index') }}">Approval Hierarchies</a></li>
	<li class="breadcrumb-item"><a href="{{ route('hierarchies.show',$hierarchy->id) }}">{{ $hierarchy->name }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Hierarchy
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Hierarchy"/>
			<x-tenant.actions.hierarchy-actions id="{{ $hierarchy->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('hierarchies.update',$hierarchy->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-8">

					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Hierarchy Info</h5>
							<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
						</div>
						<div class="card-body">
							<form>
								<div class="mb-3 row">
                                    <label class="col-form-label col-sm-3 text-sm-right">Hierarchy Name</label>
									<div class="col-sm-9">
                                        <input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id', $hierarchy->id ) }}" hidden>
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
									<label class="col-form-label col-sm-3 text-sm-right">First Approver</label>
									<div class="col-sm-9">
										<select class="form-control" name="approver_id_1" required>
											@foreach ($users as $user)
												<option {{ $user->id == old('approver_id_1',$approver_id_1) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} </option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="mb-3 row">
									<label class="col-form-label col-sm-3 text-sm-right">Second Approver</label>
									<div class="col-sm-9">
										<select class="form-control" name="approver_id_2">
											{{-- @if ($approver_id_2 == 0)
												<option value="0"><< Second Approver >> </option>
											@endif --}}
											<option value="0"><< Second Approver >> </option>
											@foreach ($users as $user)
												<option {{ $user->id == old('approver_id_2',$approver_id_2) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} </option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="mb-3 row">
									<label class="col-form-label col-sm-3 text-sm-right">Third Approver</label>
									<div class="col-sm-9">
										<select class="form-control" name="approver_id_3">
											@if ($approver_id_3 == 0)
											@endif
											<option value="0"><< Third Approver >> </option>
											@foreach ($users as $user)
												<option {{ $user->id == old('approver_id_3',$approver_id_3) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} </option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="mb-3 row">
									<label class="col-form-label col-sm-3 text-sm-right">Fourth Approver</label>
									<div class="col-sm-9">
										<select class="form-control" name="approver_id_4">
											{{-- @if ($approver_id_4 == 0)
											@endif --}}
											<option value="0"><< Fourth Approver >> </option>
											@foreach ($users as $user)
												<option {{ $user->id == old('approver_id_4',$approver_id_4) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} </option>
											@endforeach
										</select>
									</div>
								</div>


								<div class="mb-3 row">
									<label class="col-form-label col-sm-3 text-sm-right">Fifth Approver</label>
									<div class="col-sm-9">
										<select class="form-control" name="approver_id_5">
											{{-- @if ($approver_id_5 == 0)
											@endif --}}
											<option value="0"><< Fifth Approver >> </option>
											@foreach ($users as $user)
												<option {{ $user->id == old('approver_id_5',$approver_id_5) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} </option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="mb-3 row">
									<div class="col-sm-12 ml-sm-auto">
										<x-tenant.buttons.show.save/>
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

