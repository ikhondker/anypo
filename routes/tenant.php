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

use App\Http\Controllers\Share\TemplateController;

use App\Http\Controllers\Tenant\Test\TestController;
//use App\Http\Controllers\ImpersonateController;

use App\Http\Controllers\Tenant\Admin\ActivityController;
use App\Http\Controllers\Tenant\Admin\SetupController;
use App\Http\Controllers\Tenant\Admin\UserController;

use App\Http\Controllers\Tenant\Lookup\CategoryController;
use App\Http\Controllers\Tenant\Lookup\ItemCategoryController;
use App\Http\Controllers\Tenant\Lookup\CountryController;
use App\Http\Controllers\Tenant\Lookup\CurrencyController;
use App\Http\Controllers\Tenant\Lookup\DeptController;
use App\Http\Controllers\Tenant\Lookup\DesignationController;
use App\Http\Controllers\Tenant\Lookup\GroupController;
use App\Http\Controllers\Tenant\Lookup\ItemController;
use App\Http\Controllers\Tenant\Lookup\OemController;
use App\Http\Controllers\Tenant\Lookup\PayMethodController;

use App\Http\Controllers\Tenant\Lookup\RateController;
use App\Http\Controllers\Tenant\Lookup\SupplierController;
use App\Http\Controllers\Tenant\Lookup\UomController;
use App\Http\Controllers\Tenant\Lookup\UploadItemController;
use App\Http\Controllers\Tenant\Lookup\WarehouseController;
use App\Http\Controllers\Tenant\Lookup\BankAccountController;
use App\Http\Controllers\Tenant\Lookup\ProjectController;

use App\Http\Controllers\Tenant\Manage\CpController;
use App\Http\Controllers\Tenant\Manage\EntityController;
use App\Http\Controllers\Tenant\Manage\MenuController;
use App\Http\Controllers\Tenant\Manage\TableController;

use App\Http\Controllers\Tenant\Manage\StatusController;
use App\Http\Controllers\Tenant\Manage\CustomErrorController;

use App\Http\Controllers\Tenant\Workflow\HierarchyController;
//use App\Http\Controllers\Tenant\Workflow\HierarchylController;
use App\Http\Controllers\Tenant\Workflow\WfController;
use App\Http\Controllers\Tenant\Workflow\WflController;

use App\Http\Controllers\Tenant\Ae\AehController;
use App\Http\Controllers\Tenant\Ae\AelController;

use App\Http\Controllers\Tenant\Support\TicketController;

use App\Http\Controllers\Tenant\AttachmentController;
use App\Http\Controllers\Tenant\BudgetController;
use App\Http\Controllers\Tenant\DeptBudgetController;
use App\Http\Controllers\Tenant\DbuController;

use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Controllers\Tenant\NotificationController;

use App\Http\Controllers\Tenant\PrController;
use App\Http\Controllers\Tenant\PrlController;
use App\Http\Controllers\Tenant\PoController;
use App\Http\Controllers\Tenant\PolController;

use App\Http\Controllers\Tenant\ReceiptController;
use App\Http\Controllers\Tenant\InvoiceController;
use App\Http\Controllers\Tenant\InvoiceLineController;
use App\Http\Controllers\Tenant\PaymentController;

