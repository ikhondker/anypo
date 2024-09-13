
Issue Tracking Number::	2604202430-943
 CIF ID:	2045332
 Branch Name:	Bashundhara

# Widgets
-------------------------------------
php artisan make:component Tenant/Widgets/Pr/ShowPrHeader	<x-tenant.widgets.pr.show-pr-header id="{{ $pr->id }}"/>
php artisan make:component Tenant/Widgets/Pr/PrListsRecent		<x-tenant.widgets.pr.pr-lists-recent/>
php artisan make:component Tenant/Widgets/Pr/PrListsPoPending
xxphp artisan make:component Tenant/Widgets/Prl/EditPrLine
xphp artisan make:component Tenant/Widgets/Prl/ShowPrLines

xxphp artisan make:component Tenant/Widgets/Prl/Card
xxphp artisan make:component Tenant/Widgets/Prl/PrLinesTableHeader --view
xxphp artisan make:component Tenant/Widgets/Prl/CardTableHeader --view
php artisan make:component Tenant/Widgets/Prl/CardTableRow
php artisan make:component Tenant/Widgets/Prl/ListAllLines

php artisan make:component Tenant/Widgets/Wf/ApprovalHistory	<x-tenant.widgets.approval-history
php artisan make:component Tenant/Widgets/Wfl/GetApproval

php artisan make:component Tenant/Widgets/Po/ShowPoHeader	<x-tenant.widgets.po.show-po-header id="{{ $po->id }}"/>
php artisan make:component Tenant/Widgets/Po/Invoices
php artisan make:component Tenant/Widgets/Po/Payments
php artisan make:component Tenant/Widgets/Po/InvoicePayments
php artisan make:component Tenant/Widgets/Po/ListBySupplier
php artisan make:component Tenant/Widgets/Po/ListByProject
php artisan make:component Tenant/Widgets/Po/ListByBuyer
php artisan make:component Tenant/Widgets/Po/ListByDate
xxphp artisan make:component Tenant/Widgets/Po/PoLists

xxphp artisan make:component Tenant/Widgets/Pol/Card
php artisan make:component Tenant/Widgets/Pol/CardTableRow
php artisan make:component Tenant/Widgets/Pol/ListAllLines

php artisan make:component Tenant/Widgets/Pol/EditPoLine
php artisan make:component Tenant/Widgets/Pol/ShowPoLines
php artisan make:component Tenant/Widgets/Pol/PolReceipts


xxphp artisan make:component Tenant/Widgets/Pr/ListsPoPending
xxphp artisan make:component Tenant/Widgets/Submit 	<x-tenant.widgets.submit/>


# PR JS
--------------------------------------------------------------------
Where is jquery code? @include('tenant.includes.js.calculate-pr-amount')


# Final Components for PR 24-aug-24
-------------------------- ------------------------------------------

## prs.show
	<x-tenant.widgets.wfl.get-approval wfId="{{ $pr->wf_id }}" />
	<x-tenant.widgets.pr.show-pr-header prId="{{ $pr->id }}"/>
	<x-tenant.widgets.prl.list-all-lines prId="{{ $pr->id }}"/>
		<x-tenant.widgets.prl.card-table-row :line="$prl" :action="true"/>

## prs.edit
	Form
	<x-tenant.widgets.prl.list-all-lines prId="{{ $pr->id }}"/>

## prs.create
	Form
	@include('tenant.includes.pr.pr-line-add')

## prls.create
		<x-tenant.widgets.pr.show-pr-header prId="{{ $pr->id }}"/>
		loop {
			<x-tenant.widgets.prl.card-table-row :line="$prl"/>
		}
		@include('tenant.includes.pr.pr-line-add')

## prls.edit
		<x-tenant.widgets.pr.show-pr-header prId="{{ $pr->id }}"/>
		loop{
			<x-tenant.widgets.prl.card-table-row :line="$prln"/>
			@include('tenant.includes.pr.pr-line-edit')
		}

## prls.show
	N/A 403

## prs.attachment/extra/history/
	<x-tenant.info.pr-info id="{{ $pr->id }}"/>


# depricated Final Components for PR
-------------------------- ------------------------------------------
Overall Structure:

<x-tenant.widgets.prl.card :pr="$pr">
	@slot('lines')
	@endslot
</x-tenant.widgets.prl.card>


@slot('lines')
	<x-tenant.widgets.prl.card-table-row :line="$prl" :status="$pr->auth_status"/>
	or
	@include('tenant.includes.pr.pr-line-add')
	or
	@include('tenant.includes.pr.pr-line-edit')
@endslot

