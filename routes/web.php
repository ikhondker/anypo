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

Route::get('testrun/', [TestController::class, 'run'])->name('tests.run');

Route::get('/test', function () {
//return view('landlord.pages.info')->with('title','Sample Title!')->with('msg','Sample message!');
return view('landlord.pages.error');
})->name('test');

Route::get('/invociehtm', function () {
return view('invociehtm');
})->name('invociehtm');

// Route::get('/page', function () {
//     return view('paghtm');
// })->name('page');

// Route::get('/design', function () {
//     return view('design');
// })->name('design');

// Route::get('/startyhtm', function () {
//     return view('startyhtm');
// })->name('startyhtm');

// Route::get('/soon', function () {
//     return view('coming-soon');
// })->name('soon');

// Route::get('/cork', function () {
//     //return view('empty375-htm');
//     return view('starter-full-width-htm');
// });

// Route::get('/starter', function () {
//     //return view('starter-full-htm');
//     return view('starter-full');
// });

//use App\Http\Controllers\ChartController;
//Route::get('chart', [ChartController::class, 'index']);
Route::get('/both', function () {
return view('welcome');
});

Route::get('/saas', function () {
return view('saas');
});

Route::get('/design1', function () {
return view('design1');
});

Route::get('/design2', function () {
return view('login');
});

Route::get('/landlord', function () {
return view('landlord');
});

Route::get('/accounts', function () {
return view('accounts');
});



/* ======================== Seeded ======================================== */
// Route::get('/', function () {
//     return view('welcome');
// });

/* ======================== Auth routes ======================================== */
//Auth::routes();
//Auth::routes(['verify' => true]);

//   Authentication Routes...
//   GET|HEAD   localhost/login .............................................. login › Auth\LoginController@showLoginForm
//   POST       localhost/login .............................................................. Auth\LoginController@login
//   POST       localhost/logout ................................................... logout › Auth\LoginController@logout

//   GET|HEAD   localhost/register .............................. register › Auth\RegisterController@showRegistrationForm
//   POST       localhost/register ..................................................... Auth\RegisterController@register

//   GET|HEAD   localhost/password/confirm ............ password.confirm › Auth\ConfirmPasswordController@showConfirmForm
//   POST       localhost/password/confirm ....................................... Auth\ConfirmPasswordController@confirm
//   POST       localhost/password/email .............. password.email › Auth\ForgotPasswordController@sendResetLinkEmail
//   GET|HEAD   localhost/password/reset ........... password.request › Auth\ForgotPasswordController@showLinkRequestForm
//   POST       localhost/password/reset ........................... password.update › Auth\ResetPasswordController@reset
//   GET|HEAD   localhost/password/reset/{token} ............ password.reset › Auth\ResetPasswordController@showResetForm


/**
* ==================================================================================
* Public Routes related to authentication and  email verification
* ==================================================================================
*/
// Login Routes...
use App\Http\Controllers\Auth\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

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

/* ======================== Email Verification======================================== */
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

Route::get('/design', function () {
return view('design');
})->name('design');

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

/* ======================== Custom ======================================== */
Route::get('/', function () {
return view('home');
})->name('welcome');

// IQBAL 28-feb-23
Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout');

/**
* ==================================================================================
* Public Controller Based Routes
* ==================================================================================
*/

/* ======================== Home Controller ======================================== */
use App\Http\Controllers\Landlord\HomeController;

Route::get('/home', [HomeController::class, 'index'])->name('home');
//Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('/login');
Route::get('/send', [HomeController::class, 'testNotification'])->name('send');
Route::get('/demomail', [HomeController::class, 'demomail'])->name('demomail');
Route::post('/save-contact', [HomeController::class, 'saveContact'])->name('home.savecontact');
//Route::get('/payment/{invoice_no}',[App\Http\Controllers\HomeController::class, 'payment'])->name('home.payment');

/* ======================== Provision Controller ======================================== */
use App\Http\Controllers\Landlord\ProvisionController; // No authentication <================

Route::get('/pricing', [ProvisionController::class, 'pricing'])->name('provision.pricing');
//Route::get('/checkout/{id}', [ProvisionController::class, 'checkout'])->name('provision.checkout');
Route::get('/checkout', [ProvisionController::class, 'checkout'])->name('provision.checkout');
Route::get('/online/{invoice_no}', [ProvisionController::class, 'onlineInvoice'])->name('provision.web');

/* ======================== Contact ======================================== */
use App\Http\Controllers\Landlord\ContactController;

Route::resource('contacts', ContactController::class);

/* ======================== Checkout ======================================== */
use App\Http\Controllers\Landlord\CheckoutController;

Route::resource('checkouts', CheckoutController::class);

/**
* ==================================================================================
* Public routes for SSLCOMMERZ
* ==================================================================================
*/
use App\Http\Controllers\SslCommerzPaymentController;

Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/payment', [SslCommerzPaymentController::class, 'payment']);
Route::post('/paymentaddon', [SslCommerzPaymentController::class, 'paymentaddon']);

Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);

/**
* ==================================================================================
* Public routes for Paddle
* ==================================================================================
*/
// Route::get('/paddle', function (Request $request) {
// 	$payLink = $request->user()->newSubscription('default', $id = 1001)
// 		->returnTo(route('home'))
// 		->create();
// 	//$payLink='aa';
// 	return view('landlord.pages.paddle', ['payLink' => $payLink]);
// });

// Route::get('/store', function () {
//     $user = User::where('id', 1001)->first();
//     return view('store', [
//             'payLink' => $user->chargeProduct($productId = '1001')
//     ]);
// });