use App\Http\Controllers\Tenant\ReportController;
use App\Http\Controllers\Tenant\ExportController;

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


		/* ======================== Test Tenant Routes  ========================================  */
		Route::get('testrun/',[TestController::class, 'run'])->name('test.run');
		// Route::get('/test', function () {
		// 	dd('done at ' .date('Y'));
		// })->name('test');
		//Route::view('/test', 'tenant.pages.test');
		Route::get('/test', function () {
			return view('tenant.tests.test');
		})->name('test');
		Route::get('/sweet2', function () {
			return view('tenant.tests.sweet2');
		})->name('sweet2');
		Route::get('/jq', function () {
			return view('tenant.tests.jquery');
		})->name('jq');
		Route::get('/jql', function () {
			return view('tenant.tests.jqueryl');
		})->name('jql');

		/* ======================== Purging Cache ========================================  */
		Route::get('/clear', function() {
			Artisan::call('cache:clear');
			Artisan::call('cache:clear');
			Artisan::call('route:clear');
			Artisan::call('config:clear');
			Artisan::call('view:clear');
			return "Cache is cleared at ".now();
		});


		/* ======================== make auth universal ========================================  */
		Route::middleware(['universal'])->namespace('App\\Http\\Controllers\\')->group(function () {
			Auth::routes();
			//Auth::routes(['verify' => true]);
		});

		// IQBAL 28-feb-23
		Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

		/* ======================== Email Verification======================================== */
		Route::get('/email/verify', function () {
			return view('auth.verify-email');
		})->middleware('auth')->name('verification.notice');

		Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
			$request->fulfill();
			//return redirect('/home');
			Auth::logout();
			return redirect('/login');
		})->middleware(['auth', 'signed'])->name('verification.verify');

		Route::post('/email/verification-notification', function (Request $request) {
			$user = User::where('email',$request->input('email'))->first();
			$user->sendEmailVerificationNotification();
			//$request->user()->sendEmailVerificationNotification();
			//return back()->with('message', 'Verification link sent!');
            return back()->with('success', 'Verification link sent! Please check your mail and clink on \"Verify Email Address\" link.');
		})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

		// Copy content from landlord
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

		// TODO Remove
		Route::get('/ui', function () {
			return view('tenant.manage.ui');
		})->name('ui');

		/* ======================== Home Controller ======================================== */
		Route::get('/home', [DashboardController::class, 'index'])->name('home');
		//Route::get('/help', [HomeController::class, 'help'])->name('help');
		// TODO check
        // Route::get('/get-started', function () {
		// 	return view('tenant.pages.get-started');
		// })->name('get-started');

		/* ======================== Dashboard ========================================  */
		Route::resource('dashboards', DashboardController::class);
		Route::get('/', [DashboardController::class, 'index'])->name('home');

		/* ======================== User (Profile) ========================================  */
		Route::get('profile',[UserController::class, 'profile'])->name('users.profile');
		Route::get('profile-edit', [UserController::class, 'editProfile'])->name('users.profile-edit');
		Route::put('profile-update', [UserController::class, 'updateProfile'])->name('users.profile-update');
		Route::get('profile-password', [UserController::class, 'profilePassword'])->name('users.profile-password');
		Route::post('profile-password-update', [UserController::class, 'updateProfilePassword'])->name('users.profile-password-update');
		Route::get('/leave-impersonate',[UserController::class, 'leaveImpersonate'])->name('users.leave-impersonate');

		/* ======================== Attachment ======================================== */
		Route::resource('attachments', AttachmentController::class);
		Route::post('/attachment/add/{entity}/{articleId}',[AttachmentController::class,'add'])->name('attachments.add');
		Route::get('/attachments/delete/{attachment}',[AttachmentController::class,'destroy'])->name('attachments.destroy');
		Route::get('/attachments/download/{attachment}', [AttachmentController::class, 'download'])->name('attachments.download');

		/* ======================== Notification ======================================== */
		Route::resource('notifications', NotificationController::class);
		Route::get('/notification/all',[NotificationController::class, 'all'])->name('notifications.all');
		Route::get('/notifications/read/{notification}',[NotificationController::class, 'read'])->name('notifications.read');
		//Route::get('/notifications/mark-as-read/{notification}',[NotificationController::class, 'markNotification'])->name('notifications.mark-as-read');
		//Route::get('/notifications/mark-as-read',[NotificationController::class, 'markNotification'])->name('notifications.mark-as-read');

		Route::get('/notification/purge',[NotificationController::class, 'purge'])->name('notifications.purge');
		Route::get('/notifications/delete/{notification}',[NotificationController::class, 'destroy'])->name('notifications.destroy');

		/* ======================== Supplier ======================================== */
		Route::resource('suppliers', SupplierController::class);
		Route::get('/supplier/export',[SupplierController::class,'export'])->name('suppliers.export');
		Route::post('/supplier/attach',[SupplierController::class,'attach'])->name('suppliers.attach');
		Route::get('/suppliers/attachments/{supplier}',[SupplierController::class,'attachments'])->name('suppliers.attachments');
		Route::get('/suppliers/timestamp/{supplier}',[SupplierController::class, 'timestamp'])->name('suppliers.timestamp');

		/* ======================== Uom ======================================== */
		Route::get('/uoms/get-uoms-by-class/{uom_class_id}',[UomController::class, 'getUomsByClass'])->name('uoms.get-uoms-by-class');

		/* ======================== Item ======================================== */
		Route::resource('items', ItemController::class);
		Route::get('/item/export',[ItemController::class,'export'])->name('items.export');
		Route::post('/item/attach',[ItemController::class,'attach'])->name('items.attach');
		Route::get('/items/attachments/{item}',[ItemController::class,'attachments'])->name('items.attachments');
		Route::get('/items/get-item/{item}',[ItemController::class, 'getItem'])->name('items.get-item');
		Route::get('/items/timestamp/{item}',[ItemController::class, 'timestamp'])->name('items.timestamp');

		/* ======================== Project ======================================== */
		Route::resource('projects', ProjectController::class);
		Route::get('/project/export',[ProjectController::class,'export'])->name('projects.export');
		Route::post('/project/attach',[ProjectController::class,'attach'])->name('projects.attach');
		Route::get('/projects/attachments/{project}',[ProjectController::class,'attachments'])->name('projects.attachments');
		Route::get('/projects/timestamp/{project}',[ProjectController::class, 'timestamp'])->name('projects.timestamp');

		/* ======================== Pr ======================================== */
		Route::resource('prs', PrController::class);
		Route::get('/pr/my-prs',[PrController::class,'myPr'])->name('prs.my-prs');
		Route::post('/pr/attach',[PrController::class,'attach'])->name('prs.attach');
		Route::get('/prs/attachments/{pr}',[PrController::class,'attachments'])->name('prs.attachments');
		//Route::get('/pr/export',[PrController::class,'export'])->name('prs.export');
		Route::get('/prs/pdf/{pr}',[PrController::class,'pdf'])->name('prs.pdf');
		Route::get('/prs/delete/{pr}',[PrController::class,'destroy'])->name('prs.destroy');
		Route::get('/prs/cancel/{pr}',[PrController::class,'cancel'])->name('prs.cancel');
		Route::get('/prs/history/{pr}',[PrController::class,'history'])->name('prs.history');
		Route::get('/prs/extra/{pr}',[PrController::class,'extra'])->name('prs.extra');
		Route::get('/prs/submit/{pr}',[PrController::class, 'submit'])->name('prs.submit');
		Route::get('/prs/duplicate/{pr}',[PrController::class, 'duplicate'])->name('prs.duplicate');
		Route::get('/prs/convert-to-po/{pr}',[PrController::class, 'convertPo'])->name('prs.convert');
		Route::get('/prs/timestamp/{pr}',[PrController::class, 'timestamp'])->name('prs.timestamp');

		/* ======================== Prl ======================================== */
		Route::resource('prls', PrlController::class);
		//Route::get('/prl/export',[PrlController::class,'export'])->name('prls.export');
		Route::get('/prls/delete/{prl}',[PrlController::class,'destroy'])->name('prls.destroy');
		Route::get('/prls/add-line/{pr}',[PrlController::class, 'addLine'])->name('prls.add-line');
		// TODO prl cancel here

		/* ======================== Ticket ======================================== */
		Route::resource('tickets', TicketController::class);

		/* ======================== Wfl ======================================== */
		Route::resource('wfls', WflController::class);	// anyone can be in approval hierarchy

		/* ======================== Report ========================================  */
		Route::get('/report/pr/{id}',[ReportController::class, 'pr'])->name('reports.pr');

   		/* ======================== Export ======================================== */
		Route::resource('exports', ExportController::class);
		//Route::get('/exports/parameter/{export}',[ExportController::class,'parameter'])->name('exports.parameter');
		Route::put('/exports/run/{export}',[ExportController::class,'run'])->name('exports.run');
		Route::get('/export/export',[ExportController::class,'export'])->name('exports.export');

		Route::get('/export/pr',[ExportController::class,'pr'])->name('exports.pr');
		Route::get('/export/prl',[ExportController::class,'prl'])->name('exports.prl');
		Route::get('/export/po',[ExportController::class,'po'])->name('exports.po');
		Route::get('/export/pol',[ExportController::class,'pol'])->name('exports.pol');

        Route::get('/export/po-for-buyer',[ExportController::class,'poForBuyer'])->name('exports.po-for-buyer');
        Route::get('/export/po-for-project/{id}',[ExportController::class,'poForProject'])->name('exports.po-for-project');
        Route::get('/export/po-for-supplier/{id}',[ExportController::class,'poForSupplier'])->name('exports.po-for-supplier');
        // TODO
        Route::get('/export/po-for-item/{id}',[ExportController::class,'poForItem'])->name('exports.po-for-item');
        Route::get('/export/po-for-currency/{currency}',[ExportController::class,'poForCurrency'])->name('exports.po-for-currency');


		Route::get('/export/invoice',[ExportController::class,'invoice'])->name('exports.invoice');
		Route::get('/export/invoice-line',[ExportController::class,'invoiceLine'])->name('exports.invoice-line');
		Route::get('/export/payment',[ExportController::class,'payment'])->name('exports.payment');
		Route::get('/export/receipt',[ExportController::class,'receipt'])->name('exports.receipt');

        Route::get('/export/ael',[ExportController::class,'ael'])->name('exports.ael');
		Route::get('/export/ael-for-po/{id}',[ExportController::class,'aelForPo'])->name('exports.ael-for-po');
        Route::get('/export/ael-for-invoice/{id}',[ExportController::class,'aelForInvoice'])->name('exports.ael-for-invoice');
        Route::get('/export/ael-for-payment/{id}',[ExportController::class,'aelForPayment'])->name('exports.ael-for-payment');
        Route::get('/export/ael-for-receipt/{id}',[ExportController::class,'aelForReceipt'])->name('exports.ael-for-receipt');
        Route::get('/export/ael-for-aeh/{id}',[ExportController::class,'aelForAeh'])->name('exports.ael-for-aeh');

		Route::get('/export/budget/{revision?}/{parent?}',[ExportController::class,'exportBudget'])->name('exports.budget');
		Route::get('/export/dept-budget/{revision?}/{parent?}',[ExportController::class,'exportDeptBudget'])->name('exports.dept-budget');

		// Route::get('/export/project-po',[ExportController::class,'projectPo'])->name('exports.projectpo');
		// Route::get('/export/project-po-lines',[ExportController::class,'projectPoLine'])->name('exports.projectpoline');
		// Route::get('/export/supplier-po',[ExportController::class,'supplierPo'])->name('exports.supplierpo');
		// Route::get('/export/supplier-po-lines',[ExportController::class,'supplierPoLine'])->name('exports.supplierpoline');

		/* ======================== Documentation  ========================================  */
		Route::get('/docs', function () { return view('tenant.documentations.index'); })->name('docs.index');
		Route::get('/docs/template', function () { return view('tenant.documentations.template'); })->name('docs.template');
		Route::get('/docs/start', function () { return view('tenant.documentations.start'); })->name('docs.start');
		Route::get('/docs/faq', function () { return view('tenant.documentations.faq'); })->name('docs.faq');
		Route::get('/docs/pr', function () { return view('tenant.documentations.pr'); })->name('docs.pr');
		Route::get('/docs/po', function () { return view('tenant.documentations.po'); })->name('docs.po');
		Route::get('/docs/receipt', function () { return view('tenant.documentations.receipt'); })->name('docs.receipt');
		Route::get('/docs/invoice', function () { return view('tenant.documentations.invoice'); })->name('docs.invoice');
		Route::get('/docs/payment', function () { return view('tenant.documentations.payment'); })->name('docs.payment');
		Route::get('/docs/budget', function () { return view('tenant.documentations.budget'); })->name('docs.budget');
	  	Route::get('/docs/dept-budget', function () { return view('tenant.documentations.dept-budget'); })->name('docs.dept-budget');
	  	Route::get('/docs/master', function () { return view('tenant.documentations.master'); })->name('docs.master');
	  	Route::get('/docs/user', function () { return view('tenant.documentations.user'); })->name('docs.user');
		Route::get('/docs/hierarchy', function () { return view('tenant.documentations.hierarchy'); })->name('docs.hierarchy');
		Route::get('/docs/approval', function () { return view('tenant.documentations.approval'); })->name('docs.approval');
		Route::get('/docs/workflow', function () { return view('tenant.documentations.workflow'); })->name('docs.workflow');
		Route::get('/docs/interface', function () { return view('tenant.documentations.interface'); })->name('docs.interface');
		Route::get('/docs/currency', function () { return view('tenant.documentations.currency'); })->name('docs.currency');
		Route::get('/docs/accounting', function () { return view('tenant.documentations.accounting'); })->name('docs.accounting');
		Route::get('/docs/setup', function () { return view('tenant.documentations.setup'); })->name('docs.setup');


	});

