[25-NOV-2023] : Landlord Specific development Related Notes

bo01 28-JAN-23
bo02 27-FEB-23
bo04 19-MAR-23
bo05

# Markdown Reference
====================================================================
https://code.visualstudio.com/docs/languages/markdown
https://www.freecodecamp.org/news/how-to-use-markdown-in-vscode/

# 4. Diagram
====================================================================
D:\My Works\lv-anypo-local\landlord\docs\flow.vsdx

# 14. Ref Objects & Files
====================================================================
- User->Ticket
- BO-objects-lists-20240414.xlsx   C:\Users\pulok\Google Drive\Briefcase\lv-anypo
- laravel-CRUD.txt
- HO-1-objects.txt
- HO-2-components.txt
- HO-3-seeders.txt (boht seed and migration)
- Ref: laravel-project-post-create.txt
- Tenant model only Not inside landlord directory
- custom mail template is in fs06

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


# 6. Task Scheduling Billing
====================================================================
...php
$schedule->job(new Billing)->everyFiveMinutes();
php artisan queue:listen --timeout=1200
...

Running the Scheduler
The schedule:run Artisan command will evaluate all of your scheduled tasks and determine if they need to run based on the server's current time.
...
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
...

- don't need to create command !!
...php
php artisan make:command BillingCron --command=billing:cron
edit app/Console/Commands/DemoCron.php
...

...
app/Console/Kernel.php
	$schedule->command('billing:cron')
		->everyMinute();
		->daily();
		->everyFiveMinutes();
		->dailyAt('13:00');	Run the task every day at 13:00

$schedule->command('billing:cron')->everyFiveMinutes();
.. 

Step 4: Run Scheduler Command For Test
php artisan schedule:run

...php
php artisan
 billing
 billing:cron	Command description

php artisan schedule:list
...


# 4. Authentication
====================================================================
-- post login redirect to dashboard
...
LoginController.php
	protected $redirectTo = RouteServiceProvider::HOME;
RouteServiceProvider.php
	public const HOME = '/home';
	public const HOME = '/dashboards';
...


# 3. Package
====================================================================
- install and configure intervention pkg
- https://github.com/Intervention/image
	...
	composer require intervention/image
	Config\app.php	=>
	'aliases' => Facade::defaultAliases()->merge([
				// 'ExampleClass' => App\Example\ExampleClass::class,
	// IQBAL 7-FEB-23
				'Image' => Intervention\Image\Facades\Image::class,
		])->toArray(),
	...

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

# 2. Setup baseline
====================================================================
- pagination ==> laravel-prototype.txt


