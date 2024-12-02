@extends('layouts.tenant.app')
@section('title','View UoM')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('uoms.index') }}" class="text-muted">UoM's</a></li>
	<li class="breadcrumb-item active">{{ $uom->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View UoM
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.uom-actions uomId="{{ $uom->id }}"/>
		@endslot
	</x-tenant.page-header>

<x-tenant.widgets.who-when model="Uom" articleId="{{ $uom->id  }}"/>

<x-tenant.widgets.back-to-list model="Uom"/>

@endsection

