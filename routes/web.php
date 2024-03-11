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

/**
* ==================================================================================
* Route for Testing purpose
* ==================================================================================
*/
use App\Http\Controllers\Landlord\TestController;
//TODO php artisan route:cache error
Route::get('/testrun', [TestController::class, 'run'])->name('test.run');

Route::get('/test', function () {
	return view('landlord.test');
})->name('test');

Route::get('pdf', [TestController::class, 'generatePDF'])->name('pdf');


//use App\Http\Controllers\ChartController;
//Route::get('chart', [ChartController::class, 'index']);


/**
* ==================================================================================
* Public Routes related to authentication and  email verification
* ==================================================================================
*/
// Login Routes...
//TODO php artisan route:cache error
use App\Http\Controllers\Auth\LoginController;
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [LoginController::class, 'login']);
// IQBAL 28-feb-23
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout');


// Registration Routes...
use App\Http\Controllers\Auth\RegisterController;
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Password Reset Routes...
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
* Public Routes related to Email verification
* ==================================================================================
*/

Route::get('/email/verify', function () {
	if (tenant('id') == '') {
		return view('auth.landlord-verify-email');
	} else {
		return view('auth.verify-email');
	}
	})->middleware('auth')->name('verification.notice');

use Illuminate\Foundation\Auth\EmailVerificationRequest;
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
	$request->fulfill();
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
* Public Page Routes
* ==================================================================================
*/

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
	return view('landlord.pages.contact-us');
})->name('contact-us');

/**
* ==================================================================================
* Custom/Override Routes
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
* Public Controller Based Routes
* ==================================================================================
*/

/* ======================== Home Controller ======================================== */
use App\Http\Controllers\Landlord\HomeController;
//Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/pricing', [HomeController::class, 'pricing'])->name('home.pricing');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('home.checkout');

Route::get('/online/{invoice_no}', [HomeController::class, 'onlineInvoice'])->name('home.invoice');
Route::get('/send', [HomeController::class, 'testNotification'])->name('send');
Route::get('/demomail', [HomeController::class, 'demomail'])->name('demomail');
Route::post('/save-contact', [HomeController::class, 'saveContact'])->name('home.savecontact');
//Route::get('/payment/{invoice_no}',[App\Http\Controllers\HomeController::class, 'payment'])->name('home.payment');

/**
* ==================================================================================
* Public routes for stripe
* ==================================================================================
*/

Route::post('/checkout-stripe', [HomeController::class, 'checkoutStripe'])->name('checkout-stripe');
Route::post('/payment-stripe', [HomeController::class, 'paymentStripe'])->name('payment-stripe');
Route::get('/success', [HomeController::class, 'success'])->name('checkout.success');
Route::get('/cancel', [HomeController::class, 'cancel'])->name('checkout.cancel');
// TODO
// Route::post('/webhook', [HomeController::class, 'webhook'])->name('checkout.webhook');


/* ======================== Provision Controller ======================================== */
//use App\Http\Controllers\Landlord\ProvisionController; // No authentication <================
//Route::get('/pricing', [ProvisionController::class, 'pricing'])->name('provision.pricing');
//Route::get('/checkout/{id}', [ProvisionController::class, 'checkout'])->name('provision.checkout');
//Route::get('/checkout', [ProvisionController::class, 'checkout'])->name('provision.checkout');
//Route::get('/online/{invoice_no}', [ProvisionController::class, 'onlineInvoice'])->name('provision.web');

/* ======================== Contact ======================================== */
use App\Http\Controllers\Landlord\Manage\ContactController;
Route::resource('contacts', ContactController::class);

/**
* ==================================================================================
* Tenancy Related Routes which need auth and email verification ['auth', 'verified']
* ==================================================================================
*/
/* ======================== Domain ========================================  */
use App\Http\Controllers\DomainController;
Route::resource('domains', DomainController::class)->middleware(['auth', 'verified']);

/* ======================== Tenant ========================================  */
use App\Http\Controllers\TenantController;
Route::resource('tenants', TenantController::class)->middleware(['auth', 'verified']);


/**
* ==================================================================================
* Routes need auth and email verification ['auth', 'verified']
* ==================================================================================
*/
use App\Http\Controllers\Landlord\AccountController;
use App\Http\Controllers\Landlord\CommentController;
use App\Http\Controllers\Landlord\DashboardController;
use App\Http\Controllers\Landlord\NotificationController;
use App\Http\Controllers\Landlord\TicketController;

