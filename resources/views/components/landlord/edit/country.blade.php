<!-- Form -->
<div class="row mb-4">
	<label for="country" class="col-sm-3 col-form-label form-label">Country X:</label>
	<div class="col-sm-9">
		<select class="form-control" name="country">
			@foreach ($countries as $country)
				<option {{ $country->country == old('country',$value) ? 'selected' : '' }} value="{{ $country->country }}">{{ $country->name }} </option>
			@endforeach
		</select>
	
	</div>
</div>
<!-- End Form -->

