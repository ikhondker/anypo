@extends('layouts.tenant.app')
@section('title','Edit PR Line')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('prs.index') }}">Requisitions</a></li>
	<li class="breadcrumb-item"><a href="{{ route('prs.show',$pr->id) }}">PR#{{ $pr->id }}</a></li>
	<li class="breadcrumb-item active">Edit PR Line</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit PR Line
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr" label="Requisition"/>
			<x-tenant.actions.pr-actions id="{{ $pr->id }}"/>
		@endslot
	</x-tenant.page-header>
	
	{{-- @include('tenant.includes.pr.view-pr-header') --}}
	<x-tenant.widgets.pr.show-pr-header id="{{ $pr->id }}"/>

	<!-- form start -->
	<form action="{{ route('prls.update',$prl->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<!-- widget-prl-cards -->
		<x-tenant.widgets.prl.card :pr="$pr" :readOnly="false" :addMore="false">
			@slot('lines')
				<tbody>
					@forelse ($prls as $prln)
						@if ( $prln->id == $prl->id )
							@include('tenant.includes.pr.pr-line-edit')
						@else
							<x-tenant.widgets.prl.card-table-row :line="$prln" :status="$pr->auth_status"/>
						@endif 
					@empty

					@endforelse
				</tbody>
			@endslot
		</x-tenant.widgets.prl.card>
		<!-- /.widget-prl-cards -->

	</form>
	<!-- /.form end -->

	@include('tenant.includes.js.select2')
	@include('tenant.includes.js.calculate-pr-amount')
@endsection

