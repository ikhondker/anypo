

# Invoice and payment
==================================================
1. Invoice create by two place: job- CreateInvoice and bo::createInvoiceForCheckout
2. Payment made from two place: bo::payCheckoutInvoice and HomeController.paymentStripe

- 1. create subscription invoice
	- process/index.blade.php
	- route('processes.gen-invoice-all')
	- ProcessController.genInvoiceAll
	- Billing::dispatch();
		- CreateInvoice::dispatch($account->id, 1);
		- <<TABLE>> $invoice->save();

- 2. pay subscription invoice
	- invoice/invoice.blade.php
	- url('/payment-stripe') => HomeController.paymentStripe
	- <<TABLE>> $payment->save();
	- checkout.success-payment => HomeController.successPayment
	- SubscriptionInvoicePaid::dispatch($payment->id);
	- bo::extendAccountValidity($invoice->id);
	- OK

- 3. checkout (Table CHECKOUT)
	- pricing.blade.php
	- route('home.checkout')  => HomeController.checkout => view('landlord.pages.checkout)
	- route('checkout-stripe') => HomeController.checkoutStripe
	- <<TABLE>> $checkout->save();
	- checkout.success => HomeController.success
	- CreateTenant::dispatch($checkout->id);
		bo::createServiceForCheckout($this->checkout_id);
		<<TABLE>> $service->save();
		bo::createInvoiceForCheckout($this->checkout_id);
		<<TABLE>>  $invoice->save();
		bo::payCheckoutInvoice($checkout->invoice_id );
		<<TABLE>>  $payment->save();

- 4. buy add-on (Table CHECKOUT)
	- service/index.blade.php
	- <x-landlord.widget.add-addon/>
	- route('accounts.add-addon', ['account_id' => $account->id, 'addon_id' => $addon->id]) }}
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


- 5. Advance invoice and pay (Table CHECKOUT)
	invoices/index.blade.php => 	route('invoices.generate')
	- InvoiceController.generate => view('landlord.admin.invoices.generate'
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


# budget
==================================================
assumption
1. for supplier not pr/po book update only pr/po approved
2. for project not pr/po book update only pr/po approved

PrBudget
	prBudgetApprove		amount_pr_issued++	count_pr+1
	prBudgetApproveCancel	amount_pr_issued--	count_pr-1
PoBudget
	poBudgetApprove		amount_po_issued++	count_po+1
	poBudgetApproveCancel	amount_po_issued--	count_po-1
Receipt
	store			amount_grs++		count_grs+1
	cancel			amount_grs--		count_grs-1
Invocie
	post			amount_invoice++	count_invoice+1
	cancle			amount_invoice--	count_invoice-1
Payment
	store			amount_payment++	count_payment+1
	cancel			amount_payment--	count_payment-1



			Source Helper						Called From
			--------------		----------------	---------------------
prBudgetBook		PrBudget		amount_pr_booked 	PrController->submit
prBudgetBookReverse	PrBudget		- amount_pr_booked 	WflController->rejected
									WfController->wfResetPr

prBudgetApprove+1	PrBudget					WflController->approved		update project and supplier
prBudgetApproveCancel+1	PrBudget					WfController->wfResetPr 	TBD
									PrController->cancel		TBD

poBudgetBook		PoBudget					PoController->submit
poBudgetBookReverse	PoBudget		- amount_po_booked	WflController->rejected
									WfController->wfResetPo

poBudgetApprove+1	PoBudget					WflController->approved		update project and supplier
poBudgetApproveCancel+1	PoBudget					WflController->rejected		update project and supplier
									WfController->wfResetPo 	TBD
									PrController->cancel		TBD

-- count
receipt.store+1
receipt.cancel-1

invoice.post+1
invoice.cancel-1


payment.store+1
payment.cancel-1

# PR
==================================================
pr->	save	syncPrValues
	update	syncPrValues
	recalcualte	syncPrValues
prl->	save	syncPrValues
pr->	submit	syncPrValues

#  PO
==================================================
