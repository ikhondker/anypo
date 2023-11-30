{{-- <button type="submit" class="btn btn-primary me-2">{{ $title }}</button> --}}
{{-- <div class="button-group d-flex justify-content-center flex-wrap">
    <button type="submit" id="submit" name="submit" class="btn btn-primary w-100">{{ $title }}</button>
</div> --}}
{{-- <a href="{{ route($route.'.submit',$id) }}" class="btn btn-primary float-end me-2"><i class="fas fa-check-to-slot"></i> {{ $title }}</a> --}}


<div class="mb-3 float-end">
    <a class="btn btn-secondary" href="{{ url()->previous() }}"> Cancel</a>
    <button type="submit" id="submit" name="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ $title }}</button>
</div>
