<!-- Form -->
<div class="row mb-4">
    <label for="facebook" class="col-sm-3 col-form-label form-label">Facebook X:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control @error('facebook') is-invalid @enderror" 
            name="facebook" id="facebook" placeholder="https://www.facebook.com/username"     
            value="{{ old('facebook', $url ) }}"
            />
        @error('facebook')
            <div class="text-danger text-xs">{{ $message }}</div>
        @enderror
    </div>
</div>
<!-- End Form -->