/**
* ==================================================================================
* 3. Superior Routes excl User (Need Auth+ Email Verification + can:superior)
* ==================================================================================
*/
// superior is defined in AppServiceProvider.php
Route::middleware([
	'web','auth', 'verified','can:superior',
	InitializeTenancyByDomain::class,
	PreventAccessFromCentralDomains::class,
	])->group(function () {
		/* ======================== Item ======================================== */
		Route::get('/items/delete/{item}',[ItemController::class,'destroy'])->name('items.destroy');

		/* ======================== Project ======================================== */
		Route::post('/project/attach',[ProjectController::class,'attach'])->name('projects.attach');
		Route::get('/projects/delete/{project}',[ProjectController::class,'destroy'])->name('projects.destroy');
		Route::get('/projects/budget/{project}',[ProjectController::class,'budget'])->name('projects.budget');
		Route::get('/projects/po/{project}',[ProjectController::class,'po'])->name('projects.po');
		Route::get('/projects/pbu/{project}',[ProjectController::class,'pbu'])->name('projects.pbu');

		/* ======================== Dbu ======================================== */
		Route::resource('dbus', DbuController::class);
		Route::get('/dbu/export',[DbuController::class,'export'])->name('dbus.export');
		Route::get('/dbus/delete/{dbu}',[DbuController::class,'destroy'])->name('dbus.destroy');

		/* ======================== Po ======================================== */
		Route::resource('pos', PoController::class);
		Route::get('/po/my-pos',[PoController::class,'myPo'])->name('pos.my-pos');
		//Route::get('/pos/pdf/{po}',[PoController::class,'pdf'])->name('pos.pdf');
		Route::get('/pos/attachments/{po}',[PoController::class,'attachments'])->name('pos.attachments');
		Route::post('/po/attach',[PoController::class,'attach'])->name('pos.attach');
		//Route::get('/po/export',[PoController::class,'export'])->name('pos.export');
		// Route::get('/pos/export-for-supplier/{supplier}',[PoController::class,'exportForSupplier'])->name('pos.export-for-supplier');
		// Route::get('/pos/export-for-project/{project}',[PoController::class,'exportForProject'])->name('pos.export-for-project');
		// done Route::get('/pos/export-for-buyer/{user}',[PoController::class,'exportForBuyer'])->name('pos.export-for-buyer');
		Route::get('/pos/get-po/{po}',[PoController::class, 'getPo'])->name('pos.get-po');

		Route::get('/pos/delete/{po}',[PoController::class,'destroy'])->name('pos.destroy');
		Route::get('/pos/cancel/{po}',[PoController::class,'cancel'])->name('pos.cancel');
		Route::get('/pos/recalculate/{po}',[PoController::class,'recalculate'])->name('pos.recalculate');
		Route::get('/pos/extra/{po}',[PoController::class,'extra'])->name('pos.extra');
		Route::get('/pos/close/{po}',[PoController::class,'close'])->name('pos.close');
		Route::get('/pos/open/{po}',[PoController::class,'open'])->name('pos.open');
		Route::get('/pos/history/{po}',[PoController::class,'history'])->name('pos.history');
		Route::get('/pos/invoices/{po}',[PoController::class,'invoices'])->name('pos.invoices');
		Route::get('/pos/payments/{po}',[PoController::class,'payments'])->name('pos.payments');
		Route::get('/pos/ael/{po}',[PoController::class,'ael'])->name('pos.ael');

		Route::get('/pos/submit/{po}',[PoController::class, 'submit'])->name('pos.submit');
		Route::get('/pos/duplicate/{po}',[PoController::class, 'duplicate'])->name('pos.duplicate');
		Route::get('/pos/timestamp/{po}',[PoController::class, 'timestamp'])->name('pos.timestamp');

		/* ======================== Pol ======================================== */
		Route::resource('pols', PolController::class);
		//Route::get('/pol/export',[PolController::class,'export'])->name('pols.export');
		Route::get('/pols/delete/{pol}',[PolController::class,'destroy'])->name('pols.destroy');
		Route::get('/pols/add-line/{po}',[PolController::class, 'addLine'])->name('pols.add-line');
		Route::get('/pols/receipt/{pol}',[PolController::class,'receipt'])->name('pols.receipt');
		Route::get('/pols/ael/{pol}',[PolController::class,'ael'])->name('pols.ael');
		Route::get('/pols/get-pol/{pol}',[PolController::class, 'getPol'])->name('pols.get-pol');

		/* ======================== Receipt ======================================== */
		Route::resource('receipts', ReceiptController::class);
		Route::get('/receipt/my-receipts',[ReceiptController::class,'myReceipts'])->name('receipts.my-receipts');
		//Route::get('/receipt/export',[ReceiptController::class,'export'])->name('receipts.export');
		Route::get('/receipts/delete/{receipt}',[ReceiptController::class,'destroy'])->name('receipts.destroy');
		Route::get('/receipts/cancel/{receipt}',[ReceiptController::class,'cancel'])->name('receipts.cancel');
		Route::get('/receipts/ael/{receipt}',[ReceiptController::class,'ael'])->name('receipts.ael');
		Route::get('/receipts/timestamp/{receipt}',[ReceiptController::class, 'timestamp'])->name('receipts.timestamp');

		/* ======================== Invoice ======================================== */
		Route::resource('invoices', InvoiceController::class);
		Route::get('/invoice/my-invoices',[InvoiceController::class,'myInvoices'])->name('invoices.my-invoices');
		Route::post('/invoice/attach',[InvoiceController::class,'attach'])->name('invoices.attach');
		//Route::get('/invoice/export',[InvoiceController::class,'export'])->name('invoices.export');
		Route::get('/invoices/payments/{invoice}',[InvoiceController::class,'payments'])->name('invoices.payments');
		Route::get('/invoices/attachments/{invoice}',[InvoiceController::class,'attachments'])->name('invoices.attachments');
		Route::get('/invoices/get-invoices/{po}',[InvoiceController::class, 'getInvoice'])->name('invoices.get-invoice');

		Route::get('/invoices/delete/{invoice}',[InvoiceController::class,'destroy'])->name('invoices.destroy');
		Route::get('/invoices/cancel/{invoice}',[InvoiceController::class,'cancel'])->name('invoices.cancel');
		Route::get('/invoices/post/{invoice}',[InvoiceController::class,'post'])->name('invoices.post');
		Route::get('/invoices/ael/{invoice}',[InvoiceController::class,'ael'])->name('invoices.ael');
		Route::get('/invoices/timestamp/{invoice}',[InvoiceController::class, 'timestamp'])->name('invoices.timestamp');

		/* ======================== InvoiceLines ======================================== */
		Route::resource('invoice-lines', InvoiceLineController::class);
		//Route::get('/invoice-line/export',[InvoiceLineController::class,'export'])->name('invoice-lines.export'); //TODO
		Route::get('/invoice-lines/delete/{invoiceLine}',[InvoiceLineController::class,'destroy'])->name('invoice-lines.destroy');
		Route::get('/invoice-lines/add-line/{invoice}',[InvoiceLineController::class, 'addLine'])->name('invoice-lines.add-line');

		/* ======================== Payment ======================================== */
		Route::resource('payments', PaymentController::class);
		Route::get('/payment/my-payments',[PaymentController::class,'myPayments'])->name('payments.my-payments');
		//Route::get('/payment/export',[PaymentController::class,'export'])->name('payments.export');
		Route::get('/payment/cancel/{payment}',[PaymentController::class, 'cancel'])->name('payments.cancel');
		Route::get('/payments/delete/{payment}',[PaymentController::class,'destroy'])->name('payments.destroy');
		Route::get('/payments/ael/{payment}',[PaymentController::class,'ael'])->name('payments.ael');
		Route::get('/payments/timestamp/{payment}',[PaymentController::class, 'timestamp'])->name('payments.timestamp');

		/* ======================== Ael ======================================== */
		Route::resource('aels', AelController::class);

		/* ======================== Report ========================================  */
		// PR Report is moved elsewhere
		Route::resource('reports', ReportController::class);
		Route::get('/report/export',[ReportController::class, 'export'])->name('reports.export');
		Route::get('/report/po/{id}',[ReportController::class, 'po'])->name('reports.po');
		Route::get('/report/invoice/{id}',[ReportController::class, 'invoice'])->name('reports.invoice');
		Route::get('/report/payment/{id}',[ReportController::class, 'payment'])->name('reports.payment');
		Route::get('/report/receipt/{id}',[ReportController::class, 'receipt'])->name('reports.receipt');
		Route::get('/reports/parameter/{report}',[ReportController::class,'parameter'])->name('reports.parameter');
		Route::put('/reports/run/{report}',[ReportController::class,'run'])->name('reports.run');

		/* ======================== Rate ======================================== */
		Route::resource('rates', RateController::class);
		Route::get('/rate/export',[RateController::class,'export'])->name('rates.export');
		Route::get('/rates/delete/{rate}',[RateController::class,'destroy'])->name('rates.destroy');

	});


