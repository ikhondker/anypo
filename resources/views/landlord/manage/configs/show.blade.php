@extends('layouts.landlord-app')
@section('title','config')
@section('breadcrumb','View Config')

@section('content')

		<!-- Card -->
		<div class="card">
				<div class="card-header border-bottom">
					<h4 class="card-header-title">View Config</h4>
				</div>

				<!-- Body -->
				<div class="card-body">

						<!-- Form -->
						<div class="row mb-4">
							<label class="col-sm-3 col-form-label form-label">Config Logo</label>

							<div class="col-sm-9">
									<!-- Media -->
									<div class="d-flex align-items-center">
									<!-- Avatar -->
									<label class="avatar avatar-xl avatar-circle" for="avatarUploader">
										<img id="avatarImg" class="avatar-img" src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" alt="Image Description">
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

						<x-landlord.show.my-text value="{{ $config->name }}" label="Name" />
						<x-landlord.show.my-text value="{{ $config->tagline }}" label="Tagline" />
						<x-landlord.show.my-text value="{{ $config->currency }}" label="Current" />
						<x-landlord.show.my-text value="{{ $config->address1 }}" label="Address1" />
						<x-landlord.show.my-text value="{{ $config->address2 }}" label="Address2" />
						<x-landlord.show.my-text value="{{ $config->city.', '.$config->state.', '.$config->zip  }}" label="City-State-Zip" />
						<x-landlord.show.my-text value="{{ $config->relCountry->name }}" label="Country" />
						<x-landlord.show.my-text value="{{ $config->cell }}" label="Cell" />
						<x-landlord.show.my-text value="{{ $config->email }}" label="Email" />
						<x-landlord.show.my-url value="{{ $config->website }}" label="Website" />
						<x-landlord.show.my-url value="{{ $config->facebook }}" label="Facebook" />
						<x-landlord.show.my-url value="{{ $config->linkedin }}" label="LinkedIn" />
						<x-landlord.show.my-number value="{{ $config->discount_pc_3 }}" label="3 Months Discount %" />
						<x-landlord.show.my-number value="{{ $config->discount_pc_6 }}" label="6 Months Discount %" />
						<x-landlord.show.my-number value="{{ $config->discount_pc_12 }}" label="12 Months Discount %" />
						<x-landlord.show.my-number value="{{ $config->discount_pc_24 }}" label="24 Months Discount %" />
			
						<x-landlord.show.my-integer value="{{ $config->days_gen_bill }}" label="Gen Invoice Before" />
						<x-landlord.show.my-integer value="{{ $config->days_due }}" label="Mark account as due after" />
						<x-landlord.show.my-integer value="{{ $config->days_pastdue }}" label="Mark account as past due after" />
						<x-landlord.show.my-integer value="{{ $config->days_archive }}" label="Mark account for archive after" />

						<x-landlord.show.my-enable	value="{{ $config->maintenance }}" label="Maintenance ?"/>	
						<x-landlord.show.my-date-time	value="{{ $config->maintenance_start_time }}" label="Start"/>
						<x-landlord.show.my-date-time	value="{{ $config->maintenance_end_time }}" label="End"/>
						<x-landlord.show.my-enable	value="{{ $config->banner }}" label="Banner?"/>
						<x-landlord.show.my-text	value="{{ $config->banner_message }}" label="Banner"/>
				</div>
				<!-- End Body -->

				<!-- Footer -->
				<div class="card-footer pt-0">
					<div class="d-flex justify-content-end gap-3">
						<a class="btn btn-primary" href="{{ route('configs.edit',$config->id) }}">Edit</a>
					</div>
				</div>
				<!-- End Footer -->
			</div>
			<!-- End Card -->

@endsection

