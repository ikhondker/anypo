@extends('layouts.app')
@section('title','Edit Report')
@section('breadcrumb','Edit Report')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Item Report
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Report"/>
			<x-tenant.buttons.header.create object="Report"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('reports.update',$report->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Edit Report</h5>
							<h6 class="card-subtitle text-muted">Edit an Item Report.</h6>
						</div>
						<div class="card-body">
							'entity', 'name', 'summary', 'access', 'article_id', 'article_id_required',
							 'start_date', 'start_date_required', 'end_date', 'end_date_required', 
							'user_id', 'user_id_required', 'item_id', 'item_id_required', 
							'supplier_id', 'supplier_id_required',
							 'project_id', 'project_id_required', 
							 'category_id', 'category_id_required', 
							 'dept_id', 'dept_id_required', 
							 'warehouse_id', 'warehouse_id_required', 
							 'order_by', 'enable', 'updated_by', 'updated_at',

							<x-tenant.edit.name :value="$report->name"/>
							<x-tenant.edit.name :value="$report->summary"/>

							<div class="mb-3">
								<label class="form-check m-0">
								<input type="checkbox" class="form-check-input"
									name="banner_show" id="banner_show"  @checked($report->start_date)/>
								<span class="form-check-label">start_date?</span>
								</label>
							</div>

							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="start_date" name="start_date" @checked($report->start_date)>
								<label class="form-check-label" for="start_date">start_date</label>
							</div>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="start_date_required" name="start_date_required" @checked($report->start_date_required)>
								<label class="form-check-label" for="start_date_required">start_date_required</label>
							</div>

							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="end_date" name="end_date" @checked($report->end_date)>
								<label class="form-check-label" for="start_date">end_date</label>
							</div>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="end_date_required" name="end_date_required" @checked($report->end_date_required)>
								<label class="form-check-label" for="end_date_required">end_date_required</label>
							</div>

							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="user_id_required" name="user_id_required" @checked($report->user_id_required)>
								<label class="form-check-label" for="end_date_required">user_id_required</label>
							</div>
						
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

