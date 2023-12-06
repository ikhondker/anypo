<!-- form start -->
<form action="{{ route('wfls.update',$wfl->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-primary">Approval of:  PR#{{ $pr->id}} - {{ $pr->summary}}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Approver</label>
                        <input type="text" name="approver" id="approver" class="form-control" placeholder="ID" value="{{ auth()->user()->name }}" readonly>
                        <input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id', $wfl->id ) }}" hidden>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Decision:</label>
                        <select class="form-control" name="action" placeholder="Action" value="APPROVED">
                            <option {{ 'approved' == old('action',$wfl->action->value) ? 'selected' : '' }} value="{{ App\Enum\WflActionEnum::APPROVED->value }}">APPROVED</option>
                            <option {{ 'rejected' == old('action',$wfl->action->value) ? 'selected' : '' }} value="{{ App\Enum\WflActionEnum::REJECTED->value }}">REJECTED</option>
                        </select>
                        @error('action')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes:</label>
                        <textarea class="form-control" name="notes"  placeholder="Enter ..." rows="3">{{ old('notes', $wfl->notes) }}</textarea>
                        @error('notes')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <x-tenant.widgets.submit/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- /.form end -->