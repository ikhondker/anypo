[25-NOV-2023] : Instance Specific Configuration

email marketing
https://www.brevo.com/pricing/

# 13. Versions 
====================================================================
1. v0.1 Initial version after merging
2. 0.2 After Restructuring the Tenant code and Components
3. 0.3 After Restructuring Landlord
4. 0.4 After integrating AWS CDN , before clean
5. 0.5 After Dashboard, UoM, Reports etc before clean
6. 0.6 After basic GRS and Payment and before starting file comments clean
7. 0.7 After Budget calculation and other development before clean
8. 0.8 After adding Business rule, actions and other development before clean
9. 0.9 After moving attachment to private aws
10. 0.10 After site contents and FAQ and others, Before clean
11. 0.11 Before re-writing PR & PO and before clean 
12. 0.12 After merging jquery, select2, sweetalert2 and chart.js into vite
13. 0.13 pr-po rewrite, breadcrumb, custom Error  and generate advance invoice, before clean
14. 0.14 After accounting and others, before clean
15. 0.15 landlord.setup->config, landlord attachment and landlord testing, tenant action, route rearrange etc 
16. 0.16 PR and PO view rewrite, notes, actions, info etc, before clean, before tenant testing start
17. 0.17 move back project to lookup, po by supplier, po by project, separate profile, sw2 move to custom.js, Aeh, Ael ErrorLog, before discarding front theme
18. 0.18 discard front use single appstack theme, CustomException, dsicss all routes, split helper into landlord and tenant
19. 0.19 Major Update. Removed Front4.3.1 theme from Landlord. Tenant Theme AppsStack upgraded from 3.4.1 to 4.0.0. Template object moved to share. Added Budget Revision history, Before clean.
20. 0.20 cleaned, attachment description, move attachment to root, rewrite pr and po , add invoiceLines, component argument rename form id, InvoiceLines, direct creation invoice/pol/receipt, report id to code, new reports
21. 0.21 float(15,2) to decimal(19,4) , user_id and attachment_id form integer to uuid, upload attachments in attachment page , tenant db name to uid, pdf Ticket, npm recompile, sweetalert2 customization, landlord logo, reorganized Landlord menus, add SYSADMIN Role, 
22. 0.22 Landlord MenuSeeder, Ticket Create by Support for User, Tenant Create by System, Add-on add billing, comments, add Trait CreatedUpdatedBy Trait for create and update By, pr+po+inv jquery calculate, notification correction
23. 0.23 stop duplicate emp in hierarchy , due/pending is wfl getNextApproverId to setNextApproverDue, AllNotification, Enum Rearrange, timezone column, wfl start and end date, inv/payment and grs create jquery population, budget and deptBudget tax, gst, dbu amount add and budget created by , budget and deptBudget revisions, decimal back to 2, close po and invoice automatically, landlord invoice pwop and discount, account lifetime discount field
24. 0.24 Rearrange invoice & payment into single AkkControler, Reject PR/PO,  ticket first_response_at , last_response_at,  report level pdf security. ticket topics, and pivot
24. 0.25 [ongoing] demo request etc, bug request, ticket Topics


# 12. Key Configuration 
====================================================================
## landlord Helper\Landlord\FileUpload.php
- max file size 5MB	where?
- LandlordFileUpload->aws->'file_to_upload'	=> 'required|file|mimes:zip,rar,doc,docx,xls,xlsx,pdf,jpg|max:512'
- UpdateSetupRequest.php 	-> logo
- UpdateUserRequest.php 	-> avatar

## Tenant Helper\Tenant\FileUpload.php
- max file size 5MB
- FileUpload->aws->'file_to_upload'	=> 'required|file|mimes:zip,rar,doc,docx,xls,xlsx,pdf,jpg|max:512'
- UpdateSetupRequest.php 	-> logo
- UpdateUserRequest.php 	-> avatar


# 11. Performance 
====================================================================
~~~
apachebench
$ ab -n 100 -c 10 https://anypo.net/
$ ab -n 100 -c 10 https://demo1.anypo.net/
~~~
- https://gtmetrix.com/
- https://tools.pingdom.com/ Performance grade: C72
- https://www.webpagetest.org/

