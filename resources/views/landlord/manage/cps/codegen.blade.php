@extends('layouts.landlord.app')
@section('title','Code Generator - For all Tenants')
@section('breadcrumb')
	<li class="breadcrumb-item active">Code Generator</li>
@endsection

@section('content')

	<h1 class="h3 mb-3">Code Generator - For all Tenants</h1>


	<!-- form start -->
	<form id="myform" action="{{ route('cps.store') }}" method="POST" enctype="multipart/form-data">
		@csrf


		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('oems.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a>
				</div>
				<h5 class="card-title">Create OEM</h5>
				<h6 class="card-subtitle text-muted">Create a new OEM</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Section (accordionFaq ex. Faq):</th>
							<td>
								<input type="text" class="form-control @error('section') is-invalid @enderror"
								name="section" id="section" placeholder="Start"
								value="{{ old('section', 'Start' ) }}"
								required/>
							@error('section')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<tr>
							<th>XX Div (collapseOne ex. One ) NOT Used :</th>
							<td>
								<input type="text" class="form-control @error('div') is-invalid @enderror"
								name="div" id="div" placeholder="One"
								value="{{ old('div', 'One' ) }}"
								required/>
							@error('div')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<tr>
							<th>Output X:</th>
							<td>
								@isset($text)
									<code>
									{!! nl2br(htmlspecialchars($text)) !!}
									</code>
								@endisset
							</td>
						</tr>
						<x-tenant.edit.save/>
					</tbody>
				</table>
			</div>
		</div>

	</form>
	<!-- /.form end -->


	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Code Generator - For all Tenants</h5>
			<h6 class="card-subtitle text-muted">TBD</h6>
		</div>
		<div class="card-body">


		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->



@endsection

