<div class="mb-3">
    <label class="form-label">Price</label>
    <input type="number" class="form-control @error('price') is-invalid @enderror" 
        name="price" id="price" placeholder="99,999.99"     
        value="{{ old('price', '1.00' ) }}"
        step='0.01' min="1" required/>
    @error('price')
        <div class="text-danger text-xs">{{ $message }}</div>
    @enderror
</div>