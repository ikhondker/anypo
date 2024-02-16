@extends('layouts.app')
@section('title','Approval History')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Approval History PR #{{ $pr->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr"/>
			<x-tenant.buttons.header.create object="Pr"/>
			{{-- <a href="{{ route('prs.show', $pr->id) }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-eye"></i> View Pr</a> --}}
		@endslot
	</x-tenant.page-header>
	
	<x-tenant.widgets.pr-info id="{{ $pr->id }}"/>

	{{-- @include('tenant.includes.pr.view-pr-header-basic') --}}

	<!-- Approval History -->
	<x-tenant.wf.approval-history id="{{ $pr->wf_id }}"/>

@endsection

