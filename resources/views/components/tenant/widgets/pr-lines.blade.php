{{-- ================================================================== --}}
	<div class="row">
		<div class="col-12 col-xl-12">
			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<div class="dropdown position-relative">
							<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
								<i class="align-middle" data-feather="more-horizontal"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</div>
					</div>
					<h5 class="card-title">Requisition Lines</h5>
					<h6 class="card-subtitle text-muted">Using the most basic table markup, here’s how .table-based tables look in Bootstrap.</h6>
				</div>
				<table class="table">
					<thead>
						<tr>
							<th class="">LINE#</th>
							<th class="">Item</th>
							<th class="">Summary</th>
							<th class="">UOM</th>
							<th class="text-end">Qty</th>
							<th class="text-end">Price</th>
							<th class="text-end">Amount</th>
							<th class="">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($prls as $prl)
							@if ( $selected_prl_id == $prl->id )
								@include('tenant.includes.pr-line-edit')
							@else
								
								<tr class="">
									<td class="">{{ $prl->id }}</td>
									<td class="">{{ $prl->item->name }}</td>
									<td class="">{{ $prl->summary }}</td>
									<td class="">{{ $prl->item->uom->name }}</td>
									<td class="text-end">{{ $prl->qty }}</td>
									<td class="text-end"><x-tenant.list.my-number :value="$prl->price"/></td>
									<td class="text-end"><x-tenant.list.my-number :value="$prl->amount"/></td>
									<td class="">
										<a href="{{ route('prls.edit',$prl->id) }}" class="text-muted d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">Edit</a> | 
										<a href="{{ route('prls.destroy',$prl->id) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" onclick="return confirm('Do you want to delete this line? Are you sure?')" title="Delete">
											<i class="align-middle" data-feather="trash-2"></i>
										</a>
									</td>
								</tr>
							@endif

						@endforeach

						@if ($add)
							@include('tenant.includes.pr-line-add')
							@include('tenant.includes.pr-footer-edit')
						@endif
						@if ($edit)
							@include('tenant.includes.pr-footer-edit')
						@endif
						@if ($show)
							@include('tenant.includes.pr-footer-view')
						@endif 
						
							
					   

					</tbody>
				</table>
			</div>
		</div>
	</div>    
{{-- ============================================================== --}}