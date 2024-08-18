
https://laravel-news.com/laravel-n1-query-problems

php artisan make:component Admin/Form/Input


php artisan make:component Tenant/Info/AehInfo
php artisan make:component Tenant/Ael/AelForAeh


# 13. Jobs 
-------------------------------------------------------------------------------------------------
php artisan make:job ImportAllRate
xxphp artisan make:job Tenant\SynBudget
php artisan make:job Tenant\RecordDeptBudgetUsage
php artisan make:job Tenant\ConsolidateBudget

php artisan make:job Tenant\AccountingInvoice
php artisan make:job Tenant\AccountingPayment
php artisan make:job Tenant\AccountingReceipt


[php artisan make:job ImportSingleRate]
todo call API to create ticket

# 13. Rules 
-------------------------------------------------------------------------------------------------
php artisan make:rule Tenant\OverInvoiceRule	invoice.store and invoice.update invoice.post
php artisan make:rule Tenant\OverPaymentRule
php artisan make:rule Tenant\OverReceiptRule
[php artisan make:rule Tenant\GlCode] Future

# 13. Notifications
 -------------------------------------------------------------------------------------------------
php artisan notifications:table
php artisan make:notification Test1 			=>HomeController.php
php artisan make:notification PrActions			=>PrController.php
php artisan make:notification Tenant\PoActions		=>PoController.php
php artisan make:notification Tenant\UserActions	=>PrController.php
php artisan make:notification Tenant\UserRegistered	=>RegisterController.php
php artisan make:notification Tenant\NotifyAdmin
php artisan make:notification Tenant\NotifySupport
php artisan make:notification Tenant\NotifySystem
? UserCreated.php

php artisan make:notification ReportError		=>Everywhere
php artisan make:notification ReportInfo		=>Everywhere


# xxxx
----------
php artisan make:notification PrCreated		=>PrController.php
php artisan make:notification PrNeedApproval	=>PrController.php

php artisan make:notification UserRegistered	RegisterController.php
php artisan make:notification UserCreated	UserController.php/Provision.php

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


# 13. Mail 
-------------------------------------------------------------------------------------------------
ContactUsMail


# 13. Livewire 
-------------------------------------------------------------------------------------------------
php artisan make:livewire Index\\DeptIndex

# 13. Components 
-------------------------------------------------------------------------------------------------
D:\laravel\test\app\View\Components\Landlord\Card		-> Proper case
D:\laravel\test\resources\views\components\landlord\card	->lowercase
lv9->lv10: use and render
public function render()
public function render(): View|Closure|string

=>component not modify to move to tenenact 
	- Alert
	- Icons

# Feather icon for livewire
-------------------------------------
xxphp artisan make:component Icons/BellOff --view	
xxphp artisan make:component Icons/Bell --view	
	
php artisan make:component Icons/Enable 	<x-icons.enable :enable="$dept->enable"/>
php artisan make:component Icons/Edit --view 	<x-icons.edit/>
php artisan make:component Icons/Show --view 	<x-icons.show/>
php artisan make:component Icons/Info --view 	<x-icons.show/>
php artisan make:component Icons/Confirm --view <x-icons.confirm/>

# logo & avatar
-------------------------------------
xxphp artisan make:component Logo <x-logo logo="{{ $setup->logo }}"/>
xxphp artisan make:component Avatar <x-avatar avatar="{{ $user->avatar }}"/>

# Test
-------------------------------------
php artisan make:component Tenant\TestComponent		<x-tenant.common.link-po id="{{ $receipt->pol->po_id }}"/>


# Common
-------------------------------------
php artisan make:component Tenant\Common\LinkPo		<x-tenant.common.link-po id="{{ $receipt->pol->po_id }}"/>
php artisan make:component Tenant\Common\LinkPol
php artisan make:component Tenant\Common\LinkInvoice
php artisan make:component Tenant\Common\LinkReceipt
php artisan make:component Tenant\Common\LinkPayment


php artisan make:component Info --view		<x-tenant.info info="Note: You wont be able to change the currency."/>
[php artisan make:component TableLinks --view] 	<x-tenant.table-links/>
?php artisan make:component RedStar --view	<x-red-star/>
?php artisan make:component PageHeader --view 	<x-page-header/>
?php artisan make:component Alert/Success
?php artisan make:component Alert/Error
php artisan make:component Share\Actions\TableActions --view


