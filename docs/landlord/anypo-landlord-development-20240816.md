[25-NOV-2023] : Landlord Specific development Related Notes

bo01 28-JAN-23
bo02 27-FEB-23
bo04 19-MAR-23
bo05

# Markdown Reference
====================================================================
https://code.visualstudio.com/docs/languages/markdown
https://www.freecodecamp.org/news/how-to-use-markdown-in-vscode/


# 14. Ref Objects & Files
====================================================================
- User->Ticket
- D:\My Works\p2cmain\sslcommerz
- HO-objects-lists-20221015.xlsx
- laravel-CRUD.txt
- HO-1-objects.txt
- HO-2-components.txt
- HO-3-seeders.txt (boht seed and migration)
- Ref: laravel-project-post-create.txt
- Tenant model only Not inside landlord directory
- custom mail template is in fs06
- Front: bootstrap icon update from 1.9.1 to 1.11.2


# 13. Business Rules
====================================================================
1. There will be maximum one unpaid invoice. Wont be able to create invoice if have any unpaid invoice
2. Invoice cancellation is not possible
3. no space limit for in P1
15. Not possible to integrated any existing anypo user into a current account. may be P2
11. now upto 2 decimal price round down in advance pay P2
7. close account P2
3. manual join to mailing list P2
4. separate notification TicketCreated.php for user and support P2

# 12. Assumption and limitation
====================================================================
1. Used the same User model for both landlord and tenant
2. end use wont have access to notification only email . Admin/agent/manager will have access to notification
3. user can not register to an existing account. Account admin need to create user
1. end use wont have access to notification only email . Admin/agent/manager will have access to notification
2. Add-on buy will be free and will be charge form next bill cycle
4. completely remove JS form footer.blade.php check.
5. automatically get feather icons !! check landlord.manage.tables.controllers view


# 11. Pricing
====================================================================
## current
		default 5 user 	list price 30 actual 25$
		3 addition user 	19 - 15
		5 	addition user 	29-25

## initial
		in price page no multiple options
		14.99$/user min 3 user i.e. 45$/Month
		9.99$/user min 3 user i.e. 29$/Month
		then per user 6.99$ in a bundle of 3 18$
		archive mode 9.99$/month

## account creation
			- 1 month without any add-on
						- can create 3/6/12 month invoice if no earlier due, which
						- invoice extend account validity
## add-on
	 - add-on is NOT monthly basis
						- can add/remove any time
						- if current billing is one month will be added from next bill. do the same when cancel
						- if current billing is 3/6/12 month, the account validity is reduce accordingly. reverse when cancel
						- what happened if not enough days to adjust => add next cycle
						- what happened if multiple addone is bought consecutively?
						- everything is in services.index when account_id <> ''

# 10. container width()
====================================================================
@media (min-width: 1200px) {
	.container-xl, .container-lg, .container-md, .container-sm, .container {
		max-width: 1140px;
	}
}
@media (min-width: 1200px) {
	.container-xl, .container-lg, .container-md, .container-sm, .container {
		max-width: 1140px;
	}
}

# 9. Reports
====================================================================
https://www.positronx.io/laravel-pdf-tutorial-generate-pdf-with-dompdf-in-laravel/
https://www.itsolutionstuff.com/post/laravel-8-pdf-laravel-8-generate-pdf-file-using-dompdfexample.html


# 8. auth::route()
====================================================================
1. move Auth controller to landlord
2. override view from auth.register to landlord.auth.register
3. move User Model: from use App\Models\User => to use App\Models\Landlord\User;
4. DID NOT WORK => move User Model to Landlord
		https://laracasts.com/discuss/channels/general-discussion/is-it-possible-to-put-model-and-controller-files-in-subfolders
config/auth file:
Copy
'providers' => [
		'users' => [
				'driver' => 'eloquent',
				'model' => App\Models\User::class,
		]
	]
-- issue for tenant and landlord two user model
https://laracasts.com/discuss/channels/laravel/how-to-login-with-different-models-in-laravel
https://pusher.com/tutorials/multiple-authentication-guards-laravel/#run-the-application
https://techvblogs.com/blog/multiple-authentication-guards-laravel-9

<i data-lucide="refresh-cw"></i>

