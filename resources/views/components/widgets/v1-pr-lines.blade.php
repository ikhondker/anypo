{{-- ================================================================== --}}
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-header">
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
                                <tr class="bg-warning">
                            @else
                                <tr class="">
                            @endif
                                    <td class="">{{ $prl->id }} {{ $selected_prl_id }} </td>
                                    <td class="">{{ $prl->item->name }}</td>
                                    <td class="">{{ $prl->summary }}</td>
                                    <td class="">{{ $prl->item->uom->name }}</td>
                                    <td class="text-end">{{ $prl->qty }}</td>
                                    <td class="text-end"><x-list.my-number :value="$prl->price"/></td>
                                    <td class="text-end"><x-list.my-number :value="$prl->amount"/></td>
                                    <td class="">
                                        <a href="{{ route('prls.edit',$prl->id) }}" class="text-warning d-inline-block">Edit</a> | 
                                        <a href="{{ route('prls.destroy',$prl->id) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="top" onclick="return confirm('Do you want to delete this line? Are you sure?')" title="Delete">
                                            <i class="align-middle" data-feather="bell-off"></i>
                                        </a>
                                        
                                    </td>
                                </tr>
                        @endforeach

                            @if ($add)
                                @include('includes.pr-line-add')
                            @endif

                            <tr>
                                <td class="" colspan="5" scope="col">&nbsp;</td>
                                <td class="text-end" scope="col"><strong>Subtotal:</strong></td>
                                <td class="text-end" scope="col"><strong><x-list.my-number :value="$pr->subtotal"/></strong></td>
                                <td class="" scope="col">&nbsp</td>
                            </tr>

                            <tr>
                                <td class="" colspan="5" scope="col">&nbsp;</td>
                                <td class="text-end" scope="col">Tax:</td>
                                <td class="text-end" scope="col"><x-list.my-number :value="$pr->tax"/></td>
                                <td class="" scope="col">&nbsp</td>
                            </tr>
                            <tr>
                                <td class="" colspan="5" scope="col">&nbsp;</td>
                                <td class="text-end" scope="col">VAT:</td>
                                <td class="text-end" scope="col"><x-list.my-number :value="$pr->vat"/></td>
                                <td class="" scope="col">&nbsp</td>
                            </tr>
                            <tr>
                                <td class="" colspan="5" scope="col">&nbsp;</td>
                                <td class="text-end" scope="col"><strong>Total:</strong></td>
                                <td class="text-end" scope="col"><strong><x-list.my-number :value="$pr->amount"/></strong></td>
                                <td class="" scope="col">&nbsp</td>
                            </tr>
                       

                    </tbody>
                </table>
            </div>
        </div>
    </div>    
{{-- ============================================================== --}}