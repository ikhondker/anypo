@extends('layouts.landlord.app')
@section('title','Users')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('comments.index') }}" class="text-muted">Comment</a></li>
	<li class="breadcrumb-item active">{{ $comment->id }}</li>
@endsection


@section('content')

	<h1 class="h3 mb-3">View Comment</h1>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="{{ route('comments.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
						@if (auth()->user()->isSystem())
							<a class="btn btn-sm btn-danger text-white" href="{{ route('comments.edit', $comment->id) }}"><i class="fas fa-edit"></i> Edit</a>
						@endif
					</div>
					<h5 class="card-title">View Comment</h5>
					<h6 class="card-subtitle text-muted">View details of a comment.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-landlord.show.my-badge	value="{{ $comment->id }}" label="ID"/>
							<x-landlord.show.my-content	value="{{ $comment->content }}" label="Comment"/>
							<x-landlord.show.my-enable	value="{{ $comment->is_internal }}"  label="Internal?"/>
							<x-landlord.show.my-text	value="{{ $comment->owner->name  }}" label="Comment By:"/>
							<x-landlord.show.my-date	value="{{ $comment->comment_date }}" label="Date:"/>
							<x-landlord.show.my-text	value="{{ $comment->ticket->title  }}" label="Ticket:"/>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


@endsection


