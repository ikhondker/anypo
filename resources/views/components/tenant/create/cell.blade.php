<div class="mb-3">
    <label class="form-label">Cell</label>
    <input type="text" class="form-control @error('cell') is-invalid @enderror" 
        name="cell" id="cell" placeholder="01911310509"     
        value="{{ old('cell', '' ) }}"
        required/>
    @error('cell')
        <div class="text-danger text-xs">{{ $message }}</div>
    @enderror
</div>