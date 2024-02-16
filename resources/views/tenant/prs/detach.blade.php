@extends('layouts.app')
@section('title','Remove Attachments')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Remove Attachments PR #{{ $pr->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr"/>
			<x-tenant.buttons.header.create object="Pr"/>
			<x-tenant.buttons.header.edit object="Pr" :id="$pr->id"/>
			<a href="{{ route('prs.show', $pr->id) }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-eye"></i> View Pr</a>
		@endslot
	</x-tenant.page-header>
	
	<x-tenant.info.pr-info id="{{ $pr->id }}"/>

	{{-- @include('tenant.includes.pr.view-pr-header-basic') --}}

	@include('tenant.includes.detach-by-article')
 
@endsection

