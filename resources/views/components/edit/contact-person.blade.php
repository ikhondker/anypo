<div class="mb-3">
    <label class="form-label">Contact Person X</label>
    <input type="text" class="form-control @error('contact_person') is-invalid @enderror" 
        name="contact_person" id="contact_person" placeholder="Contact Persone"     
        value="{{ old('contact_person', $value ) }}"
        />
    @error('contact_person')
        <div class="text-danger text-xs">{{ $message }}</div>
    @enderror
</div>
