<table class="table">
    <thead>
        <tr>

            <th>#</th>
            <th>Date</th>
            <th>Supplier</th>
            <th>INV NO#</th>
            <th>Summary</th>
            <th>Currency</th>
            <th class="text-end">Amount</th>
            <th class="text-end">Paid</th>
            <th>PO#</th>
            <th>Status</th>
            <th>Pay Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $invoice)
        <tr>
            <td>{{ $invoices->firstItem() + $loop->index }}</td>
            <td><x-tenant.list.my-date :value="$invoice->invoice_date"/></td>
            <td>{{ $invoice->supplier->name }}</td>
            <td>{{ $invoice->invoice_no }}</td>
            <td>{{ $invoice->summary }}</td>
            <td>{{ $invoice->currency }}</td>
            <td class="text-end"><x-tenant.list.my-number :value="$invoice->amount"/></td>
            <td class="text-end"><x-tenant.list.my-number :value="$invoice->paid_amount"/></td>
            <td><x-tenant.common.link-po id="{{ $invoice->po_id }}"/></td>
            <td><span class="badge {{ $invoice->status_badge->badge }}">{{ $invoice->status_badge->name}}</span></td>
            <td><span class="badge {{ $invoice->pay_status_badge->badge }}">{{ $invoice->pay_status_badge->name}}</span></td>
            <td class="table-action">
                <x-tenant.list.actions object="Invoices" :id="$invoice->id"/>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="row pt-3">
    {{ $invoices->links() }}
</div>
<!-- end pagination -->
