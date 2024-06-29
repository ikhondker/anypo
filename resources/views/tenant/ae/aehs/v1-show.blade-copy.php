@extends('layouts.tenant.app')
@section('title','View Accounting')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('aehs.index') }}">Accounting</a></li>
	<li class="breadcrumb-item active">{{ $aeh->id }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Accounting
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Aeh"/>
		@endslot
	</x-tenant.page-header>

    <x-tenant.info.aeh-info id="{{ $aeh->id }}"/>

    <x-tenant.ael.ael-for-aeh id="{{ $aeh->id }}"/>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Accounting Detail</h5>
					<h6 class="card-subtitle text-muted">Details of an Accounting Entry Line.</h6>
				</div>

				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $aeh->id }}" label="ID#"/>
					<x-tenant.show.my-text		value="{{ $aeh->source }}" label="Source"/>
					<x-tenant.show.my-text		value="{{ $aeh->entity }}" label="Entity"/>
					<x-tenant.show.my-text		value="{{ $aeh->event }}" label="Event"/>
					<x-tenant.show.my-date		value="{{ $aeh->accounting_date }}"/>
					<x-tenant.show.my-text		value="{{ $aeh->ac_code }}" label="AC Code"/>
					<x-tenant.show.my-text		value="{{ $aeh->line_description }}" label="Line Description"/>
					<x-tenant.show.my-text		value="{{ $aeh->fc_currency }}" label="Currency"/>
					<x-tenant.show.my-number	value="{{ $aeh->fc_dr_amount }}" label="Dr"/>
					<x-tenant.show.my-number	value="{{ $aeh->fc_cr_amount }}" label="Cr"/>
					<x-tenant.show.my-created-at value="{{ $aeh->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $aeh->created_at }}"/>
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">PO #:</span>
						</div>
						<div class="col-sm-9">
							<a class="text-info" href="{{ route('pos.show',$aeh->po_id) }}">
								{{ "#". $aeh->po_id. " - ". $aeh->po->summary }}
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3 text-end">

						</div>
						<div class="col-sm-9">
							@if (auth()->user()->isSystem())
								<a href="{{ route('aels.edit',$aeh->id) }}" class="text-warning d-inline-block">Edit</a>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
		<div class="col-6">

		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->
@endsection

