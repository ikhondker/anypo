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
			<x-tenant.buttons.header.lists object="Budget"/>

			<x-tenant.actions.budget-actions id="{{ $budget->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('budgets.update',$budget->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('budgets.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>  View all</a>
				</div>
				<h5 class="card-title">Edit Budget Detail</h5>
							<h6 class="card-subtitle text-muted">Note: To edit budget amount, edit the Department budget. It will be automatically reflected in company budget.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>FY <x-tenant.info info="Note: You wont be able to change the Fiscal Year (FY)."/></th>
							<td>
								<input type="text" name="fy" id="fy" class="form-control" placeholder="ID" value="{{ $budget->fy }}" readonly>
							</td>
						</tr>
						
						
						<tr>
							<th>Budget Name</th>
							<td>
								<input type="text" class="form-control @error('name') is-invalid @enderror"
								name="name" id="name" placeholder="Budget Name"
								value="{{ old('name', $budget->name ) }}"
								/>
							@error('name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						
						

						<x-tenant.edit.notes value="{{ $budget->notes }}"/>

						<x-tenant.attachment.create/>

						<x-tenant.buttons.show.save/>
					</tbody>
				</table>
			</div>
		</div>


					

					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Attachments</h5>
							<h6 class="card-subtitle text-muted">List of document attached with this budget.</h6>
						</div>
						<div class="card-body">
							<table class="table table-sm my-2">
								<tbody>

									<tr>
										<th>Attachments</th>
										<td><x-tenant.attachment.all entity="BUDGET" aid="{{ $budget->id }}"/></td>
									</tr>
									<tr>
										<th></th>
										<td>
											@if (! $budget->closed)
												<form action="{{ route('budgets.attach') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
													@csrf
													{{-- <x-tenant.attachment.create /> --}}
													<input type="text" name="attach_budget_id" id="attach_budget_id" class="form-control" placeholder="ID" value="{{ old('id', $budget->id ) }}" hidden>
													<div class="row">
														<div class="col-sm-3 text-end">

														</div>
														<div class="col-sm-9 text-end">
															<input type="file" id="file_to_upload" name="file_to_upload" onchange="mySubmit()" style="display:none;" />
															<a href="" class="text-warning d-inline-block" onclick="document.getElementById('file_to_upload').click(); return false">Add Attachment</a>
														</div>
													</div>
												</form>
												<!-- /.form end -->
											@endif
										</td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>

	</form>
	<!-- /.form end -->


@endsection

