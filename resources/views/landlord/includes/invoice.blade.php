<div class="row">
	<div class="col-sm-12 col-md-12">
		<div class="card">
			<div class="card-body m-sm-3 m-md-5">

				<div class="row">
					<div class="col-md-6">
						<img class="rounded-circle rounded me-2 mb-2" src="{{ Storage::disk('s3l')->url('logo/logot.png') }}" alt="Logo" width="120" height="120">
						{{-- <div class="text-muted">Payment No.</div>
						<strong>741037024</strong> --}}
					</div>
					<div class="col-md-6 text-md-right">
						{{-- <div><span class="badge badge-subtle-primary">{{ strtoupper($invoice->status->name) }}</span></div> --}}

						<strong>INVOICE #{{ $invoice->invoice_no }}</strong>
						<span class="badge badge-subtle-primary">{{ strtoupper($invoice->status->name) }}</span>
						<p>
							{{ $config->name }}<br>
							{{ $config->address1 }}<br>
							@if ($config->address2 <> '' )
								{{ $config->address2 }}<br>
							@endif
							{{ $config->city . ', ' . $config->state . ', ' . $config->zip }}<br>
							{{ $config->relCountry->name }}<br>
							<a href="#">{{ $config->email }}</a>
						</p>

						@if ($invoice->status_code == App\Enum\Landlord\InvoiceStatusEnum::DUE->value)
							{{-- <form action="{{ url('/payment-stripe') }}" method="POST" class="needs-validation"> --}}
							<form action="{{ route('akk.process-subscription') }}" method="POST" class="needs-validation">
								<input type="hidden" value="{{ csrf_token() }}" name="_token" />
								<input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
								<button class="btn btn-danger btn-sm" type="submit">
									<i data-lucide="dollar-sign"></i> Pay Invoice
								</button>
							</form>
						@endif


					</div>
				</div>

				{{-- <hr class="my-4" />
				<div class="row">
					<div class="col-md-6">
						<div class="text-muted">Payment No.</div>
						<strong>741037024</strong>
					</div>
					<div class="col-md-6 text-md-right">
						<div class="text-muted">Payment Date</div>
						<strong>June 2, 2023 - 03:45 pm</strong>
					</div>
				</div> --}}

				<hr class="my-4" />

				<div class="row mb-4">
					<div class="col-md-6">
						<div class="text-muted">Client</div>
						<strong>{{ $account->name }}</strong>
						<p>
							{{ $account->address1 }}<br>
							@if ($account->address2 <> '' )
								{{ $account->address2 }}<br>
							@endif
							{{ $account->city . ', ' . $account->state . ', ' . $account->zip }}<br>
							{{ $account->relCountry->name }}<br>
							<a href="#">{{ $account->email }}</a>
						</p>
					</div>
					<div class="col-md-6 text-md-right">
						{{-- <div class="text-muted">Payment To</div>
						<strong>AppStack LLC</strong> --}}
						<p>
							Invoice : #{{ $invoice->invoice_no }}<br>
							Invoice date: {{ strtoupper(date('d-M-Y', strtotime($invoice->invoice_date))) }}<br>
							Due date: {{ strtoupper(date('d-M-Y', strtotime($invoice->due_date))) }}<br>
						</p>
					</div>
				</div>

				<table class="table table-sm">
					<thead>
						<tr>
							<th>Description</th>
							<th>Quantity</th>
							<th>Unit Price</th>
							<th class="text-end">Amount</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{!! nl2br($invoice->notes) !!}</td>
							<td>1</td>
							<td>${{ number_format($invoice->amount,2) }}</td>
							<td class="text-end">${{ number_format($invoice->amount,2) }}</td>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
							<th>Total </th>
							<th class="text-end">${{ number_format($invoice->amount,2) }}</th>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
							<th>Amount Paid </th>
							<th class="text-end">${{ number_format($invoice->amount_paid,2) }}</th>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
							<th>Due Balance</th>
							<th class="text-end">${{ number_format($invoice->amount-$invoice->amount_paid,2) }}</th>
						</tr>
					</tbody>
				</table>

				<div class="text-center">
					{{-- <p class="text-sm">
						<strong>Extra note:</strong> Please send all items at the same time to the shipping address. Thanks in advance.
					</p> --}}
					<a class="btn btn-primary" href="javascript:;" onclick="window.print(); return false;">
						<i data-lucide="printer"></i> Print This Invoice ***
					</a>

				</div>

			</div>
		</div>
	</div>
</div>
