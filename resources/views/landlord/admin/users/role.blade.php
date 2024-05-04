@extends('layouts.app')
@section('title','Users Role')
@section('breadcrumb','User Role')

@section('content')
	<div class="card col-10">
		<x-landlord.card.header object="User"/>
		<!-- card-body -->
		<div class="card-body pt-3">
			<div class="table-responsive pt-1">
				<table class="table table-no-space table-bordered table-striped">
					<thead>
						<tr>
							<th class="" scope="col">#</th>
							<th class="" scope="col">Name</th>
							<th class="" scope="col">email</th>
							<th class="" scope="col">Cell</th>
							<th class="" scope="col">Role</th>
							<th class="" scope="col">Emp</th>
							<th class="text-center" scope="col">Enable</th>
							<th class="text-center" scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
						<tr>
							<td class="">{{ $user->id }}</td>
							<td class=""><a class="text-info" href="{{ route('users.show',$user->id) }}">{{ $user->name }}</a></td>
							<td class="">{{ $user->email }}</td>
							<td class="">{{ $user->cell }}</td>
							<td class="">
								@if ( $user->role == UserRoleEnum::USER->value)
									<span class="badge badge-light-success">{{ $user->role }}</span>
								@else
									<span class="badge badge-light-error">{{ $user->role }}</span>
								@endif
							</td>
							<td class="">{{ $user->emp->name }}</td>
							<td class="text-center"><x-list.enable :enable="$user->enable"/></td>
							<td class="text-center">
								<a class="btn btn-outline-primary btn-sm mb-2 me-4" href="{{ route('users.updaterole',['user'=>Auth::user()->id,'role'=>'emp']) }}"> Emp</a>
								<a class="btn btn-outline-primary btn-sm mb-2 me-4" href="{{ route('users.updaterole',['user'=>Auth::user()->id,'role'=>'hr']) }}">HR</a>
								<a class="btn btn-outline-primary btn-sm mb-2 me-4" href="{{ route('users.updaterole',['user'=>Auth::user()->id,'role'=>'finance']) }}">Finance</a>
								<a class="btn btn-outline-primary btn-sm mb-2 me-4" href="{{ route('users.updaterole',['user'=>Auth::user()->id,'role'=>'admin']) }}">Admin</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<!-- /.card-body -->

		<x-card.footer-page object="User" links="{{ $users->links() }}" />

	</div>
	
@endsection