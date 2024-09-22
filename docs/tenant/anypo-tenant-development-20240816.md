[25-NOV-2023] : Tenant Specific development Related Notes

# 33. appstack 3.4.1 to 4.404.
-------------------------------------------------------------------------------------------------
1. replace eye icon with view button in index page
2. change show page to line line under view
3. notification list rewrite
4. notification view rewrite
5.

# 33. Learning
-------------------------------------------------------------------------------------------------
1. for non id PK, define PK in model
2. when column name and relation name equal error. Must be separated
3. when rout is same called the tenant rout invoice/attachment etc
	both in landlord and tenant Route::get('/invoices/create/{po}',[InvoiceController::class,'create'])->name('invoices.create');
	can:access-back-office

3. demo data in App\Helpers\ChartData
	ChartData::budget();
	ChartData::deptBudget();
	ChartData::project();
	ChartData::supplier();
	echo "Done";
	exit;

LandlordEventLog

App\Jobs\Landlord\CreateTenant;

# 32. Assumption and limitations
-------------------------------------------------------------------------------------------------
1. anypo logo <img src="{{asset('logo/logo.png')}}" width="80px" height="45px"/> <br>
2. any function return '' is considered as success else it will return the error code like E015
3. reports.code=ReportController.function=View.Code

# 32. Before prod deploy
-------------------------------------------------------------------------------------------------
1. TODO need to set approver_id as new admin id $hierarchyls =  [


# 31. Ref Objects & Files
-------------------------------------------------------------------------------------------------
User->Template->Dept
	D:\My Works\p2cmain\sslcommerz
	ngrok

	ModelNotFoundException -> wfController.php
	HO-objects-lists-20221015.xlsx
	laravel-CRUD.txt
	HO-1-objects.txt
	HO-2-components.txt
	HO-3-seeders.txt (both seed and migration)

upload: PR Header attachments

# 30. SEEDED FILE CHANGE
-------------------------------------------------------------------------------------------------
BO-4-source-file-modify-20230413.txt

# 34. Changes in Dept
-------------------------------------------------------------------------------------------------
1. livewire index
2. policy/access
3. card title parameter
4.

# 34. Code Quality Improve
-------------------------------------------------------------------------------------------------
1. findorfail in edit
2. user @forelse and @empty for any index/list in blade
3. handle empty belong to relation defaults
4. code formatting using pint
5. search used feather icons data-feather=
6. search used font awesome icons class="fa-r or class="fas-
7. fix label for warning in browser
8. {!! nl2br($ticket->content) !!}
9. <label for="summary" warning
10. tooltip data-bs-toggle="tooltip" data-bs-placement="top" title="View"
11. inside control function. Do the basic validation then leave for policy to check


# 28. Reports
-------------------------------------------------------------------------------------------------
https://niemvuilaptrinh.medium.com/36-html-table-style-for-web-design-faa19dad2cab


# 28. appstack deploy in aws
-------------------------------------------------------------------------------------------------
Target: Amazon S3/Buckets/anypo-public/tenant/
Source: D:\xampp\htdocs\appstack\dist
Ref: 	D:\My Works\aws\laravel-aws.txt
	.env AWS
	app.blade.php => <link rel="stylesheet" href="{{ Storage::disk('s3t')->url('css/light.css') }}">
	filesystem.php => s3t => 'root' => 'tenant/assets'
tenant/ vs tenancy
css
fonts
img
js


# 30. breadcrumb
-------------------------------------------------------------------------------------------------
## index
@section('breadcrumb')
	<li class="breadcrumb-item active">Projects</li>
@endsection

## show
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
	<li class="breadcrumb-item active">{{ $project->name }}</li>
@endsection

## edit
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
	<li class="breadcrumb-item"><a href="{{ route('projects.show',$project->id) }}">{{ $project->name }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

## create
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection


# 32. Used Common Icons (<x-tenant.buttons.header) -------------------------------------------------------------------------------------------------
list		<i data-feather="list"></i>
create		<i data-feather="plus-square"></i>
addline		<i data-feather="plus"></i>
edit		<i data-feather="edit"></i>
save		<i data-feather="save"></i>
export
pdf/print 	<i data-feather="printer"></i>
submit 		<i data-feather="external-link"></i>
payment:	<i data-feather="credit-card"></i>
		<i data-feather="alert-triangle" class="text-danger"></i>

# 27. Tenant/Docs/Support
-------------------------------------------------------------------------------------------------
accordionPr	1+n

collapsePr1	2+n
collapsePr2	2
collapsePr3	2

headingPr1	1+1
headingPr2	1+1
headingPr3	1+1


# 27. Modal Popup
-------------------------------------------------------------------------------------------------
need to update
tenant\includes\modal-boolean-advance.php
<a href="{{ route('budgets.destroy',$budget->id) }}" class="me-2 modal-boolean-advance"
	data-entity="Budget" data-name="{{ $budget->name }}" data-status="{{ ($budget->freeze ? 'UnFreeze' : 'Freeze') }}"
	data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($budget->freeze ? 'UnFreeze' : 'freeze') }}">
	<i class="align-middle text-muted" data-feather="{{ ($budget->freeze ? 'bell-off' : 'bell') }}"></i>
