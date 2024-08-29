[25-NOV-2023] : Instance Specific Source File Modification

Ref: laravel-tenancy.txt

# 1. TODO 
====================================================================
1.


# 2. SEEDED FILE CHANGE 
====================================================================
1. for jquery
- resources/js/app.js
- vite.config.js
- Ref: laravel-jquery.txt

2. app/Providers/AppServiceProvider.php

~~~
// IQBAL 28-AUG-23
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;
use App\Models\User;
~~~
~~~   
Paginator::useBootstrapFive(); 
& https not needed
Gate::define('access-back-office',)
~~~

3. app/Providers/AuthServiceProvider.php  -> add policies and in controller $this->authorize('update', $post);
    - 'App\Models\Landlord\User' => 'App\Policies\Landlord\UserPolicy',
4.  app/Http/Middleware/VerifyCsrfToken
~~~
  protected $except = [
        '/success',
        '/cancel',
        '/fail',
        '/ipn',
        '/pay-via-ajax', // only required to run example codes. Please see bellow.
    ];
~~~
- ssl commerz

5. app/Exceptions/Handler.php
- write unhandled exception in landlord ErrorLog table

6. LoginController.php => override

7. RegisterController.php => override

8. ResetPasswordController.php => override

9. ConfirmPasswordController.php => override

10. ForgotPasswordController.php => override

11. app/Providers/ViewServiceProvider.php
- https://laracasts.com/discuss/channels/laravel/view-composer-data-not-available-when-assigned-to-layout


12. app/Providers/RouteServiceProvider.php
- public const HOME = '/dashboards';
- ==>	laravel-tenancy.txt


13. app/Exceptions\Handler.php
    register on-demand


## NOT Used
~~~
protected function mapManageRoutes()
{
	Route::prefix('manage')
		->middleware('web')
		//->middleware('web', 'can:admin')
		//->namespace($this->namespace.'\Admin')
		->namespace($this->namespace)
		//->name('admin.')
		->group(base_path('routes/manage.php'));
}
~~~

13. config\logging.php, app.php, env.php, sslcommerz.php, bo.php,mail.php
- config\app.php
- APP_ENV = for instances

~~~
# IQBAL
'domain' => env('APP_DOMAIN', 'localhost'),

 'providers' => ServiceProvider::defaultProviders()->merge([
        /*
	App\Providers\TenancyServiceProvider::class,    // IQBAL
        Intervention\Image\ImageServiceProvider::class, // IQBAL
        Barryvdh\DomPDF\ServiceProvider::class,         // IQBAL
        App\Providers\ViewServiceProvider::class        // IQBAL
 
'aliases' => Facade::defaultAliases()->merge([
        // 'Example' => App\Facades\Example::class,
	'EntityEnum'	=> App\Enum\EntityEnum::class,
	'UserRoleEnum' => App\Enum\UserRoleEnum::class,
        'Image' => Intervention\Image\Facades\Image::class, //IQBAL
        'PDF' => Barryvdh\DomPDF\Facade::class,             // IQBAL

#faker
	'faker_locale' => 'en_IN',
~~~


13. Env

.env  => env('APP_NAME') 
- APP_NAME=AnyPO
- alos check $setup->name
- #APP_DOMAIN=anypo.net    # Custom
- APP_DOMAIN=localhost    # Custom
- APP_URL=http://localhost:8000
- #APP_URL=http://localhost
- QUEUE_CONNECTION=database


~~~
# IQBAL
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=948fb28b7f5b14
MAIL_PASSWORD=b519f2b726bc9b
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="i.khondker@hawarit.com"
MAIL_FROM_NAME="${APP_NAME}"
~~~

15. app/Providers/ViewServiceProvider.php

16. config/logging.php
- 'default' => env('LOG_CHANNEL', 'daily'),

### change in productions
- 'level' => env('LOG_LEVEL', 'debug'),

~~~
'bo' => [
            'driver' => 'daily',
            'path' => storage_path('logs/bo.log'),
            'level' => 'info',
        ],
 'tenant' => [
            'driver' => 'daily',
            'path' => storage_path('logs/tenant.log'),
            'level' => 'info',
        ],
~~~

17. config/tenancy.php
~~~
return [
	'tenant_model' => \App\Models\Tenant::class,

'features' => [
	Stancl\Tenancy\Features\UniversalRoutes::class,
~~~

18. config/filesystesm.php
	~~~
     's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],
        'invoices' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('PROFILE_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'visibility' => 'public',
            'root' => 'invoices'
        ],
        'avatars' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('PROFILE_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'visibility' => 'public',
            'root' => 'avatars'
        ],
    ~~~

19. app/Http/Kernel.php 
- https://stackoverflow.com/questions/73073575/user-auth-not-working-properly-for-tenant-while-using-stancl-tenancy
~~~
protected $middlewareGroups = [
  	// IQBAL 25-apr-23
        'universal' => [
        
        ],
~~~

20. DatabaseSeeder.php
- add auto run seeded

21. add in web.php
- use Illuminate\Foundation\Auth\EmailVerificationRequest;

