User (4 tables)

Ren User.php modle to org-User.php


# Objects/Classes
--------------------------

php artisan make:model User --all
php artisan make:model Landlord\Menu --all
php artisan make:model Landlord\Status --all

php artisan make:model Template --all
php artisan make:model Landlord\Entity --all
php artisan make:model Activity --all
[php artisan make:model Setup --all]
php artisan make:model Landlord\Manage\Config --all
php artisan make:model Landlord\Manage\ErrorLog --all

php artisan make:model Attachment --all
php artisan make:model Contact --all
php artisan make:model Landlord\Category --all
php artisan make:model Landlord\Country --all

php artisan make:model Landlord\MailList --all

xxphp artisan make:model Country 	--migration	php artisan make:seeder CountrySeeder

php artisan make:model Dept 	--migration	php artisan make:seeder DeptSeeder
php artisan make:model Priority --migration	php artisan make:seeder PrioritySeeder
php artisan make:model Rating 	--migration	php artisan make:seeder RatingSeeder
php artisan make:model PaymentMethod --migration	php artisan make:seeder PaymentMethodSeeder

php artisan make:model Landlord\Product --all
php artisan make:model Checkout --all
php artisan make:model Account --all
php artisan make:model Service --all
php artisan make:model Ticket --all
php artisan make:model Comment --all
php artisan make:model Invoice --all
php artisan make:model Payment --all

php artisan make:model Domain --all
php artisan make:model Tenant --all
php artisan make:model Landlord\Report --all

php artisan make:model Landlord\Manage\Cp --all

php artisan make:controller ProvisionController --resource

php artisan make:model Process --all
Dashbaord


?? ?? php artisan make:model Notification --all
php artisan make:model TicketStatus --migration	php artisan make:seeder TicketStatusSeeder
php artisan make:model UserGroup --migration	php artisan make:seeder UserGroupSeeder
php artisan make:model InvoiceGroup --migration	php artisan make:seeder InvoiceGroupSeeder
php artisan make:model AccountService --all
[?? php artisan make:model Hisotry --all]



# Event and listner ---------------------------
PS D:\laravel\bo05> php artisan make:event PodcastProcessed
   INFO  Event [D:\laravel\bo05\app/Events/PodcastProcessed.php] created successfully.  
PS D:\laravel\bo05> php artisan make:listener SendPodcastNotification --event=PodcastProcessed
   INFO  Listener [D:\laravel\bo05\app/Listeners/SendPodcastNotification.php] created successfully.  

# Resue ---------------------------
ChartController.php
HomeController.php
TestController.php

>>[REUSE] php artisan make:policy UserPolicy --model=User
	  php artisan make:model User --all

>>[REUSE] php artisan make:model Table --all
          php artisan make:controller TableController --resource

>>[REUSE] php artisan make:model Dashboard --all
>>[REUSE] php artisan make:model Template --all
>>[REUSE] php artisan make:model Activity --all
>>[REUSE] php artisan make:model Setup --all
>>[REUSE] php artisan make:model Entity --all		protected $primaryKey = 'module';
>>[REUSE] php artisan make:model Country --all
>>[REUSE] php artisan make:model Attachment --all

>>[REUSE] php artisan make:model Dept --all
	CategoryController.php
	DeptController.php
	*ImageController.php
	=>ItemController.php
	NotificationController.php
	PaymentController.php

# notification------------------------------
BO-development-log-20230401.txt


# mail------------------------------
php artisan make:mail DemoMail
xx php artisan make:mail WelcomeMail	app/Http/Controllers/Auth/RegisterController.php
php artisan make:mail ContactUsMail