#  Final Detail Components for PR
-------------------------- ------------------------------------------
## prs.show
	<x-tenant.widgets.prl.card :pr="$pr">
		<x-tenant.widgets.prl.card-table-row :line="$prl" :status="$pr->auth_status"/>
	<x-tenant.widgets.wfl.get-approval wfid="{{ $pr->wf_id }}" />

## prs.edit
	From
	<x-tenant.widgets.prl.card :pr="$pr">
		<x-tenant.widgets.prl.card-table-row :line="$prl" :status="$pr->auth_status"/>

## prs.create
	Form
	<x-tenant.widgets.prl.card :readOnly="false" :addMore="true">
		@include('tenant.includes.pr.pr-line-add')

## prls.addLine
->prls.create
	<x-tenant.widgets.prl.card :pr="$pr" :readOnly="false" :addMore="true">
		<x-tenant.widgets.prl.card-table-row :line="$prl" :status="$pr->auth_status"/>
		@include('tenant.includes.pr.pr-line-add')

## prls.edit
	<x-tenant.widgets.prl.card :pr="$pr" :readOnly="false" :addMore="true">
		@include('tenant.includes.pr.pr-line-edit')
		<x-tenant.widgets.prl.card-table-row :line="$prln" :status="$pr->auth_status"/>

## prls.show
	N/A 403

## prs.attachment/extra/history/
	<x-tenant.info.pr-info id="{{ $pr->id }}"/>

#  OLD PO
================================================================
pos.show
old
	@include('tenant.includes.po.view-po-header')
	<x-tenant.widgets.po.lines :id="$po->id" :show="true"/>
	<!-- approval form, show only if pending to current auth user -->
	@if (\App\Helpers\Workflow::allowApprove($po->wf_id))
		@include('tenant.includes.wfl-approve-reject')
	@endif

new
	<x-tenant.widgets.pr.show-po-header id="{{ $po->id }}"/>
	<x-tenant.widgets.prl.show-pr-lines id="{{ $pr->id }}">
	<x-tenant.widgets.wfl.get-approval wfid="{{ $pr->wf_id }}" />

pos.create
	form
	@include('tenant.includes.po.po-line-add')
	@include('tenant.includes.po.po-footer-form')

pos.edit
	from
	<x-tenant.widgets.pol.show-po-lines id="{{ $po->id }}">

pos.attachment/extra/history/
	<x-tenant.info.po-info id="{{ $po->id }}"/>

pols.show
N/A

pols.create
	<x-tenant.widgets.po.show-po-header id="{{ $po->id }}"/>
	<x-tenant.widgets.pol.show-po-lines id="{{ $po->id }}">
		@include('tenant.includes.po.po-line-add')
		@include('tenant.includes.po.po-footer-form')
	</x-tenant.widgets.pol.show-po-lines>

pols.edit
	<x-tenant.widgets.pol.edit-po-line poid="{{ $po->id }}" polid="{{ $pol->id }}"/>


PR & PRL:
 Route::resource('prs', PrController::class)->middleware(['auth', 'verified']);
Route::get('/pr/export',[PrController::class,'export'])->name('prs.export');
Route::get('/prs/pdf/{pr}',[PrController::class,'pdf'])->name('prs.pdf');
Route::get('/prs/delete/{pr}',[PrController::class,'destroy'])->name('prs.destroy');
Route::post('/pr/attach',[PrController::class,'attach'])->name('prs.attach');
Route::get('/prs/detach/{pr}',[PrController::class,'detach'])->name('prs.detach');
Route::get('/prs/submit/{pr}',[PrController::class, 'submit'])->name('prs.submit');

Route::get('/prls/createline/{id}',[PrlController::class, 'createLine'])->name('prls.createline');

prs.index	=> as usaul

prs.show	@include('includes.view-pr-header')
		<x-widgets.pr-lines id="{{ $pr->id }}" :show="true"/>
			@include('includes.pr-line-add')
			@include('includes.pr-footer-add')
			@include('includes.pr-footer-edit')
						@include('includes.pr-footer-view')
		@include('includes.wfl-approve-reject')
		<x-widgets.approval-history id="{{ $pr->wf_id }}"/>
prs.edit

prs.create	header+
		@include('includes.pr-line-add')
				@include('includes.pr-footer-add')
prls.createline
		@include('includes.view-pr-header')
		<x-widgets.pr-lines id="{{ $pr->id }}" :add="true"/>
			 @include('includes.pr-line-add')
						 @include('includes.pr-footer-edit') <=================
prls.edit
		 @include('includes.view-pr-header')
		<x-widgets.pr-lines id="{{ $pr->id }}" :edit="true" pid="{{ $prl->id }}"/>
		<x-widgets.approval-history id="{{ $pr->wf_id }}"/>
			@include('includes.pr-line-edit')
 			@include('includes.pr-footer-edit')