# Card
-------------------------------------
php artisan make:component Tenant\Cards\HeaderSearchExportBar  <x-tenant.cards.header-search-export-bar object="Activity"/>
php artisan make:component Tenant\Cards\HeaderSearchBar 		<x-tenant.cards.header-search-bar object="Po"/>

php artisan make:component Cards/HeaderExportButton 	<x-cards.header-export-button route="activities"/> 
?php artisan make:component Cards/Header/Search	<x-cards.header-with-simple-search object="Dept" title="Department" :export="true"/>
?php artisan make:component Cards/Header/WithSearch

# List
-------------------------------------
php artisan make:component Tenant\List\Actions		<x-list.actions object="Activity" :id="$activity->id" :edit="false"/>
php artisan make:component Tenant\List\MyAvatar		<x-list.my-avatar :avatar="$user->avatar"/>
php artisan make:component Tenant\List\MyDateTime	<x-list.my-date-time :value="$activity->created_at"/>
php artisan make:component Tenant\List\MyDate		<x-list.my-date :value="$fdr->start_date"/>
php artisan make:component Tenant\List\MyNumber		<x-list.my-number :value="$training->seat"/>
php artisan make:component Tenant\List\MyInteger
php artisan make:component Tenant\List\MyBadge		incomplete	
php artisan make:component Tenant\List\MyBoolean	<x-tenant-list.my-boolean :value="$entity->enable"/>
php artisan make:component Tenant\List\MyEnable		<x-tenant-list.my-boolean :value="$entity->enable"/>

php artisan make:component List/MyClosed			<x-tenant.list.my-closed :value="$entity->enable"/>
php artisan make:component List/MyAvatar			<x-tenant.list.my-avatar :avatar="$user->avatar"/>
?php artisan make:component List/MyStatus			<x-tenant.list.my-status :status="$advance->status"/>
php artisan make:component Tenant\List\ArticleLink	<x-tenant.list.article-link entity="{{ $wf->entity }}" :id="$wf->article_id"/>
php artisan make:component Tenant\List\ProjectLink

# Show
-------------------------------------
php artisan make:component Show/Logo		<x-show.logo logo="{{ $setup->logo }}"/>
php artisan make:component Show/Avatar		<x-show.avatar />

?php artisan make:component Show/MyId		<x-show.my-id          id="{{ $training->id }}"/>
php artisan make:component Tenant\Show/MyText		<x-show.my-text       value="{{ $user->country }}" label="Country"/>
php artisan make:component Tenant\Show\MyCode
php artisan make:component Tenant\Show\MyTextArea
php artisan make:component Tenant\Show/MyNumber	<x-tenant.show.my-number
php artisan make:component Tenant\Show\MyAmount	<x-tenant.show.my-amount - with currency
php artisan make:component Tenant\Show\MyAmountCurrency	- amount with entered currency

php artisan make:component Tenant\Show\MyCurrency	<x-tenant.show.my-integer
php artisan make:component Tenant\Show/MyInteger	<x-tenant.show.my-integer
php artisan make:component Tenant\Show/MyDate		<x-show.my-date     value="{{ $payment->pay_date }}"/>
?php artisan make:component Tenant\Show/MyDateTime	<x-show.my-date-time       value="{{$account->created_at }}" label="Created At"/>
php artisan make:component Tenant\Show/MyUrl		<x-show.my-url       value="{{ $user->lnpage }}" label="LinkedIn"/>
php artisan make:component Tenant\Show/MyBadge		<x-show.my-badge       value="{{ $user->role }}" label="Role"/>
php artisan make:component Tenant\Show/MyEmail 		<x-show.my-email       value="{{ $user->email }}"/>
php artisan make:component Tenant\Show\MyClosed		<x-show.my-boolean
php artisan make:component Tenant\Show\MyBoolean 	<x-tenant.show.my-boolean value="{{ $user->enable }}" />
php artisan make:component Tenant\Show\MyEnable	 	<x-tenant.show.my-enable value="{{ $user->enable }}" />
php artisan make:component Tenant\Show\MyCreatedAt
php artisan make:component Tenant\Show\MyUpdatedAt
php artisan make:component Tenant\Show\ArticleLink
php artisan make:component Tenant\Show\ProjectLink


# 13. Form top Drop-down Actions 
-------------------------------------------------------------------------------------------------
php artisan make:component Tenant\Actions\Admin\UserActions
php artisan make:component Tenant\Actions\Admin\UserActionsIndex
php artisan make:component Tenant\Actions\Admin\SetupActions

