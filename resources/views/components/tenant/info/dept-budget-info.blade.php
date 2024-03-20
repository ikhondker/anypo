<div class="row">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-body">
				<div class="row g-0">
					<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
						<img src="{{ asset('/img3.jpg')}}" width="180" height="180" class="mt-2" alt="Project">
					</div>
					<div class="col-sm-9 col-xl-12 col-xxl-9">
						<h4>{{ $deptBudget->dept->name }}</h4>
						<p>FY{{ $deptBudget->budget->fy }}:{{ $deptBudget->budget->name  }}</p>
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
	</div>
</div>