<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Models\User;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Sequence of Web Routes for ANYPO.NET
|--------------------------------------------------------------------------
|  1. Seeded Override Routes
|  2. Public Page Routes
|  3. Public Controller Based Routes
|  4. Public Routes related to authentication and email verification
|  5. Public Routes related to Email verification
|  6. Public routes for stripe
|  7. Routes for Regular user ['auth', 'verified']
|  8. Routes for Customer Admin User ['auth', 'verified','can:admin']
|  9. Routes for Support ['auth', 'verified','can:support']
| 10. Route only system can access ['auth', 'verified','can:system']
| 11. Route for Testing system Only ['auth', 'verified','can:system']
*/


/**
* ==================================================================================
* 1. Seeded Override Routes
* ==================================================================================
*/
Route::get('/', function () {
	return view('landlord.home');
})->name('root');
Route::get('/home', function () {
	return view('landlord.home');
})->name('home');


/**
* ==================================================================================
* 2. Public Page Routes
* ==================================================================================
*/
use App\Models\Landlord\Manage\Config;
Route::get('/product', function () {
	return view('landlord.pages.product');
})->name('product');

Route::get('/faq', function () {
	return view('landlord.pages.faq');
})->name('faq');

Route::get('/tos', function () {
	return view('landlord.pages.tos');
})->name('tos');

Route::get('/privacy', function () {
	return view('landlord.pages.privacy');
})->name('privacy');

Route::get('/about', function () {
	return view('landlord.pages.about-us');
})->name('about');

Route::get('/contact-us', function () {
	$config = Config::with('relCountry')->first();
	return view('landlord.pages.contact-us', compact('config'));
})->name('contact-us');

/**
* ==================================================================================
* 3. Public Controller Based Routes
* ==================================================================================
*/
// Home Controller 
use App\Http\Controllers\Landlord\HomeController;
Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('home.checkout');
Route::get('/online/{invoice_no}', [HomeController::class, 'onlineInvoice'])->name('home.invoice');
Route::post('/save-contact', [HomeController::class, 'saveLandlordContact'])->name('home.save-contact');
Route::post('/join-mail-list', [HomeController::class, 'joinMailList'])->name('home.join-mail-list');

/**
* ==================================================================================
* 4. Public Routes related to login and registration
* ==================================================================================
*/
use App\Http\Controllers\Auth\LoginController;
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout');

