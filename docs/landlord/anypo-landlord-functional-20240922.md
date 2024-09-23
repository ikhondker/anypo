

# 5. Business Rules
====================================================================
1. There will be maximum one unpaid invoice. Wont be able to create invoice if have any unpaid invoice
2. Invoice cancellation is not possible
3. no space limit for in P1
4. Not possible to integrated any existing anypo user into a current account. may be P2
5. now upto 4 decimal price round down in advance pay P2
6. close account P2
7. manual join to mailing list P2
8. separate notification TicketCreated.php for user and support P2



# 4. Functional Details 
====================================================================
1. new tenat is create form two places HomeController.Success and TenantController.store
2. Only admin  user can be add add-on
3. check if can mere checkout create row both form check out and buy add-on
4. Generate and Pay invoice by end admin user
~~~blade
	<a class="btn btn-primary btn-sm" href="{{ route('invoices.generate') }}">
		<i class="bi bi-plus-square me-1"></i> Generate Invoice
	</a>
~~~

# 3. Design Consideration
====================================================================
1. Intentionally kept index and all, have duplicate code. however keep separate so that back office can have separate interface. also export separate
2. 

# 2. Assumption and limitation
====================================================================
1. Used the same User model for both landlord and tenant
2. End use wont have access to notification only email . Only Backoffice may have access to notification
3. User can not register to an existing account. Account admin need to create user.
4. Add-on buy will be free and will be charge form next bill cycle (check??)
5. Completely remove JS form footer.blade.php check.!!?
6. Can not just create advance invoices. Must have to pay to accept
7. add-on how the date and charge is fined?

# 1. Pricing
====================================================================
## 1. Current
	default 5 user 	list price 30 actual 25$
	3 addition user 	19 - 15
	5 	addition user 	29-25

## 2 Initial
	in price page no multiple options
	14.99$/user min 3 user i.e. 45$/Month
	9.99$/user min 3 user i.e. 29$/Month
	then per user 6.99$ in a bundle of 3 18$
	archive mode 9.99$/month

## 3 Account Creation
	- 1 month without any add-on
	- can create 3/6/12 month invoice if no earlier due, which
	- invoice extend account validity

## 4 Add-on
	- add-on is NOT monthly basis
	- can add/remove any time
	- if current billing is one month will be added from next bill. do the same when cancel
	- if current billing is 3/6/12 month, the account validity is reduce accordingly. reverse when cancel
	- what happened if not enough days to adjust => add next cycle
	- what happened if multiple add-on is bought consecutively?
	- Everything is in services.index when account_id <> '


# 1. Account Creation and update
====================================================================
- create
	HomeCOntroller->CreateTenant::dispatch($checkout->id);->self::createCheckoutAccount($this->checkout_id);
- update
	HomeCOntroller->AddAddon::dispatch($checkout->id);