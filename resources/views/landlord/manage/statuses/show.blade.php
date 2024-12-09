@extends('layouts.landlord.app')
@section('title','Statuses')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('statuses.index') }}" class="text-muted">Statues</a></li>
	<li class="breadcrumb-item active">{{ $status->name }}</li>
@endsection

@section('content')

	<h1 class="h3 mb-3">View Statuses</h1>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="{{ route('statuses.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>View all</a>
						@if (auth()->user()->isSystem())
						<a class="btn btn-sm btn-danger text-white" href="{{ route('statuses.edit', $status->code) }}"><i data-lucide="edit"></i> Edit</a>

						@endif
					</div>
					<h5 class="card-title">View Statuses</h5>
					<h6 class="card-subtitle text-muted">View Statuses Detail.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-landlord.show.my-badge	value="{{ $status->code }}" label="Code"/>
								<x-landlord.show.my-text	value="{{ $status->name }}"/>
								<x-landlord.show.my-badge	value="{{ $status->badge }}" label="Badge"/>

								<x-landlord.show.my-enable	value="{{ $status->accounts }}" label="Accounts"/>
								<x-landlord.show.my-enable	value="{{ $status->accounts }}" label="Services"/>
								<x-landlord.show.my-enable	value="{{ $status->tickets }}" label="Tickets"/>
								<x-landlord.show.my-enable	value="{{ $status->checkouts }}" label="Checkouts"/>
								<x-landlord.show.my-enable	value="{{ $status->invoices }}" label="Invoices"/>
								<x-landlord.show.my-enable	value="{{ $status->payments }}" label="Payments"/>
								<x-landlord.show.my-enable	value="{{ $status->enable }}"/>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


@endsection

