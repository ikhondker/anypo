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

Route::get('/ap4', function () {
	return view('landlord.ap4');
})->name('ap4');



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

Route::get('/request-demo', function () {
	$config = Config::with('relCountry')->first();
	return view('landlord.pages.request-demo', compact('config'));
})->name('request-demo');

Route::get('/bug-report', function () {
	$config = Config::with('relCountry')->first();
	return view('landlord.pages.bug-report', compact('config'));
})->name('bug-report');

Route::get('/404', function () {
	abort(404);
});

/**
* ==================================================================================
* 3. Public Controller Based Routes
* ==================================================================================
*/
use App\Http\Controllers\Landlord\HomeController;
Route::post('/save-contact', [HomeController::class, 'saveLandlordContact'])->name('home.save-contact');
Route::post('/request-demo', [HomeController::class, 'requestDemo'])->name('home.request-demo');
Route::post('/join-mail-list', [HomeController::class, 'joinMailList'])->name('home.join-mail-list');

/**
* ==================================================================================
* 3. Public Controller Based Routes
* ==================================================================================
*/

use App\Http\Controllers\Landlord\AkkController;
Route::get('/pricing', [AkkController::class, 'pricing'])->name('akk.pricing');
Route::get('/checkout', [AkkController::class, 'checkout'])->name('akk.checkout');
Route::post('/process-signup', [AkkController::class, 'processSignup'])->name('akk.process-signup');
Route::post('/process-subscription', [AkkController::class, 'processSubscription'])->name('akk.process-subscription');
Route::post('/process-advance', [AkkController::class, 'processAdvance'])->name('akk.process-advance');
Route::get('/process-addon/{account_id}/{addon_id}', [AkkController::class, 'processAddon'])->name('akk.process-addon');
Route::get('/online/{invoice_no}', [AkkController::class, 'onlineInvoice'])->name('akk.invoice');

/**
* ==================================================================================
* 6. Public routes for stripe
* ==================================================================================
*/
Route::get('/success', [AkkController::class, 'success'])->name('akk.success');
Route::get('/cancel', [AkkController::class, 'cancel'])->name('akk.cancel');
//Route::get('/success-addon', [AkkController::class, 'successAddon'])->name('akk.success-addon');
Route::post('/payment-stripe', [AkkController::class, 'paymentStripe'])->name('payment-stripe');

