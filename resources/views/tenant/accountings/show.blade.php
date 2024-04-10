@extends('layouts.app')
@section('title','View Accounting')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('accountings.index') }}">Accounting</a></li>
	<li class="breadcrumb-item active">{{ $accounting->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Accounting
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Accounting"/>
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
					<x-tenant.show.my-text		value="{{ $accounting->id }}" label="ID#"/>
					<x-tenant.show.my-text		value="{{ $accounting->source }}" label="Source"/>
					<x-tenant.show.my-text		value="{{ $accounting->entity }}" label="Entity"/>
					<x-tenant.show.my-text		value="{{ $accounting->event }}" label="Event"/>
					<x-tenant.show.my-date		value="{{ $accounting->accounting_date }}"/>
					<x-tenant.show.my-text		value="{{ $accounting->ac_code }}" label="AC Code"/>
					<x-tenant.show.my-text		value="{{ $accounting->line_description }}" label="Line Description"/>
					<x-tenant.show.my-text		value="{{ $accounting->fc_currency }}" label="Currency"/>
					<x-tenant.show.my-number	value="{{ $accounting->fc_dr_amount }}" label="Dr"/>
					<x-tenant.show.my-number	value="{{ $accounting->fc_cr_amount }}" label="Cr"/>
					<x-tenant.show.my-created-at value="{{ $accounting->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $accounting->created_at }}"/>
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">PO #:</span>
						</div>
						<div class="col-sm-9">
							<a class="text-info" href="{{ route('pos.show',$accounting->po_id) }}">
								{{ "#". $accounting->po_id. " - ". $accounting->po->summary }}
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3 text-end">
							
						</div>
						<div class="col-sm-9">
							@if (auth()->user()->isSystem())
								<a href="{{ route('accountings.edit',$accounting->id) }}" class="text-warning d-inline-block">Edit</a>
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

