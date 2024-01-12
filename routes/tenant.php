<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

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
use App\Http\Controllers\Tenant\Lookup\GroupController;
use App\Http\Controllers\Tenant\Lookup\ItemController;
use App\Http\Controllers\Tenant\Lookup\OemController;
use App\Http\Controllers\Tenant\Lookup\PayMethodController;
use App\Http\Controllers\Tenant\Lookup\ProjectController;
use App\Http\Controllers\Tenant\Lookup\RateController;
use App\Http\Controllers\Tenant\Lookup\SupplierController;
use App\Http\Controllers\Tenant\Lookup\UomController;
use App\Http\Controllers\Tenant\Lookup\UploadItemController;
use App\Http\Controllers\Tenant\Lookup\WarehouseController;

use App\Http\Controllers\Tenant\Manage\EntityController;
use App\Http\Controllers\Tenant\Manage\MenuController;
use App\Http\Controllers\Tenant\Manage\TableController;
use App\Http\Controllers\Tenant\Manage\TemplateController;

use App\Http\Controllers\Tenant\Workflow\HierarchyController;
use App\Http\Controllers\Tenant\Workflow\HierarchylController;
use App\Http\Controllers\Tenant\Workflow\WfController;
use App\Http\Controllers\Tenant\Workflow\WflController;

use App\Http\Controllers\Tenant\Support\TicketController;

use App\Http\Controllers\Tenant\BudgetController;
use App\Http\Controllers\Tenant\DeptBudgetController;
use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Controllers\Tenant\NotificationController;
use App\Http\Controllers\Tenant\PaymentController;
use App\Http\Controllers\Tenant\PoController;
use App\Http\Controllers\Tenant\PolController;
use App\Http\Controllers\Tenant\PrController;
use App\Http\Controllers\Tenant\PrlController;
use App\Http\Controllers\Tenant\ReceiptController;
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

