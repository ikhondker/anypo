php artisan make:component Admin/Form/Input


# 14. Jobs 
====================================================================
~~~
php artisan queue:listen

php artisan make:job Landlord/CreateTenant
php artisan make:job Landlord/AddAddon
php artisan make:job Landlord/Billing
php artisan make:job Landlord/CreateInvoice

php artisan make:job Landlord/SubscriptionInvoicePaid
xphp artisan make:job Landlord/GenerateAllSubscriptionInvoice
php artisan make:job Landlord/AccountsArchive
~~~
# 13. View Composer 
====================================================================



# 13. Form top Drop-down Actions 
====================================================================
~~~
php artisan make:component Landlord\Actions\AccountActions
php artisan make:component Landlord\Actions\AccountActionsSupport
php artisan make:component Landlord\Actions\InvoiceActionsSupport
php artisan make:component Landlord\Actions\TicketActions


xxphp artisan make:component Tenant\Actions\Admin\UserActionsIndex
~~~

# 13. Notification 
====================================================================
~~~
php artisan notifications:table

php artisan make:notification Test			HomeController.php
php artisan make:notification UserRegistered		RegisterController.php
php artisan make:notification UserCreated		UserController.php/Provision.php
php artisan make:notification Landlord\FirstTenantUserCreated	Job/CreateTenant.php

php artisan make:notification TicketCreated	TicketController.php
php artisan make:notification TicketAssigned	TicketController.php	
php artisan make:notification TicketUpdated	CommentController.php
php artisan make:notification TicketClosed	CommentController.php

[php artisan make:notification AccountCreated]
php artisan make:notification ServicePurchased	Provision.php
php artisan make:notification AddonPurchased	HomeController.php
php artisan make:notification ServiceUpgraded  	HomeController.php

php artisan make:notification InvoiceCreated	Provision.php
php artisan make:notification InvoicePaid	Provision.php
php artisan make:notification InvoiceDue

php artisan make:notification Contacted
~~~
# 13. Mail 
====================================================================
- ContactUsMail
- _landlord_setup	-> _config

# Cards
====================================================================
php artisan make:component Landlord/Card/Header <x-landlord.card.header title="Your Title Here "/>
php artisan make:component Card/Test
php artisan make:component Card/Header		<x-card.header title="Your Title Here "/>
xxphp artisan make:component Card/HeaderSub	<x-card.header-sub title="Your Title Here "/>
php artisan make:component Card/HeaderSearch	<x-card-header-search object="Template" :export="false"/>
php artisan make:component Card/HeaderCreate	<x-card-header-create object="Template"/>
php artisan make:component Card/HeaderList	<x-card-header-list object="Template"/>

php artisan make:component CardFooterPage	<x-card-footer-page label="templates" links="{{ $templates->links() }}" />
php artisan make:component CardFooterList	<x-card-footer-list object="Template"/>
php artisan make:component CardFooter		<x-card-footer object="Template"/>

# Show
====================================================================
xxphp artisan make:component Show/Id		 <x-show.id id="{{ $training->id }}"/>
php artisan make:component Show/MyId		 <x-show.my-id id="{{ $training->id }}"/>
php artisan make:component Landlord/Show/MyText		<x-show.my-text value="{{ $user->country }}" label="Country"/>
php artisan make:component Landlord/Show/MyTitle
php artisan make:component Landlord/Show/MyContent
php artisan make:component Landlord/Show/MyNumber
php artisan make:component Landlord/Show/MyInteger
php artisan make:component Landlord/Show/MyDate		<x-show.my-date value="{{ $payment->pay_date }}"/>
php artisan make:component Landlord/Show/MyTextArea		<x-show.my-date value="{{ $payment->pay_date }}"/>

php artisan make:component Landlord/Show/MyDateTime	<x-show.my-date-time value="{{$account->created_at }}" label="Created At"/>
php artisan make:component Show/MyUrl		<x-show.my-url value="{{ $user->lnpage }}" label="LinkedIn"/>
php artisan make:component Show/MyBadge		<x-show.my-badge value="{{ $user->role }}" label="Role"/>
php artisan make:component Show/MyEnable	 <x-show.my-enable value="{{ $user->enable }}"/>

php artisan make:component Show/MyCreatedBy	 <x-show.my-created-by  value="{{$attachment->user_created_by->name }}"/>
php artisan make:component Show/MyUpdatedBy	 <x-show.my-created-at  value="{{ $attachment->created_at }}"/>
php artisan make:component Show/MyCreatedAt	 <x-show.my-updated-by  value="{{ $attachment->user_updated_by->name }}"/>
php artisan make:component Show/MyUpdatedAt	<x-show.my-updated-at  value="{{ $attachment->updated_at }}"/>

php artisan make:component Landlord/Show/Avatar
php artisan make:component Landlord/Show/Logo
php artisan make:component Landlord/Show/Save

# List
-------------------------------------
php artisan make:component Landlord/List/MyDateTime	<x-list.my-date-time :value="$activity->created_at"/>

xxphp artisan make:component List/IdLink	<x-list.id-link object="Task" :id="$mytask->id"/>
php artisan make:component List/MyIdLink 	<x-list.my-id-link object="Task" :id="$mytask->id"/>

