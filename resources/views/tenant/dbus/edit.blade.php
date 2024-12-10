@extends('layouts.tenant.app')
@section('title','Edit Dbu')
@section('breadcrumb','Edit Dbu')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Dbu
		@endslot
		@slot('buttons')

		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('dbus.update',$dbu->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('dbus.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a>
				</div>
				<h5 class="card-title">Edit DBU</h5>
				<h6 class="card-subtitle text-muted">Edit a DBU</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>


						<x-tenant.edit.id-read-only :value="$dbu->id"/>

							<tr>
								<th>FY</th>
								<td>
									<input type="text" name="budget_fy" id="budget_fy" class="form-control" placeholder="" value="{{ $dbu->deptBudget->budget->fy }}" readonly>
								</td>
							</tr>

							<tr>
								<th>Budget</th>
								<td>
									<input type="text" name="budget_name" id="budget_name" class="form-control" placeholder="" value="{{ $dbu->deptBudget->budget->name }}" readonly>
								</td>
							</tr>

							<tr>
								<th>Dept</th>
								<td>
									<input type="text" name="dept_name" id="dept_name" class="form-control" placeholder="" value="{{ $dbu->dept->name }}" readonly>
								</td>
							</tr>

							<tr>
								<th>Amount PR Booked ({{ $_setup->currency }})</th>
								<td>
									<input type="number" class="form-control @error('amount_pr_booked') is-invalid @enderror"
									name="amount_pr_booked" id="amount_pr_booked" placeholder="99,999.99"
									value="{{ old('amount_pr_booked', $dbu->amount_pr_booked ) }}"
									step='0.01' min="0" required/>
								@error('amount_pr_booked')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
								</td>
							</tr>


							<x-tenant.edit.notes value="{{ $dbu->notes }}"/>

							<x-tenant.attachment.create/>

							<x-tenant.edit.save/>
					</tbody>
				</table>
			</div>
		</div>

	</form>
	<!-- /.form end -->
@endsection

