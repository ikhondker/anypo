@extends('layouts.app')
@section('title','View Accounting')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('aels.index') }}">Accounting</a></li>
	<li class="breadcrumb-item active">{{ $ael->id }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Accounting
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Ael"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Accounting Detail</h5>
					<h6 class="card-subtitle text-muted">Details of an Accounting Entry Line.</h6>
				</div>

				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $ael->id }}" label="ID#"/>
					<x-tenant.show.my-text		value="{{ $ael->source }}" label="Source"/>
					<x-tenant.show.my-text		value="{{ $ael->entity }}" label="Entity"/>
					<x-tenant.show.my-text		value="{{ $ael->event }}" label="Event"/>
					<x-tenant.show.my-date		value="{{ $ael->accounting_date }}"/>
					<x-tenant.show.my-text		value="{{ $ael->ac_code }}" label="AC Code"/>
					<x-tenant.show.my-text		value="{{ $ael->line_description }}" label="Line Description"/>
					<x-tenant.show.my-text		value="{{ $ael->fc_currency }}" label="Currency"/>
					<x-tenant.show.my-number	value="{{ $ael->fc_dr_amount }}" label="Dr"/>
					<x-tenant.show.my-number	value="{{ $ael->fc_cr_amount }}" label="Cr"/>
					<x-tenant.show.my-created-at value="{{ $ael->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $ael->created_at }}"/>
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">PO #:</span>
						</div>
						<div class="col-sm-9">
							<a class="text-info" href="{{ route('pos.show',$ael->po_id) }}">
								{{ "#". $ael->po_id. " - ". $ael->po->summary }}
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3 text-end">
							
						</div>
						<div class="col-sm-9">
							@if (auth()->user()->isSystem())
								<a href="{{ route('aels.edit',$ael->id) }}" class="text-warning d-inline-block">Edit</a>
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