# 10. Setup 
====================================================================
1. php artisan storage:link
2. copy confg/bo
4. config: app and 
5. notification logo https://anypo.net/logo.png
6. copy font D:\laravel\anypo\storage\fonts
7. app name sow be in
8. app_name, landlord setup table and where in tenant?

# 9. Deployment Architecture 
====================================================================
0. CI/CD https://docs.gitlab.com/ee/ci/examples/laravel_with_gitlab_and_envoy/
1. do 4gb+2cpu+80Gb storage
	- CDN: aws
	- Private Files: local
2. all CSS & js is is from s3->cloudfront CDN 
3. all avatar and logo is from s3->cloudfront CDN  -> anypo=public bucket
4. all attachment form aws storage, because in future might need multiple middle tier server

~~~
; Default timeout for socket based streams (seconds)
; https://php.net/default-socket-timeout
; default_socket_timeout = 60
; Iqbal
default_socket_timeout = 360
php artisan queue:listen --timeout=1200
~~~

# 9. Post Deployment Steps
====================================================================
1. set bo.SUPPORT_MGR_ID
2. logo in landlord reports
3. enable this extension in php.ini by uncommenting this line: extension=ext/php_intl.dll
4. review App\Exceptions\Handler
5. config('akk.LANDLORD_CONFIG_ID'
6. 6. comment demo data seeder insert 

# 8. Logos Used
====================================================================
## Landlord
  logo.png (300x300) and logot.png (200x200) , 
  logo-white.svg (landlord apps) logo-whitet.svg  (Landlord Pages)

  	D:\laravel\anypo\public\assets\logo - general user including logo in pdf 

## Tenant
	logo.png and logot.png
	avatar.png


# 7. Full refresh 
====================================================================
1. delete db  tenantdemo1
2. cmd>php artisan migrate:fresh
3. php artisan db:seed

# 6. Virtual Phone Numbers for Small Businesses 
====================================================================
- https://www.wpbeginner.com/showcase/best-virtual-business-phone-number-apps-free-options/
- https://fitsmallbusiness.com/best-virtual-phone-number-provider/
- https://grasshopper.com/virtual-phone-number/
- https://callhippo.com/blog/virtual-numbers/free-virtual-phone-number-providers


# 5. Tables with Same name in both 
====================================================================
* Move to manage sub folder ween NO route level access is needed by fronted. Only model level access

			Landlord				Tenant
			'can:access-back-office'	?? TODO
1. users	admin				admin
2. setup	manage				admin	?
3. activity	admin				admin
4. attachments	admin				admin	
5. menu		manage				manage
6. Entity	manage				manage
7. country	lookup				lookup
8. dept		lookup				lookup		[no landlord controller]
9. invoice	admin				\
10. config	manage				N/A

# 4. Steps to move a Class 
====================================================================
1. Landlord Attachment 	manage -> admin
2. Controller
3. request
4. model
5. policy
6. views
7. AuthServiceProvider.php
8. web.php
9. use App\Models\Landlord\Manage\Attachment;	=> replace

# 3. Git 
====================================================================
~~~
git add app/*
git add database/*
git add resources/*
git add routes/*
git add docs/*
git add public/assets/css/landlord.css
git add public/tenancy/assets/css/tenant.css
~~~

## Manually upload
1. all config
2. .env
3. landlord custom css
3. tenant custom css

# 2. BO Migration 
====================================================================
1. configure tenancy
2. app
3. middlewere manual
4. config

# 1. Known Issue 
====================================================================
~~~
SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'created_by' cannot be null (Connection: mysql, SQL: insert into `countries` (`name`, `country`, `created_by`, `updated_by`, `updated_at`, `created_at`) values (Afghanistan, AF, ?, ?, 2023-11-27 15:02:28, 2023-11-27 15:02:28))
$table->biginteger('created_by')->nullable()->default(1001);
~~~

# 0. Unsorted
====================================================================
1. FAQ and TOS <div class="bg-img-start" style="background-image: url(./assets/svg/components/card-11.svg);">