Route::get('/success-payment', [AkkController::class, 'successPayment'])->name('checkout.success-payment');
Route::get('/success-advance', [AkkController::class, 'successAdvance'])->name('checkout.success-advance');
// TODO
// Route::post('/webhook', [AkkController::class, 'webhook'])->name('checkout.webhook');


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
		return view('auth.landlord.verify-email');
	} else {
		return view('auth.tenant.verify-email');
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
	return back()->with('success', 'Verification link sent! Please check your mail and clink on \"Verify Email Address\" link.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


/**
* ==================================================================================
* 7. Routes for Regular user ['auth', 'verified']
* ==================================================================================
*/
use App\Http\Controllers\Landlord\DashboardController;
use App\Http\Controllers\Landlord\AttachmentController;
use App\Http\Controllers\Landlord\TicketController;
use App\Http\Controllers\Landlord\CommentController;
use App\Http\Controllers\Landlord\ReportController;
use App\Http\Controllers\Landlord\Admin\UserController;

Route::middleware(['auth', 'verified'])->group(function () {

	/* ======================== Dashboard ========================================  */
	Route::resource('dashboards', DashboardController::class);

	/* ======================== Ticket ======================================== */
	Route::resource('tickets', TicketController::class);
	//Route::get('/ticket/support', [TicketController::class, 'support'])->name('tickets.support');
	Route::get('/ticket/export', [TicketController::class, 'export'])->name('tickets.export');
	Route::get('/ticket/close/{ticket}', [TicketController::class, 'close'])->name('tickets.close');

	/* ======================== Comments ========================================  */
	Route::resource('comments', CommentController::class);

	/* ======================== Report ========================================  */
	Route::resource('reports', ReportController::class);
	Route::get('/reports/pdf-invoice/{invoice}', [ReportController::class, 'viewPdfInvoice'])->name('reports.pdf-invoice');
	Route::get('/reports/pdf-receipt/{payment}', [ReportController::class, 'viewPdfPayment'])->name('reports.pdf-payment');
	Route::get('/reports/pdf-ticket/{ticket}', [ReportController::class, 'viewPdfTicket'])->name('reports.pdf-ticket');

	/* ======================== User (Profile) ========================================  */
	Route::get('profile',[UserController::class, 'profile'])->name('users.profile');
	Route::get('profile-edit', [UserController::class, 'editProfile'])->name('users.profile-edit');
	Route::put('profile-update', [UserController::class, 'updateProfile'])->name('users.profile-update');
	Route::get('profile-password', [UserController::class, 'profilePassword'])->name('users.profile-password');
	Route::post('profile-password-update', [UserController::class, 'updateProfilePassword'])->name('users.profile-password-update');
	Route::get('/leave-impersonate',[UserController::class, 'leaveImpersonate'])->name('users.leave-impersonate');

	/* ======================== User ========================================  */
	Route::resource('users', UserController::class)->middleware(['auth', 'verified']);
	Route::get('/users/password-change/{user}', [UserController::class, 'changePassword'])->name('users.password-change');
	Route::post('/user/password-update/{user}', [UserController::class, 'updatePassword'])->name('users.password-update');
	Route::get('/users/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');
	Route::get('/user/export', [UserController::class, 'export'])->name('users.export');
	//Route::get('/leave-impersonate', [UserController::class, 'leaveImpersonate'])->name('users.leave-impersonate');

	/* ======================== Attachment ======================================== */
	Route::get('/attachments/download/{attachment}', [AttachmentController::class, 'download'])->name('attachments.download');

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


Route::middleware(['auth', 'verified','can:admin'])->group(function () {

	/* ======================== Account ======================================== */
	Route::resource('accounts', AccountController::class);
	Route::get('/account/export', [AccountController::class, 'export'])->name('accounts.export');

	/* ======================== Service ======================================== */
	Route::resource('services', ServiceController::class);
	Route::get('/services/delete/{service}',[ServiceController::class, 'destroy'])->name('services.delete');

	/* ======================== Invoice ======================================== */
	Route::resource('invoices', InvoiceController::class);
	Route::get('/invoice/generate',[InvoiceController::class,'generate'])->name('invoices.generate');
	Route::get('/invoice/export', [InvoiceController::class, 'export'])->name('invoices.export');



	/* ======================== Payment ======================================== */
	Route::resource('payments', PaymentController::class);
	//Route::get('/payments/pdf/{pr}', [PaymentController::class,'pdf'])->name('payments.pdf');
	Route::get('/payment/export', [PaymentController::class, 'export'])->name('payments.export');

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
use App\Http\Controllers\Landlord\Lookup\TagController;
use App\Http\Controllers\Landlord\Manage\TicketTagController;
use App\Http\Controllers\Landlord\Manage\CheckoutController;
use App\Http\Controllers\Landlord\Manage\MailListController;
use App\Http\Controllers\Landlord\Manage\ActivityController;

// Ref: app/Providers/AppServiceProvider.php
Route::middleware(['auth', 'verified', 'can:support'])->group(function () {

	/* ======================== User ========================================  */
	Route::get('/user/all/{account?}', [UserController::class, 'all'])->name('users.all');
	Route::get('/users/impersonate/{user}/', [UserController::class, 'impersonate'])->name('users.impersonate');
	//Route::get('/leave-impersonate', [UserController::class, 'leaveImpersonate'])->name('users.leave-impersonate');

	/* ======================== Ticket ========================================  */
    Route::get('/ticket/all', [TicketController::class, 'all'])->name('tickets.all');
	Route::get('/tickets/assign/{ticket}', [TicketController::class, 'assign'])->name('tickets.assign');
	Route::post('/tickets/do-assign/{ticket}', [TicketController::class, 'doAssign'])->name('tickets.do-assign');
	Route::get('/tickets/tags/{ticket}', [TicketController::class, 'tags'])->name('tickets.tags');
	Route::post('/ticket/add-tag/{ticket}', [TicketController::class, 'addTag'])->name('tickets.add-tag');

    /* ======================== TicketTag ========================================  */
    Route::get('/ticket-tags/delete/{ticketTag}',[TicketTagController::class, 'destroy'])->name('ticket-tags.delete');

	/* ======================== Comment ========================================  */
	Route::get('/comment/all', [CommentController::class, 'all'])->name('comments.all');
	//Route::get('/comments/delete/{comment}', [CommentController::class, 'destroy'])->name('comments.delete');

	/* ======================== Accounts ========================================  */
	//Route::get('/account/all', [AccountController::class, 'all'])->name('accounts.all');

	/* ======================== Services ======================================== */
	Route::get('/service/all/{account?}', [ServiceController::class, 'all'])->name('services.all');
	Route::get('/service/export', [ServiceController::class, 'export'])->name('services.export');

	/* ======================== Invoice ======================================== */
	//Route::get('/invoice/all/{account?}/{type?}/{status?}', [InvoiceController::class, 'all'])->name('invoices.all');
	//Route::get('/invoice/all/{account?}/{type?}/{status?}', [InvoiceController::class, 'all'])->name('invoices.all');
	Route::get('/invoice/all', [InvoiceController::class, 'all'])->name('invoices.all');
    Route::get('/invoices/post/{invoice}',[InvoiceController::class, 'post'])->name('invoices.post');

	/* ======================== Payment ======================================== */
	Route::get('/payment/all/{account?}', [PaymentController::class, 'all'])->name('payments.all');

	/* ======================== Activity ======================================== */
	Route::resource('activities', ActivityController::class);
	Route::get('/activity/export', [ActivityController::class, 'export'])->name('activities.export');
	Route::get('/activity/all', [ActivityController::class, 'all'])->name('activities.all');

	/* ======================== Contact ======================================== */
	Route::resource('contacts', ContactController::class);
	Route::get('/contact/all', [ContactController::class, 'all'])->name('contacts.all');
	Route::get('/contact/export',[ContactController::class,'export'])->name('contacts.export');

	/* ======================== Category ======================================== */
	Route::resource('categories', CategoryController::class);
	Route::get('/categories/delete/{category}',[CategoryController::class, 'destroy'])->name('categories.delete');

	/* ======================== Attachment ======================================== */
	Route::resource('attachments', AttachmentController::class);
	Route::get('/attachment/export',[AttachmentController::class,'export'])->name('attachments.export');
	Route::get('/attachment/all',[AttachmentController::class, 'all'])->name('attachments.all');

	/* ======================== Country ======================================== */
	Route::resource('countries', CountryController::class);
	Route::get('/country/export',[CountryController::class,'export'])->name('countries.export');
	Route::get('/countries/delete/{country}',[CountryController::class, 'destroy'])->name('countries.delete');

	/* ======================== Product ======================================== */
	Route::resource('products', ProductController::class);
	Route::get('/products/delete/{product}',[ProductController::class, 'destroy'])->name('products.delete');

	/* ======================== Topic ======================================== */
	Route::resource('tags', TagController::class);
	Route::get('/tags/delete/{tag}',[TagController::class, 'destroy'])->name('tags.delete');

	/* ======================== Checkout ======================================== */
	Route::resource('checkouts', CheckoutController::class);
	//Route::get('/checkout/all', [CheckoutController::class, 'all'])->name('checkouts.all');
	Route::get('/checkout/export', [CheckoutController::class, 'export'])->name('checkouts.export');

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

use App\Http\Controllers\Share\TemplateController;


use App\Http\Controllers\Landlord\NotificationController;

use App\Http\Controllers\Landlord\Lookup\ReplyTemplateController;

use App\Http\Controllers\Landlord\Manage\CpController;
use App\Http\Controllers\Landlord\Manage\EntityController;
use App\Http\Controllers\Landlord\Manage\MenuController;
use App\Http\Controllers\Landlord\Manage\ConfigController;
use App\Http\Controllers\Landlord\Manage\TableController;

use App\Http\Controllers\Landlord\Manage\StatusController;
use App\Http\Controllers\Landlord\Manage\ProcessController;
use App\Http\Controllers\Landlord\Manage\ErrorLogController;

Route::middleware(['auth', 'verified','can:system'])->group(function () {

	/* ======================== Account ======================================== */

	Route::get('/accounts/delete/{account}',[AccountController::class, 'destroy'])->name('accounts.delete');
	Route::get('/accounts/reset/{account}',[AccountController::class,'reset'])->name('accounts.reset');
    Route::get('/accounts/tenant/{account}',[AccountController::class, 'tenant'])->name('accounts.tenant');

	/* ======================== Cp ======================================== */
	Route::resource('cps', CpController::class);
	Route::get('/cp/changelog',[CpController::class,'changeLog'])->name('cps.changelog');
	Route::get('/cp/codegen',[CpController::class,'codeGen'])->name('cps.codegen');
	Route::get('/cp/ui',[CpController::class,'ui'])->name('cps.ui');
    Route::get('/cp/sync',[CpController::class,'sync'])->name('cps.sync');

	//Route::get('/menus/delete/{menu}',[MenuController::class,'destroy'])->name('menus.destroy');

	/* ======================== Invoice ======================================== */
	Route::get('/invoices/pwop/{invoice}',[InvoiceController::class,'pwop'])->name('invoices.pwop');
	Route::put('/invoices/pay-pwop/{invoice}',[InvoiceController::class,'payPwop'])->name('invoices.pay-pwop');
	Route::get('/invoices/discount/{invoice}',[InvoiceController::class,'discount'])->name('invoices.discount');
	Route::put('/invoices/apply-discount/{invoice}',[InvoiceController::class,'applyDiscount'])->name('invoices.apply-discount');


	/* ======================== Notification TODO for Landlord ======================================== */
	Route::resource('notifications', NotificationController::class);
	Route::get('/notifications/read/{notification}', [NotificationController::class, 'read'])->name('notifications.read');

	/* ======================== Process ======================================== */
	Route::resource('processes', ProcessController::class);
	Route::get('/process/gen-invoice-all', [ProcessController::class, 'genInvoiceAll'])->name('processes.gen-invoice-all');
	Route::get('/process/accounts-archive', [ProcessController::class, 'accountsArchive'])->name('processes.accounts-archive');

	/* ======================== Config ======================================== */
	Route::resource('configs', ConfigController::class);

    /* ======================== ReplyTemplate ======================================== */
	Route::resource('reply-templates', ReplyTemplateController::class);
    Route::get('/reply-templates/delete/{replyTemplate}', [ReplyTemplateController::class, 'destroy'])->name('reply-templates.delete');
    Route::get('/reply-templates/get-template/{replyTemplate}',[ReplyTemplateController::class, 'getTemplate'])->name('reply-templates.get-template');


	/* ======================== ErrorLog ======================================== */
	Route::resource('error-logs', ErrorLogController::class);

	/* ======================== Status ======================================== */
	Route::resource('statuses', StatusController::class);
	Route::get('/status/export', [StatusController::class, 'export'])->name('statuses.export');
	Route::get('/statuses/delete/{status}', [StatusController::class, 'destroy'])->name('statuses.delete');

	/* ======================== Entity ======================================== */
	Route::resource('entities', EntityController::class);
	Route::get('/entities/delete/{entity}',[EntityController::class, 'destroy'])->name('entities.delete');
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

	/* ======================== Template ========================================  */
	Route::resource('templates', TemplateController::class);
	Route::post('/templates/delete/{template}',[TemplateController::class, 'destroy'])->name('templates.delete');
	Route::get('/template/export', [TemplateController::class, 'export'])->name('templates.export');

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
		//return view('landlord.tests.test');
		return view('landlord.pages.error')
				->with('title','Thank you for purchasing '.config('app.name').' service!')
				->with('msg','You will shorty receive an email, with service instance login credential. Please check your email at .');

	})->name('test');

	// Route::get('/ui', function () {
	// 	return view('landlord.manage.ui');
	// })->name('ui');

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