use App\Http\Controllers\Landlord\ReportController;

use App\Http\Controllers\Landlord\Admin\ActivityController;
use App\Http\Controllers\Landlord\Admin\InvoiceController;
use App\Http\Controllers\Landlord\Admin\PaymentController;
use App\Http\Controllers\Landlord\Admin\ServiceController;
use App\Http\Controllers\Landlord\Admin\UserController;

Route::middleware(['auth', 'verified'])->group(function () {

	/* ======================== Account ======================================== */
	Route::resource('accounts', AccountController::class);
	//Route::get('/account/export', [AccountController::class, 'export'])->name('accounts.export');
	//Route::get('/upgrade/{service_id}', [AccountController::class, 'upgrade'])->name('accounts.upgrade');
	Route::get('/add-addon/{account_id}/{addon_id}', [AccountController::class, 'addAddon'])->name('accounts.add-addon');

	/* ======================== Comments ========================================  */
	Route::resource('comments', CommentController::class);
	//Route::get('/comment/createline/{id}',[CommentController::class, 'createline'])->name('comment.createline');

	/* ======================== Dashboard ========================================  */
	//TODO enable verify middleware for all route
	Route::resource('dashboards', DashboardController::class)->middleware(['auth', 'verified']);

	/* ======================== Notification ======================================== */
	Route::resource('notifications', NotificationController::class);
	Route::get('/notifications/read/{notification}', [NotificationController::class, 'read'])->name('notifications.read');

	/* ======================== Ticket ======================================== */
	Route::resource('tickets', TicketController::class);
	//Route::get('/ticket/support', [TicketController::class, 'support'])->name('tickets.support');
	Route::get('/ticket/export', [TicketController::class, 'export'])->name('tickets.export');
	//Route::get('/tickets/pdf/{pr}', [TicketController::class,'pdf'])->name('tickets.pdf');
	Route::get('/ticket/close/{ticket}', [TicketController::class, 'close'])->name('tickets.close');

	/* ======================== Service ======================================== */
	Route::resource('services', ServiceController::class);
	
	/* ======================== Report ========================================  */
	Route::resource('reports', ReportController::class);
	Route::get('/reports/pdf-invoice/{invoice}', [ReportController::class, 'viewPdfInvoice'])->name('reports.pdf-invoice');
	Route::get('/reports/pdf-receipt/{payment}', [ReportController::class, 'viewPdfPayment'])->name('reports.pdf-payment');

	/* ======================== User ========================================  */
	Route::resource('users', UserController::class)->middleware(['auth', 'verified']);
	// TODO why remove
	// Route::get('/users/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');
	// Route::get('users-password/{user}', [UserController::class, 'userPassword'])->name('users.password');
	Route::get('/user/password-change/{user}', [UserController::class, 'changePassword'])->name('users.password-change');
	Route::post('/user/password-update/{user}', [UserController::class, 'updatePassword'])->name('users.password-update');
	Route::get('/user/export', [UserController::class, 'export'])->name('users.export');
	Route::get('/user/role', [UserController::class, 'role'])->name('users.role');
	Route::get('/user/updaterole/{user}/{role}', [UserController::class, 'updaterole'])->name('users.updaterole');
	// Route::get('/user/delete/{user}',[UserController::class, 'destroy'])->name('users.destroy');
	Route::get('/user/image/{filename}', [UserController::class, 'image'])->name('users.image');
	// TODO
	// Route::get('/user/enable/{user}',[UserController::class, 'enable'])->name('users.enable');
	Route::get('/users/impersonate/{user}/', [UserController::class, 'impersonate'])->name('users.impersonate');
	Route::get('/leave-impersonate', [UserController::class, 'leaveImpersonate'])->name('users.leave-impersonate');

	
	/* ======================== Activity ========================================  */
	Route::resource('activities', ActivityController::class);
	Route::get('/activity/export', [ActivityController::class, 'export'])->name('activities.export');

	/* ======================== Invoice ======================================== */
	Route::resource('invoices', InvoiceController::class);
	//Route::get('/invoices/pdf/{invoice}', [InvoiceController::class,'pdf'])->name('invoices.pdf');
	//Route::get('/invoice/preview/{invoice_no}',[InvoiceController::class, 'preview'])->name('invoices.preview');

	// Route::controller(InvoiceController::class)->group(function(){
	//     Route::get('invoices', 'index')->name('invoices.index');
	//     Route::post('invoices', 'store')->name('invoices.store');
	//     Route::get('invoices/create', 'create')->name('invoices.create');
	//     Route::get('invoices/{invoice}', 'show')->name('invoices.show');
	//     Route::put('invoices/{invoice}', 'update')->name('invoices.update');
	//     Route::delete('invoices/{invoice}', 'destroy')->name('invoices.destroy');
	//     Route::get('invoices/{invoice}/edit', 'edit')->name('invoices.edit');
	// });

	/* ======================== Payment ======================================== */
	Route::resource('payments', PaymentController::class);
	//Route::get('/payments/pdf/{pr}', [PaymentController::class,'pdf'])->name('payments.pdf');
});


