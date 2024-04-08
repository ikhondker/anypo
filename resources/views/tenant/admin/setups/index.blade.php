@extends('layouts.app')
@section('title','Setup')
@section('breadcrumb')
	<li class="breadcrumb-item active">Setup</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Setup
		@endslot
		@slot('buttons')
			
		@endslot
	</x-tenant.page-header>
	
	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Setup Information of : {{ $_setup->name }}</h5>
					<h6 class="card-subtitle text-muted">Configuration Information of current application.</h6>
				</div>

				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>Lead</th>
								<th>Address</th>
								<th>Currency</th>
								<th>Email</th>
								<th>Website</th>
								<th>Primary Admin</th>
								<th>Announcement?</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($setups as $setup)
							<tr>
								<td>
									{{-- @if ( $setup->logo == "")
										<img src="{{ asset('/logo/logo.png')}}" class="avatar img-fluid rounded-circle me-1" alt="{{ $setup->name }}"/>
									@else
										<img src="/logo/{{ $setup->logo }}" class="avatar img-fluid rounded-circle me-1" alt="{{ $setup->name }}"/>
									@endif --}}
									<img src="{{ Storage::disk('s3t')->url('logo/'.$setup->logo) }}" class="avatar img-fluid rounded-circle me-1" alt="{{ $setup->name }}"/>
									<a class="text-info" href="{{ route('setups.show',$setup->id) }}">{{ $setup->name }}</a>

								</td>
								<td>{{ $setup->address1 }}</td>
								<td>{{ $setup->currency }}</td>
								<td>{{ $setup->email }}</td>
								<td>{{ $setup->website }}</td>
								<td>{{ $setup->admin_user->name }}</td>
								<td><x-tenant.list.my-boolean :value="$setup->show_notice"/></td>
								<td class="table-action"><x-tenant.list.actions object="Setup" :id="$setup->id"/></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<!-- end card-body -->
			</div>
			<!-- end card -->

		</div>
		 <!-- end col -->
	</div>
	 <!-- end row -->

	

@endsection

