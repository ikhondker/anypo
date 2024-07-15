@extends('layouts.tenant.app')
@section('title','Custom Errors')

@section('breadcrumb')
	<li class="breadcrumb-item active">Custom Errors</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Custom Errors
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="CustomError"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="CustomError"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Custom Errors
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of Custom Errors.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Code</th>
								<th>Entity</th>
								<th>Error Message</th>
								<th>Enable</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($customErrors as $customError)
							<tr>
								<td>{{ $customErrors->firstItem() + $loop->index }}</td>
								<td><a href="{{ route('custom-errors.show',$customError->code) }}"><strong>{{ $customError->code }}</strong></a></td>

								<td>{{ $customError->entity }}</td>
								<td>{{ $customError->message }}</td>
								<td><x-tenant.list.my-boolean :value="$customError->enable"/></td>
								<td>
									<a href="{{ route('custom-errors.show',$customError->code) }}" class="btn btn-light"
										data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $customErrors->links() }}
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



@endsection

