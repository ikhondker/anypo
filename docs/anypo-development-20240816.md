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
2. layout chang for edit user page role change

# 12. Function Sequence in Controller 
====================================================================
1. index
2. create
3. store
4. show
5. edit
6. update
6. destroy


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

# 10. TODO 
====================================================================
1. //TODO php artisan route:cache error
1. https://www.youtube.com/watch?app=desktop&v=rtiK6iblU1I
1. rename NotificationComposer.php to TenantNotificationComposer.php
1.  same table structure setup, menu, attachment, event log etc
2.  fix file merge issue sp user model
3.  move price/checkout/online invoice in HomeCOntroller as no auth() needed
4.  use @forelse ($products as $product) everywhere
5.  all model withDefault[Empty]
6.  load balance one small vm witg apapche+2app+1 db server
7.  P2 quick code snipe generator like breadcrumb, edit, add etc
8.  merge sweet alert landlord and tenant
9.  check TODO clean
10. vite using dynamic import() to code-split the application
12. flyer for anypo.net
13. Facebook boost post design
14. FAQ landlord 
15. FAQ tenant
16. good product g2, captive listing
17. chatbot
18. screenshots for site and FAQ
20. request for demo landlord
23. check max length  for float and text(255)
24. {{ $dbus->firstItem() + $loop->index}}
25. remove use App\Enum\UserRoleEnum; as in alias
26. use bo and tenant Chanel instead of log
27. http://localhost:8000/email/verify/1 access denied
28. Route::get('users-password/{user}', [UserController::class, 'userPassword'])->name('users.password');
29. my-password-change menu entry
30. delete tenant helper
31. cell placeholder="+x(xxx)xxx-xx-xx"
32. install laravel sentry for error monitoring
33. laravel pulse
35. enable verify middleware for all route
36. throw new NotFoundHttpException();
37. index() and cache() in migration and model
38. unique in name for all lookup


# 9. TODO P2 
====================================================================
1. recon country vs currency vs flag
2. Edit CORS Configuration aws
3. terms and conditon for tena registraion
4. inital item code uplaod
5. tenant login page show comapny logo

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
- custom error reporting in laravel.log warnign and error 
- app/exceptions/Handler
- write to: \App\Models\Landlord\Manage\ErrorLog();


# 6. Learning 
====================================================================
1. for non id PK, define PK in model
2. when column name and relation name equal error. Must be separated
3. Pr status and auth_status issue. Eager loading warning. ok. Dont cast these two column in model. with() failse
4. while passing data to component, variable name with _ create issues dept_budge_id did not work bu dbid word
4. check all env used env('APP_DOMAIN'); case sensitive
5. in production env, un-handled exception write full log in laravel.log
6. to debug 404 error use the regiter method of app/Exacptins/Handler

# 5. Set Environment 
====================================================================
~~~
.env    =>  APP_DOMAIN=anypo.net    # Custom
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

# 1. Setup->config 
====================================================================
- $_landlord_setup -> _config

# 0. Done 
====================================================================
- [x] 21. tenant setup name
- [x] 22. supplier wise spent chart
- [x] 19. jquery for tenants
