User (4 tables)

Rename User.php model to org-User.php
php artisan make:model User --all

master: [PO-objects-lists-20230419.xlsx]


# Objects/Classes
php artisan make:model Notification --all
php artisan make:controller DashboardController --resource

php artisan make:model Template --all
php artisan make:model Activity --all
php artisan make:model Setup --all
php artisan make:model Entity --all
php artisan make:model Attachment --all
php artisan make:model Menu --all
php artisan make:model Tenant\Status --all
php artisan make:model Tenant\Manage\CustomError --all

php artisan make:model Country 	--all
php artisan make:model Currency	--all
php artisan make:model Dept --all
php artisan make:model Designation --all
php artisan make:model Group --all
php artisan make:model Category --all
php artisan make:model Supplier --all  <<<<<<<<<<<<<<
php artisan make:model Warehouse --all
php artisan make:model BankAccount --all


php artisan make:model Uom --all
php artisan make:model Oem --all
php artisan make:model OrgType --all	<< dont use
php artisan make:model Project --all
php artisan make:model Budget --all

php artisan make:model GlType -mcr  <==================
php artisan make:seeder GlTypeSeeder

php artisan make:model Organization --all	<< dont use
php artisan make:model Item --all
php artisan make:model Hierarchy --all
php artisan make:model Hierarchyl --all
eephp artisan make:model Wf --all
php artisan make:model Wfl --all

php artisan make:model Report --all
php artisan make:model DeptBudget --all
php artisan make:model Tenant\Dbu --all		<< DeptBudgetUsages

php artisan make:model Pr --all
php artisan make:model Prl --all

php artisan make:model Po --all
php artisan make:model Pol --all

php artisan make:model Receipt --all

xxphp artisan make:model PayMethod --all	<< don't used


php artisan make:model Tenant\Invoice --all
php artisan make:model Tenant\InvoiceLines --all


php artisan make:model Payment --all

php artisan make:model Tenant\Ae\Aeh --all
php artisan make:model Tenant\Ae\Ael --all

php artisan make:model Tenant\Manage\Cp --all

php artisan make:controller FileAccessController --resource
php artisan make:model UploadItem -mcr
php artisan make:policy UploadItemPolicy --model=UploadItem

[php artisan make:model Exchange -mcr]
php artisan make:model Rate -mcr
php artisan make:policy RatePolicy --model=Rate

-- model and migration
php artisan make:model UomClass --migration

Contact
xxphp artisan make:model Doc -mcr
xxphp artisan make:controller ImpersonateController  --resource


- special
php artisan make:model Tenant\Support\Ticket --all

-- end ------------  end ------------
php artisan make:model Priority --migration	php artisan make:seeder PrioritySeeder
php artisan make:model Contact --all
Process
php artisan make:model Country 	--migration	php artisan make:seeder CountrySeeder
php artisan make:model Dept 	--migration	php artisan make:seeder DeptSeeder
php artisan make:model Category --migration	php artisan make:seeder CategorySeeder
php artisan make:model Priority --migration	php artisan make:seeder PrioritySeeder

php artisan make:model Invoice --all
php artisan make:model Payment --all

php artisan make:model Rating 	--migration	php artisan make:seeder RatingSeeder
php artisan make:model TicketStatus --migration	php artisan make:seeder TicketStatusSeeder
php artisan make:model PaymentMethod --migration	php artisan make:seeder PaymentMethodSeeder
php artisan make:model UserGroup --migration	php artisan make:seeder UserGroupSeeder
php artisan make:model InvoiceGroup --migration	php artisan make:seeder InvoiceGroupSeeder

php artisan make:model Ticket --all
php artisan make:model Comment --all


[?? php artisan make:model Hisotry --all]

# Resue 
---------------------------
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

# notification
------------------------------
BO-development-log-20230401.txt


# mail
------------------------------
php artisan make:mail DemoMail
xx php artisan make:mail WelcomeMail	app/Http/Controllers/Auth/RegisterController.php
php artisan make:mail ContactUsMail

