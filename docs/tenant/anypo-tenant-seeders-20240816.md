neo4j/pgadmin/qgis/FMEdata Inspector/FME Workbench/ 

// IQBAL
use Faker\Generator;

# tenant 
---------------
>> refresh
php artisan tenants:migrate-fresh --tenants=demo1

>> seed ALL tenant table
php artisan tenants:seed --class=TenantSeeder --tenants=demo1

php artisan tenants:rollback --tenants=demo1
php artisan tenants:migrate --tenants=demo1
php artisan queue:listen

php artisan tenants:seed --tenants=demo1
php artisan tenants:seed --class=UserSeeder --tenants=demo1
php artisan tenants:seed --class=MenuSeeder --tenants=demo1

# landlord 
---------------
delete from payments;
delete from invoices;
delete from account_services;
delete from accounts;
delete from checkouts;
delete from comments;
delete from tickets;
delete from attachments;

# Follow this => tenant seeder
-------------------
Database\Seeders\Landlord\
php artisan tenants:seed --class="Database\Seeders\Share\TemplateSeeder" --tenants=demo1


php artisan tenants:seed --class=HawarSeeder --tenants=demo1

php artisan tenants:seed --class=UserSeeder --tenants=demo1
php artisan tenants:seed --class=SetupSeeder --tenants=demo1


php artisan tenants:seed --class=EntitySeeder --tenants=demo1
php artisan tenants:seed --class=StatusSeeder --tenants=demo1
php artisan tenants:seed --class=CustomErrorSeeder --tenants=demo1
php artisan tenants:seed --class=MenuSeeder --tenants=demo1

php artisan tenants:seed --class=CategorySeeder --tenants=demo1
php artisan tenants:seed --class=CountrySeeder --tenants=demo1
php artisan tenants:seed --class=CurrencySeeder --tenants=demo1

php artisan tenants:seed --class=HierarchySeeder --tenants=demo1
php artisan tenants:seed --class=HierarchylSeeder --tenants=demo1

php artisan tenants:seed --class=DeptSeeder --tenants=demo1
php artisan tenants:seed --class=DesignationSeeder --tenants=demo1

php artisan tenants:seed --class=GlTypeSeeder --tenants=demo1
php artisan tenants:seed --class=GroupSeeder --tenants=demo1

php artisan tenants:seed --class=OemSeeder --tenants=demo1
php artisan tenants:seed --class=PayMethodSeeder --tenants=demo1
php artisan tenants:seed --class=ProjectSeeder --tenants=demo1
php artisan tenants:seed --class=SupplierSeeder --tenants=demo1

php artisan tenants:seed --class=UomClassSeeder --tenants=demo1
php artisan tenants:seed --class=UomSeeder --tenants=demo1

php artisan tenants:seed --class=WarehouseSeeder --tenants=demo1
php artisan tenants:seed --class=BankAccountSeeder --tenants=demo1
php artisan tenants:seed --class=ItemSeeder --tenants=demo1

php artisan tenants:seed --class=BudgetSeeder --tenants=demo1
php artisan tenants:seed --class=DeptBudgetSeeder --tenants=demo1 !! rivison issue

php artisan tenants:seed --class=PrSeeder --tenants=demo1
php artisan tenants:seed --class=PrlSeeder --tenants=demo1

php artisan tenants:seed --class=PoSeeder --tenants=demo1
php artisan tenants:seed --class=PolSeeder --tenants=demo1

php artisan tenants:seed --class=ReceiptSeeder --tenants=demo1
php artisan tenants:seed --class=PrlSeeder --tenants=demo1

php artisan tenants:seed --class=PoSeeder --tenants=demo1
php artisan tenants:seed --class=PolSeeder --tenants=demo1

php artisan tenants:seed --class=ReportSeeder --tenants=demo1

php artisan tenants:seed --class=MenuSeeder --tenants=demo1
Notification
activity
[php artisan tenants:seed --class=OrgTypeSeeder --tenants=geda]
[php artisan tenants:seed --class=OrganizationSeeder --tenants=geda]
Wf
Wfl
Report

Dahsboard
Activity 
Notification
Attachment 
Contact

po/pol
Receipt
Payment

---------- end ------------------------------
php artisan db:seed --class="Database\Seeders\Landlord\PrioritySeeder"
php artisan db:seed --class="Database\Seeders\Landlord\RatingSeeder"
php artisan db:seed --class="Database\Seeders\Landlord\TicketStatusSeeder"
php artisan db:seed --class="Database\Seeders\Landlord\PaymentMethodSeeder"

php artisan db:seed --class="Database\Seeders\Landlord\ServiceSeeder"
php artisan db:seed --class="Database\Seeders\Landlord\AccountSeeder"

php artisan db:seed --class="Database\Seeders\Landlord\TicketSeeder"
php artisan db:seed --class="Database\Seeders\Landlord\CommentSeeder"

php artisan db:seed --class=InvoiceSeeder
php artisan db:seed --class=PaymentSeeder
-----------------------------------