/**
 * ==================================================================================
 * Routes allowed to back office only ['auth', 'verified','can:access-back-office']
 * ==================================================================================
*/
use App\Http\Controllers\Landlord\Lookup\CategoryController;
use App\Http\Controllers\Landlord\Lookup\CountryController;
use App\Http\Controllers\Landlord\Lookup\ProductController;
use App\Http\Controllers\Landlord\Lookup\StatusController;

use App\Http\Controllers\Landlord\Manage\AttachmentController;
use App\Http\Controllers\Landlord\Manage\CheckoutController;
use App\Http\Controllers\Landlord\Manage\EntityController;
use App\Http\Controllers\Landlord\Manage\MenuController;
use App\Http\Controllers\Landlord\Manage\ProcessController;
use App\Http\Controllers\Landlord\Manage\SetupController;
use App\Http\Controllers\Landlord\Manage\TableController;
use App\Http\Controllers\Landlord\Manage\TemplateController;

// TODO uncomment
// Ref: app/Providers/AppServiceProvider.php
Route::middleware(['auth', 'verified','can:access-back-office'])->group(function () {
//Route::middleware(['auth', 'verified'])->group(function () {

	// Route::get('dashboard', function () {
	// 	// Matches The "/admin/dashboard" URL
	// 	return "This is from admin route from admin.route file at after auth " . now();
	// });
	
	/* ======================== Account ======================================== */
	Route::get('/accounts/delete/{account}',[AccountController::class, 'destroy'])->name('accounts.delete');

	/* ======================== Category ======================================== */
	Route::resource('categories', CategoryController::class);
	//P2 Route::get('/categories/delete/{category}',[CategoryController::class, 'destroy'])->name('categories.delete');
		
	/* ======================== Country ======================================== */
	Route::resource('countries', CountryController::class);
	Route::get('/country/export',[CountryController::class,'export'])->name('countries.export');
	Route::get('/countries/delete/{country}',[CountryController::class, 'destroy'])->name('countries.delete');

	/* ======================== Product ======================================== */
	Route::resource('products', ProductController::class);

	/* ======================== Status ======================================== */
	Route::resource('statuses', StatusController::class);
	Route::get('/status/export', [StatusController::class, 'export'])->name('statuses.export');
	Route::get('/statuses/delete/{status}', [StatusController::class, 'destroy'])->name('statuses.delete');

	/* ======================== Attachment ======================================== */
	Route::resource('attachments', AttachmentController::class);
	Route::get('/attachments/download/{fileName}', [AttachmentController::class, 'download'])->name('attachments.download');

	/* ======================== Checkout ======================================== */
	Route::resource('checkouts', CheckoutController::class);
	Route::get('/checkout/all', [CheckoutController::class, 'all'])->name('checkouts.all');
					
	/* ======================== Entity ======================================== */
	Route::resource('entities', EntityController::class);
	//Route::get('/entity/delete/{entity}',[EntityController::class, 'destroy'])->name('entities.destroy');
	Route::get('/entity/export', [EntityController::class, 'export'])->name('entities.export');

	/* ======================== Menu ======================================== */
	Route::resource('menus', MenuController::class);
	Route::get('/menu/export', [MenuController::class,'export'])->name('menus.export');
	Route::get('/menus/delete/{menu}', [MenuController::class,'destroy'])->name('menus.delete');

	/* ======================== Process ======================================== */
	Route::resource('processes', ProcessController::class);
	Route::get('/process/gen-invoice-all', [ProcessController::class, 'genInvoiceAll'])->name('processes.gen-invoice-all');
	Route::get('/process/accounts-archive', [ProcessController::class, 'accountsArchive'])->name('processes.accounts-archive');

	/* ======================== Setup ======================================== */
	Route::resource('setups', SetupController::class);
	//Route::get('/setups1', [SetupController::class,'index'])->name('setups.index');
	
	/* ======================== Table ========================================  */
	Route::resource('tables', TableController::class);
	Route::get('/table/structure/{table}', [TableController::class, 'structure'])->name('tables.structure');
	Route::get('/table/controllers', [TableController::class, 'controllers'])->name('tables.controllers');
	Route::get('/table/models', [TableController::class, 'models'])->name('tables.models');
	Route::get('/table/routes', [TableController::class, 'routes'])->name('tables.routes');
	Route::get('/table/route-code', [TableController::class, 'routeCode'])->name('tables.route-code');
	Route::get('/table/policies', [TableController::class, 'policies'])->name('tables.policies');
	Route::get('/table/comments', [TableController::class, 'comments'])->name('tables.comments');
	Route::get('/table/check', [TableController::class, 'check'])->name('tables.check');
	Route::get('/table/messages', [TableController::class, 'messages'])->name('tables.messages');
	
	/* ======================== Template ========================================  */
	Route::resource('templates', TemplateController::class);
	Route::get('/template/export', [TemplateController::class, 'export'])->name('templates.export');
	Route::post('/template/delete/{template}',[TemplateController::class, 'destroy'])->name('templates.delete');

	
	/* ======================== Ticket ========================================  */
	Route::get('/ticket/all', [TicketController::class, 'all'])->name('tickets.all');
	Route::get('/ticket/assign/{ticket}', [TicketController::class, 'assign'])->name('tickets.assign');
	Route::post('/ticket/doassign/{ticket}', [TicketController::class, 'doAssign'])->name('tickets.doassign');

	/* ======================== User ========================================  */
	Route::get('/user/all', [UserController::class, 'all'])->name('users.all');

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
	Route::get('/contact/all', [ContactController::class, 'all'])->name('contacts.all');
});
	

