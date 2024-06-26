@extends('layouts.tenant.app')
@section('title','Hierarchy')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('hierarchies.index') }}">Approval Hierarchies</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Hierarchy
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="Hierarchy"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('hierarchies.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row">
			<div class="col-8">

				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Create Hierarchy</h5>
						<h6 class="card-subtitle text-muted">Create New Apporval Hierarchy.</h6>
					</div>
					<div class="card-body">
						<form>

							<div class="mb-3 row">
								<label class="col-form-label col-sm-3 text-sm-right">Hierarchy Name</label>
								<div class="col-sm-9">
									<input type="text" class="form-control @error('name') is-invalid @enderror"
									name="name" id="name" placeholder="Hierarchy Name"
									value="{{ old('name', '' ) }}"
									required/>
								@error('name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
								</div>
							</div>

							<div class="mb-3 row">
								<label class="col-form-label col-sm-3 text-sm-right">First Approver</label>
								<div class="col-sm-9">
									<select class="form-control" name="approver_id_1" required>
										<option value="0"><< First Approver >> </option>
										@foreach ($users as $user)
											<option value="{{ $user->id }}" {{ $user->id == old('user_id') ? 'selected' : '' }} >{{ $user->name }} </option>
										@endforeach
									</select>
									@error('approver_id_1')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-form-label col-sm-3 text-sm-right">Second Approver</label>
								<div class="col-sm-9">
									<select class="form-control" name="approver_id_2">
										<option value="0"><< Second Approver >> </option>
										@foreach ($users as $user)
											<option value="{{ $user->id }}" {{ $user->id == old('user_id') ? 'selected' : '' }} >{{ $user->name }} </option>
										@endforeach
									</select>
									@error('approver_id_2')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-form-label col-sm-3 text-sm-right">Third Approver</label>
								<div class="col-sm-9">
									<select class="form-control" name="approver_id_3">
										<option value="0"><< Third Approver >> </option>
										@foreach ($users as $user)
											<option value="{{ $user->id }}" {{ $user->id == old('user_id') ? 'selected' : '' }} >{{ $user->name }} </option>
										@endforeach
									</select>
									@error('approver_id_3')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-form-label col-sm-3 text-sm-right">Fourth Approver</label>
								<div class="col-sm-9">
									<select class="form-control" name="approver_id_4">
										<option value="0"><< Fourth Approver >> </option>
										@foreach ($users as $user)
											<option value="{{ $user->id }}" {{ $user->id == old('user_id') ? 'selected' : '' }} >{{ $user->name }} </option>
										@endforeach
									</select>
									@error('approver_id_4')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
							</div>

							<div class="mb-3 row">
								<label class="col-form-label col-sm-3 text-sm-right">Fifth Approver</label>
								<div class="col-sm-9">
									<select class="form-control" name="approver_id_5">
										<option value=""><< Fifth Approver >> </option>
										@foreach ($users as $user)
											<option value="{{ $user->id }}" {{ $user->id == old('user_id') ? 'selected' : '' }} >{{ $user->name }} </option>
										@endforeach
									</select>
									@error('user_id')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
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

			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->

	</form>
	<!-- /.form end -->

@endsection
