
# 4. Flow 
====================================================================
1. Pricing->Checkout->Stripe Success(provision=Create User+Account+Service i.e. Purchase)->upgrade => bill next cycle
2. Register->Login->Pricing->Checkout->Success(provision=Create Account+service i.e. Purchase)->upgrade => bill next cycle
3. Invoice type: checkout->invoice_type
4. Table account. column: next_bill_generated, next_invoice_no, last_bill_date
5. job->CreateTenant->createCheckoutAccount : Defaulted


# 3. Invoice and payment
==================================================
1. Invoice created by three place: job- CreateInvoice and bo::createInvoiceForCheckout, Process
2. Payment made from two place: bo::payCheckoutInvoice and HomeController.paymentStripe

## 1. create Subscription Invoice
	- process/index.blade.php
	- route('processes.gen-invoice-all')
	- ProcessController.genInvoiceAll
	- Billing::dispatch();
		- CreateInvoice::dispatch($account->id, 1);
		- <<TABLE>> $invoice->save();

## 2. Pay Subscription Invoice
	- invoice/invoice.blade.php 
	- url('/payment-stripe') => HomeController.paymentStripe
	- <<TABLE>> $payment->save();
	- checkout.success-payment => HomeController.successPayment
	- SubscriptionInvoicePaid::dispatch($payment->id);
	- bo::extendAccountValidity($invoice->id);
	- OK

## 3. Checkout (Table CHECKOUT)
	- pricing.blade.php 
	- route('home.checkout')  => HomeController.checkout => view('landlord.pages.checkout)
	- route('checkout-stripe') => HomeController.checkoutStripe
	- <<TABLE>> $checkout->save();
	- checkout.success => HomeController.success
	- CreateTenant::dispatch($checkout->id);
		bo::createInvoiceForCheckout($this->checkout_id);
		<<TABLE>> $service->save();
		bo::createInvoiceForCheckout($this->checkout_id);
		<<TABLE>>  $invoice->save();
		bo::payCheckoutInvoice($checkout->invoice_id );
		<<TABLE>>  $payment->save();

## 4. buy addon (Table CHECKOUT)
	- service/index.blade.php
	- <x-landlord.widget.add-addon/>
	- route('accounts.add-addon', ['account_id' => $account->id, 'addon_id' => $addon->id])
	- AccountController.addAddon
	- <<TABLE>> $checkout->save();
	- set $checkout->end_date	
	- route('checkout.success-addon') => HomeController.successAddon
	- AddAddon::dispatch($checkout->id);
	- bo::createInvoiceForCheckout($this->checkout_id);
		<<TABLE>>  $invoice->save();
	- bo::payCheckoutInvoice($checkout->invoice_id );
		<<TABLE>>  $payment->save();

	?? bo::createInvoiceForCheckout($this->checkout_id); check


## 5. Advance invoice and pay (Table CHECKOUT)
	invoices/index.blade.php => 	route('invoices.generate') 
	- InvoiceController.generate => view('landlord.admin.invoices.generate')
	- route('invoices.store') 
	- <<TABLE>> $checkout->save();
	- set $checkout->end_date	
	- route('checkout.success-advance') => HomeController.successAdvance
	- Advance::dispatch($checkout->id);
	- bo::createInvoiceForCheckout($this->checkout_id);
		<<TABLE>>  $invoice->save();
	- bo::payCheckoutInvoice($checkout->invoice_id );
		<<TABLE>>  $payment->save();
	- bo::extendAccountValidity($invoice_id);
	- Ok


# 2. bill and payment cycle 
====================================================================
need to update

6. InvoiceController->createSubscriptionInvoice: Set
7. job->SubscriptionInvoicePaid : reset
8. addon - none


# 1. Functional details 
====================================================================

1. Generate and Pay invoice by end user
	<a class="btn btn-primary btn-sm" href="{{ route('invoices.generate') }}">
		<i class="bi bi-plus-square me-1"></i> Generate Invoice
	</a>
2. storage as addon
3. Only admin  user can be added as add on
4. check if can mere checkout create row both form check out and buy add-on

-- add-on buy process
1. Stop if any unpaid invoice
2. add buy user in account page
3. upon confirmation add row in checkout with addon = true and lunch stripepayment
4. upon successful payment
	- create invoice
	- create payment
	- create service row
	- update account user limit ad n price
	- Done
