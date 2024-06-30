<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Ref/Cheque</th>
            <th class="text-end">Amount</th>
            <th>Currency</th>
            <th>Bank</th>
            <th>Supplier</th>
            <th>Inv Num</th>
            <th>PO#</th>
            <th>Paid By</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $payment)
        <tr>
            <td>{{ $payments->firstItem() + $loop->index }}</td>
            <td><x-tenant.list.my-date :value="$payment->pay_date"/></td>
                <td>{{ $payment->cheque_no }}</td>
                <td class="text-end"><x-tenant.list.my-number :value="$payment->amount"/></td>
                <td>{{ $payment->currency }}</td>
                <td>{{ $payment->bank_account->ac_name }}</td>
            <td>{{ $payment->invoice->supplier->name }}</td>
            <td><a class="text-info" href="{{ route('invoices.show',$payment->invoice_id) }}">{{ $payment->invoice->invoice_no }} </a> </td>
            <td><x-tenant.common.link-po id="{{ $payment->invoice->po_id }}"/></td>
            <td>{{ $payment->payee->name }} </td>
            <td><span class="badge {{ $payment->status_badge->badge }}">{{ $payment->status_badge->name}}</span></td>

            <td class="table-action">
                <a href="{{ route('payments.show',$payment->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                    <i class="align-middle" data-lucide="eye"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="row pt-3">
    {{ $payments->links() }}
</div>
<!-- end pagination -->
