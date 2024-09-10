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

# 33. TODO 
-------------------------------------------------------------------------------------------------
158. clean akk.GUEST_USER_ID
157. wfs.index badge not shown
156. check DbuDeptBudget extends Component , dept-budget.dbu.php
155. fix component list -> ArticleLink and ProjectLink
154. export file name add export
153. allow user to edit attachment file description
155. add users need multi user avatar
153. po table issue, invoiceLines, reports, FAQ, attachments
152. re-use D:\Temp\svg\illustrations\png from Front theme
148. Find and replace 'PO #', 'PR #', debug('tenant, =$, @can('edit' , ANYPO.NET, <i class="bi"
126. find and replace 01911310509 +0012262804920 you@company.com email@example.com
127. address/remove all TODO
147. rewrite po lists
145. Department Budget [BDT] export
144. dbu export user_id -= null
143. Home - 2024 - Dept Budgets - IT -Edit
141. calculate-pr-amount.blade.php pr_amount during add line incorrect
140. set fb and linked url to any po during setup and seeded
139. edit master data supp/project/item by buyer @can button not shown
137. budget revision TODO link for source with DB:insert and last id
136. create UOM - UoM Class - default uom mention
135. hierarchyl export serial number
133. budget revision TODO check budget and dept_budge duplicate form fornt end.
132. ({{ $_setup->currency }}) is not working in project show and create
131. country, status, code edit error is showing
130. ticket create and view update from tenant without login to landlord
129. anypo item tax+gst, JS for tax gst, pr pdf tax, p2 reject pr, pr dashboard converted to po count
128. adding default T&C text in PO line break check
125. calculate-pr-amount.blade hard-coded 1001
124. TODO prl cancel here
123. Recon script not accounted transaction an fix issue.
122. Manual Generate Accounting admin
121. ac_expense validate now aplha_dash need to allow .
120. country currency model called twice in edit page in control and in component
119. **search PO/PO by Number
118. add facebook messenger chat in landlord site
117. getting started mail notification
116. getting started page *
115. both in landlord and tenant Route::get('/invoices/create/{po}',[InvoiceController::class,'create'])->name('invoices.create');
114. split RecordDeptBudgetUsage job into FIVE separate class
113. Budget Utilized 30?
112. finalize <x-tenant.widgets.budget-stat/>
111. email gateway use AWS
110. view composer in login page view name inside viewService provider
109. setup->admin_id is degraded to user and edit setup admin_id drop down error
108. start and end date date-time and date only seeder issue. seeder store date and time
107. some object does not start with 1001, setup, menu, designation, group, pay_method, (workaround id=> deployed)


# 30 Nice to Have P2 
-------------------------------------------------------------------------------------------------
158. prefix form pr/po number
134. command generator based on tenants
142. budget update approval workflow P2
1. add advance/prepayment functionality
1. edit user edit form show profile left side 
2. PR budget utilization pie chart in budget dashboard
1. item attachment, supplier attachments
1.	* a check list to check count and amount by sql with budget level count of po/project/supplier etc
2.	separate pr download and my-pr download
3.	add date filter in applicable index pages like Ael
4.	API in landlord to create ticket form tenant on unexpected issues
5.	allow download data with parameter and filter like date/vendor/project item etc
6.	 <label for="summary"
7.	breadcrumb change to icons
8.	breadcrumb replace with feather arrow icon
9.	during user creation by admin set dept and designation
10.	during user registration set set dept and designation
11.	format code by psr-12 standards
12.	Report run log in table and index page
13.	SMS notification
14.	newsletter
15.	add time zone
16.	replace sweet alert with livewire bootstrap alert
17.	bug report/enhancement request
18.	show pr/po line in email notification
19.	Budget revision history, 
20.	Collapse a card 
21.	Del Class* in tables
22.	liveware authorize fail abort 403. now full screen
23.	Add collapsible card + add search card + search in menu + hamburger icon change
24.	page loader spinner in pages
25.	$setup->enable = false. block access
26.	<link rel='canonical' href='https://appstack.bootlab.io/pages-blank.html' />
27.	hide support user activity from activity view
118. vite /npm build deploy to amazon 



# 29. TODO P2
-------------------------------------------------------------------------------------------------
1.  multiple notice with history
1. search with account=no file invoice/payment/receipt
103. export data to csv from elequent
104. write a schedule job to post tena summary to landlord
103. auto update inv/grs /pol status
112. laravel down from application
65. Allow rejected pr/po edit and resubmit


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
$user->role    		    = UserRoleEnum::ADMIN->value;

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
             'email'    => request()->email,
             'password' => request()->password,
             'enable'   => 1
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


# 0. DONE 
-------------------------------------------------------------------------------------------------
x151. paid_amount vs amount_paid landlord vs tenant (keep amount_paid)
x147. disabe one buyer to submission by other buyer PO
x146. Dashboard [TODO - BUYER] count+pending pr and my po
x124. aeh list not shwon
x121. changlog
x120. remove create with Creare for for inv/receipt/payment revision_dept_budget_id TODO
x118. repalce create route to create-for-pol like in 
x146. clean template app.php
x124. convert to po does not gen line_num in PO
x123. upload item action drop down
x122. class="text-muted" in breadcrumb
x120. Interface Items add action component
x119. why <x-tenant.create.address2/> is not linked
x118. null issue with edit->address1, address2 etc 
x117. 403 is not renderd properly
x116. logo in login page
x148. use App\Helpers\Akk; where it is called?
x143. <i class="far fa-fw fa-bell"></i>
x141. error reportign in laravel.log warnign and error app/exception.handle
x123 profiel action not shows
x121.find and replace anypo.com 
x121. move project inside lookup
x121. po by supplier, po by project 
x103. # 1. Dashboard chart
x102. chartjs issue fix when all value is zero
x3. send notification admin on new user registration
x133. update seeded hierarchy with tenant admin_id
x131. seeded back account FC update after setup freeze and supplies
x130. hod/others see only approved pr and po's
x94. remove group controller
x88. no country is enabled. may hide country from list?
x109. Chart.js v2.9.4 . I want to use the latest v4.4.1 directly using CDN. How do
x108. select2 for items
x105.  rewrite pr+po
x108. large file upload size 5MB
x78. pie chart in project view page
x83. action link in notification does not show tenant URL
x102. report on detail spending of a supplier or a prokect
x101. show notice form landlord for downatime
x87. notification from column add and icon in dropdown avatarb.png is now
x86. reset password no message
x39. budget utilization group by query
x92. contact us from help page and save in landlor contact table with attachment
x85. post login redirect to dashboard
x86. post logout redirect to login
x87. highligh help link when clicked add in seeder 
xbudget+dept_budgets+prejct+supplier 
xadd 	count_pr_booked and count_po_booked
xrename 	amount_pr_issued  amount_pr
xrename 	amount_po_issued  amount_po
xcount_pr should covner both book and approve budget/dpetbudgt/suppoer/proejct
xcount_po should covner both book and approve budget/dpetbudgt/suppoer/proejct
x111. tax report
x110. readonly and lock base on setup. stop creating
x105. supplier spend analyses
x104. project spet analysis and report
x102. action in pr and po list
x102. cunt zero row in pr and po and update
x104. stop entering over amount
x101. tax +vat add in unit price grs price
x100. update count columns in budget and deptBudget table <========
x98. update appstack theme and aws re-upload
x97. getAll replace with scope
x96. save and save and add line one place move
x95. cancellations
x93. check if ->unique(); is covered in request and fornicated
x92. fk uom to pr_lines option item uom, then uom class
x89. make sure user & hod can raise pr of his own dep rest can do for all
x88. not showing <i class="fa-solid fa-magnifying-glass"></i>
x87. set new password page not formated
x88. varify email link does not work
x89. why PaymentControler is empty
x90. PoControlelr is empty
x91. RecepitControler is not completed 
x93. tenant wise log file
x94. attachment file to budget
x95. error 403
x51.	Force close po/pr 
x68.	PR cancel, PR line cancel
x69.	PO cancel PO line cancel
x36.	issue with page 404 http://geda.localhost:8000/table
x67.	Query tenant database and dashboard
x85. change avatar and log form prive to publci folder
x64.	url('/prs/'.$this->pr->id)) 
x1.	tooltip
xx3.	search @enderror
xx4.	create two user while creating new tenant system and support
xx5.	exclude system and support form tenant user list
xx6.	country seeder
xx9.	master message form OEM
x11.	sign-in event activity log
x14.	Route::get('/dept(?s)/export',[DeptController::class, 'export'])->name('depts.export'); 
x16.	custom 403
xx18.	Laravel: Two Ways to Seed Data with Relationships
xx19.	item & supplier upload bulk upload interface
x20.	reset wf for pr by admin
x21.	delete PR
x25.	send all notification in que
x29.	impersonate in laravel
xx31.	use App\Helpers\CheckAccess; to AccesssAccess::hasAccess
xx32.	add before function in policy for system
x38.	highlight selected menu items
x41.	active menu blue mark
x45.	check po/pr budget
x37.	first login ensure currency and country is setup
x34.	update event log user $request->name) instead of dept->name.
x35.	move hierarchy migration before dept and add <=
x47.	purge read notification
x50.	Open next budget year, instead of seeded budget
x62.	search and replace static::ENTITY
x63.	end entity/ENTITY and use enum
x66.	T&C in PR & PO (P2)
x71.	notice display
x75.	add/edit designatsion_id in user table and then hierarchy Line show
x80.	dell org, orgType, banckAcount
x81.	delete attachments
x13.	search length validation to min 3 char
x15.	<link rel="canonical" href="https://appstack.bootlab.io/pages-sign-in.html" />
x60.	ChartJS
xx59.	Add submission_date column in pr/po
xx61.	<span class="text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="This is sample Text!"><i class="align-middle" data-feather="info"></i></span> my-number.blade.php
x54.	Add grs/payment to budget line 
x55.	Pr/po submission date -> budget booking+ confirm 
x56.	Grs->sum->budget_line 
x57.	Payment ->sum-> budget_line  
xx84. fix user action notification url
xx74.	notify system notification
x2.	dashboard count user role
x43.	active menu, count/sum budget/notification
x133. asset('flow/po.jpg') to aws
x111. <nav aria-label="breadcrumb">
x127. allow delete draft PR and PO only
x126. tos and privacy policy need to copied form landlord
x120. PO T&C and in report
x117. show line number properly in pr & PO
x124. {!! nl2br($ticket->content) !!}
x125. 'can:access-back-office' tenant.php rearrange for back office
x123. register user
x114. breadcrumb and navigation 
x121. accounting reports develop and flag updates
x115. CustomError table
x119. not space in item and project code 
x113. report run count
x112. error_code in other table
x104. revise cost 39$
x86  Font Awesome font load form CDN
x160. show attachments, add attachment
x159. attachment id replace with random code
x150. Printed Receipt Report (TBD)
x150. Printed Invoice Report (TBD)
x149. Printed Payment Report (TBD)
