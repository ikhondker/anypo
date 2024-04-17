<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Sequence of Web Routes for ANYPO.NET
|--------------------------------------------------------------------------
|  1. Tenant Public routes (No Auth Required)
|  2. Tenant routes Need Auth and Email Verification
|  3. Tenant Back Office Routes (Need Auth+ Email Verification + can:access-back-office)
|  4. Tenant Old Public+Auth Routes (Need to Check)
|  5. Tenant Route for Testing purpose and Misc Routes (Ony For back Office)
|  6. 
|  7. 
*/

use App\Http\Controllers\Tenant\TestController;
//use App\Http\Controllers\ImpersonateController;

use App\Http\Controllers\Tenant\Admin\ActivityController;
use App\Http\Controllers\Tenant\Admin\AttachmentController;
use App\Http\Controllers\Tenant\Admin\SetupController;
use App\Http\Controllers\Tenant\Admin\UserController;

use App\Http\Controllers\Tenant\Lookup\CategoryController;
use App\Http\Controllers\Tenant\Lookup\CountryController;
use App\Http\Controllers\Tenant\Lookup\CurrencyController;
use App\Http\Controllers\Tenant\Lookup\DeptController;
use App\Http\Controllers\Tenant\Lookup\DesignationController;
//use App\Http\Controllers\Tenant\Lookup\GroupController;
use App\Http\Controllers\Tenant\Lookup\ItemController;
use App\Http\Controllers\Tenant\Lookup\OemController;
use App\Http\Controllers\Tenant\Lookup\PayMethodController;

use App\Http\Controllers\Tenant\Lookup\RateController;
use App\Http\Controllers\Tenant\Lookup\SupplierController;
use App\Http\Controllers\Tenant\Lookup\UomController;
use App\Http\Controllers\Tenant\Lookup\UploadItemController;
use App\Http\Controllers\Tenant\Lookup\WarehouseController;
use App\Http\Controllers\Tenant\Lookup\BankAccountController;

use App\Http\Controllers\Tenant\Manage\EntityController;
use App\Http\Controllers\Tenant\Manage\MenuController;
use App\Http\Controllers\Tenant\Manage\TableController;
use App\Http\Controllers\Tenant\Manage\TemplateController;
use App\Http\Controllers\Tenant\Manage\StatusController;
use App\Http\Controllers\Tenant\Manage\CustomErrorController;

use App\Http\Controllers\Tenant\Workflow\HierarchyController;
//use App\Http\Controllers\Tenant\Workflow\HierarchylController;
use App\Http\Controllers\Tenant\Workflow\WfController;
use App\Http\Controllers\Tenant\Workflow\WflController;

use App\Http\Controllers\Tenant\Support\TicketController;

use App\Http\Controllers\Tenant\BudgetController;
use App\Http\Controllers\Tenant\DeptBudgetController;
use App\Http\Controllers\Tenant\DbuController;

use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Controllers\Tenant\NotificationController;

use App\Http\Controllers\Tenant\PrController;
use App\Http\Controllers\Tenant\PrlController;
use App\Http\Controllers\Tenant\PoController;
use App\Http\Controllers\Tenant\PolController;
use App\Http\Controllers\Tenant\ProjectController;
use App\Http\Controllers\Tenant\ReceiptController;
use App\Http\Controllers\Tenant\InvoiceController;
//use App\Http\Controllers\Tenant\InvoiceLinesController;
use App\Http\Controllers\Tenant\PaymentController;
use App\Http\Controllers\Tenant\AelController;
use App\Http\Controllers\Tenant\ReportController;


use App\Http\Controllers\Tenant\HomeController;
// TODO Check
//use App\Http\Controllers\FileAccessController;
//use App\Http\Controllers\DocController;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Helpers\GetRate;
use Illuminate\Support\Facades\Log;

//use App\Jobs\SendEmailJob;
/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/
// 'auth', 'verified','can:access-back-office'


