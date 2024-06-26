@extends('layouts.tenant.app')
@section('title','Budget Usages')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('dbus.index') }}">Budget Usages</a></li>
	<li class="breadcrumb-item active">{{ $dbu->id }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Budget Usages
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Dbu"/>
		@endslot
	</x-tenant.page-header>

	

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Budget Usages Information </h5>
					<h6 class="card-subtitle text-muted">Basic information about this Budget Usages.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $dbu->id }}" label="ID"/>
					<x-tenant.show.my-text		value="{{ $dbu->deptBudget->budget->name }}" label="Budget Name"/>
					<x-tenant.show.my-text		value="{{ $dbu->deptBudget->budget->fy }}" label="FY"/>
					<x-tenant.show.my-text		value="{{ $dbu->dept->name }}" label="Dept"/>
					<x-tenant.show.my-date		value="{{ $dbu->created_at }}" label="Date"/>
					<x-tenant.show.my-text		value="{{ $dbu->entity }}" label="Entity"/>
					<x-tenant.show.article-link entity="{{ $dbu->entity }}" :id="$dbu->article_id"/>
					<x-tenant.show.my-text		value="{{ $dbu->event }}" label="Event"/>
					<x-tenant.show.project-link id="{{ $dbu->project_id }}" :label="$dbu->project->name"/>
					<x-tenant.show.my-amount	value="{{ $dbu->amount_pr_booked }}" label="PR Booked"/>
					<x-tenant.show.my-amount	value="{{ $dbu->amount_pr }}" label="PR Approved"/>
					<x-tenant.show.my-amount	value="{{ $dbu->amount_po_booked }}" label="PO Booked"/>
					<x-tenant.show.my-amount	value="{{ $dbu->amount_po }}" label="PO Issued"/>
					<x-tenant.show.my-amount	value="{{ $dbu->amount_grs }}" label="GRS Amount"/>
					<x-tenant.show.my-amount	value="{{ $dbu->amount_payment }}" label="Payment Amount"/>
					<x-tenant.show.my-text		value="{{ $dbu->id }}" label="Transaction ID"/>		
						
					<div class="row">
						<div class="col-sm-3 text-end">
							
						</div>
						<div class="col-sm-9 text-end">
							@if (auth()->user()->isSystem())
								<a href="{{ route('dbus.edit',$dbu->id) }}" class="text-warning d-inline-block">Edit</a>
							@endif
						</div>
					</div>

				</div>
			</div>
		</div>
	
		<!-- end col-6 -->
	</div>
	<!-- end row -->

	<div class="row">
		<div class="col-6">
			
		</div>
		<!-- end col-6 -->
		<div class="col-6">
			
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

	<script type="text/javascript">
		function mySubmit() {
			document.getElementById('frm1').submit();
		}
	</script>


@endsection

