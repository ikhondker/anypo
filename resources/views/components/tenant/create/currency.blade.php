<div class="mb-3 row">
	<label class="col-form-label col-sm-3 text-sm-right">Currency</label>
	<div class="col-sm-9">
		<select class="form-control" name="currency" required>
			<option value=""><< Currency >> </option>
			@foreach ($currencies as $currency)
				<option value="{{ $currency->currency }}" {{ $currency->currency == old('currency') ? 'selected' : '' }} >{{ $currency->currency." -".$currency->name." (".$currency->country.")" }} </option>
			@endforeach
		</select>
		@error('currency')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</div>
</div>
