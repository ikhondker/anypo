@extends('layouts.landlord.app')
@section('title','View Unhandled Error Log')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('error-logs.index') }}" class="text-muted">Error Logs</a></li>
	<li class="breadcrumb-item active">{{ $errorLog->id }}</li>
@endsection

@section('content')

	<a href="{{ route('error-logs.index') }}" class="btn btn-primary float-end mt-n1"><i data-lucide="database"></i> View all</a>
	<h1 class="h3 mb-3">View Unhandled Error Log</h1>

			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="{{ route('error-logs.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i>View all</a>
						@if (auth()->user()->isSystem())
						<a class="btn btn-sm btn-danger text-white" href="{{ route('error-logs.edit', $errorLog->id) }}"><i data-lucide="edit"></i> Edit</a>
						@endif
					</div>
					<h5 class="card-title">View Unhandled Error Log</h5>
					<h6 class="card-subtitle text-muted">View Unhandled Error Log Details.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-landlord.show.my-badge		value="{{ $errorLog->id }}" label="ID"/>
							<x-landlord.show.my-text		value="{{ $errorLog->tenant }}" label="Tenant"/>
							<x-landlord.show.my-url			value="{{ $errorLog->url }}"/>
							<x-landlord.show.my-text		value="{{ $errorLog->e_class }}" label="Class"/>
							<x-landlord.show.my-text		value="{{ $errorLog->user_id }}" label="User ID"/>
							<x-landlord.show.my-text		value="{{ $errorLog->role }}" label="Role"/>
							<x-landlord.show.my-date-time	value="{{ $errorLog->created_at }}" label="Created At:"/>
							<x-landlord.show.my-content		value="{{ $errorLog->message }}" label="Message"/>
						</tbody>
					</table>
				</div>
			</div>


@endsection
