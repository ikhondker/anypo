@extends('layouts.app')
@section('title','Edit Dbu')
@section('breadcrumb','Edit Dbu')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Dbu
		@endslot
		@slot('buttons')
		<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="Dbu"/>
			<x-tenant.buttons.header.create object="Dbu"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('dbus.update',$dbu->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Dbu Info</h5>
						</div>
						<div class="card-body">

							<x-tenant.edit.id-read-only :value="$dbu->id"/>

							<div class="mb-3">
								<label class="form-label">FY</label>
								<input type="text" name="budget_fy" id="budget_fy" class="form-control" placeholder="" value="{{ $dbu->deptBudget->budget->fy }}" readonly>
							</div>
							<div class="mb-3">
								<label class="form-label">Budget</label>
								<input type="text" name="budget_name" id="budget_name" class="form-control" placeholder="" value="{{ $dbu->deptBudget->budget->name  }}" readonly>
							</div>
							<div class="mb-3">
								<label class="form-label">Dept</label>
								<input type="text" name="dept_name" id="dept_name" class="form-control" placeholder="" value="{{ $dbu->dept->name }}" readonly>
							</div>

							<div class="mb-3">
								<label class="form-label">Amount PR Booked ({{ $_setup->currency }})</label>
								<input type="number" class="form-control @error('amount_pr_booked') is-invalid @enderror"
									name="amount_pr_booked" id="amount_pr_booked" placeholder="99,999.99"
									value="{{ old('amount_pr_booked', $dbu->amount_pr_booked ) }}"
									step='0.01' min="0" required/>
								@error('amount_pr_booked')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>


							<x-tenant.edit.notes value="{{ $dbu->notes }}"/>

							<x-tenant.attachment.create/>
							
							<x-tenant.buttons.show.save/>
							
						</div>
					</div>
				</div>
				<!-- end col-6 -->

				<div class="col-6">
					<div class="card">
						
					</div>
				</div>
				<!-- end col-6 -->
			</div>

			
	</form>
	<!-- /.form end -->
@endsection

