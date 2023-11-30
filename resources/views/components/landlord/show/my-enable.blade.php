<div class="row mb-4">
    <label class="col-sm-3 col-form-label form-label">{{ $label }}</label>
    <div class="col-sm-9 col-form-label">
        <span class="badge {{ ($value ? 'bg-info' : 'bg-danger') }}">{{ ($value ? 'Yes' : 'No') }}</span>
    </div>
</div>
