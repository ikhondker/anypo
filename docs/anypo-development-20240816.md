[25-NOV-2023] : Instance Specific development Related Notes

# 13. Use sequence 
====================================================================
1. Models
2. Enums
3. Helpers
4. Notifications
5. Jobs
6. Mails
7. Rules
8. Packages
9. Exceptions
10. Events
11. Controller
12. Seeded
13. FUTURE 
1. create a new role PM for projects
2. layout change for edit user page role change


# 12. Icons
====================================================================
-	<i class="align-middle me-1" data-lucide="eye"></i> View Purchase Order
-	<i class="align-middle me-1" data-lucide="paperclip"></i> View Attachments
-	<i class="align-middle me-1" data-lucide="edit"></i> Edit Purchase Order
-	<i class="align-middle me-1" data-lucide="plus-circle"></i> Create Invoice
-	<i class="align-middle me-1" data-lucide="printer"></i> Print Purchase Order
-	<i class="align-middle me-1 text-danger" data-lucide="dollar-sign"></i> Lifetime Discount (*)
-	<i class="align-middle me-1 text-danger" data-lucide="rotate-ccw"></i> Account Reset (*)
-	<i class="align-middle me-1 text-danger" data-lucide="delete"></i> Delete Account (*)
-	<i class="fas fa-plus"></i> New Ticket


# 12. Function Sequence in Controller 
====================================================================
1. index
2. create
3. store
4. show
5. edit
6. update
6. destroy

<div class="text-danger text-xs">{{ $message }}</div>
to
<div class="small text-danger">{{ $message }}</div>

# 11. Frequent 
====================================================================
~~~
use Illuminate\Support\Facades\Log;
Log::debug('fileName='. $filename);
Log::info(print_r($dept_budget, true));
composer update
php artisan --version
git commit -m "Tables"
php artisan queue:flush
php artisan queue:listen --timeout=1200
php artisan schedule:run
$user->isBackOffice()
<i class="bi {{ ($menu->enable ? 'bi-bell-slash' : 'bi-bell') }} " style="font-size: 1.3rem;"></i>
optional($article->expired_at)->format('Y-m-d')
Log::info(print_r($dept_budget, true));
~~~


# 8. Folders 
====================================================================
### From CRUD perspective not from daily menu/link perspective
1. lookup	- contains both lookup and master data
2. admin	- client admin
3. workflow	- hierarchy and workflow related
4. reports	- reports both client and back office
5. manage	- only that have/need back end access
6. system	- only system access NOT used so far
7. ae		- Accounting entries


# 7. Error Reporting 
====================================================================
- custom error reporting in laravel.log warning and error 
- app/exceptions/Handler
- write to: \App\Models\Landlord\Manage\ErrorLog();


# 6. Learning 
====================================================================
1. for non id PK, define PK in model
2. when column name and relation name equal error. Must be separated
3. Pr status and auth_status issue. Eager loading warning. ok. Don't cast these two column in model. with() fails
4. while passing data to component, variable name with _ create issues dept_budge_id did not work bu dbid word
4. check all env used env('APP_DOMAIN'); case sensitive
5. in production env, un-handled exception write full log in laravel.log
6. to debug 404 error use the register method of app/Exception/Handler
7. if get js error in developer tools, first disable all chrome extension special google Sheets etc
8. for ajax to works use <script type="module"> not <script type="text/javascript">
9. sweetalert2 confirmation on form post account/generate.blade.php
10. use config('app.url') or config('app.domain'). Not env(APP_DOMAIN) and env(APP_URL) . Remember APP_DOMAIN is added by iqbal in app.php. Ref: \resources\views\vendor\mail\text
11. use trait to add a custoem function to all Model like App\Trait\CreatedUpdateBy 
12. The relationship is Tenant hasMany Domain. https://tenancyforlaravel.com/docs/v3/tenant-identification/
13. Aliases is in app.php like 'UserRoleEnum'	=> App\Enum\UserRoleEnum::class,

# 5. Set Environment 
====================================================================
~~~
.env =>  APP_DOMAIN=anypo.net # Custom
app.php => 'domain' => env('APP_DOMAIN', 'localhost'),
Log::debug("app.names= ".config('app.name') );
Log::debug("app.domain= ".config('app.domain') );
Log::debug("app.url= ".config('app.url') );
D:\laravel\anypo\config/akk.php
~~~

# 4. Authorization, CRUD and Homepage 
====================================================================
- ref: laravel-CRUD.txt
- https://laracasts.com/discuss/channels/laravel/make-my-root-login-page
- Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('/login');

# 3. Route 
====================================================================
~~~
Route::post('password/email', [
	'as' => 'laravel.password.email',
	'uses' => 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail'
]);

Route::get('password/reset', [
	'as' => 'laravel.password.request',
	'uses' => 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm'
]);
~~~

# 2. Generate dummy chart data screenshot 
====================================================================
- TestController => run()
- //ChartData::budget();
- //ChartData::deptBudget();
- //ChartData::project();
- ChartData::supplier();
- echo "Done";
- exit;

# 1. Interface and layout 
====================================================================
 - table 
		appstack4\docs\ecommerce-orders.html
		<table id="datatables-orders" class="table w-100">

# 1. Setup->config 
====================================================================
- $_landlord_setup -> _config

