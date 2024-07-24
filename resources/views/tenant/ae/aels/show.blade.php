@extends('layouts.tenant.app')
@section('title','View Accounting')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('aels.index') }}" class="text-muted">Accounting</a></li>
	<li class="breadcrumb-item active">{{ $ael->id }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Accounting
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Ael"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Accounting Detail</h5>
					<h6 class="card-subtitle text-muted">Details of an Accounting Entry Line.</h6>
				</div>

				<div class="card-body">

					<table class="table table-sm my-2">
						<tbody>
							<tr>
								<th>Header#</th>
								<td>
									<a href="{{ route('aehs.show',$ael->aeh_id) }}" class="text-muted"><strong>{{ $ael->aeh_id }}</strong></a>
								</td>
							</tr>
							<x-tenant.show.my-text		value="{{ $ael->id }}" label="Line#"/>
							<x-tenant.show.my-date		value="{{ $ael->accounting_date }}"/>
							<x-tenant.show.my-text		value="{{ $ael->ac_code }}" label="AC Code"/>
							<x-tenant.show.my-text		value="{{ $ael->line_description }}" label="Line Description"/>
							<x-tenant.show.my-text		value="{{ $ael->fc_currency }}" label="Currency"/>
							<x-tenant.show.my-number	value="{{ $ael->fc_dr_amount }}" label="Dr"/>
							<x-tenant.show.my-number	value="{{ $ael->fc_cr_amount }}" label="Cr"/>
							<x-tenant.show.my-created-at value="{{ $ael->updated_at }}"/>
							<x-tenant.show.my-updated-at value="{{ $ael->created_at }}"/>
							@if (auth()->user()->isSystem())
								<tr>
									<th></th>
									<td>
										<a href="{{ route('aels.edit',$ael->id) }}" class="text-warning d-inline-block">Edit</a>
									</td>
								</tr>
							@endif

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
		<div class="col-6">
			
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->
@endsection