/**
* ==================================================================================
* Routes need auth and email verification
* ==================================================================================
*/

use App\Http\Controllers\DomainController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\FileAccessController;

use App\Http\Controllers\Landlord\DashboardController;
use App\Http\Controllers\Landlord\NotificationController;
use App\Http\Controllers\Landlord\ActivityController;
use App\Http\Controllers\Landlord\UserController;
use App\Http\Controllers\Landlord\TicketController;
use App\Http\Controllers\Landlord\CommentController;
use App\Http\Controllers\Landlord\AccountController;
use App\Http\Controllers\Landlord\ServiceController;
use App\Http\Controllers\Landlord\InvoiceController;
use App\Http\Controllers\Landlord\PaymentController;
use App\Http\Controllers\Landlord\ReportController;
use App\Http\Controllers\Landlord\ProcessController;
use App\Http\Controllers\Landlord\AttachmentController;

Route::middleware(['auth', 'verified'])->group(function () {

/* ======================== Dashboard ========================================  */
//TODO enable verify middleware for all route
Route::resource('dashboards', DashboardController::class)->middleware(['auth', 'verified']);

/* ======================== Notification ======================================== */
Route::resource('notifications', NotificationController::class);
Route::get('/notifications/read/{notification}', [NotificationController::class, 'read'])->name('notifications.read');

/* ======================== Activity ========================================  */
Route::resource('activities', ActivityController::class);
Route::get('/activity/export', [ActivityController::class, 'export'])->name('activities.export');

/* ======================== FileAccess ======================================== */
//Route::get('/logo/{file}', [FileAccessController::class, 'logo'])->name('logo');
//Route::get('/avatar/{file}', [FileAccessController::class, 'avatar'])->name('avatar');

/* ======================== User ========================================  */
Route::resource('users', UserController::class)->middleware(['auth', 'verified']);
// TODO why remove
//Route::get('/users/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('users-password/{user}', [UserController::class, 'userPassword'])->name('users.password');
Route::post('/user/update-password/{user}', [UserController::class, 'updatePassword'])->name('users.update.password');
Route::get('/user/export', [UserController::class, 'export'])->name('users.export');
Route::get('/user/role', [UserController::class, 'role'])->name('users.role');
Route::get('/user/updaterole/{user}/{role}', [UserController::class, 'updaterole'])->name('users.updaterole');
//Route::get('/user/delete/{user}',[UserController::class, 'destroy'])->name('users.destroy');
Route::get('/user/image/{filename}', [UserController::class, 'image'])->name('users.image');
// TODO
//Route::get('/user/enable/{user}',[UserController::class, 'enable'])->name('users.enable');
Route::get('/users/impersonate/{user}/', [UserController::class, 'impersonate'])->name('users.impersonate');
Route::get('/leave-impersonate', [UserController::class, 'leaveImpersonate'])->name('users.leave-impersonate');


/* ======================== Ticket ======================================== */
Route::resource('tickets', TicketController::class);
//Route::get('/ticket/support', [TicketController::class, 'support'])->name('tickets.support');
Route::get('/ticket/export', [TicketController::class, 'export'])->name('tickets.export');
//Route::get('/tickets/pdf/{pr}', [TicketController::class,'pdf'])->name('tickets.pdf');
Route::get('/ticket/close/{ticket}', [TicketController::class, 'close'])->name('tickets.close');
/* ======================== Comment ======================================== */
Route::resource('comments', CommentController::class);
//Route::get('/comment/createline/{id}',[CommentController::class, 'createline'])->name('comment.createline');

/* ======================== Account ======================================== */
Route::resource('accounts', AccountController::class);
//Route::get('/account/export', [AccountController::class, 'export'])->name('accounts.export');
//Route::get('/upgrade/{service_id}', [AccountController::class, 'upgrade'])->name('accounts.upgrade');
Route::get('/add-addon/{account_id}/{addon_id}', [AccountController::class, 'addAddon'])->name('accounts.add-addon');

/* ======================== Service ======================================== */
Route::resource('services', ServiceController::class);

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

/* ======================== report ========================================  */
Route::resource('reports', ReportController::class);
Route::get('/reports/pdf-invoice/{invoice}', [ReportController::class, 'viewPdfInvoice'])->name('reports.pdf-invoice');
Route::get('/reports/pdf-receipt/{payment}', [ReportController::class, 'viewPdfPayment'])->name('reports.pdf-payment');

/* ======================== Domain ========================================  */
Route::resource('domains', DomainController::class)->middleware(['auth', 'verified']);

/* ======================== Tenant ========================================  */
Route::resource('tenants', TenantController::class)->middleware(['auth', 'verified']);

/* ======================== Process ======================================== */
Route::resource('processes', ProcessController::class);
Route::get('/process/gen-invoice-all', [ProcessController::class, 'genInvoiceAll'])->name('processes.gen-invoice-all');
Route::get('/process/accounts-archive', [ProcessController::class, 'accountsArchive'])->name('processes.accounts-archive');

/* ======================== Attachment ======================================== */
Route::resource('attachments', AttachmentController::class);
Route::get('/attachments/download/{filename}', [AttachmentController::class, 'download'])->name('attachments.download');
//Route::get('/attachments/addempdoc/{id}',[AttachmentController::class, 'addempdoc'])->name('attachments.addempdoc');
//Route::get('/attachment/addempdoc',[AttachmentController::class, 'addempdoc'])->name('attachments.addempdoc');
//Route::get('/attachments/emp/{id}',[AttachmentController::class, 'emp'])->name('attachments.emp');

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