# 7. TODO - Open
====================================================================
110. change invoice description of advance payment 
109. button show save. card cards
108. bypass payment and create tenant for sysadmin
106. mail-lists views
107. {!! nl2br($ticket->content) !!}
106. breadcrumb in landlord app
105. move attachment download to a verified route
102. country icon size
101. enable disable user
100. make user admin and vice versa
99. captcha
97. clean landlord.head.blade.php remove direct js and css
96. config('app.domain'); vs app_domain
91. clean config(app.url) vs env(app_URL)
95. datetime-local value edit for maintenance start
97. menu rearrange
94. <x-tenant.landlord-notice-all-tenants/>
93. <x-tenant.landlord-notice-one-tenant/>
38. error card in general page
66. search IQBAL
68. user update request
66. badge attribute
69. lock/cancel/archive account
74. sweet alert everywhere
75. post login re-direct to dashboard	https://laraveldaily.com/post/change-redirect-login-register-laravel-breeze
79. ticket category
87. tenant table -> add columns. its inside data
90. Verification mail to ques event(new Registered($user));
94. var_dump(__METHOD__); var_dump(__FUNCTION__);
96. invoice and receipt drop-down policy check
98. error message bullet point in main pages

# 6. P2 TODO
====================================================================
92. add manager call back in tickets
98. predefined text in support ticket
97. date picker
2. storage usages statistics
67. prepare pest and dusk test cases
2. storage usages statistics
6. bug report/feature request
9. auth check for route tables
13. component for create and list <a> with icons
19. chatbot
31. laravel 9 disable auto login after registration
47. mail when a user activated UserController ->destroy
63. captcha in contact us page

# 6. Task Scheduling Billing
====================================================================
$schedule->job(new Billing)->everyFiveMinutes();
php artisan queue:listen --timeout=1200
Running the Scheduler
 The schedule:run Artisan command will evaluate all of your scheduled tasks and determine if they need to run based on the server's current time.
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1

-- don't need to create command !!
php artisan make:command BillingCron --command=billing:cron
edit app/Console/Commands/DemoCron.php

app/Console/Kernel.php
	$schedule->command('billing:cron')
								 ->everyMinute();
		->daily();
		->everyFiveMinutes();
		->dailyAt('13:00');	Run the task every day at 13:00

$schedule->command('billing:cron')->everyFiveMinutes();

Step 4: Run Scheduler Command For Test
php artisan schedule:run

php artisan
 billing
 billing:cron	Command description

php artisan schedule:list

# 5. SSLCommerz
====================================================================
2. Laravel sslcommerz => https://github.com/sslcommerz/SSLCommerz-Laravel
Step 1: Download and extract the library files.
Step 2: Copy the Library folder and put it in the laravel project's app/ directory. If needed, then run composer dump -o.
Step 3: Copy the config/sslcommerz.php file into your project's config/ folder.
Step 4: Copy and put 3 key-value pairs from env_example to your .env file.
Step 5: Add exceptions for VerifyCsrfToken middleware accordingly.