</a>
@include('tenant.includes.modal-boolean-advance')

tenant\includes\modal-boolean.php
<a href="{{ route('budgets.create') }}" class="btn btn-primary float-end modal-boolean"><i data-feather="folder-plus"></i> Open Next FY Budget*</a>
@include('tenant.includes.modal-boolean')

# 27. Header buttons
-------------------------------------------------------------------------------------------------
	Create 	Edit 	List
index	Yes
show	Yes	Yes	Yes
edit	Yes		Yes
create			Yes
Submit
Print

# 26. Free Exchange rate
-------------------------------------------------------------------------------------------------
call: Dashboard->index->  ImportAllRate::dispatch();->app\helpers\ExchangeRate.php->ExchangeRate::getRate($pr->currency, $setup->currency);
Ref: laravel-exchange-api.txt
Where it is initiated?
$rate = ExchangeRate::getRate($pr->currency, $setup->currency);
Job: ImportAllRate
Log::debug("Rates Importing for ".$current_rate_month);

# 25. Enable Test Mail using Queue
-------------------------------------------------------------------------------------------------
php artisan make:mail SendEmailTest
file: app/Mail/SendEmailTest.php
return new Content(
			view: 'emails.test',
		);
create: resources/views/emails/test.blade.php

.env
QUEUE_CONNECTION=database
php artisan queue:table
INFO: Migration created successfully.
2023_07_26_134042_create_jobs_table.php

--> migrate in landlord
php artisan migrate

[-- not move to tenant sub folder
php artisan tenants:migrate --tenants=geda]

php artisan make:job SendEmailJob

php artisan make:job SendEmailQueueJob
	INFO  Job [D:\laravel\po02\app/Jobs/SendEmailQueueJob.php] created successfully.

create route: /send-queue-email

for Notification:
class Test extends Notification
class Test extends Notification implements ShouldQueue

you must have to run following command to see queue process, you must have to keep start this command:
=>php artisan queue:work
php artisan queue:listen
php artisan queue:flush

# 24. View Composer for menu/notification count etc
-------------------------------------------------------------------------------------------------
Note: View Composer variable start with _setup etc

Setup/Notification Count
php artisan make:provider ViewServiceProvider
INFO  Provider [D:\laravel\po02\app/Providers/ViewServiceProvider.php] created successfully.

config/app.php
'providers' => [
	// Add View Composer Provider
	App\Providers\ViewServiceProvider::class
 ],

=> app/Providers/ViewServiceProvider.php
boot():
Facades\View::composer('app', SetupComposer::class);

Create File:
App\View\Composers\SetupComposer

in layout\app.blade.php
{{ $setup->name}} :-)

# 23. Livewire Modal
-------------------------------------------------------------------------------------------------
php artisan make:livewire Dept/Index
TBD

# 22. Import from xlsx
-------------------------------------------------------------------------------------------------
Ref: laravel-packages-used.txt
[- this one is used , but downgraded psr/http-message (2.0 => 1.1)]
-- install smooths in  Laravel v10.43.0
composer show psr/http-message
composer require phpoffice/phpspreadsheet

[=> Use the option --with-all-dependencies (-W) to allow upgrades, downgrades and removals
=>composer require phpoffice/phpspreadsheet --with-all-dependencies
Downgrading psr/http-message (2.0 => 1.1)]

https://phpspreadsheet.readthedocs.io/en/latest/topics/reading-files/
https://sweetcode.io/import-and-export-excel-files-data-using-in-laravel/

