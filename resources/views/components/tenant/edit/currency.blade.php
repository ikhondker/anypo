<div class="mb-3">
    <label class="form-label">Currency</label>
    <select class="form-control" name="currency">
        @foreach ($currencies as $currency)
            <option {{ $currency->currency == old('currency',$value) ? 'selected' : '' }} value="{{ $currency->currency }}">{{ $currency->currency." -".$currency->name." (".$currency->country.")" }} </option>
        @endforeach
    </select>
</div>