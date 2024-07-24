	<!-- form start -->
	<form action="{{ route('wfls.update',$wfl->id) }}" method="POST">
		@csrf
		@method('PUT')

		<div class="card badge-subtle-primary">
			<div class="card-header badge-subtle-primary">
				<h5 class="card-title">Your Approval Needed</h5>
				<h6 class="card-subtitle text-muted">Please enter Approval Actions, Approve or Reject.</h6>
			</div>
			<div class="card-body">
				
					<table class="table table-sm my-2">
						<tbody>
							<tr>
								<th width="20%">Decision :</th>
								<td>
									<select class="form-control" name="action" placeholder="Action" value="APPROVED">
									<option {{ 'approved' == old('action',$wfl->action->value) ? 'selected' : '' }} value="{{ App\Enum\WflActionEnum::APPROVED->value }}">APPROVED</option>
									<option {{ 'rejected' == old('action',$wfl->action->value) ? 'selected' : '' }} value="{{ App\Enum\WflActionEnum::REJECTED->value }}">REJECTED</option>
									</select>
									@error('action')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</td>
							</tr>
							<tr>
								<th>Notes :</th>
								<td>
									<textarea class="form-control" name="notes" placeholder="Enter ..." rows="3">{{ old('notes', $wfl->notes) }}</textarea>
									@error('notes')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</td>
							</tr>
							<tr>
								<th>Approver :</th>
								<td>
									<input type="text" name="approver" id="approver" class="form-control" placeholder="ID" value="{{ auth()->user()->name }}" readonly>
									<input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id', $wfl->id ) }}" hidden>
								</td>
							</tr>
							<x-tenant.buttons.show.save/>
						</tbody>
					</table>
			</div>
		</div>


	</form>
	<!-- /.form end -->