/**
* ==================================================================================
* 3. HoD + Admin  (Need Auth+ Email Verification + can:hod)
* ==================================================================================
*/
// TODO
Route::middleware([
	'web','auth', 'verified','can:hod-or-cxo',
	InitializeTenancyByDomain::class,
	PreventAccessFromCentralDomains::class,
	])->group(function () {


	});


/**
* ==================================================================================
* 3. HoD + CxO + Admin  (Need Auth+ Email Verification + can:hod)
* ==================================================================================
*/
Route::middleware([
	'web','auth', 'verified','can:hod-or-cxo',
	InitializeTenancyByDomain::class,
	PreventAccessFromCentralDomains::class,
	])->group(function () {

		/* ======================== DeptBudget ======================================== */
		Route::resource('dept-budgets', DeptBudgetController::class);
		Route::get('/dept-budget/export',[DeptBudgetController::class,'export'])->name('dept-budgets.export');
		//TODO
		Route::get('/dept-budgets/delete/{deptBudget}',[DeptBudgetController::class,'destroy'])->name('dept-budgets.destroy');
		//Route::get('/dept-budgets/revision/{deptBudget}',[DeptBudgetController::class,'revision'])->name('dept-budgets.revision');
		Route::post('/dept-budget/attach',[DeptBudgetController::class,'attach'])->name('dept-budgets.attach');
		Route::get('/dept-budgets/attachments/{deptBudget}',[DeptBudgetController::class,'attachments'])->name('dept-budgets.attachments');
		Route::get('/dept-budgets/dbu/{deptBudget}',[DeptBudgetController::class,'dbu'])->name('dept-budgets.dbu');
		Route::get('/dept-budget/revisions-all',[DeptBudgetController::class,'revisionsAll'])->name('dept-budgets.revisions-all');
		Route::get('/dept-budget/revisions/{deptBudget?}',[DeptBudgetController::class,'revisions'])->name('dept-budgets.revisions');
		Route::get('/dept-budgets/revision-detail/{deptBudget}',[DeptBudgetController::class,'revisionDetail'])->name('dept-budgets.revision-detail');
		Route::get('/dept-budgets/timestamp/{deptBudget}',[DeptBudgetController::class, 'timestamp'])->name('dept-budgets.timestamp');
	});