php artisan make:component List/MyDateTime	<x-list.my-date-time :value="$activity->created_at"/>
php artisan make:component List/MyDate		<x-list.my-date :value="$fdr->start_date"/>
php artisan make:component List/MyNumber	<x-list.my-number :value="$training->seat"/>
php artisan make:component List/MyInteger
php artisan make:component List/MyBadge		incomplete	
php artisan make:component List/MyEnable	<x-list.my-enable :value="$entity->enable"/>
php artisan make:component List/MyStatus	<x-list.my-status :status="$advance->status"/>

# Common
-------------------------------------
php artisan make:component RedStar --view	<x-red-star/>
php artisan make:component Landlord/Alert/AppAlertError
php artisan make:component Landlord/Alert/AppAlertSuccess
php artisan make:component Landlord/Alert/AlertError
php artisan make:component Landlord/Alert/AlertSuccess


php artisan make:component forms.input --view

# Create
-------------------------------------
php artisan make:component Landlord/Create/Name		<x-landlord.create.name :value="$user->name"/>
php artisan make:component Landlord/Create/Email
php artisan make:component Landlord/Create/Cell
php artisan make:component Landlord/Create/Title
php artisan make:component Landlord/Create/Content

php artisan make:component Create/Amount	<x-create.amount/>
php artisan make:component Create/Price		<x-create.price/>
php artisan make:component Create/qty		<x-create.qty/>
qty
php artisan make:component Create/DateStart	<x-create.date-start/>	
php artisan make:component Create/DateEnd	<x-create.date-end/>	
php artisan make:component Create/Notes		<x-create.notes/>

php artisan make:component Landlord/Create/Save


# Readonly
-------------------------------------
php artisan make:component Landlord/Edit/IdReadOnly	<x-edit.id-read-only :value="$warehouse->id"/>


# Edit
-------------------------------------
php artisan make:component Landlord/Edit/Name		<x-landlord.edit.name :value="$user->name"/>
php artisan make:component Landlord/Edit/Email
php artisan make:component Landlord/Edit/Cell
php artisan make:component Landlord/Edit/Address1
php artisan make:component Landlord/Edit/Address2
php artisan make:component Landlord/Edit/CityStateZip
//php artisan make:component Landlord/Edit/City
//php artisan make:component Landlord/Edit/State
//php artisan make:component Landlord/Edit/Zip
php artisan make:component Landlord/Edit/Website
php artisan make:component Landlord/Edit/Facebook
php artisan make:component Landlord/Edit/Linkedin
xxphp artisan make:component Landlord/Edit/Notes
php artisan make:component Landlord/Edit/Title
php artisan make:component Landlord/Edit/Tagline
php artisan make:component Landlord/Edit/Content

php artisan make:component Landlord/Edit/Save

php artisan make:component Landlord/Edit/Notes		<x-landlord.edit.notes

# Edit/Table based
-------------------------------------
php artisan make:component Landlord/Edit/Country		<x-edit.country :value="$warehouse->country"/>
php artisan make:component Landlord/Edit/Dept
php artisan make:component Landlord/Edit/Priority
php artisan make:component Landlord/Edit/Agent

# Attachments
-------------------------------------
php artisan make:component Landlord\Attachment\image	<x-attachment.create />
php artisan make:component Attachment\Create	<x-attachment.create />

php artisan make:component Attachment\ShowById
php artisan make:component Attachment\Show	<x-attachment.show  entity="{{ $entity }}" aid="{{ $advance->id }}"/>	

php artisan make:component Attachment\ListOne	<x-attachment.list-one  entity="{{ $entity }}" aid="{{ $library->id }}"/>
php artisan make:component Attachment\ListAll	<x-attachment.list-all entity="{{ $entity }}" aid="{{ $pr->id }}"/>
php artisan make:component Attachment\Raw	<x-attachment.raw id="{{ $attachment->id }}"/>
php artisan make:component Attachment\EmpDocs	<x-attachment.emp-docs emp_id="{{ $attachment->id }}"/>

# Icons
-------------------------------------
php artisan make:component Landlord/Icons/DuoAbs029 --view
php artisan make:component Landlord/Icons/DuoAbs027 --view <x-landlord.icons.duo-abs027/>
php artisan make:component Landlord/Icons/DuoCom006 --view
php artisan make:component Landlord/Icons/DuoCom013 --view
php artisan make:component Landlord/Icons/DuoGen012 --view

# Modal
-------------------------------------
php artisan make:component Modal/Upgrade	<x-modal.upgrade/>

# Widget
-------------------------------------
php artisan make:component Landlord/Widgets/TicketHeader
php artisan make:component Landlord/Widgets/TicketComments
php artisan make:component Landlord/Widgets/TicketTopics
php artisan make:component Landlord/Widgets/TicketLists
php artisan make:component Landlord/Widgets/Kpi		<x-landlord.widget.kpi/>
php artisan make:component Landlord/Widgets/AddAddon
php artisan make:component Landlord/Widgets/ExpireWarning
php artisan make:component Landlord/Widgets/AccountServices

card-numbers
Scarborough ON M1G1R9, Canada

# Forms
-------------------------------------
php artisan make:component Landlord/Forms/Contact



# Others
-------------------------------------
php artisan make:component Landlord/TableLinks
php artisan make:component Landlord/NavBar --view
<x-table-links/>

# profile
php artisan make:component Landlord/Widgets/User/UserProfile
php artisan make:component Landlord/Widgets/User/UserDetail


# Button
-------------------------------------
//php artisan make:component Landlord/Buttons/Show/Edit		<x-landlord.buttons.show.edit object="User" :id="$user->id"/>
xxphp artisan make:component Landlord/Buttons/Show/Save		<x-landlord.buttons.show.save/>
