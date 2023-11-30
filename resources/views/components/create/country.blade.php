<div class="mb-3">
    <label class="form-label">Country</label>
    <select class="form-control" name="country" required>
        <option value=""><< Country >> </option>
        @foreach ($countries as $country)
            <option value="{{ $country->country }}" {{ $country->country == old('country') ? 'selected' : '' }} >{{ $country->name }} </option>
        @endforeach
    </select>
</div>
