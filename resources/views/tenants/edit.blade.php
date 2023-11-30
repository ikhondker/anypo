@extends('landlord.layouts.site-app')
@section('title','Edit Account')
@section('breadcrumb','Edit Account')

@section('content')


	<x-landlord.card.header title="Edit Account"/>


	<!-- form start -->
	<form action="{{ route('accounts.update',$account->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		 <!-- my-section-row -->
		 <div class="row my-section-row justify-content-between">
			<div class="col-xl-6">

				<h6>Account Info:-</h6>
				<x-landlord.show.my-badge      value="{{ $account->site }}" label="Site"/>

				<div class="form-group row">
					<label for="name" class="col-sm-3 col-form-label col-form-label-sm">Account Name</label>
					<div class="col-sm-9">
						<input type="text" class="form-control form-control-sm" 
							name="name" id="name" placeholder="Name" 
							value="{{ old('name', $account->name ) }}"     
							class="@error('name') is-invalid @enderror" required>
						@error('name')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>


				<div class="form-group row">
					<label for="tagline" class="col-sm-3 col-form-label col-form-label-sm">Tagline</label>
					<div class="col-sm-9">
						<input type="text" class="form-control form-control-sm" 
							name="tagline" id="tagline" placeholder="Name" 
							value="{{ old('tagline', $account->tagline ) }}"     
							class="@error('tagline') is-invalid @enderror">
						@error('tagline')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="form-group row">
					<label for="email" class="col-sm-3 col-form-label col-form-label-sm">Email</label>
					<div class="col-sm-9">
						<input email="text" class="form-control form-control-sm" 
							name="email" id="email" placeholder="name@company.com" 
							value="{{ old('email', $account->email ) }}"     
							class="@error('email') is-invalid @enderror" required>
						@error('email')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
						
					</div>
				</div>

				<div class="form-group row">
					<label for="cell" class="col-sm-3 col-form-label col-form-label-sm">Cell</label>
					<div class="col-sm-9">
						<input cell="text" class="form-control form-control-sm" 
							name="cell" id="cell" placeholder="01911-" 
							value="{{ old('cell', $account->cell ) }}"     
							class="@error('cell') is-invalid @enderror" required>
						@error('cell')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
						
					</div>
				</div>
				<x-landlord.show.my-badge      value="{{ $account->id }}" label="ID"/>
			</div>

			<div class="col-xl-6">
				<h6>Address:-</h6>
				<div class="form-group row">
					<label for="address1" class="col-sm-3 col-form-label col-form-label-sm">Address1</label>
					<div class="col-sm-9">
						<input type="text" class="form-control form-control-sm" 
							name="address1" id="address1" placeholder="Address1" 
							value="{{ old('address1', $account->address1 ) }}"     
							class="@error('address1') is-invalid @enderror" required>
						@error('address1')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
						
					</div>
				</div>

				<div class="form-group row">
					<label for="address2" class="col-sm-3 col-form-label col-form-label-sm">Address2</label>
					<div class="col-sm-9">
						<input type="text" class="form-control form-control-sm" 
							name="address2" id="address2" placeholder="Address2" 
							value="{{ old('address2', $account->address2 ) }}"     
							class="@error('address2') is-invalid @enderror">
						@error('address2')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
						
					</div>
				</div>

				<div class="form-group row">
					<label for="state" class="col-sm-3 col-form-label col-form-label-sm">State</label>
					<div class="col-sm-9">
						<input type="text" class="form-control form-control-sm" 
							name="state" id="state" placeholder="N/A" 
							value="{{ old('state', $account->state ) }}"     
							class="@error('state') is-invalid @enderror">
						@error('state')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="form-group row">
					<label for="zip" class="col-sm-3 col-form-label col-form-label-sm">Zip</label>
					<div class="col-sm-9">
						<input type="text" class="form-control form-control-sm" 
							name="zip" id="zip" placeholder="1209" 
							value="{{ old('zip', $account->zip ) }}"     
							class="@error('zip') is-invalid @enderror">
						@error('zip')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="form-group row">
					<label for="country" class="col-sm-3 col-form-label col-form-label-sm">Country</label>
					<div class="col-sm-9">
						<select class="form-control" name="user_id">
							@foreach ($countries as $country)
								<option {{ $country->country == old('country',$account->country) ? 'selected' : '' }} value="{{ $country->country }}">{{ $country->name }} </option>
							@endforeach
						</select>
					</div>
				</div>

				{{-- <div class="form-group row">
					<label for="country" class="col-sm-3 col-form-label col-form-label-sm">Country</label>
					<div class="col-sm-9">
						<input type="text" class="form-control form-control-sm" 
							name="country" id="country" placeholder="bd" 
							value="{{ old('country', $account->country ) }}"     
							class="@error('country') is-invalid @enderror">
						@error('country')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div> --}}



			</div>
		</div>
		<!-- /.my-section-row -->

		<!-- my-section-row -->
		<div class="row my-section-row justify-content-between">
			<div class="col-xl-6">
				<h6>Account Logo:-</h6>
				<div class="form-group row">
					<label for="name" class="col-sm-3 col-form-label col-form-label-sm">Image</label>
					<div class="col-sm-9">
						<x-landlord.attachment.create />
					</div>
				</div>
			</div>

			<div class="col-xl-6">
				<h6>Social:-</h6>
				<div class="form-group row">
					<label for="facebook" class="col-sm-3 col-form-label col-form-label-sm">Facebook</label>
					<div class="col-sm-9">
						<input type="text" class="form-control form-control-sm" 
							name="facebook" id="facebook" placeholder="https://www.facebook.com/username" 
							value="{{ old('facebook', $account->facebook ) }}"     
							class="@error('facebook') is-invalid @enderror">
						@error('facebook')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
						
					</div>
				</div>

				<div class="form-group row">
					<label for="linkedin" class="col-sm-3 col-form-label col-form-label-sm">LinkedIn</label>
					<div class="col-sm-9">
						<input type="text" class="form-control form-control-sm" 
							name="linkedin" id="linkedin" placeholder="https://www.linkedin.com/username" 
							value="{{ old('linkedin', $account->linkedin ) }}"     
							class="@error('linkedin') is-invalid @enderror">
						@error('linkedin')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>
			</div>
		</div>
		<!-- /.my-section-row -->



		<div class="my-section-buttons">
			<div class="d-grid gap-2 d-md-flex justify-content-md-end">
				<a class="btn btn-dark" href="{{ route('accounts.index') }}">Cancel</a>
				<button type="submit" class="btn btn-info">Save</button>
			</div>
		</div>

	</form>
	<!-- /.form end -->

@endsection

@section('sidebar')
<a href="{{ route('accounts.index') }}" class="btn btn-primary btn-sidebar">Account List</a>
<a href="{{ route('tickets.index') }}" class="btn btn-secondary btn-sidebar">Ticket Lists</a>
<a href="{{ route('users.index') }}" class="btn btn-success btn-sidebar">Users Lists</a>
<a href="{{ route('dashboards.index') }}" class="btn btn-dark btn-sidebar">Dashboard</a>


@endsection