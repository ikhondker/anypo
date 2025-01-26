@extends('layouts.landlord.app')
@section('title','Topic')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('topics.index') }}" class="text-muted">Topic</a></li>
	<li class="breadcrumb-item active">{{ $topic->name }}</li>
@endsection


@section('content')

	<h1 class="h3 mb-3">View Topic</h1>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="{{ route('topics.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a>
						@if (auth()->user()->isSys())
							<a class="btn btn-sm btn-danger text-white" href="{{ route('topics.edit', $topic->id) }}"><i data-lucide="edit"></i> Edit</a>
						@endif
					</div>
					<h5 class="card-title">View Topic</h5>
					<h6 class="card-subtitle text-muted">View details of a topic.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-landlord.show.my-text	value="{{ $topic->name }}" label="Topic"/>
							<x-landlord.show.my-enable	value="{{ $topic->enable }}"/>
							<x-landlord.show.my-badge	value="{{ $topic->id }}" label="ID"/>
							<x-landlord.show.my-date	value="{{ $topic->created_at }}" label="Created At:"/>
							<x-landlord.show.my-content	value="{{ $topic->notes }}" label="Notes"/>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


@endsection


