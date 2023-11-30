<!-- Form -->
<div class="row mb-4">
    <label for="dept_id" class="col-sm-3 col-form-label form-label">Dept X:</label>
    <div class="col-sm-9">
        <select class="form-control" name="dept_id">
            @foreach ($depts as $dept)
                <option {{ $dept->id == old('dept_id', $value) ? 'selected' : '' }} value="{{ $dept->id }}">{{ $dept->name }} </option>
            @endforeach
        </select>
    
    </div>
</div>
<!-- End Form -->