php artisan make:component Tenant\Actions\Workflow\HierarchyActions

php artisan make:component Tenant\Actions\Lookup\SupplierActions
php artisan make:component Tenant\Actions\Lookup\ItemActions
php artisan make:component Tenant\Actions\Lookup\CategoryActions
php artisan make:component Tenant\Actions\Lookup\UomActions
php artisan make:component Tenant\Actions\Lookup\GroupActions
php artisan make:component Tenant\Actions\Lookup\OemActions
php artisan make:component Tenant\Actions\Lookup\DeptActions
php artisan make:component Tenant\Actions\Lookup\DesignationActions
php artisan make:component Tenant\Actions\Lookup\CurrencyActions
php artisan make:component Tenant\Actions\Lookup\CountryActions
php artisan make:component Tenant\Actions\Lookup\WarehouseActions
php artisan make:component Tenant\Actions\Lookup\BankAccountActions
php artisan make:component Tenant\Actions\Lookup\ProjectActions
php artisan make:component Tenant\Actions\Lookup\UploadItemActionsIndex

php artisan make:component Tenant\Actions\Notification\NotificationActions

php artisan make:component Tenant\Actions\Ae\AelActions
php artisan make:component Tenant\Actions\AelActions

php artisan make:component Tenant\Actions\Manage\MenuActions
php artisan make:component Tenant\Actions\Manage\StatusActions
php artisan make:component Tenant\Actions\Manage\EntityActions
php artisan make:component Tenant\Actions\Manage\CustomErrorActions

php artisan make:component Tenant\Actions\DashboardActions
php artisan make:component Tenant\Actions\BudgetActions
php artisan make:component Tenant\Actions\DeptBudgetActions
php artisan make:component Tenant\Actions\PrActions		<x-tenant.actions.pr-actions id="{{ $pr->id }}"/>
php artisan make:component Tenant\Actions\PrActionsIndex
php artisan make:component Tenant\Actions\PoActions		<x-tenant.actions.po-actions id="{{ $po->id }}" show="true"/>
php artisan make:component Tenant\Actions\PoActionsIndex
php artisan make:component Tenant\Actions\PolActions
php artisan make:component Tenant\Actions\InvoiceActions
php artisan make:component Tenant\Actions\InvoiceActionsIndex
php artisan make:component Tenant\Actions\PaymentActions
php artisan make:component Tenant\Actions\PaymentActionsIndex
php artisan make:component Tenant\Actions\ReceiptActions
php artisan make:component Tenant\Actions\ReceiptActionsIndex


php artisan make:component Share\Actions\TemplateActions

# Button
-------------------------------------
php artisan make:component Buttons/Header/Create	<x-buttons.header.create object="User"/>
php artisan make:component Buttons/Header/Edit		<x-buttons.header.edit object="User" :id="$user->id"/>
php artisan make:component Buttons/Header/Lists		<x-buttons.header.lists object="Setup"/>
php artisan make:component Buttons/Header/AddLine	<x-buttons.header.add-line object="User" :id="$user->id"/>
php artisan make:component Buttons/Header/Pdf		<x-buttons.header.pdf object="User" :id="$user->id"/>
php artisan make:component Buttons/Header/Password	<x-buttons.header.password object="User" :id="$user->id"/>
php artisan make:component Buttons/Header/Save		<x-buttons.header.save 
php artisan make:component Buttons/Header/Submit	<x-buttons.header.submit/>

php artisan make:component Tenant/Buttons/Show/Edit		<x-tenant.buttons.show.edit object="User" :id="$user->id"/>
php artisan make:component Tenant/Buttons/Show/Save		<x-tenant.buttons.show.save/>

xxphp artisan make:component Buttons/Header/Submit	<x-buttons.header.submit object="User" :id="$user->id"/>
xxphp artisan make:component Button/Create	<x-button.create object="User"/>
xxphp artisan make:component Button/ShowList	<x-button.list object="Setup"/>
xxphp artisan make:component Button/Edit		<x-button.edit object="User" :id="$user->id"/>
xxphp artisan make:component Button/EditInShow	<x-button.edit-in-show object="Setup" :id="$setup->id"/>
xxphp artisan make:component Button/Save	xx<x-button.save/>

