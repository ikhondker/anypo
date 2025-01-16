@extends('layouts.tenant.app')
@section('title','Attachments')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('prs.index') }}" class="text-muted">Requisitions</a></li>
	<li class="breadcrumb-item"><a href="{{ route('prs.show',$pr->id) }}" class="text-muted">PR#{{ $pr->id }}</a></li>
	<li class="breadcrumb-item active">Attachments</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			PR #{{ $pr->id }} : Attachments
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="Pr" label="Requisition"/>
			<x-tenant.buttons.header.create model="Pr" label="Requisition"/>
			<x-tenant.actions.pr-actions prId="{{ $pr->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>

	{{-- <x-tenant.info.pr-info prId="{{ $pr->id }}"/> --}}

	<x-tenant.attachment.list-all-by-article entity="{{ EntityEnum::PR->value }}" articleId="{{ $pr->id }}"/>

	<div class="row">
		<div class="col-sm-6">
			@if ($pr->auth_status == App\Enum\Tenant\AuthStatusEnum::DRAFT->value)
				<x-tenant.attachment.add entity="{{ EntityEnum::PR->value }}" articleId="{{ $pr->id }}"/>
			@endif
			</div>
		<div class="col-sm-6 text-end">
				<a class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Back" href="{{ route('prs.show', $pr->id) }}"><i data-lucide="arrow-left-circle"></i> Back to PR</a>
		</div>
	</div>
@endsection

