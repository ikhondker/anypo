@extends('layouts.tenant.app')
@section('title','Edit Budget')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('budgets.index') }}" class="text-muted">Budgets</a></li>
	<li class="breadcrumb-item"><a href="{{ route('budgets.show',$budget->id) }}" class="text-muted">{{ $budget->name }}</a></li>
	<li class="breadcrumb-item active"> Edit</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Budget
		@endslot
		@slot('buttons')
			<x-tenant.actions.budget-actions budgetId="{{ $budget->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('budgets.update',$budget->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('budgets.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a>
				</div>
				<h5 class="card-title">Edit Budget Detail</h5>
				<h6 class="card-subtitle text-muted">Note: To edit budget amount, edit the Department budget. It will be automatically reflected in company budget.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>FY :<x-tenant.info info="Note: You wont be able to change the Fiscal Year (FY)."/></th>
							<td>
								<input type="text" name="fy" id="fy" class="form-control" placeholder="YYYY" value="{{ $budget->fy }}" readonly>
							</td>
						</tr>
						<tr>
							<th>Budget Name :</th>
							<td>
								<input type="text" class="form-control @error('name') is-invalid @enderror"
								name="name" id="name" placeholder="Budget Name"
								value="{{ old('name', $budget->name ) }}"
								/>
							@error('name')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<tr>
							<th>Amount {{ $_setup->currency }} : <x-tenant.info info="Note: You wont be able to edit. Auto calculated based on dept budgets."/></th>
							<td>
								<input type="text" name="amount" id="amount" class="form-control" placeholder="1.0" value="{{ $budget->amount }}" readonly>
							</td>
						</tr>
						<x-tenant.edit.notes value="{{ $budget->notes }}"/>
						<x-tenant.attachment.create/>
						<x-tenant.edit.save/>
					</tbody>
				</table>
			</div>
		</div>

	</form>
	<!-- /.form end -->

@endsection

