@extends('layouts.tenant.app')
@section('title','View Setup')
@section('breadcrumb')
	{{-- <li class="breadcrumb-item"><a href="{{ route('setups.index') }}">Setup</a></li> --}}
	<li class="breadcrumb-item active">{{ $setup->name }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Setup
		@endslot
		@slot('buttons')
			<x-tenant.actions.admin.setup-actions setupId="{{ $setup->id }}"/>
		@endslot
	</x-tenant.page-header>


<div class="row">
	<div class="col-12 col-lg-6">
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a class="btn btn-sm btn-light" href="{{ route('setups.edit', $setup->id ) }}"><i class="fas fa-edit"></i> Edit</a>
				</div>
				<h5 class="card-title">Setup Information</h5>
				<h6 class="card-subtitle text-muted">Setup Information.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Logo :</th>
							<td>
								<img src="{{ Storage::disk('s3t')->url('logo/'.$setup->logo) }}" alt="{{ $setup->name }}" class="img-fluid rounded-circle mb-2" width="128" height="128" title="{{ $setup->name }}">
							</td>
						</tr>
						<x-tenant.show.my-text		value="{{ $setup->name }}"/>
						<x-tenant.show.my-text		value="{{ $setup->tagline }}" label="Tagline"/>
						<x-tenant.show.my-text		value="{{ $setup->admin_user->name }}" label="Admin"/>
						<tr>
							<th>Currency : </th>
							<td>
								{{ $setup->currency.' - '.$setup->relCurrency->name.' ('.$setup->relCurrency->country.')' }}<x-tenant.info info="Note: You wont be able to change the currency."/>
							</td>
						</tr>
						@if (auth()->user()->isSystem())
							<x-tenant.show.my-boolean	value="{{ $setup->freezed }}" label="Setup freezed"/>
						@endif
						<x-tenant.show.my-boolean	value="{{ $setup->enable }}"/>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-12 col-lg-6">
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a class="btn btn-sm btn-light" href="{{ route('setups.edit', $setup->id ) }}"><i class="fas fa-edit"></i> Edit</a>
				</div>
				<h5 class="card-title">Address Information</h5>
				<h6 class="card-subtitle text-muted">Address Information.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.show.my-text value="{{ $setup->address1 }}" label="Address1"/>
						<x-tenant.show.my-text value="{{ $setup->address2 }}" label="Address2"/>
						<x-tenant.show.my-text value="{{ $setup->city.', '.$setup->state.', '.$setup->zip }}" label="City"/>
						<x-tenant.show.my-text value="{{ $setup->country_name->name }}" label="Country"/>
						<x-tenant.show.my-text value="{{ $setup->cell }}" label="Cell"/>
						<x-tenant.show.my-text value="{{ $setup->email }}" label="E-mail"/>
						<x-tenant.show.my-url value="{{ $setup->website }}" label="Website"/>
						<x-tenant.show.my-url value="{{ $setup->facebook }}" label="Facebook"/>
						<x-tenant.show.my-url value="{{ $setup->linkedin }}" label="LinkedIn"/>
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
				{{-- <div class="card-actions float-end">
					<a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-light"><i class="fas fa-edit"></i> Edit User</a>
				</div> --}}
				<h5 class="card-title">Integration Information</h5>
				<h6 class="card-subtitle text-muted">Integration Information.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.show.my-text value="{{ $setup->ac_accrual }}" label="Accrual Account"/>
						<x-tenant.show.my-text value="{{ $setup->ac_liability }}" label="Liability Account"/>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-12 col-lg-6">
		<div class="card">
			<div class="card-header">
					{{-- <div class="card-actions float-end">
						<a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-light"><i class="fas fa-edit"></i> Edit User</a>
					</div> --}}
					<h5 class="card-title">Announcement</h5>
					<h6 class="card-subtitle text-muted">General Announcement configuration.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.show.my-boolean	value="{{ $setup->banner_show }}" label="Announcement"/>
						<x-tenant.show.my-text-area value="{{ $setup->banner_message }}" label="Announcement"/>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>






@endsection

