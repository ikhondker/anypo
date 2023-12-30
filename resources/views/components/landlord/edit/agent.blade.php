<!-- Form -->
<div class="row mb-4">
    <label for="agent_id" class="col-sm-3 col-form-label form-label">Agent X:</label>
    <div class="col-sm-9">
        <select class="form-control" name="agent_id" id="agent_id">
            @foreach ($agents as $agent)
                <option {{ $agent->id == old('agent_id', $value) ? 'selected' : '' }} value="{{ $agent->id }}">{{ $agent->name }} </option>
            @endforeach
        </select>
    
    </div>
</div>
<!-- End Form -->

