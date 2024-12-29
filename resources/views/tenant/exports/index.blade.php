@extends('layouts.tenant.app')
@section('title','Exports')
@section('breadcrumb')
	<li class="breadcrumb-item active">Exports</li>
@endsection


@section('content')
	<x-tenant.page-header>
		@slot('title')
			Exports
		@endslot
		@slot('buttons')
			{{-- <x-tenant.buttons.header.create model="Exports"/> --}}
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Exports Lists</h5>
					<h6 class="card-subtitle text-muted">Lists of available exports and brief description.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Entity</th>
								<th>Name</th>
								<th>Description</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>

							@foreach ($exports as $export)
								<tr>
									<td>{{ $exports->firstItem() + $loop->index }}</td>
									<td>{{ $export->entity }}</td>
									<td>{{ $export->name }}</td>
									<td>{{ $export->summary }}</td>
									<td class="">
										<a href="{{ route('exports.parameter',$export->entity) }}" class="btn btn-light"
											data-bs-toggle="tooltip" data-bs-placement="top" title="View"> <i data-lucide="printer"></i> Run Export
										</a>
									</td>
								</tr>
							@endforeach

						</tbody>
					</table>

					<div class="row pt-3">
							{{ $exports->links() }}
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