Copy SslCommerzPaymentController into your project's Controllers folder.
Copy defined routes from routes/web.php into your project's route file.
Copy views from resources/views/*.blade.php.

>> my note: add @csrf in exampleEasycheckout.blade.php. http://localhost:8000/example1 works

Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

.env
APP_URL=http://localhost
to
APP_URL=http://localhost:8000
success/cancel should work

VerifyCsrfToken
	protected $except = [
				'/success',
				'/cancel',
				'/fail',
				'/ipn',
				'/pay-via-ajax', // only required to run example codes. Please see bellow.
		];

VISA:
Card Number: 4111111111111111
Exp: 12/25
CVV: 111


# 4. Authentication
====================================================================
Copy:
	D:\laravel\ho03\resources\views\auth
	D:\laravel\ho03\app\Http\Controllers\Auth

- system@example.com/password
- homepage
- user seeder
- login
- Registration
- reset password
- create user
- profile
- logout http://localhost:8000/

Steps
	- auth.blade.php layout
	- page: login.blade.php
	- seed user
 	- http://localhost:8000/login

-- post login redirect to dashboard
LoginController.php
	protected $redirectTo = RouteServiceProvider::HOME;
RouteServiceProvider.php
	public const HOME = '/home';
	public const HOME = '/dashboards';

# 3. Package
====================================================================
- install and configure intervention pkg
	https://github.com/Intervention/image
	composer require intervention/image
	Config\app.php	=>
	'aliases' => Facade::defaultAliases()->merge([
				// 'ExampleClass' => App\Example\ExampleClass::class,
	// IQBAL 7-FEB-23
				'Image' => Intervention\Image\Facades\Image::class,
		])->toArray(),

- inbstal dompdf
	https://github.com/barryvdh/laravel-dompdf
	composer require barryvdh/laravel-dompdf

	Configure DomPDF Package in Laravel
Open config/app.php fil
'providers' => [
	Barryvdh\DomPDF\ServiceProvider::class,
],
'aliases' => [
	 // IQBAL 1-MAR-23
	'Image' => Intervention\Image\Facades\Image::class,
	'PDF' => Barryvdh\DomPDF\Facade::class,
]
[php artisan vendor:publish]
Route::get('/employee/pdf', [EmployeeController::class, 'createPDF']);
<a class="btn btn-primary" href="{{ URL::to('/employee/pdf') }}">Export to PDF</a>

# 2. Setup baseline
====================================================================
- pagination ==> laravel-prototype.txt
- modify and run migration for basic table
- modify and run seeder as needed
- http://localhost:8000/tables
- http://localhost:8000/test
- http://localhost:8000/testrun
- http://localhost:8000/design


# 1. Template page
====================================================================
- php artisan db:seed --class=EntitySeeder
- php artisan db:seed --class=TemplateSeeder
- set route template
- number, date/validation
- dropdown
- view/add/edit/inactive
- export
- log event
- validation
- created_by and updated_by

# 0. DONE
====================================================================
x1. attachment add account
x4. profile photo
x8. account logo
x10. TicketStatusEnum.php did not work in ticket controller
x11. enum for Ticket notifications
x15. fix enum issue
x17. page to site layout rename
x20. record last login
x22. contact for save to db
x23. date casts 10.x
x24. contact both auth and non-auth access
x25. contact add attachments
x26. mail in laravel 10.x
x27. md5 or sha1 to do this: echo 'Generated random string 1 : ' . Str::random(10);
x29. ensure Enum is working
x32. https://www.itsolutionstuff.com/post/how-to-create-custom-log-file-in-laravelexample.html
	https://houseofcoder.medium.com/creating-custom-log-file-in-laravel-aa28f63fc7ab
x33. move all to subfolder landlord
x34. logEvent => EventLog::event
x35. checkbox during register tick mandatory
x36. email verified at enable
x37. Price is in US dollars and excludes tax
x39. php artisan route:cache delete route
x40. lnpage->linkedin fbpage->facebook
x42. sing up mail to user
x43. starter->sme->enterprise  starter->small office->medium office
x45. // TicketStatusEnum::NEW, remove
x46. Country dropdown user account etc
x48. add admin checkbox in edit user screen
x49. add attachment id in ticket/comment/contact etc
x51. validation message checkout together
x52. Simple Pagination
x58. Send mail to whom contacted Notification won’t work
x16. sslcommerz
x21. common component
x27. convert all lv9 policy to lv10 and others policy+mail+request+seeder+factory+relatsion+component
x44. created by default 1 for lookups
x51. Move to landlord
x72. addon purchase invoice
xApp\Policies\Landlord\Lookup\DeptPolicy', does not exists
xApp\Policies\Landlord\Lookup\PaymentMethodPolicy
xApp\Policies\Landlord\Lookup\PriorityPolicy"
xApp\Policies\Landlord\Lookup\RatingPolicy
x98. entry directory and model => entity->subdir
x96. aws attachment
x95. status rewrite
x30. does not comply with psr-4 auto loading standard. Skipping.
x60. / vs /home vs /welcome
x67. move notifcation back from landlord
x60. durign chekcout if exising email is used, make sure after login he can not buy if alredy under any account
x65. use slot for layouts.app
x68. menu
x76. you have an unpaid invoice
x77. receipt downalod
x78. process move to landlord as user will gen own invoice
x81. This daily driver will create one log file per day in the format of laravel-YYYY-MM-DD.log
x92. stop payong already paid invoice
x89. hide suport engineer name form ticket
x95. bootstrap icon update form 1.9.1 to 1.11.2
x61. Store file in landlord sub folder
x63. event(new Registered($user));
x65. dont create invoice if last one is unpaid
x64. set APP_ENV for instances
x64. User avatar upload
x61. Verify Your Email Address tempale for landlord and tenant
x62. veryfy email @if (session('resent')) is not working
x63. you@example.com or you@youromapny.com
x84. Remove  LandlordCheckAccess Reference
x85. no space in site name/regex
x98. put a single place checkout row creation checkout + buy add-on
x70. invoice type subscript/addon/archive
x73. P2 create 3/6/12 invoice/50. Generate invoice for 3 months
x80. laravel text field length
x86. P2 admin -> generate invoice for account
x103 landlord-verify-email.blade.php