# 21. sweet alert
-------------------------------------------------------------------------------------------------
sweet-alert2.txt -> countries->index.blade.php
<a href="{{ route('countries.destroy',$country->country) }}" class="me-2 enable-confirm"
	data-entity="Country" data-name="{{ $country->name }}" data-status="{{ ($country->enable ? 'Disable' : 'Enable') }}"
	data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($country->enable ? 'Disable' : 'Enable') }}">
	<i class="align-middle {{ ($country->enable ? 'text-danger' : 'text-success') }}" data-feather="{{ ($country->enable ? 'bell-off' : 'bell') }}"></i>
</a>
 @include('includes.modal-enable')

# 20. Last login
-------------------------------------------------------------------------------------------------
https://dev.to/snehalkadwe/get-last-login-of-user-in-laravel-ckg
https://laraveldaily.com/post/save-users-last-login-time-ip-address
You need to know that there is authenticated() method in the AuthenticatesUsers trait. It's called every time someone logs in.
LoginController.php => function authenticated(Request $request, $user)

# 19. POST LOGIN CHECK
-------------------------------------------------------------------------------------------------
https://dev.to/arielmejiadev/fired-an-action-when-user-is-logged-in-or-verified-with-laravel-4p3k
https://laracasts.com/discuss/channels/laravel/header-may-not-contain-more-than-a-single-header-new-line-detected
I have just need to redirect to strings, not using the route() method.
https://codeanddeploy.com/blog/laravel/laravel-8-logout-for-your-authenticated-user

edit LoginController.php
public function redirectTo()
	{
		auth()->user()->notify(new StatusNotification());
	}


LoginController
TODO: //is_null('email_verified_at')

Note: By Default User created are disable. Enable it
protected function credentials(Request $request)

# 18. Enum
-------------------------------------------------------------------------------------------------
https://www.itsolutionstuff.com/post/how-to-use-enum-in-laravelexample.html
https://enversanli.medium.com/how-to-use-enums-with-laravel-9-d18f1ee35b56
$role = UserRoleEnum::MANAGER;
echo $role->value;

1. define in migration
2. define enum
3. cast in model
4. refer in controller

1. UserRoleEnum
2. TicketStatusEnum

use enum:
$user->role		= UserRoleEnum::ADMIN->value;

@if (  $user->role ==  App\Enum\UserRoleEnum::USER)
	<span class="badge bg-soft-primary">{{ $user->role }}</span>
@else
	<span class="badge bg-soft-danger">{{ $user->role }}</span>
@endif

switch (auth()->user()->role->value) {
	case UserRoleEnum::USER->value:
				$users= $users->byuser()->orderBy('id', 'DESC')->paginate(10);
				break;
		case UserRoleEnum::ADMIN->value:
				$users= $users->byaccount()->orderBy('id', 'DESC')->paginate(10);
				break;
		default:
				$users= $users->orderBy('id', 'DESC')->paginate(10);
				Log::debug("Other roles!");
}


# 17. Alias
-------------------------------------------------------------------------------------------------
Config\app.php	=>

  'aliases' => Facade::defaultAliases()->merge([
		// 'ExampleClass' => App\Example\ExampleClass::class,
		// IQBAL 12-APR-23
		'FileUpload' => App\Helpers\FileUpload::class,
		'Workflow' => App\Helpers\Workflow::class,
		'Image' => Intervention\Image\Facades\Image::class,
		'UserRoleEnum' => App\Enum\UserRoleEnum::class,
		'TicketStatusEnum' => App\Enum\TicketStatusEnum::class,
	])->toArray(),
blade: \App\Helpers\Workflow
class: Workflow::

# 16. eMails Verification
-------------------------------------------------------------------------------------------------
https://stackoverflow.com/questions/68287936/where-we-sould-dispatch-use-illuminate-auth-events-registered
https://laravel.com/docs/10.x/verification
class User extends Authenticatable implements MustVerifyEmail
{
	use Notifiable;
	// ...
}

Class "EmailVerificationRequest" does not exist
add in web.php
	use Illuminate\Foundation\Auth\EmailVerificationRequest;

user registration from three places:
1. self register
2. buy account+service
3. admin created user manually


Auth::routes() is just a helper class that helps you generate all the routes required for user authentication. You can browse the code here
https://github.com/laravel/framework/blob/10.x/src/Illuminate/Routing/Router.php

1. change verify.blade.php to verify-email.blade.php
2. change route name from 'resend' to 'send' in that file
3. change routes in web.php as
Route::resource('dashboards', DashboardController::class)->middleware(['auth', 'verified']);
4. add three verify route form laravel 10 documents


