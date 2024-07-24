<div class="card">

	<div class="card-header">
		<div class="card-actions float-end">
			<a class="btn btn-sm btn-light" href="{{ route('dept-budgets.edit', $deptBudget->id ) }}"><i class="fas fa-edit"></i> Edit</a>
			<a class="btn btn-sm btn-light" href="{{ route('dept-budgets.index') }}" ><i class="fas fa-list"></i> View all</a>
		</div>
		<h5 class="card-title mb-0">Dept Budget</h5>
	</div>
	<div class="card-body">
		<div class="row g-0">
			<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
				<img src="{{ Storage::disk('s3t')->url('flow/dept-budget.jpg') }}" width="240" height="321" class="mt-2" alt="Dept Budget">
			</div>
			<div class="col-sm-9 col-xl-12 col-xxl-9">
			
				<strong>{{ $deptBudget->dept->name }}</strong>
				<p>FY{{ $deptBudget->budget->fy }}: {{ $deptBudget->budget->name }}</p>

				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Budget</th>
							<td>{{number_format($deptBudget->amount, 2)}} {{ $_setup->currency }}</td>
						</tr>
						<tr>
							<th>PO Issued</th>
							<td>{{number_format($deptBudget->amount_po, 2)}} {{ $_setup->currency }}</td>
						</tr>
						<tr>
							<th>GRS Amount</th>
							<td>{{number_format($deptBudget->amount_grs, 2)}} {{ $_setup->currency }}</td>
						</tr>
						<tr>
							<th>Invoice Amount</th>
							<td>{{number_format($deptBudget->amount_invoice, 2)}} {{ $_setup->currency }}</td>
						</tr>
						<tr>
							<th>Payment Amount</th>
							<td>{{number_format($deptBudget->amount_payment, 2)}} {{ $_setup->currency }}</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><a href="{{ route('dept-budgets.show',$deptBudget->id) }}" class="text-warning d-inline-block">View Detail ...</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>