/**
* ==================================================================================
* 3. Buyer+ CxO + Admin  (Need Auth+ Email Verification + can:cxo)
* ==================================================================================
*/
Route::middleware([
	'web','auth', 'verified','can:buyer-or-cxo',
	InitializeTenancyByDomain::class,
	PreventAccessFromCentralDomains::class,
	])->group(function () {

		/* ======================== Supplier ======================================== */
		Route::get('/supplier/spends',[SupplierController::class,'spends'])->name('suppliers.spends');
		Route::get('/suppliers/po/{supplier}',[SupplierController::class,'po'])->name('suppliers.po');

		/* ======================== Project ======================================== */
		Route::get('/project/spends',[ProjectController::class,'spends'])->name('projects.spends');

	});

/**
* ==================================================================================
* 3. CxO + Admin  (Need Auth+ Email Verification + can:cxo)
* ==================================================================================
*/
Route::middleware([
	'web','auth', 'verified','can:cxo',
	InitializeTenancyByDomain::class,
	PreventAccessFromCentralDomains::class,
	])->group(function () {

		/* ======================== Budget ======================================== */
		Route::resource('budgets', BudgetController::class);
		//Route::get('/budget/export',[BudgetController::class,'export'])->name('budgets.export');
		Route::get('/budgets/delete/{budget}',[BudgetController::class,'destroy'])->name('budgets.destroy');
		Route::post('/budget/attach',[BudgetController::class,'attach'])->name('budgets.attach');
		Route::get('/budgets/attachments/{budget}',[BudgetController::class,'attachments'])->name('budgets.attachments');

		//Route::get('/budget/revisions-all',[BudgetController::class,'revisionsAll'])->name('budgets.revisions-all');
		Route::get('/budget/revisions/{budget?}',[BudgetController::class,'revisions'])->name('budgets.revisions');
		Route::get('/budgets/timestamp/{budget}',[BudgetController::class, 'timestamp'])->name('budgets.timestamp');

	});


