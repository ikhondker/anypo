@extends('layouts.tenant.app')
@section('title','Edit Setup')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('setups.index') }}" class="text-muted">Setup</a></li>
	<li class="breadcrumb-item"><a href="{{ route('setups.show',$setup->id) }}" class="text-muted">{{ $setup->name }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Setup
		@endslot
		@slot('buttons')
			<x-tenant.actions.admin.setup-actions setupId="{{ $setup->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('setups.update',$setup->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')


		<div class="row">
			<div class="col-12 col-lg-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Edit Basic Information</h5>
						<h6 class="card-subtitle text-muted">Basic Configuration details.</h6>
					</div>
					<div class="card-body">
						<table class="table table-sm my-2">
							<tbody>
								<x-tenant.edit.name :value="$setup->name"/>
								<x-tenant.edit.email :value="$setup->email"/>
								<tr>
									<th>Tagline :</th>
									<td>
										<input type="text" class="form-control @error('tagline') is-invalid @enderror"
											name="tagline" id="tagline" placeholder="Tagline"
											value="{{ old('tagline', $setup->tagline ) }}"
											required/>
										@error('tagline')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
									</td>
								</tr>
								<tr>
									<th>Primary Admin :</th>
									<td>
										<select class="form-control" name="admin_id">
											@foreach ($admins as $user)
												<option {{ $user->id == old('admin_id',$setup->admin_id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
											@endforeach
										</select>
									</td>
								</tr>

							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-6">
				<div class="card">
					<div class="card-header">
						<div class="card-actions float-end">
							<a class="btn btn-sm btn-light" href="{{ route('setups.show', $setup->id ) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Setup</a>
						</div>
						<h5 class="card-title">Logo (90x90)</h5>
						<h6 class="card-subtitle text-muted">Edit Company Logo (90x90).</h6>
					</div>
					<div class="card-body">
						<table class="table table-sm my-2">
							<tbody>
								<tr>
									<th></th>
									<td>
										<img src="{{ Storage::disk('s3t')->url('logo/'.$setup->logo) }}" alt="{{ $setup->name }}" class="rounded-circle rounded me-2 mb-2" title="{{ $setup->name }}" width="120px">
										{{-- <x-tenant.show.logo logo="{{ $setup->logo }}"/> --}}
										<x-tenant.attachment.create />
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>

		<div class="row">
			<div class="col-12 col-lg-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Currency and GL Account</h5>
						<h6 class="card-subtitle text-muted">Edit GL Accounts.</h6>
					</div>
					<div class="card-body">
						<table class="table table-sm my-2">
							<tbody>
								<tr>
									<th width="25%">Currency :<x-tenant.info info="Note: You wont be able to change the Currency."/></th>
									<td>
										<input type="text" name="currency" id="currency" class="form-control" placeholder="USD" value="{{ old('currency', $setup->currency ) }}" readonly>
									</td>
								</tr>
								<tr>
									<th>Accrual Account :</th>
									<td>
										<input type="text" class="form-control @error('ac_accrual') is-invalid @enderror"
											name="ac_accrual" id="ac_accrual" placeholder="Accrual Account"
											style="text-transform: uppercase"
											value="{{ old('ac_accrual', $setup->ac_accrual ) }}"
											required/>
										@error('ac_accrual')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
									</td>
								</tr>
								<tr>
									<th>Liability Account :</th>
									<td>
										<input type="text" class="form-control @error('ac_liability') is-invalid @enderror"
											name="ac_liability" id="ac_liability" placeholder="Supplier Liability Account"
											style="text-transform: uppercase"
											value="{{ old('ac_liability', $setup->ac_liability ) }}"
											/>
										@error('ac_liability')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
									</td>
								</tr>

							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Edit Address</h5>
							<h6 class="card-subtitle text-muted">Edit Company Address details.</h6>
						</div>
						<div class="card-body">
							<table class="table table-sm my-2">
								<tbody>
									<x-tenant.edit.address1 value="{{ $setup->address1 }}"/>
									<x-tenant.edit.address2 value="{{ $setup->address2 }}"/>
									<x-tenant.edit.city-state-zip city="{{ $setup->city }}" state="{{ $setup->state }}" zip="{{ $setup->zip }}"/>
									<x-tenant.edit.country :value="$setup->country"/>

									<x-tenant.edit.website value="{{ $setup->website }}"/>
									<x-tenant.edit.facebook value="{{ $setup->facebook }}"/>
									<x-tenant.edit.linked-in value="{{ $setup->linkedin }}"/>
								</tbody>
							</table>
						</div>
					</div>
			</div>
		</div>

		<x-tenant.edit.save/>

	</form>
	<!-- /.form end -->
@endsection

