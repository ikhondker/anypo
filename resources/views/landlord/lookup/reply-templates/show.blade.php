@extends('layouts.landlord.app')
@section('title','Reply Templates')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('reply-templates.index') }}" class="text-muted">Reply Templates</a></li>
	<li class="breadcrumb-item active">{{ $replyTemplate->name }}</li>
@endsection


@section('content')

	<h1 class="h3 mb-3">View Reply Templates</h1>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="{{ route('reply-templates.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
						@if (auth()->user()->isSystem())
						<a class="btn btn-sm btn-danger text-white" href="{{ route('reply-templates.edit', $replyTemplate->id) }}"><i class="fas fa-edit"></i> Edit</a>

						@endif
					</div>
					<h5 class="card-title">View Reply Templates</h5>
					<h6 class="card-subtitle text-muted">View details of a replyTemplate.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-landlord.show.my-text	value="{{ $replyTemplate->name }}" label="Reply Templates"/>
							<x-landlord.show.my-enable	value="{{ $replyTemplate->enable }}"/>
							<x-landlord.show.my-badge	value="{{ $replyTemplate->id }}" label="ID"/>
							<x-landlord.show.my-date	value="{{ $replyTemplate->created_at }}" label="Created At"/>
							<x-landlord.show.my-content	value="{{ $replyTemplate->notes }}" label="Message"/>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


@endsection