/**
* ==================================================================================
* 3. Buyer Routes (Need Auth+ Email Verification + can:buyer)
* ==================================================================================
*/

Route::middleware([
	'web','auth', 'verified','can:buyer',
	InitializeTenancyByDomain::class,
	PreventAccessFromCentralDomains::class,
	])->group(function () {


		/* ======================== Pr ======================================== */
		Route::get('/prs/add-to-po/{pr}',[PrController::class,'addToPo'])->name('prs.add-to-po');
		Route::post('/prs/add-lines-to-po/{pr}', [PrController::class, 'addPrLineToPo'])->name('prs.add-lines-to-po');

		/* ======================== Supplier ======================================== */
		Route::get('/suppliers/delete/{supplier}',[SupplierController::class,'destroy'])->name('suppliers.destroy');

		/* ======================== Receipt ======================================== */
		Route::get('/receipt/create-for-pol/{pol?}',[ReceiptController::class,'createForPol'])->name('receipts.create-for-pol');

		/* ======================== Invoice ======================================== */
		Route::get('/invoice/create-for-po/{po?}',[InvoiceController::class,'createForPo'])->name('invoices.create-for-po');

		/* ======================== Payment ======================================== */
		Route::get('/payment/create-for-invoice/{invoice?}',[PaymentController::class,'createForInvoice'])->name('payments.create-for-invoice');
		//Route::get('/payments/create-for-invoice/{id?}',[PaymentController::class,'testNotification'])->name('payments.create-for-invoice');
		//Route::get('/payments/send/{id}',[PaymentController::class,'testNotification'])->name('payments.send');

		/* ======================== UploadItem ======================================== */
		Route::resource('upload-items', UploadItemController::class);
		Route::get('/upload-items/delete/{uploadItem}',[UploadItemController::class,'destroy'])->name('upload-items.destroy');
		Route::get('/upload-item/export',[UploadItemController::class, 'export'])->name('upload-items.export');
		Route::get('/upload-item/check',[UploadItemController::class, 'check'])->name('upload-items.check');
		Route::get('/upload-item/purge',[UploadItemController::class, 'purge'])->name('upload-items.purge');
		Route::get('/upload-item/import',[UploadItemController::class, 'import'])->name('upload-items.import');

	});

/**
* ==================================================================================
* 3. Admin Routes (Need Auth+ Email Verification + can:admin)
* ==================================================================================
*/

