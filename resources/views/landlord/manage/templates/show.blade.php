@extends('layouts.landlord.app')
@section('title','Template')
@section('breadcrumb','View Templates v1.2 (20-FEB-23)')

@section('content')

<h1 class="h3 mb-3">Template Info</h1>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('templates.index') }}" class="btn btn-sm btn-light"><i class="fas fa-edit"></i>  View all</a>
					@if (auth()->user()->isSystem())
					<a class="btn btn-sm btn-danger text-white" href="{{ route('templates.edit', $template->id) }}"><i class="fas fa-edit"></i> Edit</a>

					@endif
				</div>
				<h5 class="card-title">Template Info</h5>
				<h6 class="card-subtitle text-muted">View Template Details.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-landlord.show.my-text	value="{{ $template->code }}" label="CODE"/>
						<x-landlord.show.my-text	value="{{ $template->summary }}" label="Summary"/>
						<x-landlord.show.my-text	value="{{ $template->name }}"/>
						<x-landlord.show.my-text	value="{{ $template->email }}" label="E-mail"/>
						<x-landlord.show.my-text	value="{{ $template->phone }}" label="Phone"/>
						<x-landlord.show.my-badge	value="{{ $template->user->name }}" label="User Name"/>
						<x-landlord.show.my-badge	value="{{ $template->my_enum }}" label="Enum/Role:"/>
						<x-landlord.show.my-enable	value="{{ $template->enable }}"/>
						<x-landlord.show.my-badge	value="{{ $template->id }}" label="ID"/>

						<x-landlord.show.my-text value="{{ $template->address1 }}" label="Address1"/>
						<x-landlord.show.my-text value="{{ $template->address2 }}" label="Address2"/>
						<x-landlord.show.my-number value="{{ $template->qty }}" label="Qty"/>
						<x-landlord.show.my-number value="{{ $template->amount }}" label="Amount"/>

						<x-landlord.show.my-enable		value="{{ $template->my_bool }}"/>
						<x-landlord.show.my-date		value="{{ $template->my_date }}" label="Date"/>
						<x-landlord.show.my-date-time	value="{{ $template->my_date_time }}" label="Datetime"/>

						<tr>
							<th>Photo :</th>
							<td>
								@if ( $template->image <> '')
									<img src="{{ url('profile/'.$template->image) }}" width="90px">
								@else
									<img src="{{ url('profile/avatar.png') }}" width="90px">
								@endif
							</td>
						</tr>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

	<!-- Card -->
	<div class="card">
		<div class="card-header border-bottom">
			<h4 class="card-header-title">Template Info</h4>
		</div>

		<!-- Body -->
		<div class="card-body">

			<!-- Form -->
			<div class="row mb-4">
			<label class="col-sm-3 col-form-label form-label">Template Logo</label>

			<div class="col-sm-9">
				<!-- Media -->
				<div class="d-flex align-items-center">
				<!-- Avatar -->
				<label class="avatar avatar-xl avatar-circle" for="avatarUploader">
					<img id="avatarImg" class="avatar-img" src="{{ asset('/assets/img/160x160/img9.jpg') }}" alt="Image Description">
				</label>

				<div class="d-grid d-sm-flex gap-2 ms-4">
					<div class="form-attachment-btn btn btn-primary btn-sm">Upload photo
					<input type="file" class="js-file-attach form-attachment-btn-label" id="avatarUploader"
							data-hs-file-attach-options='{
								"textTarget": "#avatarImg",
								"mode": "image",
								"targetAttr": "src",
								"resetTarget": ".js-file-attach-reset-img",
								"resetImg": "./assets/img/160x160/img1.jpg",
								"allowTypes": [".png", ".jpeg", ".jpg"]
							}'>
					</div>
					<!-- End Avatar -->
				</div>
				</div>
				<!-- End Media -->
			</div>
			</div>
			<!-- End Form -->
				<x-landlord.show.my-text	value="{{ $template->code }}" label="CODE"/>
				<x-landlord.show.my-text	value="{{ $template->summary }}" label="Summary"/>
				<x-landlord.show.my-text	value="{{ $template->name }}"/>
				<x-landlord.show.my-text	value="{{ $template->email }}" label="E-mail"/>
				<x-landlord.show.my-text	value="{{ $template->phone }}" label="Phone"/>
				<x-landlord.show.my-badge	value="{{ $template->user->name }}" label="User Name"/>
				<x-landlord.show.my-badge	value="{{ $template->my_enum }}" label="Enum/Role:"/>
				<x-landlord.show.my-enable	value="{{ $template->enable }}"/>
				<x-landlord.show.my-badge	value="{{ $template->id }}" label="ID"/>

				<x-landlord.show.my-text value="{{ $template->address1 }}" label="Address1"/>
				<x-landlord.show.my-text value="{{ $template->address2 }}" label="Address2"/>
				<x-landlord.show.my-number value="{{ $template->qty }}" label="Qty"/>
				<x-landlord.show.my-number value="{{ $template->amount }}" label="Amount"/>

				<x-landlord.show.my-enable		value="{{ $template->my_bool }}"/>
				<x-landlord.show.my-date		value="{{ $template->my_date }}" label="Date"/>
				<x-landlord.show.my-date-time	value="{{ $template->my_date_time }}" label="Datetime"/>


					<div class="row mb-4">
						<label class="col-sm-3 col-form-label form-label">Photo:</label>
						<div class="col-sm-9 col-form-label">
							@if ( $template->image <> '')
							<img src="{{ url('profile/'.$template->image) }}" width="90px">
							@else
								<img src="{{ url('profile/avatar.png') }}" width="90px">
							@endif
						</div>
					</div>

		</div>
		<!-- End Body -->

		<!-- Footer -->
		<div class="card-footer pt-0">
		<div class="d-flex justify-content-end gap-3">
			<a class="btn btn-primary" href="{{ route('templates.edit',$template->id) }}">Edit</a>
		</div>
		</div>
		<!-- End Footer -->

	</div>
	<!-- End Card -->
@endsection