/**
* ==================================================================================
* 1. Tenant Public routes (No Auth Required)
* ==================================================================================
*/
Route::middleware([
	'web',
	InitializeTenancyByDomain::class,
	PreventAccessFromCentralDomains::class,
	])->group(function () {

		/* ======================== make auth universal ========================================  */
		Route::middleware(['universal'])->namespace('App\\Http\\Controllers\\')->group(function () { 
			Auth::routes(); 
		});
	
		// IQBAL 28-feb-23
		Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

		/* ======================== Email Verification======================================== */
		Route::get('/email/verify', function () {
			return view('auth.verify-email');
		})->middleware('auth')->name('verification.notice');

		Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
			$request->fulfill();
			return redirect('/home');
		})->middleware(['auth', 'signed'])->name('verification.verify');

		Route::post('/email/verification-notification', function (Request $request) {
			$user = User::where('email',$request->input('email'))->first();
			$user->sendEmailVerificationNotification();
			//$request->user()->sendEmailVerificationNotification();
			//return back()->with('message', 'Verification link sent!');
			return back()->with('success','Verification link sent! Please check your mail and clink on "Verify Email Address" link.');

		})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

		// TODO Check
		Route::get('/tos', function () {
			return view('tenant.pages.tos');
		})->name('tos');

		Route::get('/privacy', function () {
			return view('tenant.pages.privacy');
		})->name('privacy');
});

