	<!-- form start -->
	<form action="{{ route('wfls.update',$wfl->id) }}" method="POST">
		@csrf
		@method('PUT')

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Approval Actions</h5>
						<h6 class="card-subtitle text-muted">Please enter Approval Actions, Approve or Reject.</h6>
					</div>
					<div class="card-body">
						<form>
							
							<fieldset class="mb-3">
								<div class="row">
									<label class="col-form-label col-sm-2 text-sm-right pt-sm-0">Decision</label>
									<div class="col-sm-10">
										<select class="form-control" name="action" placeholder="Action" value="APPROVED">
											<option {{ 'approved' == old('action',$wfl->action->value) ? 'selected' : '' }} value="{{ App\Enum\WflActionEnum::APPROVED->value }}">APPROVED</option>
											<option {{ 'rejected' == old('action',$wfl->action->value) ? 'selected' : '' }} value="{{ App\Enum\WflActionEnum::REJECTED->value }}">REJECTED</option>
										</select>
										@error('action')
											<div class="text-danger text-xs">{{ $message }}</div>
										@enderror

										{{-- <label class="form-check">
											<input name="radio-3" type="radio" class="form-check-input" checked>
											<span class="form-check-label">Approve</span>
										</label>
										<label class="form-check">
											<input name="radio-3" type="radio" class="form-check-input">
											<span class="form-check-label">Reject</span>
										</label> --}}
									
									</div>
								</div>
							</fieldset>
							<div class="mb-3 row">
								<label class="col-form-label col-sm-2 text-sm-right">Notes</label>
								<div class="col-sm-10">
									<textarea class="form-control" name="notes"  placeholder="Enter ..." rows="3">{{ old('notes', $wfl->notes) }}</textarea>
									@error('notes')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-form-label col-sm-2 text-sm-right">Approver</label>
								<div class="col-sm-10">
									<input type="text" name="approver" id="approver" class="form-control" placeholder="ID" value="{{ auth()->user()->name }}" readonly>
									<input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id', $wfl->id ) }}" hidden>
								</div>
							</div>
							<div class="mb-3 row">
								<label class="col-form-label col-sm-2 text-sm-right">&nbsp;</label>
								<div class="col-sm-10 ml-sm-auto">
									{{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
									<x-tenant.buttons.show.save/>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</form>
	<!-- /.form end -->
