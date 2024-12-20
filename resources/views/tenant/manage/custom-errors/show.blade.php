@extends('layouts.tenant.app')
@section('title','View Custom Error')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('custom-errors.index') }}" class="text-muted">Custom Errors</a></li>
	<li class="breadcrumb-item active">{{ $customError->code }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Custom Error
		@endslot
		@slot('buttons')
			<x-tenant.actions.manage.custom-error-actions code="{{ $customError->code }}"/>
		@endslot
	</x-tenant.page-header>



	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a class="btn btn-sm btn-light" href="{{ route('custom-errors.edit', $customError->code ) }}"><i data-lucide="edit"></i> Edit</a>
				<a class="btn btn-sm btn-light" href="{{ route('custom-errors.index') }}" ><i data-lucide="database"></i> View all</a>
			</div>
			<h5 class="card-title">Custom Error Detail</h5>
			<h6 class="card-subtitle text-muted">Custom Error detail information.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-text		value="{{ $customError->code }}" label="Code"/>
					<x-tenant.show.my-text		value="{{ $customError->entity }}" label="Entity"/>
					<x-tenant.show.my-text		value="{{ $customError->message }}" label="Message"/>
					<x-tenant.show.my-boolean	value="{{ $customError->enable }}"/>
					<x-tenant.show.my-created_at value="{{ $customError->created_at }}"/>
					<x-tenant.show.my-updated_at value="{{ $customError->updated_at }}"/>
			</table>
		</div>
	</div>




@endsection

