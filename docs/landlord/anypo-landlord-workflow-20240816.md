# 9. Business Flow 
====================================================================
1. Pricing->Checkout->Stripe Success(provision=Create User+Account+Service i.e. Purchase)->upgrade => bill next cycle
2. Register->Login->Pricing->Checkout->Success(provision=Create Account+service i.e. Purchase)->upgrade => bill next cycle
3. Invoice type: checkout->invoice_type
4. Table account. column: next_bill_generated, next_invoice_no, last_bill_date
5. job->CreateTenant->createCheckoutAccount : Defaulted


# 8. Invoice and Payment Codes
==================================================
1. Invoice created by three place: job- 
	- CreateInvoice: called form where?
	- bo::createInvoiceForCheckout, : called form where 
	- Process: scheduled

2. Payment made from three place: 
	- bo::payCheckoutInvoice and 
	- HomeController.paymentStripe
    - InvoiceController.payPwop

# 7. Regular Checkout (Table CHECKOUT)
====================================================================
~~~
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
~~~

# 6. Advance invoice and pay (Table CHECKOUT)
====================================================================
~~~
- invoices/index.blade.php => 	route('invoices.generate') 
- InvoiceController.generate => view('landlord.admin.invoices.generate')
- route('invoices.store') 
- <<TABLE>> set $checkout->end_date	
- <<TABLE>> $checkout->save();
- route('checkout.success-advance') => HomeController.successAdvance
- AddAdvance::dispatch($checkout->id);
- bo::createInvoiceForCheckout($this->checkout_id);
	<<TABLE>>  $invoice->save();
- bo::payCheckoutInvoice($checkout->invoice_id );
	<<TABLE>>  $payment->save();
- bo::extendAccountValidity($invoice_id);
- Ok
~~~

# 5. Buy add-on buy process (Table CHECKOUT)
====================================================================
1. Stop if any unpaid invoice
2. add buy user in account page
3. upon confirmation add row in checkout with addon = true and lunch stripe payment
4. upon successful payment
	- create invoice
	- create payment
	- create service row
	- update account user limit and price
	- Done

~~~
- service/index.blade.php
- <x-landlord.widget.add-addon/>
- route('accounts.add-addon', ['account_id' => $account->id, 'addon_id' => $addon->id])
- AccountController.addAddon
- <<TABLE>> set $checkout->end_date	
- <<TABLE>> $checkout->save();
-> Stripe ->
- route('checkout.success-addon') => HomeController.successAddon
- AddAddon::dispatch($checkout->id);
- bo::createServiceForCheckout($this->checkout_id);
- bo::createInvoiceForCheckout($this->checkout_id);
	<<TABLE>>  $invoice->save();
- bo::payCheckoutInvoice($checkout->invoice_id );
	<<TABLE>>  $payment->save();
$account->user		= $account->user + $addon->user;
$account->price		= $account->price + $addon->price;
<<TABLE>> $account->save();
$checkout->status_code = LandlordCheckoutStatusEnum::COMPLETED->value;
<<TABLE>> $checkout->update();
~~~

# 4. create Monthly Subscription Invoice (by Billing Process)
====================================================================
~~~
- process/index.blade.php
- route('processes.gen-invoice-all')
- ProcessController.genInvoiceAll
- ProcessBilling::dispatch();
- CreateMonthlyInvoice::dispatch($account->id, 1, $process->id);
- <<TABLE>> $invoice->save();
~~~

# 3. Pay Generated Subscription Invoice
====================================================================
- invoice/invoice.blade.php 
- url('/payment-stripe') => HomeController.paymentStripe
- <<TABLE>> $payment->save();
- checkout.success-payment => HomeController.successPayment
- SubscriptionInvoicePaid::dispatch($payment->id);
- bo::extendAccountValidity($invoice->id);
- OK



# 1. bill and payment cycle 
====================================================================
- need to update
- InvoiceController->createSubscriptionInvoice: Set
- job->SubscriptionInvoicePaid : reset
- addon - none
