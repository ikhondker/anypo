@extends('layouts.tenant.app')
@section('title','Edit Currency')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('currencies.index') }}" class="text-muted">Currencies</a></li>
	<li class="breadcrumb-item"><a href="{{ route('currencies.show',$currency->currency) }}" class="text-muted">{{ $currency->name }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Currency
		@endslot
		@slot('buttons')

		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('currencies.update',$currency->currency) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')


		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('currencies.create') }}" class="btn btn-sm btn-light"><i data-lucide="plus"></i> Create</a>
					<a href="{{ route('currencies.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Currency Edit</h5>
				<h6 class="card-subtitle text-muted">Edit a currency.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Code:</th>
							<td>
								<input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('currency', $currency->currency ) }}" readonly>
							</td>
						</tr>
						<x-tenant.edit.name :value="$currency->name"/>
							<x-tenant.edit.save/>
					</tbody>
				</table>
			</div>
		</div>

	</form>
	<!-- /.form end -->
@endsection

