@extends('layouts.tenant.app')
@section('title','Edit Report')
@section('breadcrumb','Edit Report')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Report
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
							<h5 class="card-title">Edit Report {{ "#".$report->id." ". $report->name }}</h5>
							<h6 class="card-subtitle text-muted">Edit Report Settings.</h6>
						</div>
						<div class="card-body">

							<x-tenant.edit.name :value="$report->name"/>
							<x-tenant.edit.summary :value="$report->summary"/>

							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="article_id" name="article_id" @checked($report->article_id)>
								<label class="form-check-label" for="article_id">article_id</label>
							</div>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="article_id_required" name="article_id_required" @checked($report->article_id_required)>
								<label class="form-check-label" for="article_id_required">article_id_required</label>
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
								<input class="form-check-input" type="checkbox" id="user_id" name="user_id" @checked($report->user_id)>
								<label class="form-check-label" for="user_id">user_id</label>
							</div>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="user_id_required" name="user_id_required" @checked($report->user_id_required)>
								<label class="form-check-label" for="user_id_required">user_id_required</label>
							</div>
					
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="item_id" name="item_id" @checked($report->item_id)>
								<label class="form-check-label" for="item_id">item_id</label>
							</div>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="item_id_required" name="item_id_required" @checked($report->item_id_required)>
								<label class="form-check-label" for="item_id_required">item_id_required</label>
							</div>

							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="supplier_id" name="supplier_id" @checked($report->supplier_id)>
								<label class="form-check-label" for="supplier_id">supplier_id</label>
							</div>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="supplier_id_required" name="supplier_id_required" @checked($report->supplier_id_required)>
								<label class="form-check-label" for="supplier_id_required">supplier_id_required</label>
							</div>

							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="project_id" name="project_id" @checked($report->project_id)>
								<label class="form-check-label" for="project_id">project_id</label>
							</div>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="project_id_required" name="project_id_required" @checked($report->project_id_required)>
								<label class="form-check-label" for="project_id_required">project_id_required</label>
							</div>

							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="category_id" name="category_id" @checked($report->category_id)>
								<label class="form-check-label" for="category_id">category_id</label>
							</div>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="item_id_required" name="item_id_required" @checked($report->item_id_required)>
								<label class="form-check-label" for="item_id_required">item_id_required</label>
							</div>

							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="dept_id" name="dept_id" @checked($report->dept_id)>
								<label class="form-check-label" for="dept_id">dept_id</label>
							</div>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="dept_id_required" name="dept_id_required" @checked($report->dept_id_required)>
								<label class="form-check-label" for="dept_id_required">dept_id_required</label>
							</div>

							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="warehouse_id" name="warehouse_id" @checked($report->warehouse_id)>
								<label class="form-check-label" for="warehouse_id">warehouse_id</label>
							</div>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="warehouse_id_required" name="warehouse_id_required" @checked($report->warehouse_id_required)>
								<label class="form-check-label" for="warehouse_id_required">warehouse_id_required</label>
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

