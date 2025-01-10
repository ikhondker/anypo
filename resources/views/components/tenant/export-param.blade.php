	<!-- form start -->
	<form id="myform" action="{{ route('exports.run', $export->entity) }}" method="POST">
		@csrf
		@method('PUT')

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title"> {{ $export->name }}</h5>
						<h6 class="card-subtitle text-muted">Please enter exports parameter and click on 'Export Data'.</h6>
					</div>
					<div class="card-body">
							{{-- <input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id',$export->id ) }}"> --}}
							<input type="text" name="entity" id="entity" class="form-control" placeholder="entity" value="{{ old('entity', $entity ) }}" hidden>
							@if ($export->article_id_required)
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">{{ $export->entity }} ID :</label>
									<div class="col-sm-10">
											<input type="text" class="form-control @error('article_id') is-invalid @enderror"
												name="article_id" id="article_id" placeholder=""
												value="{{ old('article_id', '0000' ) }}"
												required/>
											@error('article_id')
												<div class="small text-danger">{{ $message }}</div>
											@enderror
									</div>
								</div>
							@endif

							@if ($export->start_date)
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">Start Date </label>
									<div class="col-sm-10">
											<input type="date" class="datepicker form-control @error('start_date') is-invalid @enderror"
												name="start_date" id="start_date" placeholder=""
												value="{{ old('start_date', date('Y-m-01') ) }}"
												required/>
											@error('start_date')
												<div class="small text-danger">{{ $message }}</div>
											@enderror
									</div>
								</div>
							@endif
							@if ($export->end_date)
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">End Date </label>
									<div class="col-sm-10">
										<input type="date" class="form-control @error('end_date') is-invalid @enderror"
											name="end_date" id="end_date" placeholder=""
											value="{{ old('end_date', date('Y-m-d') ) }}"
											required/>
										@error('end_date')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>
							@endif

							@if ($export->currency)
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">Currency</label>
									<div class="col-sm-10">
										<select class="form-control" name="currency">
											<option value=""><< Currency >> </option>
											@foreach ($currencies as $currency)
												<option value="{{ $currency->currency }}" {{ $currency->currency == old('currency') ? 'selected' : '' }} >{{ $currency->currency }}</option>
											@endforeach
										</select>
										@error('dept_id')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>
							@endif

							@if ($export->dept_id)
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">Department</label>
									<div class="col-sm-10">
										<select class="form-control" name="dept_id" {{ $export->dept_id_required ? "required" : "" }}>
											<option value=""><< Department >> </option>
											@foreach ($depts as $dept)
												<option value="{{ $dept->id }}" {{ $dept->id == old('dept_id') ? 'selected' : '' }} >{{ $dept->name }}</option>
											@endforeach
										</select>
										@error('dept_id')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>
							@endif
							@if ($export->supplier_id)
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">Supplier</label>
									<div class="col-sm-10">
										<select class="form-control" name="supplier_id" {{ $export->supplier_id_required ? "required" : "" }}>
											<option value=""><< Supplier >> </option>
											@foreach ($suppliers as $supplier)
												<option value="{{ $supplier->id }}" {{ $supplier->id == old('supplier_id') ? 'selected' : '' }} >{{ $supplier->name }}</option>
											@endforeach
										</select>
										@error('supplier_id')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>
							@endif
							@if ($export->project_id)
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">Project</label>
									<div class="col-sm-10">
										<select class="form-control" name="project_id" {{ $export->project_id_required ? "required" : "" }}>
											<option value=""><< Project >> </option>
											@foreach ($projects as $project)
												<option value="{{ $project->id }}" {{ $project->id == old('project_id') ? 'selected' : '' }} >{{ $project->name }}</option>
											@endforeach
										</select>
										@error('project_id')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>
							@endif
							@if ($export->warehouse_id)
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">Warehouse</label>
									<div class="col-sm-10">
										<select class="form-control" name="warehouse_id" {{ $export->warehouse_id_required ? "required" : "" }}>
											<option value=""><< Warehouse >> </option>
											@foreach ($warehouses as $warehouse)
												<option value="{{ $warehouse->id }}" {{ $warehouse->id == old('warehouse_id') ? 'selected' : '' }} >{{ $warehouse->name }}</option>
											@endforeach
										</select>
										@error('warehouse_id')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>
							@endif
							@if ($export->bank_account_id)
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">Bank Account</label>
									<div class="col-sm-10">
										<select class="form-control" name="bank_account_id" {{ $export->bank_account_id_required ? "required" : "" }}>
											<option value=""><< Bank Account >> </option>
											@foreach ($bank_accounts as $bank_account)
												<option value="{{ $bank_account->id }}" {{ $bank_account->id == old('bank_account_id') ? 'selected' : '' }} >{{ $bank_account->name }}</option>
											@endforeach
										</select>
										@error('bank_account_id')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>
							@endif

							@if ($export->user_id)
								<div class="mb-3 row">
									<label class="col-form-label col-sm-2 text-sm-right">User </label>
									<div class="col-sm-10">
										<select class="form-control" name="user_id" {{ $export->user_id_required ? "required" : "" }}>
											<option value=""><< User >> </option>
											@foreach ($users as $user)
												<option value="{{ $user->id }}" {{ $user->id == old('user_id') ? 'selected' : '' }} >{{ $user->name }}</option>
											@endforeach
										</select>
										@error('user_id')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>
							@endif

							<div class="mb-3 row">
								<label class="col-form-label col-sm-2 text-sm-right pt-sm-0">&nbsp;</label>
								<div class="col-sm-10 ml-sm-auto">
									<a class="btn btn-secondary" href="{{ url()->previous() }}"><i data-lucide="x-circle"></i> Cancel</a>
									<button type="submit" id="submit" name="submit" class="btn btn-primary"><i data-lucide="printer"></i> Export Data</button>
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
