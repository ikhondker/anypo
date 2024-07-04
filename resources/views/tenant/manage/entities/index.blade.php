@extends('layouts.tenant.app')
@section('title','Entity List')
@section('breadcrumb')
	<li class="breadcrumb-item active">Entities</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Entity List
		@endslot
		@slot('buttons')

		@endslot
	</x-tenant.page-header>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Entity List</h5>
            <h6 class="card-subtitle text-muted">List of Entities.</h6>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Entity</th>
                        <th>Name</th>
                        <th>Model</th>
                        <th>Route</th>
                        <th>Directory</th>
                        <th>Notification</th>
                        <th>Enable?</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entities as $entity)
                    <tr>
                        <td>{{ $entity->entity }}</td>
                        <td>{{ $entity->name }}</td>
                        <td>{{ $entity->model }}</td>
                        <td>{{ $entity->route }}</td>
                        <td>{{ $entity->directory }}</td>
                        <td><x-tenant.list.my-boolean :value="$entity->notification"/></td>
                        <td><x-tenant.list.my-boolean :value="$entity->enable"/></td>
                        <td class="table-action">
                            <a href="{{ route('entities.destroy',$entity->entity) }}" class="me-2 sw2-advance"
                                data-entity="Entity" data-name="{{ $entity->name }}" data-status="{{ ($entity->enable ? 'Disable' : 'Enable') }}"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($entity->enable ? 'Disable' : 'Enable') }}">
                                <i class="align-middle text-muted" data-lucide="{{ ($entity->enable ? 'bell-off' : 'bell') }}"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
        <!-- end card-body -->
    </div>
    <!-- end card -->




@endsection

