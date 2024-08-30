
#  Data Access 
----------------------------------
Ref: ANYPO-objects-lists-20240507.xlsx -> access

# Page Header Buttons 
----------------------------
page	Button	Dropdown	Route
index	Create 
create	Save,List	
Actions	None	Yes		show,edit,history,attachment etc

# routes 
----------------------------
delete: where draft can be deleted like pr by use
cancel: where can not be deleted. Only cancel by admin. Like payment


# Tech:
- Attachments are in aws
- logo, avatar and assets are in amazon public

# PR
- 5 type list: @include('tenant.includes.pr.pr-lists-table')
	all (index) + my (my-prs) + recent (pr-lists-recent) + pending  (pr-lists-po-pending)	
pr.index : HoD+Buyer+CxO sees only approve PR lists	
	user: sees only his PR

- don't allow REJECTED PR to delete or cancel as it has dbu rows.
- only can submit own dept PR
- dept_budget_id set during submissions
- Function currency amounts is set during submit
- rejected pr can not be re-submitted. Instead copy
- User and HoD Can create only own department PR
- only buyer can convert to PO
- can delete only DRFT PR
- can NOT delete REJCTED PR as contain line in DBU
- can cancel REJECTED PR
- dynamic change of UoM code is in calculate-pr-amount.blade

# BUYER:
- buyer can view/edit ALL PO (except draft?)+ GRS+ Invoice (both)+ Payment , because 
		a. if any buyer left with partial paid PO or partially receipt PO
		b. buyer need to see all PO of a supplier to make decision
		c. Need to see all GRS
- create separate link with my PO
- NO one buyer can not see other buyers PO
- NO one buyer can not edit other buyer PO or edit line
- stop. currently can only sees own PO

# PO
- 5 type list: @include('tenant.includes.po.po-lists-table')
	all (index) + my (my-pos)+ recent (po-lists-recent) + supplier(ListBySupplier->list-by-supp) + project(ListByProject->list-by-project)
- buyer can create direly manual PO
- pos header requester_id not decided yet
- dynamic change of UoM code is in calculate-po-amount
 
# BUDGET
- not optional. use workaround . large budget amount and forget
- update by 
	- dept budget add/edit
	- pr submitted
	- pr cancels
	- pr workflow reset
	- po submitted
	- po cancels
	- po workflow reset

# PROJECT
- budget control is optional. should we make it mandatory and user workaround?
- 