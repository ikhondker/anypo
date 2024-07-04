@extends('layouts.tenant.app')
@section('title','View Custom Error')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('custom-errors.index') }}">Custom Errors</a></li>
	<li class="breadcrumb-item active">{{ $customError->code }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Custom Error
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="CustomError"/>
			<x-tenant.buttons.header.create object="CustomError"/>
			<x-tenant.buttons.header.edit object="CustomError" :id="$customError->code"/>
		@endslot
	</x-tenant.page-header>



	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a href="{{ route('custom-errors.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>  View all</a>
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
					<x-tenant.buttons.show.edit object="CustomError" :id="$customError->code"/>

			</table>
		</div>
	</div>




@endsection

