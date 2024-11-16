php artisan queue:listen
email_verified_at

 ($user->email_verified_at == '') ? false : true;

# IQBAL
~~~
use Faker\Generator;

php artisan migrate:rollback
php artisan migrate
-- all seeder
php artisan db:seed			<=== Full
[php artisan db:seed --class="Database\Seeders\Landlord\LandlordSeeder"]

php artisan migrate:rollback
php artisan migrate:reset
php artisan migrate:refresh
php artisan migrate:fresh

php artisan db:seed --class="UserSeeder"
~~~

# Landlord Individual Seeder 
-------------------
~~~
[ 
php artisan db:seed --class="Database\Seeders\Landlord\UserSeeder"
php artisan db:seed --class="Database\Seeders\Landlord\MenuSeeder"
php artisan db:seed --class="Database\Seeders\Landlord\StatusSeeder"
php artisan db:seed --class="Database\Seeders\Landlord\TemplateSeeder"
php artisan db:seed --class="Database\Seeders\Landlord\EntitySeeder"
#Activity 
xxphp artisan db:seed --class="Database\Seeders\Landlord\SetupSeeder"
php artisan db:seed --class="Database\Seeders\Landlord\ConfigSeeder"
#Attachment 
php artisan db:seed --class="Database\Seeders\Landlord\ContactSeeder"
php artisan db:seed --class="Database\Seeders\Landlord\TopicSeeder"
php artisan db:seed --class="Database\Seeders\Landlord\CategorySeeder"
php artisan db:seed --class="Database\Seeders\Landlord\CountrySeeder"
php artisan db:seed --class="Database\Seeders\Landlord\DeptSeeder"
php artisan db:seed --class="Database\Seeders\Landlord\PrioritySeeder"
php artisan db:seed --class="Database\Seeders\Landlord\RatingSeeder"
php artisan db:seed --class="Database\Seeders\Landlord\PaymentMethodSeeder"
php artisan db:seed --class="Database\Seeders\Landlord\ReplyTemplateSeeder"

php artisan db:seed --class="Database\Seeders\Landlord\ProductSeeder"
#checkout
php artisan db:seed --class="Database\Seeders\Landlord\AccountSeeder"
xxphp artisan db:seed --class="Database\Seeders\Landlord\ServiceSeeder"
php artisan db:seed --class="Database\Seeders\Landlord\TicketSeeder"
php artisan db:seed --class="Database\Seeders\Landlord\CommentSeeder"
php artisan db:seed --class="Database\Seeders\Landlord\InvoiceSeeder"
php artisan db:seed --class="Database\Seeders\Landlord\PaymentSeeder"
]
~~~

# Dahsbaord

# Notification