# 15. Mails
-------------------------------------------------------------------------------------------------
https://www.itsolutionstuff.com/post/laravel-10-mail-laravel-10-send-mail-tutorialexample.html
https://techsolutionstuff.com/post/laravel-10-send-email-with-attachment-example
https://www.itsolutionstuff.com/post/laravel-send-mail-using-mailtrap-exampleexample.html
https://mailtrap.io/blog/laravel-email-testing/

Global Mail Address config/mail.php file
'from' => [
		'address' => env('MAIL_FROM_ADDRESS', 'i.khondker@hawarIt.com'),
		'name' => env('MAIL_FROM_NAME', 'HawarIT Limited'),
],

=> https://mailtrap.io/signin -> .env
MAIL_MAILER=smtp
-# MAIL_HOST=mailhog
-# MAIL_PORT=1025
-# MAIL_USERNAME=null
-# MAIL_PASSWORD=null
-# MAIL_ENCRYPTION=null
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=948fb28b7f5b14
MAIL_PASSWORD=b519f2b726bc9b
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="i.khondker@hawarit.com"
MAIL_FROM_NAME="${APP_NAME}"

# 14. Creating custom log file
------------------------------------------
config/logging.php
'bo' => [
			'driver' => 'single',
			'path' => storage_path('logs/bo.log'),
			'level' => 'info',
		],

Inside controller
use Illuminate\Support\Facades\Log;
Log::channel('anypo')->info('This is testing for ItSolutionStuff.com!');

-- Example One
Log::channel('anypo')->info('New user logged in');
[2023-04-06 18:30:39] local.INFO: This is testing for ItSolutionStuff.com!

#Example Two
$user_name = auth()->check() ? auth()->user()->name : 'Name here';
$user_email = auth()->check() ? auth()->user()->email : 'email here';
$user = ['name'=>$user_name, 'email'=>$user_email];
Log::channel('anypo')->info('User details',$user]);

[2023-04-06 18:30:39] local.INFO: User details [{"name":"System Owner (Iqbal)","email":"system@example.com"}]

# 13. Notification Enable
-------------------------------------------------------------------------------------------------
List in PO-2-components-20230603.txt

mail is configured in .env
https://webomnizz.com/laravel-notification-customize-markdown-email-header-and-footer/

HomeController->sendNotification
route.php
	Route::get('/send', [App\Http\Controllers\HomeController::class, 'sendNotification'])->name('send');
	http://localhost:8000/send

php artisan make:model Notification --controller --resource
==> in Model: Notification extends Model
	protected $primaryKey = 'id';
	protected $keyType = 'string';
	// https://stackoverflow.com/questions/61844701/laravel-how-to-get-id-of-database-notification
	protected $casts = [
		'data' => 'array',
		'id' => 'string'
	];

public function via(object $notifiable): array
	{
		//return ['mail'];
		return ['mail','database'];
	}

# 12. multi-word controller name two
-------------------------------------------------------------------------------------------------
=> view and route same like leave-types
=>
model: LeaveType.php
table: leave_types
route: resource('leave-types', LeaveTypeController::class);
link:  route('leave-types.create')
view:  view('leave-types.show',compact('leaveType'));
data:  $leave_types = LeaveType::latest();
view folder: leave-types

# 11. Add Timestamp (Home)
---------------------------------------------------------------------------------
  created_by and updated_by -- add inside model
  https://stackoverflow.com/questions/64241140/created-by-updated-by-in-laravels-updateorcreate
  https://laravel.com/docs/9.x/eloquent#observers
  use: https://dev.to/hasanmn/automatically-update-createdby-and-updatedby-in-laravel-using-bootable-traits-28g9

-- create Trait Manually trait D:\laravel\ho01\app\Traits\AddCreatedUpdatedBy.php
-- add reference in UomModel before class
	use App\Traits\AddCreatedUpdatedBy;	->AddTimestamp
-- use inside UomModel Class
	use AddCreatedUpdatedBy;
	or use HasFactory, AddCreatedUpdatedBy;

# 10. Authorization, CRUD and Homepage -------------------------------------------------------------------------------------------------
ref: laravel-CRUD.txt

// two route
Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
//Route::get('/home', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('home');


a. post login redirect to dashboard
	LoginController.php
	protected $redirectTo = RouteServiceProvider::HOME;