// Registration Routes...
use App\Http\Controllers\Auth\RegisterController;
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Self Password Reset Routes...
use App\Http\Controllers\Auth\ConfirmPasswordController;
Route::get('/password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('/password/confirm', [ConfirmPasswordController::class, 'confirm']);

use App\Http\Controllers\Auth\ForgotPasswordController;
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email'); // view not override yet
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

use App\Http\Controllers\Auth\ResetPasswordController;
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update'); // view not override yet
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

/**
* ==================================================================================
* 5. Public Routes related to Email verification
* ==================================================================================
*/
use Illuminate\Foundation\Auth\EmailVerificationRequest;
Route::get('/email/verify', function () {
	if (tenant('id') == '') {
		return view('auth.landlord-verify-email');
	} else {
		return view('auth.verify-email');
	}
	})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
	$request->fulfill();
	// not needed in landlord as user created is enabled by default.
	//Auth::logout();
	//return redirect('/login');
	return redirect('/home');
	})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
	try {
		session()->put('resent', true);
		$user = User::where('email', $request->input('email'))->firstOrFail();
		$user->sendEmailVerificationNotification();
	} catch (\Exception $exception) {
		// General Exception class which is the parent of all Exceptions
	}
	//$request->user()->sendEmailVerificationNotification();
	//return back()->with('message', 'Verification link sent!');
	return back()->with('success', 'Verification link sent! Please check your mail and clink on "Verify Email Address" link.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/**
* ==================================================================================
* 6. Public routes for stripe
* ==================================================================================
*/
Route::post('/checkout-stripe', [HomeController::class, 'checkoutStripe'])->name('checkout-stripe');
Route::post('/payment-stripe', [HomeController::class, 'paymentStripe'])->name('payment-stripe');
Route::get('/success', [HomeController::class, 'success'])->name('checkout.success');
Route::get('/success-payment', [HomeController::class, 'successPayment'])->name('checkout.success-payment');
Route::get('/success-addon', [HomeController::class, 'successAddon'])->name('checkout.success-addon');
Route::get('/success-advance', [HomeController::class, 'successAdvance'])->name('checkout.success-advance');
Route::get('/cancel', [HomeController::class, 'cancel'])->name('checkout.cancel');
// TODO
// Route::post('/webhook', [HomeController::class, 'webhook'])->name('checkout.webhook');

/**
* ==================================================================================
* 7. Routes for Regular user ['auth', 'verified']
* ==================================================================================
*/
use App\Http\Controllers\Landlord\DashboardController;
use App\Http\Controllers\Landlord\TicketController;
use App\Http\Controllers\Landlord\CommentController;
use App\Http\Controllers\Landlord\ReportController;
use App\Http\Controllers\Landlord\Admin\UserController;
use App\Http\Controllers\Landlord\Admin\AttachmentController;

Route::middleware(['auth', 'verified'])->group(function () {

	/* ======================== Dashboard ========================================  */
	Route::resource('dashboards', DashboardController::class);
	
	/* ======================== Ticket ======================================== */
	Route::resource('tickets', TicketController::class);
	//Route::get('/ticket/support', [TicketController::class, 'support'])->name('tickets.support');
	//Route::get('/tickets/pdf/{pr}', [TicketController::class,'pdf'])->name('tickets.pdf');
	Route::get('/ticket/export', [TicketController::class, 'export'])->name('tickets.export');
	Route::get('/ticket/close/{ticket}', [TicketController::class, 'close'])->name('tickets.close');
	
	/* ======================== Comments ========================================  */
	Route::resource('comments', CommentController::class);

	/* ======================== Report ========================================  */
	Route::resource('reports', ReportController::class);
	Route::get('/reports/pdf-invoice/{invoice}', [ReportController::class, 'viewPdfInvoice'])->name('reports.pdf-invoice');
	Route::get('/reports/pdf-receipt/{payment}', [ReportController::class, 'viewPdfPayment'])->name('reports.pdf-payment');

	/* ======================== User ========================================  */
	Route::resource('users', UserController::class)->middleware(['auth', 'verified']);
	Route::get('/users/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');
	Route::get('/users/password-change/{user}', [UserController::class, 'changePassword'])->name('users.password-change');
	Route::post('/user/password-update/{user}', [UserController::class, 'updatePassword'])->name('users.password-update');
	Route::get('/user/export', [UserController::class, 'export'])->name('users.export');
	Route::get('/leave-impersonate', [UserController::class, 'leaveImpersonate'])->name('users.leave-impersonate');
	
	/* ======================== Attachment ======================================== */
	Route::get('/attachments/download/{fileName}', [AttachmentController::class, 'download'])->name('attachments.download');

});


/**
* ==================================================================================
* 8. Routes for Customer Admin User ['auth', 'verified','can:admin']
* ==================================================================================
*/
use App\Http\Controllers\Landlord\AccountController;
use App\Http\Controllers\Landlord\Admin\ServiceController;
use App\Http\Controllers\Landlord\Admin\InvoiceController;
use App\Http\Controllers\Landlord\Admin\PaymentController;
use App\Http\Controllers\Landlord\Admin\ActivityController;

Route::middleware(['auth', 'verified','can:admin'])->group(function () {

	/* ======================== Account ======================================== */
	Route::resource('accounts', AccountController::class);
	//Route::get('/account/export', [AccountController::class, 'export'])->name('accounts.export');
	Route::get('/add-addon/{account_id}/{addon_id}', [AccountController::class, 'addAddon'])->name('accounts.add-addon');

	/* ======================== Service ======================================== */
	Route::resource('services', ServiceController::class);

	/* ======================== Invoice ======================================== */
	Route::resource('invoices', InvoiceController::class);
	Route::get('/invoice/generate',[InvoiceController::class,'generate'])->name('invoices.generate');

	/* ======================== Payment ======================================== */
	Route::resource('payments', PaymentController::class);
	//Route::get('/payments/pdf/{pr}', [PaymentController::class,'pdf'])->name('payments.pdf');

	/* ======================== Activity ========================================  */
	Route::resource('activities', ActivityController::class);
});


/**
 * ==================================================================================
 * 9. Routes for Support ['auth', 'verified','can:support']
 * ==================================================================================
*/
use App\Http\Controllers\DomainController;
use App\Http\Controllers\TenantController;

use App\Http\Controllers\Landlord\Manage\ContactController;
use App\Http\Controllers\Landlord\Lookup\CategoryController;
use App\Http\Controllers\Landlord\Lookup\CountryController;
use App\Http\Controllers\Landlord\Lookup\ProductController;
use App\Http\Controllers\Landlord\Manage\CheckoutController;
use App\Http\Controllers\Landlord\Manage\MailListController;

// Ref: app/Providers/AppServiceProvider.php
Route::middleware(['auth', 'verified','can:support'])->group(function () {
	
	/* ======================== User ========================================  */
	Route::get('/user/all', [UserController::class, 'all'])->name('users.all');
	Route::get('/users/impersonate/{user}/', [UserController::class, 'impersonate'])->name('users.impersonate');
	//Route::get('/leave-impersonate', [UserController::class, 'leaveImpersonate'])->name('users.leave-impersonate');
	
	/* ======================== Ticket ========================================  */
	Route::get('/ticket/all', [TicketController::class, 'all'])->name('tickets.all');
	Route::get('/ticket/assign/{ticket}', [TicketController::class, 'assign'])->name('tickets.assign');
	Route::post('/ticket/doassign/{ticket}', [TicketController::class, 'doAssign'])->name('tickets.doassign');

	/* ======================== Accounts ========================================  */
	Route::get('/account/all', [AccountController::class, 'all'])->name('accounts.all');

	/* ======================== Services ======================================== */
	Route::get('/service/all', [ServiceController::class, 'all'])->name('services.all');

		/* ======================== Invoice ======================================== */
	Route::get('/invoice/all', [InvoiceController::class, 'all'])->name('invoices.all');

	/* ======================== Payment ======================================== */
	Route::get('/payment/all', [PaymentController::class, 'all'])->name('payments.all');

	/* ======================== Activity ======================================== */
	Route::get('/activity/all', [ActivityController::class, 'all'])->name('activities.all');

	/* ======================== Contact ======================================== */
	Route::resource('contacts', ContactController::class);
	Route::get('/contact/all', [ContactController::class, 'all'])->name('contacts.all');
	
	/* ======================== Category ======================================== */
	Route::resource('categories', CategoryController::class);
	//P2 Route::get('/categories/delete/{category}',[CategoryController::class, 'destroy'])->name('categories.delete');
	
	/* ======================== Attachment ======================================== */
	Route::resource('attachments', AttachmentController::class);
	//Route::get('/attachment/download/{fileName}', [AttachmentController::class, 'download'])->name('attachments.download');
		
	/* ======================== Country ======================================== */
	Route::resource('countries', CountryController::class);
	Route::get('/country/export',[CountryController::class,'export'])->name('countries.export');
	Route::get('/countries/delete/{country}',[CountryController::class, 'destroy'])->name('countries.delete');

	/* ======================== Product ======================================== */
	Route::resource('products', ProductController::class);

	/* ======================== Checkout ======================================== */
	Route::resource('checkouts', CheckoutController::class);
	Route::get('/checkout/all', [CheckoutController::class, 'all'])->name('checkouts.all');
					
	/* ======================== MailList ======================================== */
	Route::resource('mail-lists', MailListController::class)->middleware(['auth', 'verified']);
	//Route::get('/maillist/export',[MailListController::class,'export'])->name('maillists.export');
	Route::get('/mail-lists/delete/{mailList}',[MailListController::class,'destroy'])->name('mail-lists.destroy');

	/* ======================== Domain ========================================  */
	Route::resource('domains', DomainController::class);

	/* ======================== Tenant ========================================  */
	Route::resource('tenants', TenantController::class);
});
	

/**
* ==================================================================================
* 10. Route only system can access ['auth', 'verified','can:system']
* ==================================================================================
*/
use App\Http\Controllers\Landlord\NotificationController;

use App\Http\Controllers\Landlord\Manage\EntityController;
use App\Http\Controllers\Landlord\Manage\MenuController;
use App\Http\Controllers\Landlord\Manage\ConfigController;
use App\Http\Controllers\Landlord\Manage\TableController;
use App\Http\Controllers\Landlord\Manage\TemplateController;
use App\Http\Controllers\Landlord\Manage\StatusController;
use App\Http\Controllers\Landlord\Manage\ProcessController;
use App\Http\Controllers\Landlord\Manage\ErrorLogController;

Route::middleware(['auth', 'verified','can:system'])->group(function () {

	/* ======================== Account ======================================== */
	Route::get('/accounts/delete/{account}',[AccountController::class, 'destroy'])->name('accounts.delete');

	/* ======================== Notification TODO for Landlord ======================================== */
	Route::resource('notifications', NotificationController::class);
	Route::get('/notifications/read/{notification}', [NotificationController::class, 'read'])->name('notifications.read');

	/* ======================== Process ======================================== */
	Route::resource('processes', ProcessController::class);
	Route::get('/process/gen-invoice-all', [ProcessController::class, 'genInvoiceAll'])->name('processes.gen-invoice-all');
	Route::get('/process/accounts-archive', [ProcessController::class, 'accountsArchive'])->name('processes.accounts-archive');

	/* ======================== Config ======================================== */
	Route::resource('configs', ConfigController::class);

	/* ======================== ErrorLog ======================================== */
	Route::resource('error-logs', ErrorLogController::class);
	
	/* ======================== Status ======================================== */
	Route::resource('statuses', StatusController::class);
	Route::get('/status/export', [StatusController::class, 'export'])->name('statuses.export');
	Route::get('/statuses/delete/{status}', [StatusController::class, 'destroy'])->name('statuses.delete');
		
	/* ======================== Entity ======================================== */
	Route::resource('entities', EntityController::class);
	//Route::get('/entity/delete/{entity}',[EntityController::class, 'destroy'])->name('entities.destroy');
	Route::get('/entity/export', [EntityController::class, 'export'])->name('entities.export');
	
	/* ======================== Menu ======================================== */
	Route::resource('menus', MenuController::class);
	Route::get('/menu/export', [MenuController::class,'export'])->name('menus.export');
	Route::get('/menus/delete/{menu}', [MenuController::class,'destroy'])->name('menus.delete');

	/* ======================== Table ========================================  */
	Route::resource('tables', TableController::class);
	Route::get('/table/structure/{table}',[TableController::class, 'structure'])->name('tables.structure');
	Route::get('/table/controllers/{dir?}',[TableController::class, 'controllers'])->name('tables.controllers');
	Route::get('/table/controllers-fnc/{dir?}',[TableController::class, 'fncControllers'])->name('tables.fnc-controllers');
	Route::get('/table/models/{dir?}',[TableController::class, 'models'])->name('tables.models');
	Route::get('/table/models-fnc/{dir?}',[TableController::class, 'fncModels'])->name('tables.fnc-models');
	Route::get('/table/policies/{dir?}',[TableController::class, 'policies'])->name('tables.policies');
	Route::get('/table/policies-fnc/{dir?}',[TableController::class, 'fncPolicies'])->name('tables.fnc-policies');
	Route::get('/table/helpers',[TableController::class, 'helpers'])->name('tables.helpers');
	Route::get('/table/helpers-fnc',[TableController::class, 'fncHelpers'])->name('tables.fnc-helpers');
	Route::get('/table/routes',[TableController::class, 'routes'])->name('tables.routes');
	Route::get('/table/route-code/{dir?}',[TableController::class, 'routeCode'])->name('tables.route-code');
	Route::get('/table/comments/{dir?}',[TableController::class, 'comments'])->name('tables.comments');
	Route::get('/table/messages/{dir?}',[TableController::class, 'messages'])->name('tables.messages');
	Route::get('/table/check',[TableController::class, 'check'])->name('tables.check');

	/* ======================== Template ========================================  */
	Route::resource('templates', TemplateController::class);
	Route::get('/template/export', [TemplateController::class, 'export'])->name('templates.export');
	Route::post('/template/delete/{template}',[TemplateController::class, 'destroy'])->name('templates.delete');
});

	
/**
* ==================================================================================
* 11. Route for Testing system Only ['auth', 'verified','can:system']
* ==================================================================================
*/
use App\Http\Controllers\Landlord\Test\TestController;
Route::middleware(['auth', 'verified','can:system'])->group(function () {

	//TODO php artisan route:cache error
	Route::get('/testrun', [TestController::class, 'run'])->name('test.run');
	Route::get('/send', [HomeController::class, 'testNotification'])->name('send');
	Route::get('/demomail', [HomeController::class, 'demomail'])->name('demomail');

	Route::get('/test', function () {
		return view('landlord.tests.test');
	})->name('test');
	Route::get('/sweet2', function () {
		return view('landlord.tests.sweet2');
	})->name('sweet2');
	Route::get('/jq', function () {
		return view('landlord.tests.jquery');
	})->name('jq');
	Route::get('/jql', function () {
		return view('landlord.tests.jqueryl');
	})->name('jql');
	Route::get('pdf', [TestController::class, 'generatePDF'])->name('pdf');
});


/* ======================== Purging Cache ========================================  */
Route::get('/clear', function () {
	Artisan::call('cache:clear');
	Artisan::call('cache:clear');
	Artisan::call('route:clear');
	Artisan::call('config:clear');
	Artisan::call('view:clear');
	return "Cache is cleared at " . now();
});