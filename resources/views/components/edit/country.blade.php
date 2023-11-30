<div class="mb-3">
    <label class="form-label">Country</label>
    <select class="form-control" name="country">
        @foreach ($countries as $country)
            <option {{ $country->country == old('country',$value) ? 'selected' : '' }} value="{{ $country->country }}">{{ $country->name }} </option>
        @endforeach
    </select>
</div>