Route::middleware([
	'web','auth', 'verified','can:admin',
	InitializeTenancyByDomain::class,
	PreventAccessFromCentralDomains::class,
	])->group(function () {

	/* ======================== User ========================================  */
	Route::resource('users', UserController::class);	// needed for edit
	Route::get('/users/password-change/{user}', [UserController::class, 'changePassword'])->name('users.password-change');
	Route::post('/users/password-update/{user}', [UserController::class, 'updatePassword'])->name('users.password-update');
	Route::get('/users/delete/{user}',[UserController::class, 'destroy'])->name('users.destroy');
	Route::get('/user/export',[UserController::class, 'export'])->name('users.export');
	Route::get('/users/timestamp/{user}',[UserController::class, 'timestamp'])->name('users.timestamp');
	//Route::get('/user/profile',[UserController::class, 'profile'])->name('users.profile');
	// Route::get('/users/password/{user}',[UserController::class, 'password'])->name('users.password');
	// Route::post('/users/change-pass/{user}',[UserController::class, 'changepass'])->name('users.change-pass');
	//TODO remove next two used in footer
	//Route::get('/user/role',[UserController::class, 'role'])->name('users.role');
	//Route::get('/user/updaterole/{user}/{role}',[UserController::class, 'updaterole'])->name('users.updaterole');
	//Route::get('/user/image/{filename}',[UserController::class, 'image'])->name('users.image');
	// TODO
	//Route::get('/user/enable/{user}',[UserController::class, 'enable'])->name('users.enable');

	/* ======================== Currency ======================================== */
	Route::resource('currencies', CurrencyController::class);
	Route::get('/currency/export',[CurrencyController::class,'export'])->name('currencies.export');
	Route::get('/currencies/delete/{currency}',[CurrencyController::class, 'destroy'])->name('currencies.destroy');
	Route::get('/currencies/timestamp/{currency}',[CurrencyController::class, 'timestamp'])->name('currencies.timestamp');

	/* ======================== Dept (template)======================================== */
	Route::resource('depts', DeptController::class);
	Route::get('/dept/export',[DeptController::class, 'export'])->name('depts.export');
	Route::get('/depts/delete/{dept}',[DeptController::class, 'destroy'])->name('depts.destroy');
	Route::get('/depts/timestamp/{dept}',[DeptController::class, 'timestamp'])->name('depts.timestamp');

	/* ======================== Designation ======================================== */
	Route::resource('designations', DesignationController::class);
	Route::get('/designation/export',[DesignationController::class, 'export'])->name('designations.export');
	Route::get('/designations/delete/{designation}',[DesignationController::class, 'destroy'])->name('designations.destroy');
	Route::get('/designations/timestamp/{designation}',[DesignationController::class, 'timestamp'])->name('designations.timestamp');

	/* ======================== Group ======================================== */
	Route::resource('groups', GroupController::class);
	Route::get('/group/export',[GroupController::class,'export'])->name('groups.export');
	Route::get('/groups/delete/{group}',[GroupController::class,'destroy'])->name('groups.destroy');
	Route::get('/groups/timestamp/{group}',[GroupController::class, 'timestamp'])->name('groups.timestamp');

	/* ======================== Warehouse ======================================== */
	Route::resource('warehouses', WarehouseController::class);
	Route::get('/warehouse/export',[WarehouseController::class,'export'])->name('warehouses.export');
	Route::get('/warehouses/delete/{warehouse}',[WarehouseController::class,'destroy'])->name('warehouses.destroy');
	Route::get('/warehouses/timestamp/{warehouse}',[WarehouseController::class, 'timestamp'])->name('warehouses.timestamp');

	/* ======================== BankAccount ======================================== */
	Route::resource('bank-accounts', BankAccountController::class);
	Route::get('/bank-account/export',[BankAccountController::class,'export'])->name('bank-accounts.export');
	Route::get('/bank-accounts/delete/{bankAccount}',[BankAccountController::class,'destroy'])->name('bank-accounts.destroy');
	Route::post('/bank-account/attach',[BankAccountController::class,'attach'])->name('bank-accounts.attach');
	Route::get('/bank-accounts/timestamp/{bankAccount}',[BankAccountController::class, 'timestamp'])->name('bank-accounts.timestamp');
	//Route::get('/bank-accounts/attachments/{bankAccount}',[BankAccountController::class,'attachments'])->name('bank-accounts.detach');

	/* ======================== Category ======================================== */
	Route::resource('categories', CategoryController::class);
	Route::get('/category/export',[CategoryController::class, 'export'])->name('categories.export');
	Route::get('/categories/delete/{category}',[CategoryController::class, 'destroy'])->name('categories.destroy');
	Route::get('/categories/timestamp/{category}',[CategoryController::class, 'timestamp'])->name('categories.timestamp');

	/* ======================== ItemCategory ======================================== */
	Route::resource('item-categories', ItemCategoryController::class);
	Route::get('/item-category/export',[ItemCategoryController::class, 'export'])->name('item-categories.export');
	Route::get('/item-categories/delete/{itemCategory}',[ItemCategoryController::class, 'destroy'])->name('item-categories.destroy');
	Route::get('/item-categories/timestamp/{itemCategory}',[ItemCategoryController::class, 'timestamp'])->name('item-categories.timestamp');

	/* ======================== Uom ======================================== */
	Route::resource('uoms', UomController::class);
	Route::get('/uom/export',[UomController::class,'export'])->name('uoms.export');
	Route::get('/uoms/delete/{uom}',[UomController::class,'destroy'])->name('uoms.destroy');
	Route::get('/uoms/timestamp/{uom}',[UomController::class, 'timestamp'])->name('uoms.timestamp');


	/* ======================== Oem ======================================== */
	Route::resource('oems', OemController::class);
	Route::get('/oem/export',[OemController::class,'export'])->name('oems.export');
	Route::get('/oems/delete/{oem}',[OemController::class,'destroy'])->name('oems.destroy');
	Route::get('/oems/timestamp/{oem}',[OemController::class, 'timestamp'])->name('oems.timestamp');


	/* ======================== Setup ======================================== */
	Route::resource('setups', SetupController::class);
	// CHECK
	Route::get('setups/image/{filename}',[SetupController::class, 'image'])->name('setups.image');
	Route::get('setups/announcement/{setup}', [SetupController::class, 'notice'])->name('setups.announcement');
	Route::post('setups/update-notice/{setup}', [SetupController::class, 'updateNotice'])->name('setups.update-notice');
	Route::get('setups/tc/{setup}', [SetupController::class, 'tc'])->name('setups.tc');
	Route::post('setups/update-tc/{setup}', [SetupController::class, 'updateTc'])->name('setups.update-tc');
	Route::post('setups/freeze/{setup}', [SetupController::class, 'freeze'])->name('setups.freeze');
	Route::get('/setups/timestamp/{setup}',[SetupController::class, 'timestamp'])->name('setups.timestamp');

	/* ======================== Hierarchy ======================================== */
	Route::resource('hierarchies', HierarchyController::class);
	Route::get('/hierarchy/export',[HierarchyController::class,'export'])->name('hierarchies.export');
	Route::get('/hierarchies/delete/{hierarchy}',[HierarchyController::class,'destroy'])->name('hierarchies.destroy');
	Route::get('/hierarchies/timestamp/{hierarchy}',[HierarchyController::class, 'timestamp'])->name('hierarchies.timestamp');

	/* ======================== Aeh ======================================== */
	Route::resource('aehs', AehController::class);

	/* ======================== Wf ======================================== */
	Route::resource('wfs', WfController::class);
	Route::get('/wf/export',[WfController::class,'export'])->name('wfs.export');
	Route::get('/wfs/wf-reset-pr/{pr}',[WfController::class,'wfResetPr'])->name('wfs.wf-reset-pr');
	Route::get('/wfs/wf-reset-po/{po}',[WfController::class,'wfResetPo'])->name('wfs.wf-reset-po');

	/* ======================== Wfl ======================================== */
	Route::get('/wfl/export',[WflController::class,'export'])->name('wfls.export');
	Route::get('/wfls/delete/{wfl}',[WflController::class,'destroy'])->name('wfls.destroy');

});