/**
* ==================================================================================
* 2. Tenant Routes (Need Auth and Email Verification)
* ==================================================================================
*/
Route::middleware([
	'web','auth', 'verified',
	InitializeTenancyByDomain::class,
	PreventAccessFromCentralDomains::class,
	])->group(function () {

		/* ======================== Home Controller ======================================== */
		Route::get('/home', [DashboardController::class, 'index'])->name('home');
		Route::get('/help', [HomeController::class, 'help'])->name('help');
		Route::get('/get-started', function () {
			return view('tenant.pages.get-started');
		})->name('get-started');

		/* ======================== Dashboard ========================================  */
		Route::resource('dashboards', DashboardController::class);
		Route::get('/', [DashboardController::class, 'index'])->name('home');
		//TODO enable verify middleware for all route
		//Route::get('/home', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
		//Route::resource('dashboards', DashboardController::class);

		/* ======================== User ========================================  */
		Route::resource('users', UserController::class);
		Route::get('/users/delete/{user}',[UserController::class, 'destroy'])->name('users.destroy');
		// TOTO check ->middleware(['auth', 'verified']) for the rest
		Route::get('users.password/{user}',[UserController::class, 'password'])->name('users.password');
		Route::post('users/changepass/{user}',[UserController::class, 'changepass'])->name('users.changepass');
		Route::get('/user/export',[UserController::class, 'export'])->name('users.export');
		//TODO remove next two used in footer
		Route::get('/user/role',[UserController::class, 'role'])->name('users.role');
		Route::get('/user/updaterole/{user}/{role}',[UserController::class, 'updaterole'])->name('users.updaterole');
		//Route::get('/user/image/{filename}',[UserController::class, 'image'])->name('users.image');
		// TODO
		//Route::get('/user/enable/{user}',[UserController::class, 'enable'])->name('users.enable');

		/* ======================== Activity ======================================== */
		Route::resource('activities', ActivityController::class);
		Route::get('/activity/export',[ActivityController::class, 'export'])->name('activities.export');

		/* ======================== Attachment ======================================== */
		Route::resource('attachments', AttachmentController::class);
		Route::get('/attachment/export',[AttachmentController::class,'export'])->name('attachments.export');
		Route::get('/attachments/delete/{attachment}',[AttachmentController::class,'destroy'])->name('attachments.destroy');
		Route::get('/attachments/download/{fileName}',[AttachmentController::class, 'download'])->name('attachments.download');

		/* ======================== Notification ======================================== */
		Route::resource('notifications', NotificationController::class);
		Route::get('/notification/all',[NotificationController::class, 'all'])->name('notifications.all');
		Route::get('/notifications/read/{notification}',[NotificationController::class, 'read'])->name('notifications.read');
		Route::get('/notification/purge',[NotificationController::class, 'purge'])->name('notifications.purge');
		Route::get('/notifications/delete/{notification}',[NotificationController::class, 'destroy'])->name('notifications.destroy');

		/* ======================== Country ======================================== */
		Route::resource('countries', CountryController::class);
		Route::get('/country/export',[CountryController::class,'export'])->name('countries.export');
		Route::get('/countries/delete/{country}',[CountryController::class, 'destroy'])->name('countries.destroy');

		/* ======================== Currency ======================================== */
		Route::resource('currencies', CurrencyController::class);
		Route::get('/currency/export',[CurrencyController::class,'export'])->name('currencies.export');
		Route::get('/currencies/delete/{currency}',[CurrencyController::class, 'destroy'])->name('currencies.destroy');

		/* ======================== Setup ======================================== */
		Route::resource('setups', SetupController::class);
		// CHECK
		Route::get('setups/image/{filename}',[SetupController::class, 'image'])->name('setups.image');
		Route::get('setups/announcement/{setup}', [SetupController::class, 'notice'])->name('setups.announcement');
		Route::post('setups/update-notice/{setup}', [SetupController::class, 'updateNotice'])->name('setups.update-notice');
		Route::get('setups/tc/{setup}', [SetupController::class, 'tc'])->name('setups.tc');
		Route::post('setups/update-tc/{setup}', [SetupController::class, 'updateTc'])->name('setups.update-tc');
		Route::post('setups/freeze/{setup}', [SetupController::class, 'freeze'])->name('setups.freeze');
		
		/* ======================== Dept (template)======================================== */
		Route::resource('depts', DeptController::class);
		Route::get('/dept/export',[DeptController::class, 'export'])->name('depts.export');
		Route::get('/depts/delete/{dept}',[DeptController::class, 'destroy'])->name('depts.destroy');

		/* ======================== Designation ======================================== */
		Route::resource('designations', DesignationController::class);
		Route::get('/designation/export',[DesignationController::class, 'export'])->name('designations.export');
		Route::get('/designations/delete/{designation}',[DesignationController::class, 'destroy'])->name('designations.destroy');

		/* ======================== TODO Group ======================================== */
		Route::resource('groups', GroupController::class);
		//Route::get('/group/export',[GroupController::class,'export'])->name('groups.export');
		//Route::get('/groups/delete/{group}',[GroupController::class,'destroy'])->name('groups.destroy');

		/* ======================== Warehouse ======================================== */
		Route::resource('warehouses', WarehouseController::class);
		Route::get('/warehouse/export',[WarehouseController::class,'export'])->name('warehouses.export');
		Route::get('/warehouses/delete/{warehouse}',[WarehouseController::class,'destroy'])->name('warehouses.destroy');

		/* ======================== BankAccount ======================================== */
		Route::resource('bank-accounts', BankAccountController::class);
		Route::get('/bank-account/export',[BankAccountController::class,'export'])->name('bank-accounts.export');
		Route::get('/bank-accounts/delete/{bankAccount}',[BankAccountController::class,'destroy'])->name('bank-accounts.destroy');
		Route::post('/bank-account/attach',[BankAccountController::class,'attach'])->name('bank-accounts.attach');
		//Route::get('/bank-accounts/attachments/{bankAccount}',[BankAccountController::class,'attachments'])->name('bank-accounts.detach');

		/* ======================== Category ======================================== */
		Route::resource('categories', CategoryController::class);
		Route::get('/category/export',[CategoryController::class, 'export'])->name('categories.export');
		Route::get('/categories/delete/{category}',[CategoryController::class, 'destroy'])->name('categories.destroy');

		/* ======================== Uom ======================================== */
		Route::resource('uoms', UomController::class);
		Route::get('/uom/export',[UomController::class,'export'])->name('uoms.export');
		Route::get('/uoms/delete/{uom}',[UomController::class,'destroy'])->name('uoms.destroy');
		Route::get('/uoms/get-uoms-by-class/{uom_class_id}',[UomController::class, 'getUomsByClass'])->name('uoms.get-uoms-by-class');

		/* ======================== Oem ======================================== */
		Route::resource('oems', OemController::class);
		Route::get('/oem/export',[OemController::class,'export'])->name('oems.export');
		Route::get('/oems/delete/{oem}',[OemController::class,'destroy'])->name('oems.destroy');

		/* ======================== Supplier ======================================== */
		Route::resource('suppliers', SupplierController::class);
		Route::get('/supplier/spends',[SupplierController::class,'spends'])->name('suppliers.spends');
		Route::get('/supplier/export',[SupplierController::class,'export'])->name('suppliers.export');
		Route::get('/suppliers/delete/{supplier}',[SupplierController::class,'destroy'])->name('suppliers.destroy');

		/* ======================== Project ======================================== */
		Route::resource('projects', ProjectController::class);
		Route::post('/project/attach',[ProjectController::class,'attach'])->name('projects.attach');
		Route::get('/projects/attachments/{project}',[ProjectController::class,'attachments'])->name('projects.attachments');
		Route::get('/project/export',[ProjectController::class,'export'])->name('projects.export');
		Route::get('/projects/delete/{project}',[ProjectController::class,'destroy'])->name('projects.destroy');
		Route::get('/projects/budget/{project}',[ProjectController::class,'budget'])->name('projects.budget');

		/* ======================== Budget ======================================== */
		Route::resource('budgets', BudgetController::class);
		Route::get('/budget/export',[BudgetController::class,'export'])->name('budgets.export');
		Route::get('/budgets/delete/{budget}',[BudgetController::class,'destroy'])->name('budgets.destroy');
		Route::post('/budget/attach',[BudgetController::class,'attach'])->name('budgets.attach');
		Route::get('/budgets/attachments/{budget}',[BudgetController::class,'attachments'])->name('budgets.attachments');
		
		/* ======================== Item ======================================== */
		Route::resource('items', ItemController::class);
		Route::get('/item/export',[ItemController::class,'export'])->name('items.export');
		Route::get('/items/delete/{item}',[ItemController::class,'destroy'])->name('items.destroy');
		Route::get('/items/get-item/{item}',[ItemController::class, 'getItem'])->name('items.get-item');

		/* ======================== Hierarchy ======================================== */
		Route::resource('hierarchies', HierarchyController::class);
		Route::get('/hierarchy/export',[HierarchyController::class,'export'])->name('hierarchies.export');
		Route::get('/hierarchies/delete/{hierarchy}',[HierarchyController::class,'destroy'])->name('hierarchies.destroy');

		/* ======================== Wf ======================================== */
		Route::resource('wfs', WfController::class);
		Route::get('/wf/export',[WfController::class,'export'])->name('wfs.export');
		//Route::get('/wf/get-reset-pr-num',[WfController::class,'getResetPrNum'])->name('wfs.get-reset-pr-num');
		Route::get('/wfs/wf-reset-pr/{pr}',[WfController::class,'wfResetPr'])->name('wfs.wf-reset-pr');
		//Route::get('/wf/get-reset-po-num',[WfController::class,'getResetPoNum'])->name('wfs.get-reset-po-num');
		Route::get('/wfs/wf-reset-po/{po}',[WfController::class,'wfResetPo'])->name('wfs.wf-reset-po');

		/* ======================== Wfl ======================================== */
		Route::resource('wfls', WflController::class);
		Route::get('/wfl/export',[WflController::class,'export'])->name('wfls.export');
		Route::get('/wfls/delete/{wfl}',[WflController::class,'destroy'])->name('wfls.destroy');

		/* ======================== DeptBudget ======================================== */
		Route::resource('dept-budgets', DeptBudgetController::class);
		Route::get('/dept-budget/export',[DeptBudgetController::class,'export'])->name('dept-budgets.export');
		//TODO
		Route::get('/dept-budgets/delete/{deptBudget}',[DeptBudgetController::class,'destroy'])->name('dept-budgets.destroy');
		//Route::get('/dept-budgets/revision/{deptBudget}',[DeptBudgetController::class,'revision'])->name('dept-budgets.revision');
		Route::post('/dept-budget/attach',[DeptBudgetController::class,'attach'])->name('dept-budgets.attach');
		Route::get('/dept-budgets/attachments/{deptBudget}',[DeptBudgetController::class,'attachments'])->name('dept-budgets.attachments');
		Route::get('/dept-budgets/budget/{deptBudget}',[DeptBudgetController::class,'budget'])->name('dept-budgets.budget');

		/* ======================== Dbu ======================================== */
		Route::resource('dbus', DbuController::class);
		Route::get('/dbu/export',[DbuController::class,'export'])->name('dbus.export');
		Route::get('/dbus/delete/{dbu}',[DbuController::class,'destroy'])->name('dbus.destroy');

		/* ======================== Pr ======================================== */
		Route::resource('prs', PrController::class);
		Route::get('/prs/attachments/{pr}',[PrController::class,'attachments'])->name('prs.attachments');
		Route::post('/pr/attach',[PrController::class,'attach'])->name('prs.attach');

		Route::get('/pr/export',[PrController::class,'export'])->name('prs.export');
		Route::get('/prs/pdf/{pr}',[PrController::class,'pdf'])->name('prs.pdf');
		Route::get('/prs/delete/{pr}',[PrController::class,'destroy'])->name('prs.destroy');
		Route::get('/prs/cancel/{pr}',[PrController::class,'cancel'])->name('prs.cancel');
		Route::get('/prs/recalculate/{pr}',[PrController::class,'recalculate'])->name('prs.recalculate');
		Route::get('/prs/history/{pr}',[PrController::class,'history'])->name('prs.history');
		Route::get('/prs/extra/{pr}',[PrController::class,'extra'])->name('prs.extra');
		
		Route::get('/prs/submit/{pr}',[PrController::class, 'submit'])->name('prs.submit');
		Route::get('/prs/copy/{pr}',[PrController::class, 'copy'])->name('prs.copy');
		Route::get('/prs/convert-to-po/{pr}',[PrController::class, 'convertPo'])->name('prs.convert');
			
		/* ======================== Prl ======================================== */
		Route::resource('prls', PrlController::class);
		Route::get('/prl/export',[PrlController::class,'export'])->name('prls.export');
		Route::get('/prls/delete/{prl}',[PrlController::class,'destroy'])->name('prls.destroy');
		Route::get('/prls/add-line/{pr}',[PrlController::class, 'addLine'])->name('prls.add-line');
		// TODO pol cancel here

		/* ======================== Po ======================================== */
		Route::resource('pos', PoController::class);
		//Route::get('/pos/pdf/{po}',[PoController::class,'pdf'])->name('pos.pdf');
		Route::get('/pos/attachments/{po}',[PoController::class,'attachments'])->name('pos.attachments');
		Route::post('/po/attach',[PoController::class,'attach'])->name('pos.attach');
		Route::get('/po/export',[PoController::class,'export'])->name('pos.export');
		Route::get('/pos/delete/{po}',[PoController::class,'destroy'])->name('pos.destroy');
		Route::get('/pos/cancel/{po}',[PoController::class,'cancel'])->name('pos.cancel');
		Route::get('/pos/extra/{po}',[PoController::class,'extra'])->name('pos.extra');
		Route::get('/pos/close/{po}',[PoController::class,'close'])->name('pos.close');
		Route::get('/pos/open/{po}',[PoController::class,'open'])->name('pos.open');
		Route::get('/pos/history/{po}',[PoController::class,'history'])->name('pos.history');
		Route::get('/pos/invoice/{po}',[PoController::class,'invoice'])->name('pos.invoice');
		Route::get('/pos/ael/{po}',[PoController::class,'ael'])->name('pos.ael');

		Route::get('/pos/submit/{po}',[PoController::class, 'submit'])->name('pos.submit');
		Route::get('/pos/copy/{po}',[PoController::class, 'copy'])->name('pos.copy');

		/* ======================== Pol ======================================== */
		Route::resource('pols', PolController::class);
		Route::get('/pol/export',[PolController::class,'export'])->name('pols.export');
		Route::get('/pols/delete/{pol}',[PolController::class,'destroy'])->name('pols.destroy');
		Route::get('/pols/add-line/{po}',[PolController::class, 'addLine'])->name('pols.add-line');
		Route::get('/pols/receipt/{pol}',[PolController::class,'receipt'])->name('pols.receipt');
		Route::get('/pols/ael/{pol}',[PolController::class,'ael'])->name('pols.ael');

		/* ======================== Receipt ======================================== */
		Route::resource('receipts', ReceiptController::class);
		Route::get('/receipts/create/{pol}',[ReceiptController::class,'create'])->name('receipts.create');
		Route::get('/receipt/export',[ReceiptController::class,'export'])->name('receipts.export');
		Route::get('/receipts/delete/{receipt}',[ReceiptController::class,'destroy'])->name('receipts.destroy');
		Route::get('/receipts/cancel/{receipt}',[ReceiptController::class,'cancel'])->name('receipts.cancel');
		Route::get('/receipts/ael/{receipt}',[ReceiptController::class,'ael'])->name('receipts.ael');

		/* ======================== Invoice ======================================== */
		Route::resource('invoices', InvoiceController::class);
		Route::post('/invoice/attach',[InvoiceController::class,'attach'])->name('invoices.attach');
		Route::get('/invoice/export',[InvoiceController::class,'export'])->name('invoices.export');
		Route::get('/invoices/attachments/{invoice}',[InvoiceController::class,'attachments'])->name('invoices.attachments');
		Route::get('/invoices/create/{po}',[InvoiceController::class,'create'])->name('invoices.create');
		Route::get('/invoices/delete/{invoice}',[InvoiceController::class,'destroy'])->name('invoices.destroy');
		Route::get('/invoices/cancel/{invoice}',[InvoiceController::class,'cancel'])->name('invoices.cancel');
		Route::get('/invoices/post/{invoice}',[InvoiceController::class,'post'])->name('invoices.post');
		Route::get('/invoices/ael/{invoice}',[InvoiceController::class,'ael'])->name('invoices.ael');

		/* ======================== Payment ======================================== */
		Route::resource('payments', PaymentController::class);
		Route::get('/payment/export',[PaymentController::class,'export'])->name('payments.export');
		Route::get('/payment/cancel/{payment}',[PaymentController::class, 'cancel'])->name('payments.cancel');
		Route::get('/payments/create/{invoice}',[PaymentController::class,'create'])->name('payments.create');
		Route::get('/payments/delete/{payment}',[PaymentController::class,'destroy'])->name('payments.destroy');
		Route::get('/payments/ael/{payment}',[PaymentController::class,'ael'])->name('payments.ael');

		/* ======================== Accounting ======================================== */
		Route::resource('aels', AelController::class);
		Route::get('/ael/export-for-po/{id}',[AelController::class,'exportForPo'])->name('aels.export-for-po');

		/* ======================== Report ========================================  */
		Route::resource('reports', ReportController::class);
		Route::get('/report/export',[ReportController::class, 'export'])->name('reports.export');
		Route::get('/report/pr/{id}',[ReportController::class, 'pr'])->name('reports.pr');
		Route::get('/report/po/{id}',[ReportController::class, 'po'])->name('reports.po');
		
		Route::get('/reports/parameter/{report}',[ReportController::class,'parameter'])->name('reports.parameter');
		Route::put('/reports/run/{report}',[ReportController::class,'run'])->name('reports.run');

		/* ======================== UploadItem ======================================== */
		Route::resource('upload-items', UploadItemController::class);
		Route::get('/upload-item/export',[UploadItemController::class, 'export'])->name('upload-items.export');
		Route::get('/upload-item/check',[UploadItemController::class, 'check'])->name('upload-items.check');
		Route::get('/upload-item/import',[UploadItemController::class, 'import'])->name('upload-items.import');

		/* ======================== Rate ======================================== */
		Route::resource('rates', RateController::class);
		Route::get('/rate/export',[RateController::class,'export'])->name('rates.export');
		Route::get('/rates/delete/{rate}',[RateController::class,'destroy'])->name('rates.destroy');

		/* ======================== Ticket ======================================== */
		Route::resource('tickets', TicketController::class);

	});


