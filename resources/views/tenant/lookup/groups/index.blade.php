@extends('layouts.tenant.app')
@section('title','Group')
@section('breadcrumb')
	<li class="breadcrumb-item active">Item Groups</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Item Groups
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Group"/>
		@endslot
	</x-tenant.page-header>

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
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($groups as $group)
					<tr>
						<td>{{ $groups->firstItem() + $loop->index }}</td>
						<td><a href="{{ route('groups.show',$group->id) }}"><strong>{{ $group->name }}</strong></a></td>
						<td><x-tenant.list.my-boolean :value="$group->enable"/></td>
						<td>
							<a href="{{ route('groups.show',$group->id) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
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


@endsection

