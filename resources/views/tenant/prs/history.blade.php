@extends('layouts.tenant.app')
@section('title','Approval History')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('prs.index') }}" class="text-muted">Requisitions</a></li>
	<li class="breadcrumb-item"><a href="{{ route('prs.show',$pr->id) }}" class="text-muted">PR#{{ $pr->id }}</a></li>
	<li class="breadcrumb-item active">Approval History</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Approval History PR #{{ $pr->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr" label="Requisition"/>
			<x-tenant.buttons.header.create object="Pr" label="Requisition"/>
			<x-tenant.actions.pr-actions id="{{ $pr->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>
	
	<x-tenant.info.pr-info id="{{ $pr->id }}"/>

	{{-- @include('tenant.includes.pr.view-pr-header-basic') --}}

	<!-- Approval History -->
	<x-tenant.wf.approval-history id="{{ $pr->wf_id }}"/>

@endsection

