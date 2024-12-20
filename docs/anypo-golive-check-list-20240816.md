Go-live check and prerequisite list

# 4. Testing
====================================================================
$composer dump autoload
$php artisan route:list


# 3. Laravel
====================================================================
1. remove unused package like telescope/debugger/n+1 etc
2. upgrade all pack using composer
3. check all env user env('APP_DOMAIN'); case sensitive
4. build and upload landlord asset in aws css/js/img
5. build and upload tenant asset in aws css/js/img
6.

# 2. Landlord
====================================================================
1. landlord user default password

# 1. Tenant
====================================================================
1. tenant user default password
3. tenant budget seeded. Stop dummy data load
4. tenant seeded item check
5. item code upload
6. check non existent subdomain error like abc1.anypo.net

