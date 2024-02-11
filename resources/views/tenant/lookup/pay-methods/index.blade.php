@extends('layouts.app')
@section('title','PayMethod')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			PayMethod
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="PayMethod"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-8">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="PayMethod"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Payment Method Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
				</div>
			  
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Number</th>
								<th>Currency</th>
								<th>Start-End</th>
								<th>Enable</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							
							@foreach ($pay_methods as $payMethod)
							<tr>
								<td>{{ $payMethod->id }}</td>
								<td><a class="text-info" href="{{ route('pay-methods.show',$payMethod->id) }}">{{ $payMethod->name }}</a></td>
								<td>{{ $payMethod->pay_method_number }}</td>
								<td>{{ $payMethod->currency }}</td>
								<td><x-tenant.list.my-date :value="$payMethod->start_date"/> - <x-tenant.list.my-date :value="$payMethod->end_date"/></td>
								<td><x-tenant.list.my-boolean :value="$payMethod->enable"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="PayMethod" :id="$payMethod->id"/>
									<a href="{{ route('pay-methods.destroy', $payMethod->id) }}" class="me-2 modal-boolean-advance" 
										data-entity="PayMethod" data-name="{{ $payMethod->name }}" data-status="{{ ($payMethod->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($payMethod->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-feather="{{ ($payMethod->enable ? 'bell-off' : 'bell') }}"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $pay_methods->links() }}
					</div>
					<!-- end pagination -->
					
				</div>
				<!-- end card-body -->
			</div>
			<!-- end card -->

		</div>
		 <!-- end col -->
	</div>
	 <!-- end row -->

	@include('tenant.includes.modal-boolean-advance')
	
@endsection