/**
* ==================================================================================
* 3. Tenant Back Office Routes (Need Auth+ Email Verification + can:access-back-office)
* ==================================================================================
*/
Route::middleware([
	'web','auth', 'verified','can:access-back-office',
	InitializeTenancyByDomain::class,
	PreventAccessFromCentralDomains::class,
	])->group(function () {

		/* ======================== User ========================================  */
		Route::get('/users/impersonate/{user}/',[UserController::class, 'impersonate'])->name('users.impersonate');
		Route::get('/leave-impersonate',[UserController::class, 'leaveImpersonate'])->name('users.leave-impersonate');

		/* ======================== Table ========================================  */
		Route::resource('tables', TableController::class);
		Route::get('/table/structure/{table}',[TableController::class, 'structure'])->name('tables.structure');
		Route::get('/table/controllers',[TableController::class, 'controllers'])->name('tables.controllers');
		Route::get('/table/controllers-fnc',[TableController::class, 'fncControllers'])->name('tables.fnc-controllers');
		Route::get('/table/models',[TableController::class, 'models'])->name('tables.models');
		Route::get('/table/models-fnc',[TableController::class, 'fncModels'])->name('tables.fnc-models');
		Route::get('/table/policies',[TableController::class, 'policies'])->name('tables.policies');
		Route::get('/table/policies-fnc',[TableController::class, 'fncPolicies'])->name('tables.fnc-policies');
		Route::get('/table/helpers',[TableController::class, 'helpers'])->name('tables.helpers');
		Route::get('/table/helpers-fnc',[TableController::class, 'fncHelpers'])->name('tables.fnc-helpers');
		
		Route::get('/table/routes',[TableController::class, 'routes'])->name('tables.routes');
		
		Route::get('/table/route-code',[TableController::class, 'routeCode'])->name('tables.route-code');
		Route::get('/table/comments',[TableController::class, 'comments'])->name('tables.comments');
		Route::get('/table/check',[TableController::class, 'check'])->name('tables.check');
		Route::get('/table/messages',[TableController::class, 'messages'])->name('tables.messages');

		/* ======================== Template ========================================  */
		Route::resource('templates', TemplateController::class);
		Route::get('/template/export',[TemplateController::class, 'export'])->name('templates.export');
		Route::get('/templates/delete/{template}',[TemplateController::class, 'destroy'])->name('templates.destroy');
		Route::get('/templates/submit/{template}',[TemplateController::class, 'submit'])->name('templates.submit');

		/* ======================== Menu ======================================== */
		Route::resource('menus', MenuController::class);
		Route::get('/menu/export',[MenuController::class,'export'])->name('menus.export');
		Route::get('/menus/delete/{menu}',[MenuController::class,'destroy'])->name('menus.destroy');

		/* ======================== Entity ======================================== */
		Route::resource('entities', EntityController::class);
		Route::get('/entities/delete/{entity}',[EntityController::class, 'destroy'])->name('entities.destroy');
		
		/* ======================== Status ======================================== */
		Route::resource('statuses', StatusController::class);
		Route::get('/status/export',[StatusController::class,'export'])->name('statuses.export');
		Route::get('/statuses/delete/{status}',[StatusController::class,'destroy'])->name('statuses.destroy');

		/* ======================== CustomError ======================================== */
		Route::resource('custom-errors', CustomErrorController::class);
		Route::get('/custom-error/export',[CustomErrorController::class,'export'])->name('custom-errors.export');
		Route::get('/custom-errors/delete/{customError}',[CustomErrorController::class,'destroy'])->name('custom-errors.destroy');

		/* ======================== Report ========================================  */
		Route::get('/report/createPDF',[ReportController::class, 'createPDF'])->name('reports.createPDF');
		Route::get('/report/templatepr',[ReportController::class, 'templatepr'])->name('reports.templatepr');
		Route::get('/report/templatepo',[ReportController::class, 'templatepo'])->name('reports.templatepo');
		Route::get('/report/stocks',[ReportController::class, 'stocks'])->name('reports.stocks');
		
		Route::get('/clear', function() {
			Artisan::call('cache:clear');
			Artisan::call('cache:clear');
			Artisan::call('route:clear');
			Artisan::call('config:clear');
			Artisan::call('view:clear');
			return "Cache is cleared at ".now();
		});

	});

