@extends('layouts.app')
@section('title','Group')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Group
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Group"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-8">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Group" :export="true"/>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Enable</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($groups as $group)
							<tr>
								<td>{{ $groups->firstItem() + $loop->index }}</td>
								<td>{{ $group->name }}</td>
								<td><x-tenant.list.my-boolean :value="$group->enable"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="Group" :id="$group->id" :show="false"/>
									<a href="{{ route('groups.destroy',$group->id) }}" class="me-2 modal-boolean-advance"
										data-entity="Group" data-name="{{ $group->name }}" data-status="{{ ($group->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($group->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle {{ ($group->enable ? 'text-muted' : 'text-success') }}" data-feather="{{ ($group->enable ? 'bell-off' : 'bell') }}"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $groups->links() }}
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

