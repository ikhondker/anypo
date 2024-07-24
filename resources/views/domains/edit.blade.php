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
			<form id="myform" action="{{ route('domains.update',$domain->id) }}" method="POST">
				@csrf
				@method('PUT')

				<table class="table table-sm my-2">
					<tbody>
						<x-landlord.edit.id-read-only :value="$domain->id"/>
						<tr>
							<th>Domain :</th>
							<td>
								<input type="text" class="form-control @error('domain') is-invalid @enderror"
									name="domain" id="domain" placeholder="domain"
									value="{{ old('domain', $domain->domain ) }}"
									required/>
								@error('domain')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						<tr>
							<th>Tenant ID :</th>
							<td>
								<input type="text" class="form-control @error('tenant_id') is-invalid @enderror"
									name="tenant_id" id="tenant_id" placeholder="tenant_id"
									value="{{ old('tenant_id', $domain->tenant_id ) }}"
									required/>
								@error('tenant_id')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						
					</tbody>
				</table>

				<x-landlord.edit.save/>
			</form>
		</div>
	</div>


@endsection


