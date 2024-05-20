<div class="mb-3 row">
	<label class="col-form-label col-sm-3 text-sm-right">Currency</label>
	<div class="col-sm-9">
		<select class="form-control" name="currency" id="currency" required>
			@foreach ($currencies as $currency)
				<option {{ $currency->currency == old('currency',$value) ? 'selected' : '' }} value="{{ $currency->currency }}">{{ $currency->currency." -".$currency->name." (".$currency->country.")" }} </option>
			@endforeach
		</select>
		@error('currency')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</div>
</div>

