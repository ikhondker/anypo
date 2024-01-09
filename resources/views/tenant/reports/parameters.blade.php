@extends('layouts.app')
@section('title','Report Parameter')
@section('breadcrumb','Report Parameter')

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
	<form id="myform" action="{{ route('reports.update', $report->id) }}" method="POST">
		@csrf
		@method('PUT')

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title"> {{ $report->name }}</h5>
						<h6 class="card-subtitle text-muted">Please enter reports parameter and clink on run.</h6>
					</div>
					<div class="card-body">
							{{-- <input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id',$report->id ) }}"> --}}

							<div class="mb-3 row">
								<label class="col-form-label col-sm-2 text-sm-right">Start Date </label>
								<div class="col-sm-10">
										<input type="date" class="form-control @error('start_date') is-invalid @enderror"
											name="start_date" id="start_date" placeholder=""
											value="{{ old('start_date', date('Y-m-d') ) }}"
											required/>
										@error('start_date')
											<div class="text-danger text-xs">{{ $message }}</div>
										@enderror
								</div>
							</div>

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
							<fieldset class="mb-3">
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
							</div>

							<div class="mb-3 row">
								<label class="col-form-label col-sm-2 text-sm-right pt-sm-0">&nbsp;</label>
								<div class="col-sm-10 ml-sm-auto">
									<a class="btn btn-secondary" href="{{ url()->previous() }}"><i data-feather="x-circle"></i> Cancel</a>
									<button type="submit" id="submit" name="submit" class="btn btn-primary"><i data-feather="printer"></i> Run</button>
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

@endsection