/**
* ==================================================================================
* 3. Tenant Back Office Routes (Need Auth+ Email Verification + can:access-back-office)
* ==================================================================================
*/
Route::middleware([
	'web','auth', 'verified','can:support',
	InitializeTenancyByDomain::class,
	PreventAccessFromCentralDomains::class,
	])->group(function () {

		/* ======================== User ========================================  */
		Route::get('/users/impersonate/{user}/',[UserController::class, 'impersonate'])->name('users.impersonate');

		/* ======================== Pr ======================================== */
		Route::get('/prs/recalculate/{pr}',[PrController::class,'recalculate'])->name('prs.recalculate');

		/* ======================== Invoice ======================================== */
		Route::get('/invoices/recalculate/{invoice}',[InvoiceController::class,'recalculate'])->name('invoices.recalculate');

		/* ======================== Aeh ========================================  */
		Route::get('/aeh/manual',[AehController::class,'manual'])->name('aehs.manual');
		Route::post('/aeh/manual-ael',[AehController::class,'manualAeh'])->name('aehs.manual-aeh');

		/* ======================== Ael ========================================  */
		// Check
		//Route::get('/ael/manual',[AelController::class,'manual'])->name('aels.manual');
		//Route::post('/ael/manual-ael',[AelController::class,'manualAel'])->name('aels.manual-ael');

		/* ======================== Country ======================================== */
		Route::resource('countries', CountryController::class);
		Route::get('/country/export',[CountryController::class,'export'])->name('countries.export');
		Route::get('/countries/delete/{country}',[CountryController::class, 'destroy'])->name('countries.destroy');
	});

/**
* ==================================================================================
* 3. System
* ==================================================================================
*/
Route::middleware([
	'web','auth', 'verified','can:system',
	InitializeTenancyByDomain::class,
	PreventAccessFromCentralDomains::class,
	])->group(function () {

		/* ======================== Cp ======================================== */
		Route::resource('cps', CpController::class);
		Route::get('/cp/changelog',[CpController::class,'changeLog'])->name('cps.changelog');
		Route::get('/cp/codegen',[CpController::class,'changeLog'])->name('cps.changelog');
		Route::get('/cp/ui',[CpController::class,'ui'])->name('cps.ui');
		Route::get('/cp/timestamp',[CpController::class,'checkTimestamp'])->name('cps.timestamp');
		//Route::get('/menus/delete/{menu}',[MenuController::class,'destroy'])->name('menus.destroy');

		/* ======================== Table ========================================  */
		Route::resource('tables', TableController::class);
		Route::get('/table/structure/{table}',[TableController::class, 'structure'])->name('tables.structure');
		Route::get('/table/controllers/{dir?}',[TableController::class, 'controllers'])->name('tables.controllers');
		Route::get('/table/controllers-fnc/{dir?}',[TableController::class, 'fncControllers'])->name('tables.fnc-controllers');
		Route::get('/table/models/{dir?}',[TableController::class, 'models'])->name('tables.models');
		Route::get('/table/all-models',[TableController::class, 'allModels'])->name('tables.all-models');
		Route::get('/table/models-fnc/{dir?}',[TableController::class, 'fncModels'])->name('tables.fnc-models');
		Route::get('/table/policies/{dir?}',[TableController::class, 'policies'])->name('tables.policies');
		Route::get('/table/policies-fnc/{dir?}',[TableController::class, 'fncPolicies'])->name('tables.fnc-policies');
		Route::get('/table/helpers/{dir?}',[TableController::class, 'helpers'])->name('tables.helpers');
		Route::get('/table/helpers-fnc/{dir?}',[TableController::class, 'fncHelpers'])->name('tables.fnc-helpers');
		Route::get('/table/routes',[TableController::class, 'routes'])->name('tables.routes');
		Route::get('/table/route-code/{dir?}',[TableController::class, 'routeCode'])->name('tables.route-code');
		Route::get('/table/comments/{dir?}',[TableController::class, 'comments'])->name('tables.comments');
		Route::get('/table/messages/{dir?}',[TableController::class, 'messages'])->name('tables.messages');
		Route::get('/table/check',[TableController::class, 'check'])->name('tables.check');

		/* ======================== User ======================================== */
		Route::get('/user/switch',[UserController::class, 'switch'])->name('users.switch');

		/* ======================== Activity ======================================== */
		Route::resource('activities', ActivityController::class);
		Route::get('/activity/export',[ActivityController::class, 'export'])->name('activities.export');

		/* ======================== Template ========================================  */
		Route::resource('templates', TemplateController::class);
		Route::get('/template/export',[TemplateController::class, 'export'])->name('templates.export');
		Route::get('/templates/delete/{template}',[TemplateController::class, 'destroy'])->name('templates.destroy');
		Route::get('/templates/submit/{template}',[TemplateController::class, 'submit'])->name('templates.submit');

		/* ======================== Attachment ======================================== */
		Route::get('/attachment/export',[AttachmentController::class,'export'])->name('attachments.export');
		Route::get('/attachment/all',[AttachmentController::class, 'all'])->name('attachments.all');

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

		/* ======================== Notification ======================================== */
		Route::get('/notification/full',[NotificationController::class, 'full'])->name('notifications.full');


		/* ======================== Purging Cache ========================================  */
		// Route::get('/clear', function() {
		// 	Artisan::call('cache:clear');
		// 	Artisan::call('cache:clear');
		// 	Artisan::call('route:clear');
		// 	Artisan::call('config:clear');
		// 	Artisan::call('view:clear');
		// 	return "Cache is cleared at ".now();
		// });

	});

/**
* ==================================================================================
* 5. Route for Testing purpose and Misc Routes (Ony For back Office)
* ==================================================================================
*/
Route::middleware([
	// TODO 'web','auth', 'verified','can:system',
	'web','auth', 'verified',
	InitializeTenancyByDomain::class,
	PreventAccessFromCentralDomains::class,
	])->group(function () {

		//Route::get('/payment/send/{xid?}',[PaymentController::class,'testNotification'])->name('payments.send');
		/* ======================== Home Controller ======================================== */
		Route::get('/send/{id?}', [HomeController::class, 'testNotification'])->name('send');
		Route::get('/demomail', [HomeController::class, 'demomail'])->name('demomail');
		Route::post('/save-contact', [HomeController::class, 'saveContact'])->name('home.savecontact');
		Route::get('/send-queue-email', function(){
			$send_mail = 'khondker@gmail.com';
			dispatch(new App\Jobs\SendEmailQueueJob($send_mail));
			dd('Send mail using que successfully !!');
		});
		Route::get('email-test', function(){
			$details['email'] = 'khondker@gmail.com';
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
	//	return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
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
