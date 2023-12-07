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

use App\Http\Controllers\Landlord\DashboardController;
use App\Http\Controllers\Landlord\TicketController;
use App\Http\Controllers\Landlord\UserController;
use App\Http\Controllers\Landlord\AccountController;
use App\Http\Controllers\Landlord\CheckoutController;
use App\Http\Controllers\Landlord\ServiceController;
use App\Http\Controllers\Landlord\InvoiceController;
use App\Http\Controllers\Landlord\PaymentController;
use App\Http\Controllers\Landlord\ActivityController;
use App\Http\Controllers\Landlord\ContactController;

use App\Http\Controllers\Landlord\Manage\SetupController;
use App\Http\Controllers\Landlord\Manage\StatusController;
use App\Http\Controllers\Landlord\Manage\TableController;
use App\Http\Controllers\Landlord\Manage\TemplateController;
use App\Http\Controllers\Landlord\Manage\EntityController;
use App\Http\Controllers\Landlord\Manage\MenuController;
use App\Http\Controllers\Landlord\Manage\ProductController;
use App\Http\Controllers\Landlord\Manage\CategoryController;
use App\Http\Controllers\Landlord\Manage\CountryController;

// works also
// Route::get('dashboard', function () {
//     // Matches The "/admin/dashboard" URL
//     return "This is from admin route from admin.route file at" . now();
// });

/**
 * ==================================================================================
 * Routes allowed to back office only
 * ==================================================================================
*/

// TODO uncomment
// Ref: app/Providers/AppServiceProvider.php
//Route::middleware(['auth', 'verified','can:access-back-office'])->group(function () {
Route::middleware(['auth', 'verified'])->group(function () {

	Route::get('dashboard', function () {
		// Matches The "/admin/dashboard" URL
		return "This is from admin route from admin.route file at after auth " . now();
	});
	
	/* ======================== Ticket ========================================  */
	Route::get('/ticket/all', [TicketController::class, 'all'])->name('tickets.all');
	Route::get('/ticket/assign/{ticket}', [TicketController::class, 'assign'])->name('tickets.assign');

	/* ======================== User ========================================  */
	Route::get('/user/all', [UserController::class, 'all'])->name('users.all');

	/* ======================== Accounts ========================================  */
	Route::get('/account/all', [AccountController::class, 'all'])->name('accounts.all');

	/* ======================== Checkout ======================================== */
	Route::get('/checkout/all', [CheckoutController::class, 'all'])->name('checkouts.all');

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

	/* ======================== Setup ======================================== */
	Route::resource('setups', SetupController::class);
	//Route::get('/setups1', [SetupController::class,'index'])->name('setups.index');

	/* ======================== Menu ======================================== */
	Route::resource('menus', MenuController::class);
	Route::get('/menu/export', [MenuController::class,'export'])->name('menus.export');
	Route::get('/menus/delete/{ menu }', [MenuController::class,'destroy'])->name('menus.destroy');

	/* ======================== Status ======================================== */
	Route::resource('statuses', StatusController::class);
	Route::get('/status/export', [StatusController::class, 'export'])->name('statuses.export');
	Route::get('/statuses/delete/{ status }', [StatusController::class, 'destroy'])->name('statuses.destroy');

	/* ======================== Entity ======================================== */
	Route::resource('entities', EntityController::class);
	//Route::get('/entity/delete/{entity}',[EntityController::class, 'destroy'])->name('entities.destroy');
	Route::get('/entity/export', [EntityController::class, 'export'])->name('entities.export');

	/* ======================== Product ======================================== */
	Route::resource('products', ProductController::class);

	/* ======================== Country ======================================== */
	Route::resource('countries', CountryController::class);
	Route::get('/country/export',[CountryController::class,'export'])->name('countries.export');
	Route::get('/countries/delete/{country}',[CountryController::class, 'destroy'])->name('countries.destroy');

	/* ======================== Category ======================================== */
	Route::resource('categories', CategoryController::class);
	Route::get('/categories/delete/{category}',[CategoryController::class, 'destroy'])->name('categories.destroy');
	
	/* ======================== Template ========================================  */
	Route::resource('templates', TemplateController::class);
	Route::get('/template/export', [TemplateController::class, 'export'])->name('templates.export');
	//Route::get('/template/delete/{template}',[TemplateController::class, 'destroy'])->name('templates.destroy');

});
