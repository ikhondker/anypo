<!-- Form -->
<div class="row mb-4">
    <label for="address2" class="col-sm-3 col-form-label form-label">Address2 X:</label>
    <div class="col-sm-9">
        <input type="text" class="form-control @error('address2') is-invalid @enderror" 
            name="address2" id="address2" placeholder="Address 2"     
            value="{{ old('address2', $value ) }}"
            />
        @error('address2')
            <div class="text-danger text-xs">{{ $message }}</div>
        @enderror
    </div>
</div>
<!-- End Form -->