# Edit/Readonly
-------------------------------------
xxphp artisan make:component Tenant/Edit/IdHidden	<x-tenant.edit.id-hidden :id="$warehouse->id"/>
php artisan make:component Tenant/Edit/IdReadOnly	<x-tenant.edit.id-read-only :value="$warehouse->id"/>
php artisan make:component Tenant/Edit/Name		<x-edit.name :value="$warehouse->name"/>
php artisan make:component Tenant/Edit/Code		<x-edit.code :value="$status->code"/>
php artisan make:component Tenant/Edit/Summary		<x-edit.name :value="$warehouse->name"/>
php artisan make:component Tenant/Edit/ContactPerson	<x-tenant.edit.contact-person :value="$warehouse->contact_person"/>
php artisan make:component Tenant/Edit/Address1	<x-edit.address1 :value="$warehouse->address1"/>
php artisan make:component Tenant/Edit/Address2	<x-edit.address2 :value="$warehouse->address2"/>
php artisan make:component Tenant/Edit/Address2


php artisan make:component Tenant/Edit/CityStateZip
//php artisan make:component Tenant/Edit/City		<x-edit.city :value="$warehouse->city"/>
//php artisan make:component Tenant/Edit/State		<x-edit.state :value="$warehouse->state"/>
//php artisan make:component Tenant/Edit/Zip		<x-edit.zip :value="$warehouse->zip"/>
php artisan make:component Tenant/Edit/Cell		<x-edit.cell :value="$warehouse->cell"/>
php artisan make:component Tenant/Edit/Email		<x-edit.email/>
php artisan make:component Tenant/Edit/Website
php artisan make:component Tenant/Edit/Facebook
php artisan make:component Tenant/Edit/LinkedIn

php artisan make:component Tenant/Edit/StartDate	<x-tenant.edit.start-date :value="$warehouse->cell"/>
php artisan make:component Tenant/Edit/EndDate
php artisan make:component Tenant/Edit/Amount
php artisan make:component Tenant/Edit/Price
php artisan make:component Tenant/Edit/Notes		<x-tenant.edit.notes
-- table based
php artisan make:component Edit/Country		<x-edit.country :value="$warehouse->country"/>
php artisan make:component Edit/Currency	<x-edit.currency :value="$pr->currency"/>

# Create
-------------------------------------
php artisan make:component Tenant/Create/Code		<x-tenant.create.code/>
php artisan make:component Tenant/Create/Name		<x-tenant.create.name/>
php artisan make:component Tenant/Create/Address1	<x-create.address1/>
php artisan make:component Tenant/Create/Address2	<x-create.address2/>
php artisan make:component Tenant/Create/CityStateZip
//php artisan make:component Tenant/Create/City		<x-create.city/>
//php artisan make:component Tenant/Create/State		<x-create.state/>
//php artisan make:component Tenant/Create/Zip		<x-create.zip/>
php artisan make:component Tenant/Create/Country	<x-create.country/>
php artisan make:component Tenant/Create/Currency	<x-create.currency/>	
php artisan make:component Tenant/Create/Cell		<x-create.cell/>
php artisan make:component Tenant/Create/Email		<x-create.email/>
php artisan make:component Tenant/Create/Website
php artisan make:component Tenant/Create/Facebook
php artisan make:component Tenant/Create/LinkedIn
?php artisan make:component Create/ContactPerson	<x-create.contact-person/>

php artisan make:component Create/StartDate	<x-tenant.create.start-date/>
php artisan make:component Create/EndDate
php artisan make:component Create/Amount	<x-tenant.create.amount/>
php artisan make:component Create/Price		<x-tenant.create.price/>
php artisan make:component Tenant/Create/PriceFc	<x-tenant.create.price-fc/>
php artisan make:component Tenant/Create/Notes		<x-tenant.create.notes/>

# Notifications
-------------------------------------
php artisan make:component Notifications\All		   <x-tenant.notifications.all/>
php artisan make:component Notifications\Unread		    <x-tenant.notifications.unread/>

# Attachments
-------------------------------------
php artisan make:component Tenant\Attachment\Create	<x-tenant.attachment.create />
php artisan make:component Tenant\Attachment\Single	<x-tenant.attachment.single id="{{ $attachment->id }}"/>
php artisan make:component Tenant\Attachment\All	<x-tenant.attachment.all entity="{{ $entity }}" aid="{{ $pr->id }}"/>
php artisan make:component Tenant\Attachment\ListAllByArticle

