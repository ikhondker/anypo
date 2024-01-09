@extends('layouts.landlord-app')
@section('title','Template')
@section('breadcrumb','Create Templates v1.2 (31-JAN-23)')

@section('content')

	<!-- Card -->
	<div class="card">
		<form action="{{ route('templates.store') }}" method="POST" enctype="multipart/form-data">
			@csrf

			<div class="card-header d-flex justify-content-between align-items-center border-bottom">
				<h5 class="card-header-title">Create Template</h5>
				<button class="btn btn-primary btn-sm" type="submit" form="myform"><i class="bi bi-save"></i> Save</button>
			</div>

			<!-- Body -->
			<div class="card-body">
				<x-landlord.create.name/>
				<x-landlord.create.email/>
				<x-landlord.create.cell/>

				<!-- List Group -->
				<div class="list-group list-group-flush list-group-no-gutters">
					<!-- Item -->
					<div class="list-group-item">
						<!-- Form Switch -->
						<label class="form-check form-switch" for="admin">
							<input class="form-check-input mt-0" type="checkbox" id="admin" name="admin">
							<span class="d-block"> Make this person an Admin</span>
							<span class="d-block small text-muted">Be careful! This user will be able to perform all admin activities</span>
						</label>
					  <!-- End Form Switch -->
					</div>
					<!-- End Item -->
				</div>
				<!-- End List Group -->


				{{-- OLD FORMAT BELLOW  --}}
				<div class="form-group row mb-4">
					<label for="code" class="col-sm-2 col-form-label text-end text-secondary">CODE:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control"
							style="text-transform: uppercase"
							name="code" id="code" placeholder="CODE"
							value="{{ old('code', "" ) }}"
							class="@error('code') is-invalid @enderror" required>
						@error('code')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="form-group row mb-4">
					<label for="summary" class="col-sm-2 col-form-label text-end text-secondary">Summary:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control"
							name="summary" id="summary" placeholder="Summary"
							value="{{ old('summary', "" ) }}"
							class="@error('summary') is-invalid @enderror" required>
						@error('summary')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="form-group row mb-4">
					<label for="name" class="col-sm-2 col-form-label text-end text-secondary">Name:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control"
							name="name" id="name" placeholder="Name"
							value="{{ old('name', "" ) }}"
							class="@error('name') is-invalid @enderror" required>
						@error('name')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="form-group row mb-4">
					<label for="notes" class="col-sm-2 col-form-label text-end text-secondary">Notes:</label>
					<div class="col-sm-10">
						<textarea class="form-control" rows="3" name="Description"
						placeholder="Enter ...">{{ old('notes', "Enter ...") }}</textarea>
					</div>
				</div>

				<div class="form-group row mb-4">
					<label for="address1" class="col-sm-2 col-form-label text-end text-secondary">Address1:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control"
							name="address1" id="address1" placeholder="address1"
							value="{{ old('address1', "address1" ) }}"
							class="@error('address1') is-invalid @enderror">
						@error('address1')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="form-group row mb-4">
					<label for="email" class="col-sm-2 col-form-label text-end text-secondary">Email:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control"
							name="email" id="email" placeholder="email@example.com"
							value="{{ old('email', "email@example.com" ) }}"
							class="@error('email') is-invalid @enderror" required>
						@error('email')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="form-group row mb-4">
					<label for="phone" class="col-sm-2 col-form-label text-end text-secondary">Phone:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control"
							name="phone" id="phone" placeholder="phone"
							value="{{ old('phone', "01911310509" ) }}"
							class="@error('phone') is-invalid @enderror">
						@error('phone')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="form-group row mb-4">
					<label for="user_id" class="col-sm-2 col-form-label text-end text-secondary">User :</label>
					<div class="col-sm-10">
						<select class="form-control" name="user_id" required>
							<option value=""><< User >> </option>
							@foreach ($users as $user)
								<option value="{{ $user->id }}" {{ $user->id == old('user_id') ? 'selected' : '' }} >{{ $user->name }} </option>
							@endforeach
						</select>
						@error('user_id')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="form-group row mb-4">
					<label for="my_enum" class="col-sm-2 col-form-label text-end text-secondary">Role:</label>
					<div class="col-sm-10">
						<select class="form-control js-example-basic-single" name="my_enum" required>
							<option value=""><< Role >> </option>
							<option value="user" {{ 'user' == old('my_enum') ? 'selected' : '' }}>User</option>
							<option value="agent" {{ 'agent' == old('my_enum') ? 'selected' : '' }}>Agent</option>
							<option value="admin" {{ 'admin' == old('my_enum') ? 'selected' : '' }}>Admin</option>
							<option value="system" {{ 'system' == old('my_enum') ? 'selected' : '' }}>System</option>
						</select>
					</div>
				</div>


				<div class="form-group row mb-4">
					<label for="qty" class="col-sm-2 col-form-label text-end text-secondary">Qty:</label>
					<div class="col-sm-10">
						<input type="number" class="form-control"
							name="qty" id="qty" placeholder="1"
							value="{{ old('qty', "1" ) }}"
							style="text-align: right;" min="1"
							class="@error('qty') is-invalid @enderror" required>
						@error('qty')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="form-group row mb-4">
					<label for="amount" class="col-sm-2 col-form-label text-end text-secondary">Amount:</label>
					<div class="col-sm-10">
						<input type="number" class="form-control"
							name="amount" id="amount" placeholder="1.00"
							style="text-align: right;" step='0.01' min="1"
							value="{{ old('amount', "1.0" ) }}"
							class="@error('amount') is-invalid @enderror" required>
						@error('amount')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="form-group row mb-4">
					<label for="my_date" class="col-sm-2 col-form-label text-end text-secondary">Date:</label>
					<div class="col-sm-10">
						<input type="date" class="form-control"
							name="my_date" id="my_date" placeholder="Enter Date"
							value="{{ old('my_date', date('Y-m-d') ) }}"
							class="@error('my_date') is-invalid @enderror" required>
						@error('my_date')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="form-group row mb-4">
					<label for="my_date_time" class="col-sm-2 col-form-label text-end text-secondary">Date Time:</label>
					<div class="col-sm-10">
						<input type="date" class="form-control"
							name="my_date_time" id="my_date_time" placeholder="Enter Date and Time"
							value="{{ old('my_date_time', date('Y-m-d') ) }}"
							class="@error('my_date_time') is-invalid @enderror">
						@error('my_date_time')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="form-group row mb-4">
					<label for="my_bool" class="col-sm-2 col-form-label text-end text-secondary">Boolean:</label>
					<div class="col-sm-10">
						<div class="form-check form-check-primary form-check-inline">
							<input class="form-check-input" type="checkbox" name="my_bool" id="my_bool" checked="">
							<label class="form-check-label" for="form-check-default-checked">
								Active
							</label>
						</div>
					</div>
				</div>

				<x-landlord.attachment.create />

				<div class="form-group row mb-4">
					<label for="my_date_time" class="col-sm-2 col-form-label text-end text-secondary">Date Time:</label>
					<div class="col-sm-10">
						Enum:TODO my_enum
						Image: TODO image
					</div>
				</div>


			</div>
			<!-- End Body -->


			<x-landlord.create.save/>
		</form>
	</div>
	<!-- End Card -->

@endsection