/**
* ==================================================================================
* Route for Purging Cache
* ==================================================================================
*/
Route::get('/clear', function () {
	Artisan::call('cache:clear');
	Artisan::call('cache:clear');
	Artisan::call('route:clear');
	Artisan::call('config:clear');
	Artisan::call('view:clear');
	return "Cache is cleared at " . now();
});
	
/* ======================== Error ======================================== */
Route::get('/account-missing', function () {
	return view('landlord.errors.account-missing');
})->name('account-missing');
	
Route::get('/account-linked', function () {
	return view('landlord.errors.account-linked');
})->name('account-linked');
	
// /* ======================== Addon ======================================== */
// use App\Http\Controllers\AddonController;
// Route::resource('addons', AddonController::class);
// Route::get('/addon/buy/{service}/{product_id}',[AddonController::class, 'buy'])->name('addons.buy');

// works
// Route::prefix('admin')->group(function () {
//     Route::get('dashboard', function () {
//         // Matches The "/admin/dashboard" URL
//         return "This is from admin route" . now();
//     });
// });
	
/**
* ==================================================================================
* Route for aws
* ==================================================================================
*/
	
#http://anypo.s3-website-us-east-1.amazonaws.com/avatars\1
#object url: https://anypo.s3.amazonaws.com/avatars/img4.jpg
Route::get('buckets', function(){
	// OK
	//$disk = 'avatars';
	//$heroImage = Storage::get('img5.jpg');
	//$uploadedPath = Storage::disk($disk)->put('img5.jpg', $heroImage);
	
	$disk = 's3-landlord-avatars';
	$heroImage = Storage::get('img5.jpg');
	$uploadedPath = Storage::disk($disk)->put('img5.jpg', $heroImage);

	#Object URL
	#https://anypo.s3.amazonaws.com/avatars/img5.jpg

	// return whole image Ok
	//return Storage::disk('s3')->response('avatars/' . 'img5.jpg');
	
	// OK
	return Redirect::to('https://anypo.s3.amazonaws.com/avatars/img5.jpg');

});

// Route::get('buckets', function(){
//     $disk = 'invoices';
//     $heroImage = Storage::get('img4.jpg');
//     $uploadedPath = Storage::disk($disk)->put('img4.jpg', $heroImage);
//     return Storage::disk($disk)->url($uploadedPath);
// });
