<!-- Form -->
<div class="row mb-4">
	<label for="priority_id" class="col-sm-3 col-form-label form-label">Priority X:</label>
	<div class="col-sm-9">
		<select class="form-control" name="priority_id">
			@foreach ($priorities as $priority)
				<option {{ $priority->id == old('priority_id',$value) ? 'selected' : '' }} value="{{ $priority->id }}">{{ $priority->name }} </option>
			@endforeach
		</select>
	
	</div>
</div>
<!-- End Form -->

