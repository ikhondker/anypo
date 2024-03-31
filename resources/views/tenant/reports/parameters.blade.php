@extends('layouts.app')
@section('title','Report Parameter')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('reports.index') }}">Reports</a></li>
	<li class="breadcrumb-item active">{{ $report->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Report Parameter
		@endslot
		@slot('buttons')
			<a href="{{ route('reports.index') }}" class="btn btn-primary float-end me-2"><i data-feather="list"></i> Reports List</a>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('reports.run', $report->id) }}" method="POST">
		@csrf
		@method('PUT')

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title"> {{ $report->name }}</h5>
						<h6 class="card-subtitle text-muted">Please enter reports parameter and click on 'Run Report'.</h6>
					</div>
					<div class="card-body">
							{{-- <input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id',$report->id ) }}"> --}}

							@if ($report->start_date)
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">Start Date </label>
									<div class="col-sm-10">
											<input type="date" class="datepicker form-control @error('start_date') is-invalid @enderror"
												name="start_date" id="start_date" placeholder=""
												value="{{ old('start_date', date('Y-m-01') ) }}"
												required/>
											@error('start_date')
												<div class="text-danger text-xs">{{ $message }}</div>
											@enderror
									</div>
								</div>
							@endif
							@if ($report->end_date)
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">End Date </label>
									<div class="col-sm-10">
										<input type="date" class="form-control @error('end_date') is-invalid @enderror"
											name="end_date" id="end_date" placeholder=""
											value="{{ old('end_date', date('Y-m-d') ) }}"
											required/>
										@error('end_date')
											<div class="text-danger text-xs">{{ $message }}</div>
										@enderror
									</div>
								</div>
							@endif
							@if ($report->dept_id)
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">Department</label>
									<div class="col-sm-10">
										<select class="form-control" name="dept_id" {{ $report->dept_id_required ? "required" : "" }}>
											<option value=""><< Department >> </option>
											@foreach ($depts as $dept)
												<option value="{{ $dept->id }}" {{ $dept->id == old('pm_id') ? 'selected' : '' }} >{{ $dept->name }} </option>
											@endforeach
										</select>
										@error('dept_id')
											<div class="text-danger text-xs">{{ $message }}</div>
										@enderror
									</div>
								</div>
							@endif
							@if ($report->supplier_id)
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">Supplier</label>
									<div class="col-sm-10">
										<select class="form-control" name="supplier_id" required>
											<option value=""><< Supplier >> </option>
											@foreach ($suppliers as $supplier)
												<option value="{{ $supplier->id }}" {{ $supplier->id == old('pm_id') ? 'selected' : '' }} >{{ $supplier->name }} </option>
											@endforeach
										</select>
										@error('supplier_id')
											<div class="text-danger text-xs">{{ $message }}</div>
										@enderror
									</div>
								</div>
							@endif
							@if ($report->project_id)
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">Project</label>
									<div class="col-sm-10">
										<select class="form-control" name="project_id" required>
											<option value=""><< Project >> </option>
											@foreach ($projects as $project)
												<option value="{{ $project->id }}" {{ $project->id == old('pm_id') ? 'selected' : '' }} >{{ $project->name }} </option>
											@endforeach
										</select>
										@error('project_id')
											<div class="text-danger text-xs">{{ $message }}</div>
										@enderror
									</div>
								</div>
							@endif
							@if ($report->warehouse_id)
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">Warehouse</label>
									<div class="col-sm-10">
										<select class="form-control" name="warehouse_id" required>
											<option value=""><< Warehouse >> </option>
											@foreach ($warehouses as $warehouse)
												<option value="{{ $warehouse->id }}" {{ $warehouse->id == old('pm_id') ? 'selected' : '' }} >{{ $warehouse->name }} </option>
											@endforeach
										</select>
										@error('warehouse_id')
											<div class="text-danger text-xs">{{ $message }}</div>
										@enderror
									</div>
								</div>
							@endif
							@if ($report->bank_account_id)
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">Bank Account</label>
									<div class="col-sm-10">
										<select class="form-control" name="bank_account_id" required>
											<option value=""><< Bank Account >> </option>
											@foreach ($bank_accounts as $bank_account)
												<option value="{{ $bank_account->id }}" {{ $bank_account->id == old('pm_id') ? 'selected' : '' }} >{{ $bank_account->name }} </option>
											@endforeach
										</select>
										@error('bank_account_id')
											<div class="text-danger text-xs">{{ $message }}</div>
										@enderror
									</div>
								</div>
							@endif

							@if ($report->pm_id)
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">Project Manager </label>
									<div class="col-sm-10">
										<select class="form-control" name="pm_id" required>
											<option value=""><< Project Manager >> </option>
											@foreach ($pms as $user)
												<option value="{{ $user->id }}" {{ $user->id == old('pm_id') ? 'selected' : '' }} >{{ $user->name }} </option>
											@endforeach
										</select>
										@error('pm_id')
											<div class="text-danger text-xs">{{ $message }}</div>
										@enderror
									</div>
								</div>
							@endif

							{{-- <fieldset class="mb-3">
								<div class="row">
									<label class="col-form-label col-sm-2 text-sm-right pt-sm-0">Radios</label>
									<div class="col-sm-10">
										<label class="form-check">
											<input name="radio-3" type="radio" class="form-check-input" checked>
											<span class="form-check-label">Default radio</span>
										</label>
										<label class="form-check">
											<input name="radio-3" type="radio" class="form-check-input">
											<span class="form-check-label">Second default radio</span>
										</label>
									</div>
								</div>
							</fieldset>

							<div class="mb-3 row">
								<label class="col-form-label col-sm-2 text-sm-right pt-sm-0">Checkbox</label>
								<div class="col-sm-10">
									<label class="form-check m-0">
										<input type="checkbox" class="form-check-input">
										<span class="form-check-label">Check me out</span>
									</label>
								</div>
							</div> --}}

							<div class="mb-3 row">
								<label class="col-form-label col-sm-2 text-sm-right pt-sm-0">&nbsp;</label>
								<div class="col-sm-10 ml-sm-auto">
									<a class="btn btn-secondary" href="{{ url()->previous() }}"><i data-feather="x-circle"></i> Cancel</a>
									<button type="submit" id="submit" name="submit" class="btn btn-primary"><i data-feather="printer"></i> Run Report</button>
								</div>
							</div>
					</div>
				</div>
			</div>
			<!-- end col-6 -->

			<div class="col-6">

			</div>
			<!-- end col-6 -->

		</div>
		<!-- end row -->

	</form>
	<!-- /.form end -->
	
	
	{{-- <script type="module">
		$( "#datepicker" ).datepicker();
	</script> --}}

		
	{{-- <script type="module">  
		$('.date').datepicker({    
		format: dd-mm-yyyy'  
		});    
	</script>    --}}

	{{-- <script type="module">
		$(function() {
		   $('#datetimepicker').datetimepicker();
		});
	</script>   --}}

	{{-- <script type="module">
		$( function() {
			$(".datepicker" ).datepicker();
		});
	</script> --}}


@endsection