# Modal
-------------------------------------
?php artisan make:component Modal/Upgrade	<x-modal.upgrade/>

# Info
-------------------------------------
php artisan make:component Tenant/Info/ProjectInfo
php artisan make:component Tenant/Info/PrInfo		<x-tenant.info.pr-info id="{{ $pr->id }}"/>
php artisan make:component Tenant/Info/PoInfo		<x-tenant.info.po-info id="{{ $po->id }}"/>
php artisan make:component Tenant/Info/PolInfo
php artisan make:component Tenant/Info/DeptBudgetInfo
php artisan make:component Tenant/Info/InvoiceInfo
php artisan make:component Tenant/Info/PaymentInfo
php artisan make:component Tenant/Info/ReceiptInfo
php artisan make:component Tenant/Info/SupplierInfo

# Tabl
e-------------------------------------
php artisan make:component Tenant/Table/Folders



--From Landlord-------------------------------------
php artisan make:component Tenant\LandlordNoticeAllTenants	<x-tenant.landlord-notice-all-tenants/>
php artisan make:component Tenant\LandlordNoticeOneTenant	<x-tenant.landlord-notice-one-tenant/>


--Widgets-------------------------------------
rest is in anypo-tenant-pr-po-components-20240323.txt


php artisan make:component Tenant/Widgets/DbuDept
php artisan make:component Tenant/Widgets/DbuProject

php artisan make:component Tenant/Widgets/User/UserProfile
php artisan make:component Tenant/Widgets/User/UserDetail

php artisan make:component Tenant/Ael/AelForPo
php artisan make:component Tenant/Ael/AelForInvoice
php artisan make:component Tenant/Ael/AelForPayment
php artisan make:component Tenant/Ael/AelForReceipt


--Dashboard-------------------------------------
php artisan make:component Tenant/Dashboards/PrCounts		<x-tenant.dashboards.pr-counts/>
php artisan make:component Tenant/Dashboards/PoCounts		<x-tenant.dashboards.pr-counts/>
php artisan make:component Tenant/Dashboards/PoStats		<x-tenant.dashboards.po-stats :id="$po->id"/>
php artisan make:component Tenant/Dashboards/PoCountsBuyer	<x-tenant.dashboards.pr-counts-buyer/>
php artisan make:component Tenant/Dashboards/ProjectCounts	<x-tenant.dashboards.project-counts/>
php artisan make:component Tenant/Dashboards/SupplierCounts	<x-tenant.dashboards.supplier-counts/>
php artisan make:component Tenant/Dashboards/ItemCounts		<x-tenant.dashboards.items-counts/>

php artisan make:component Tenant/Dashboards/BudgetStat
php artisan make:component Tenant/Dashboards/DeptBudgetStat	<x-tenant.dashboards.dept-budget-stat id="{{ auth()->user()->dept_id }}" />
php artisan make:component Tenant/Dashboards/NotificationStat

?php artisan make:component Tenant/Widgets/BudgetStat30

--Chart-------------------------------------
php artisan make:component Tenant/Charts/DeptBudgetPoPie	<x-tenant.charts.dept-budget-po-pie :dbid="$deptBudget->id"/>
php artisan make:component Tenant/Charts/DeptBudgetPrPie	<x-tenant.charts.dept-budget-pr-pie :dbid="$deptBudget->id"/>
php artisan make:component Tenant/Charts/DeptBudgetBar		<x-tenant.charts.dept-budget-bar :dbid="$deptBudget->id"/>

php artisan make:component Tenant/Charts/BudgetPoPie		<x-tenant.charts.budget-po-pie/>
php artisan make:component Tenant/Charts/BudgetByDeptPie	
php artisan make:component Tenant/Charts/BudgetByDeptPoBar

?php artisan make:component Tenant/Charts/BudgetPie		<x-tenant.charts.budget-pie/>
php artisan make:component Tenant/Charts/BudgetByDeptBar	<x-tenant.charts.dept-budget-pie/>

php artisan make:component Tenant/Charts/SpendsByProjectBar
php artisan make:component Tenant/Charts/SpendsByProjectCountBar
php artisan make:component Tenant/Charts/SpendsBySupplierBar
php artisan make:component Tenant/Charts/SpendsBySupplierCountBar

<x-tenant.charts.budget-by-dept-po-bar/>