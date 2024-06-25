@extends('layouts.landlord.app')
@section('title','Edit Domain')
@section('breadcrumb','Edit Domain')

@section('content')

<h1 class="h3 mb-3">Edit Domain</h1>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Edit Domain (Admin Only)</h5>
			<h6 class="card-subtitle text-muted">Edit Domain Details.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('tenants.update',$tenant->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<table class="table table-sm my-2">
					<tbody>

					<x-landlord.edit.name :value="$tenant->id"/>
                    <x-landlord.edit.name :value="$tenant->status"/>


					</tbody>
				</table>

				<x-landlord.edit.save/>
			</form>
		</div>
	</div>


@endsection