/**
* ==================================================================================
* 4. Tenant Old Public+Auth Routes (Need to Check)
* ==================================================================================
*/
Route::middleware([
	'web',
	InitializeTenancyByDomain::class,
	PreventAccessFromCentralDomains::class,
	])->group(function () {
	
	// Route::get('/', function () {
	//     return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
	// });

	
	/* ======================== FileAccess ======================================== */
	//Route::get('/logo/{file}', [FileAccessController::class, 'logo'])->name('logo');
	//Route::get('/avatar/{file}', [FileAccessController::class, 'avatar'])->name('avatar');

	/* ======================== Hierarchyl ======================================== */
	//Route::resource('hierarchyls', HierarchylController::class)->middleware(['auth', 'verified']);
	//Route::get('/hierarchyl/export',[HierarchylController::class,'export'])->name('hierarchyls.export');
	//Route::get('/hierarchyls/delete/{hierarchyl}',[HierarchylController::class,'destroy'])->name('hierarchyls.destroy');

	/* ======================== PayMethod ======================================== */
	//Route::resource('pay-methods', PayMethodController::class)->middleware(['auth', 'verified']);
	//Route::get('/pay-method/export',[PayMethodController::class,'export'])->name('pay-methods.export');
	//Route::get('/pay-methods/delete/{payMethod}',[PayMethodController::class,'destroy'])->name('pay-methods.destroy');

	/* ======================== InvoiceLines ======================================== */
	//Route::resource('invoicelines', InvoiceLinesController::class)->middleware(['auth', 'verified']);
	//Route::get('/invoicelines/export',[InvoiceLinesController::class,'export'])->name('invoicelines.export');
	//Route::get('/invoicelines/delete/{invoicelines}',[InvoiceLinesController::class,'destroy'])->name('invoicelines.destroy');
	
	//Route::get('/entity/delete/{entity}',[EntityController::class, 'destroy'])->name('entities.destroy');
	//Route::get('/entity/export',[EntityController::class, 'export'])->name('entities.export');
	
	/* ======================== Pages ======================================== */
	// Route::get('/faq', function () {
	// 	return view('pages.faq');
	// })->name('faq');

	// Route::get('/about', function () {
	// 	return view('pages.about-us');
	// })->name('about');

	// Route::get('/contact-us', function () {
	// 	return view('pages.contact-us');
	// })->name('contact-us');

});