Route::middleware([
	'web',
	InitializeTenancyByDomain::class,
	PreventAccessFromCentralDomains::class,
])->group(function () {
	
	// Route::get('/', function () {
	//     return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
	// });


	/**
	* ==================================================================================
	* Route for Testing purpose
	* ==================================================================================
	*/
	Route::get('testrun/',[TestController::class, 'run'])->name('test.run');
	Route::get('/test', function () {
		dd('done at ' .date('Y'));
	})->name('test');
	
	
	/* ======================== make auth universal ========================================  */
	 Route::middleware(['universal'])->namespace('App\\Http\\Controllers\\')->group(function () { 
		Auth::routes(); 
	});
   
	// IQBAL 28-feb-23
	Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

	/* ======================== User ========================================  */
	Route::resource('users', UserController::class)->middleware(['auth', 'verified']);
	Route::get('/users/delete/{user}',[UserController::class, 'destroy'])->name('users.destroy');
	// TOTO check ->middleware(['auth', 'verified']) for the rest
	Route::get('users.password/{user}',[UserController::class, 'password'])->name('users.password');
	Route::post('users/changepass/{user}',[UserController::class, 'changepass'])->name('users.changepass');
	Route::get('/user/export',[UserController::class, 'export'])->name('users.export');
	//TODO remove next two used in footer
	Route::get('/user/role',[UserController::class, 'role'])->name('users.role');
	Route::get('/user/updaterole/{user}/{role}',[UserController::class, 'updaterole'])->name('users.updaterole');
	Route::get('/user/image/{filename}',[UserController::class, 'image'])->name('users.image');
	// TODO
	//Route::get('/user/enable/{user}',[UserController::class, 'enable'])->name('users.enable');
	Route::get('/users/impersonate/{user}/',[UserController::class, 'impersonate'])->name('users.impersonate');
	Route::get('/leave-impersonate',[UserController::class, 'leaveImpersonate'])->name('users.leave-impersonate');
	
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

	/* ======================== Home Controller ======================================== */
	Route::get('/help', [HomeController::class, 'help'])->name('help');
	Route::get('/send', [HomeController::class, 'testNotification'])->name('send');
	Route::get('/demomail', [HomeController::class, 'demomail'])->name('demomail');
	Route::get('/home', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
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

	/* ======================== Dashboard ========================================  */
	//TODO enable verify middleware for all route
	Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
	//Route::get('/home', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
	Route::resource('dashboards', DashboardController::class)->middleware(['auth', 'verified']);
	//Route::resource('dashboards', DashboardController::class);

	/* ======================== Table ========================================  */
	Route::resource('tables', TableController::class);
	Route::get('/table/structure/{table}',[TableController::class, 'structure'])->name('tables.structure');
	Route::get('/table/controllers',[TableController::class, 'controllers'])->name('tables.controllers');
	Route::get('/table/models',[TableController::class, 'models'])->name('tables.models');
	Route::get('/table/routes',[TableController::class, 'routes'])->name('tables.routes');
	Route::get('/table/route-code',[TableController::class, 'routeCode'])->name('tables.route-code');
	Route::get('/table/policies',[TableController::class, 'policies'])->name('tables.policies');
	Route::get('/table/comments',[TableController::class, 'comments'])->name('tables.comments');
	Route::get('/table/check',[TableController::class, 'check'])->name('tables.check');
	Route::get('/table/messages',[TableController::class, 'messages'])->name('tables.messages');

	/* ======================== Template ========================================  */
	Route::resource('templates', TemplateController::class);
	Route::get('/template/export',[TemplateController::class, 'export'])->name('templates.export');
	Route::get('/templates/delete/{template}',[TemplateController::class, 'destroy'])->name('templates.destroy');
	Route::get('/templates/submit/{template}',[TemplateController::class, 'submit'])->name('templates.submit');

	/* ======================== Menu ======================================== */
	Route::resource('menus', MenuController::class)->middleware(['auth', 'verified']);
	Route::get('/menu/export',[MenuController::class,'export'])->name('menus.export');
	Route::get('/menus/delete/{menu}',[MenuController::class,'destroy'])->name('menus.destroy');
	
	/* ======================== Notification ======================================== */
	Route::resource('notifications', NotificationController::class);
	Route::get('/notification/all',[NotificationController::class, 'all'])->name('notifications.all');
	Route::get('/notifications/read/{notification}',[NotificationController::class, 'read'])->name('notifications.read');
	Route::get('/notification/purge',[NotificationController::class, 'purge'])->name('notifications.purge');
	Route::get('/notifications/delete/{notification}',[NotificationController::class, 'destroy'])->name('notifications.destroy');

	/* ======================== Activity ======================================== */
	Route::resource('activities', ActivityController::class)->middleware(['auth', 'verified']);
	Route::get('/activity/export',[ActivityController::class, 'export'])->name('activities.export');

	/* ======================== Attachment ======================================== */
	Route::resource('attachments', AttachmentController::class)->middleware(['auth', 'verified']);
	Route::get('/attachment/export',[AttachmentController::class,'export'])->name('attachments.export');
	Route::get('/attachments/delete/{attachment}',[AttachmentController::class,'destroy'])->name('attachments.destroy');
	Route::get('/attachments/download/{filename}',[AttachmentController::class, 'download'])->name('attachments.download');
	
	/* ======================== Country ======================================== */
	Route::resource('countries', CountryController::class)->middleware(['auth', 'verified']);
	Route::get('/country/export',[CountryController::class,'export'])->name('countries.export');
	Route::get('/countries/delete/{country}',[CountryController::class, 'destroy'])->name('countries.destroy');

	/* ======================== Currency ======================================== */
	Route::resource('currencies', CurrencyController::class)->middleware(['auth', 'verified']);
	Route::get('/currency/export',[CurrencyController::class,'export'])->name('currencies.export');
	Route::get('/currencies/delete/{currency}',[CurrencyController::class, 'destroy'])->name('currencies.destroy');

	/* ======================== Entity ======================================== */
	Route::resource('entities', EntityController::class)->middleware(['auth', 'verified']);
	Route::get('/entities/delete/{entity}',[EntityController::class, 'destroy'])->name('entities.destroy');
	
	/* ======================== Setup ======================================== */
	Route::resource('setups', SetupController::class)->middleware(['auth', 'verified']);
	Route::get('setups/image/{filename}',[SetupController::class, 'image'])->name('setups.image');
	Route::get('setups/announcement/{setup}', [SetupController::class, 'notice'])->name('setups.announcement');
	Route::post('setups/updatenotice/{setup}', [SetupController::class, 'updatenotice'])->name('setups.updatenotice');
	Route::post('setups/freeze/{setup}', [SetupController::class, 'freeze'])->name('setups.freeze');
	

	/* ======================== FileAccess ======================================== */
	//Route::get('/logo/{file}', [FileAccessController::class, 'logo'])->name('logo');
	//Route::get('/avatar/{file}', [FileAccessController::class, 'avatar'])->name('avatar');

	/* ======================== Dept (template)======================================== */
	Route::resource('depts', DeptController::class)->middleware(['auth', 'verified']);
	Route::get('/dept/export',[DeptController::class, 'export'])->name('depts.export');
	Route::get('/depts/delete/{dept}',[DeptController::class, 'destroy'])->name('depts.destroy');

	/* ======================== Designation ======================================== */
	Route::resource('designations', DesignationController::class)->middleware(['auth', 'verified']);
	Route::get('/designation/export',[DesignationController::class, 'export'])->name('designations.export');
	Route::get('/designations/delete/{designation}',[DesignationController::class, 'destroy'])->name('designations.destroy');

	/* ======================== Group ======================================== */
	Route::resource('groups', GroupController::class)->middleware(['auth', 'verified']);
	Route::get('/group/export',[GroupController::class,'export'])->name('groups.export');
	Route::get('/groups/delete/{group}',[GroupController::class,'destroy'])->name('groups.destroy');

	/* ======================== Warehouse ======================================== */
	Route::resource('warehouses', WarehouseController::class)->middleware(['auth', 'verified']);
	Route::get('/warehouse/export',[WarehouseController::class,'export'])->name('warehouses.export');
	Route::get('/warehouses/delete/{warehouse}',[WarehouseController::class,'destroy'])->name('warehouses.destroy');

	/* ======================== Category ======================================== */
	Route::resource('categories', CategoryController::class)->middleware(['auth', 'verified']);
	Route::get('/category/export',[CategoryController::class, 'export'])->name('categories.export');
	Route::get('/categories/delete/{category}',[CategoryController::class, 'destroy'])->name('categories.destroy');

	/* ======================== Uom ======================================== */
	Route::resource('uoms', UomController::class)->middleware(['auth', 'verified']);
	Route::get('/uom/export',[UomController::class,'export'])->name('uoms.export');
	Route::get('/uoms/delete/{uom}',[UomController::class,'destroy'])->name('uoms.destroy');

	/* ======================== Oem ======================================== */
	Route::resource('oems', OemController::class)->middleware(['auth', 'verified']);
	Route::get('/oem/export',[OemController::class,'export'])->name('oems.export');
	Route::get('/oems/delete/{oem}',[OemController::class,'destroy'])->name('oems.destroy');

	/* ======================== Supplier ======================================== */
	Route::resource('suppliers', SupplierController::class)->middleware(['auth', 'verified']);
	Route::get('/supplier/export',[SupplierController::class,'export'])->name('suppliers.export');
	Route::get('/suppliers/delete/{supplier}',[SupplierController::class,'destroy'])->name('suppliers.destroy');

	/* ======================== Project ======================================== */
	Route::resource('projects', ProjectController::class)->middleware(['auth', 'verified']);
	Route::get('/project/export',[ProjectController::class,'export'])->name('projects.export');
	Route::get('/projects/delete/{project}',[ProjectController::class,'destroy'])->name('projects.destroy');
	Route::post('/project/attach',[ProjectController::class,'attach'])->name('projects.attach');
	Route::get('/projects/detach/{project}',[ProjectController::class,'detach'])->name('projects.detach');

	/* ======================== Budget ======================================== */
	Route::resource('budgets', BudgetController::class)->middleware(['auth', 'verified']);
	Route::get('/budget/export',[BudgetController::class,'export'])->name('budgets.export');
	Route::get('/budgets/delete/{budget}',[BudgetController::class,'destroy'])->name('budgets.destroy');
	Route::post('/budget/attach',[BudgetController::class,'attach'])->name('budgets.attach');
	Route::get('/budgets/detach/{budget}',[BudgetController::class,'detach'])->name('budgets.detach');
	
	/* ======================== Item ======================================== */
	Route::resource('items', ItemController::class)->middleware(['auth', 'verified']);
	Route::get('/item/export',[ItemController::class,'export'])->name('items.export');
	Route::get('/items/delete/{item}',[ItemController::class,'destroy'])->name('items.destroy');

	/* ======================== Hierarchy ======================================== */
	Route::resource('hierarchies', HierarchyController::class)->middleware(['auth', 'verified']);
	Route::get('/hierarchy/export',[HierarchyController::class,'export'])->name('hierarchies.export');
	Route::get('/hierarchies/delete/{hierarchy}',[HierarchyController::class,'destroy'])->name('hierarchies.destroy');

	/* ======================== Hierarchyl ======================================== */
	//Route::resource('hierarchyls', HierarchylController::class)->middleware(['auth', 'verified']);
	//Route::get('/hierarchyl/export',[HierarchylController::class,'export'])->name('hierarchyls.export');
	//Route::get('/hierarchyls/delete/{hierarchyl}',[HierarchylController::class,'destroy'])->name('hierarchyls.destroy');

	/* ======================== Wf ======================================== */
	Route::resource('wfs', WfController::class)->middleware(['auth', 'verified']);
	Route::get('/wf/export',[WfController::class,'export'])->name('wfs.export');
	Route::get('/wf/reset-pr',[WfController::class,'resetpr'])->name('wfs.reset-pr');
	Route::post('/wf/deletewfpr',[WfController::class,'deletewfpr'])->name('wfs.deletewfpr');
	Route::get('/wf/reset-po',[WfController::class,'resetpo'])->name('wfs.reset-po');
	Route::get('/wfs/delete/{wf}',[WfController::class,'destroy'])->name('wfs.destroy');

	/* ======================== Wfl ======================================== */
	Route::resource('wfls', WflController::class)->middleware(['auth', 'verified']);
	Route::get('/wfl/export',[WflController::class,'export'])->name('wfls.export');
	Route::get('/wfls/delete/{wfl}',[WflController::class,'destroy'])->name('wfls.destroy');

	/* ======================== Report ========================================  */
	Route::resource('reports', ReportController::class)->middleware(['auth', 'verified']);
	Route::get('/report/export',[ReportController::class, 'export'])->name('reports.export');
	Route::get('/report/pr/{id}',[ReportController::class, 'pr'])->name('reports.pr');
	Route::get('/report/createPDF',[ReportController::class, 'createPDF'])->name('reports.createPDF');
	Route::get('/report/templatepr',[ReportController::class, 'templatepr'])->name('reports.templatepr');
	Route::get('/report/templatepo',[ReportController::class, 'templatepo'])->name('reports.templatepo');
	Route::get('/report/stocks',[ReportController::class, 'stocks'])->name('reports.stocks');

	/* ======================== DeptBudget ======================================== */
	Route::resource('dept-budgets', DeptBudgetController::class)->middleware(['auth', 'verified']);
	Route::get('/dept-budget/export',[DeptBudgetController::class,'export'])->name('dept-budgets.export');
	//TODO
	Route::get('/dept-budgets/delete/{deptBudget}',[DeptBudgetController::class,'destroy'])->name('dept-budgets.destroy');
	//Route::get('/dept-budgets/revision/{deptBudget}',[DeptBudgetController::class,'revision'])->name('dept-budgets.revision');
	Route::post('/dept-budget/attach',[DeptBudgetController::class,'attach'])->name('dept-budgets.attach');
	Route::get('/dept-budgets/detach/{deptBudget}',[DeptBudgetController::class,'detach'])->name('dept-budgets.detach');
   
	/* ======================== PayMethod ======================================== */
	Route::resource('pay-methods', PayMethodController::class)->middleware(['auth', 'verified']);
	Route::get('/pay-method/export',[PayMethodController::class,'export'])->name('pay-methods.export');
	Route::get('/pay-methods/delete/{payMethod}',[PayMethodController::class,'destroy'])->name('pay-methods.destroy');

	/* ======================== Pr ======================================== */
	Route::resource('prs', PrController::class)->middleware(['auth', 'verified']);
	Route::get('/pr/export',[PrController::class,'export'])->name('prs.export');
	Route::get('/prs/pdf/{pr}',[PrController::class,'pdf'])->name('prs.pdf');
	Route::get('/prs/delete/{pr}',[PrController::class,'destroy'])->name('prs.destroy');

	Route::post('/pr/attach',[PrController::class,'attach'])->name('prs.attach');
	Route::get('/prs/detach/{pr}',[PrController::class,'detach'])->name('prs.detach');
	Route::get('/prs/submit/{pr}',[PrController::class, 'submit'])->name('prs.submit');
	Route::get('/prs/copy/{pr}',[PrController::class, 'copy'])->name('prs.copy');

	/* ======================== Prl ======================================== */
	Route::resource('prls', PrlController::class)->middleware(['auth', 'verified']);
	Route::get('/prl/export',[PrlController::class,'export'])->name('prls.export');
	Route::get('/prls/delete/{prl}',[PrlController::class,'destroy'])->name('prls.destroy');
	Route::get('/prls/createline/{id}',[PrlController::class, 'createLine'])->name('prls.createline');

	/* ======================== Po ======================================== */
	Route::resource('pos', PoController::class)->middleware(['auth', 'verified']);
	Route::get('/po/export',[PoController::class,'export'])->name('pos.export');
	Route::get('/pos/delete/{po}',[PoController::class,'destroy'])->name('pos.destroy');

	/* ======================== Pol ======================================== */
	Route::resource('pols', PolController::class)->middleware(['auth', 'verified']);
	Route::get('/pol/export',[PolController::class,'export'])->name('pols.export');
	Route::get('/pols/delete/{pol}',[PolController::class,'destroy'])->name('pols.destroy');

	/* ======================== Receipt ======================================== */
	Route::resource('receipts', ReceiptController::class)->middleware(['auth', 'verified']);
	Route::get('/receipt/export',[ReceiptController::class,'export'])->name('receipts.export');
	Route::get('/receipts/delete/{receipt}',[ReceiptController::class,'destroy'])->name('receipts.destroy');

	/* ======================== Payment ======================================== */
	Route::resource('payments', PaymentController::class)->middleware(['auth', 'verified']);
	Route::get('/payment/export',[PaymentController::class,'export'])->name('payments.export');
	Route::get('/payments/delete/{payment}',[PaymentController::class,'destroy'])->name('payments.destroy');

	/* ======================== UploadItem ======================================== */
	Route::resource('upload-items', UploadItemController::class)->middleware(['auth', 'verified']);
	Route::get('/upload-item/export',[UploadItemController::class, 'export'])->name('upload-items.export');
	Route::get('/upload-item/check',[UploadItemController::class, 'check'])->name('upload-items.check');
	Route::get('/upload-item/import',[UploadItemController::class, 'import'])->name('upload-items.import');


	/* ======================== Rate ======================================== */
	Route::resource('rates', RateController::class)->middleware(['auth', 'verified']);
	Route::get('/rate/export',[RateController::class,'export'])->name('rates.export');
	Route::get('/rates/delete/{rate}',[RateController::class,'destroy'])->name('rates.destroy');

	/* ======================== Ticket ======================================== */
	Route::resource('tickets', TicketController::class);
	

	/* ======================== Misc Tenant Routes  ========================================  */

	Route::get('/html', function () {
		return view('blankhtml');
	})->name('blank');
	
	Route::get('/design', function () {
		return view('design');
	})->name('design');

	

	//Route::get('/entity/delete/{entity}',[EntityController::class, 'destroy'])->name('entities.destroy');
	//Route::get('/entity/export',[EntityController::class, 'export'])->name('entities.export');
	
	Route::get('/clear', function() {
		Artisan::call('cache:clear');
		Artisan::call('cache:clear');
		Artisan::call('route:clear');
		Artisan::call('config:clear');
		Artisan::call('view:clear');
		return "Cache is cleared at ".now();
	});
	
	/* ======================== Pages ======================================== */
	// Route::get('/faq', function () {
	// 	return view('pages.faq');
	// })->name('faq');

	Route::get('/tos', function () {
		return view('tenant.pages.tos');
	})->name('tos');

	Route::get('/privacy', function () {
		return view('tenant.pages.privacy');
	})->name('privacy');

	// Route::get('/about', function () {
	// 	return view('pages.about-us');
	// })->name('about');

	// Route::get('/contact-us', function () {
	// 	return view('pages.contact-us');
	// })->name('contact-us');


});