b. post logout redirect to login:
	LoginController.php
	public function logout(Request $request) {
			return redirect('/');
	}

-- for PO it was done by route "/"
RouteServiceProvider.php
	public const HOME = '/home';
	//public const HOME = '/dashboards';

logout
	// IQBAL 28-feb-23
	Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout');


https://laracasts.com/discuss/channels/laravel/make-my-root-login-page
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('/login');

# 9. Restrict Login for deactivated user
-------------------------------------------------------------------------------------------------
	// disable user login LoginController.php
	// IQBAL 9-sep-2022
	//added to overwrite the login credentials
	 protected function credentials(Request $request)
	 {
		//Log::debug('I am here!');
		return [
			 'email'	=> request()->email,
			 'password' => request()->password,
			 'enable'	=> 1
		 ];
	 }

-- disable auto login after registration
RegiserController.php
protected $redirectTo = '/logout';

-- disable not email verified user login
https://laravel.com/docs/10.x/verification
https://larainfo.com/blogs/laravel-8-email-verification-with-laravel-ui
** https://stackoverflow.com/questions/71220314/laravel-e-mail-verification-re-send-method
-- ?? rename verfy.blade.php pto verify-email.blade.php as per verification.notice route . did not work
verification.notice Laravel

Protecting Routes
Route::get('/profile', function () {
	// Only verified users may access this route...
})->middleware(['auth', 'verified']);

# 8. authentication
-------------------------------------------------------------------------------------------------
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

# 7. Helpers
-------------------------------------------------------------------------------------------------

app/Helpers/helpers.php
	-- exportCSV()
	-- logEvent()

Register File Path In composer.json File in "autoload":

},
  "files": [
		"app/Helpers/helpers.php"
	]
*** Eachtime added a function run it

composer dump-autoload	<<====== take time OK. MUST


# 6. Template page
-------------------------------------------------------------------------------------------------
- php artisan db:seed --class=EntitySeeder
- php artisan db:seed --class=TemplateSeeder
- set route template

- component
[	php artisan make:component AlertSuccess
	php artisan make:component AlertError
	php artisan make:component Breadcrumb]
- number, date/validation
- dropdown
- view/add/edit/inactive
- export
- log event
- validation
- created_by and updated_by



# 5. Package
-------------------------------------------------------------------------------------------------
- Ref: laravel-used-packages.txt
- install and configure intervin pkg
  https://github.com/Intervention/image
  composer require intervention/image
  Config\app.php	=>
  'aliases' => Facade::defaultAliases()->merge([
		// 'ExampleClass' => App\Example\ExampleClass::class,
	// IQBAL 7-FEB-23
		'Image' => Intervention\Image\Facades\Image::class,
	])->toArray(),

- install dompdf
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

# 4. Baseline
-------------------------------------------------------------------------------------------------
- paginations ==> laravel-prototype.txt
- modify and run migration for basic table
- modify and run seeder as needed
- http://localhost:8000/tables
- http://localhost:8000/test
- http://localhost:8000/testrun
- http://localhost:8000/design


# 2. Setup
-------------------------------------------------------------------------------------------------
Ref ==> laravel-create-project.txt
 - Create db
 - install laravel and and change .ENV
 - remove vite
 - pas .bat file => C:\Windows\System32\lv.bat
 - set route test and test run
 - set route design
 - apply theme starter <depends>
 - starter-full-width-htm.blade.php => master.blade.php
 - add custom css & js in master.blade.php D:\laravel\bo02\public\custom.css
 - D:\laravel\bo02\public\custom.css
 - D:\laravel\bo02\public\site
 - set @content
 - test.blade.php based on master.blade.php
 - tables routes and views based on master.blade.php => http://localhost:8000/tables Ok
 - add to git D:\My Works\lv-my-docs\laravel-git.txt
 - tune /c/Users/pulok/.bashrc in linux
 - config\ihk.php . Just create. dont need anyhtign else. config('ihk.MSG_DENY') and sslcommerz.php
 - app.php => config('app.name') = 'name' => env('APP_NAME', 'AnyPO'),
 - edit .env
	APP_NAME=Laravel
	APP_URL=http://localhost:8000
	SSLCZ_STORE_ID='perso5d0879ec44338'
	MAIL on top
 - enable spell checker
 - data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
 - php artisan storage:link
	INFO  The [D:\laravel\po02\public\storage] link has been connected to [D:\laravel\po02\storage\app/public].