/**
* ==================================================================================
* 5. Route for Testing purpose and Misc Routes (Ony For back Office)
* ==================================================================================
*/
Route::middleware([
	'web','auth', 'verified','can:access-back-office',
	InitializeTenancyByDomain::class,
	PreventAccessFromCentralDomains::class,
	])->group(function () {

		/* ======================== Home Controller ======================================== */
		Route::get('/send', [HomeController::class, 'testNotification'])->name('send');
		Route::get('/demomail', [HomeController::class, 'demomail'])->name('demomail');
		Route::post('/save-contact', [HomeController::class, 'saveContact'])->name('home.savecontact');
		Route::get('/send-queue-email', function(){
			$send_mail = 'khondker@gmail.com';
			dispatch(new App\Jobs\SendEmailQueueJob($send_mail));
			dd('Send mail using que successfully !!');
		});
		Route::get('email-test', function(){
			$details['email'] = 'your_email@gmail.com';
			dispatch(new App\Jobs\SendEmailJob($details));
			dd('Done: '. now());
		});

		/* ======================== Misc Tenant Routes  ========================================  */
		Route::get('/html', function () {
			return view('blankhtml');
		})->name('blank');
		
		Route::get('/design', function () {
			return view('design');
		})->name('design');

		/* ======================== Test Tenant Routes  ========================================  */
		Route::get('testrun/',[TestController::class, 'run'])->name('test.run');
		// Route::get('/test', function () {
		// 	dd('done at ' .date('Y'));
		// })->name('test');
		//Route::view('/test', 'tenant.pages.test');
		Route::get('/test', function () {
			return view('tenant.pages.test');
		})->name('test');
		Route::get('/sweet2', function () {
			return view('tenant.pages.sweet2');
		})->name('sweet2');
		Route::get('/jq', function () {
			return view('tenant.pages.jquery');
		})->name('jq');
		Route::get('/jql', function () {
			return view('tenant.pages.jqueryl');
		})->name('jql');

	});
