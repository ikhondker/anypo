<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The model to policy mappings for the application.
	 *
	 * @var array<class-string, class-string>
	 */
	protected $policies = [

		/*
		|-----------------------------------------------------------------------------
		| Common																	 +
		|-----------------------------------------------------------------------------
		*/
		'App\Models\User' 							=> 'App\Policies\UserPolicy',
		'App\Models\Tenant'							=> 'App\Policies\TenantPolicy',
		'App\Models\Domain' 						=> 'App\Policies\DomainPolicy',

		/*
		|-----------------------------------------------------------------------------
		| Share																	 +
		|-----------------------------------------------------------------------------
		*/
		'App\Models\Share\Template'		=> 'App\Policies\Share\TemplatePolicy',

		/*
		|-----------------------------------------------------------------------------
		| Landlord																	 +
		|-----------------------------------------------------------------------------
		*/
		'App\Models\Landlord\Akk'					=> 'App\Policies\Landlord\AkkPolicy',
		'App\Models\Landlord\Account'				=> 'App\Policies\Landlord\AccountPolicy',
		'App\Models\Landlord\Attachment' 			=> 'App\Policies\Landlord\AttachmentPolicy',
		'App\Models\Landlord\Comment' 				=> 'App\Policies\Landlord\CommentPolicy',
		'App\Models\Landlord\Dashboard' 			=> 'App\Policies\Landlord\DashboardPolicy',
		'App\Models\Landlord\Report' 				=> 'App\Policies\Landlord\ReportPolicy',
		'App\Models\Landlord\Ticket' 				=> 'App\Policies\Landlord\TicketPolicy',

		'App\Models\Landlord\Admin\Invoice' 		=> 'App\Policies\Landlord\Admin\InvoicePolicy',
		'App\Models\Landlord\Admin\Payment' 		=> 'App\Policies\Landlord\Admin\PaymentPolicy',
		'App\Models\Landlord\Admin\Service' 		=> 'App\Policies\Landlord\Admin\ServicePolicy',

		'App\Models\Landlord\Lookup\Category' 		=> 'App\Policies\Landlord\Lookup\CategoryPolicy',
		'App\Models\Landlord\Lookup\Country' 		=> 'App\Policies\Landlord\Lookup\CountryPolicy',
		'App\Models\Landlord\Lookup\Product' 		=> 'App\Policies\Landlord\Lookup\ProductPolicy',
		'App\Models\Landlord\Lookup\Topic' 			=> 'App\Policies\Landlord\Lookup\TopicPolicy',
		'App\Models\Landlord\Lookup\ReplyTemplate' 	=> 'App\Policies\Landlord\Lookup\ReplyTemplatePolicy',

		'App\Models\Landlord\Manage\Activity'		=> 'App\Policies\Landlord\Manage\ActivityPolicy',
		'App\Models\Landlord\Manage\Checkout' 		=> 'App\Policies\Landlord\Manage\CheckoutPolicy',
		'App\Models\Landlord\Manage\Contact' 		=> 'App\Policies\Landlord\Manage\ContactPolicy',
		'App\Models\Landlord\Manage\Entity' 		=> 'App\Policies\Landlord\Manage\EntityPolicy',
		'App\Models\Landlord\Manage\ErrorLog' 		=> 'App\Policies\Landlord\Manage\ErrorLogPolicy',
		'App\Models\Landlord\Manage\MailList' 		=> 'App\Policies\Landlord\Manage\MailListPolicy',
		'App\Models\Landlord\Manage\Menu' 			=> 'App\Policies\Landlord\Manage\MenuPolicy',
		'App\Models\Landlord\Manage\Process' 		=> 'App\Policies\Landlord\Manage\ProcessPolicy',
		'App\Models\Landlord\Manage\Config' 		=> 'App\Policies\Landlord\Manage\ConfigPolicy',
		'App\Models\Landlord\Manage\Status' 		=> 'App\Policies\Landlord\Manage\StatusPolicy',
		'App\Models\Landlord\Manage\Table' 			=> 'App\Policies\Landlord\Manage\TablePolicy',
		'App\Models\Landlord\Manage\Cp' 			=> 'App\Policies\Landlord\Manage\CpPolicy',
		'App\Models\Landlord\Manage\TicketTopic' 	=> 'App\Policies\Landlord\Manage\TicketTopicPolicy',

		/*
		|-----------------------------------------------------------------------------
		| Tenant																	 +
		|-----------------------------------------------------------------------------
		*/

		'App\Models\Tenant\Admin\Activity' 		=> 'App\Policies\Tenant\Admin\ActivityPolicy',

		'App\Models\Tenant\Admin\Setup' 		=> 'App\Policies\Tenant\Admin\SetupPolicy',

		'App\Models\Tenant\Lookup\Category'		=> 'App\Policies\Tenant\Lookup\CategoryPolicy',
		'App\Models\Tenant\Lookup\ItemCategory'	=> 'App\Policies\Tenant\Lookup\ItemCategoryPolicy',
		'App\Models\Tenant\Lookup\Country'		=> 'App\Policies\Tenant\Lookup\CountryPolicy',
		'App\Models\Tenant\Lookup\Currency'		=> 'App\Policies\Tenant\Lookup\CurrencyPolicy',
		'App\Models\Tenant\Lookup\Dept'			=> 'App\Policies\Tenant\Lookup\DeptPolicy',
		'App\Models\Tenant\Lookup\Designation'	=> 'App\Policies\Tenant\Lookup\DesignationPolicy',
		'App\Models\Tenant\Lookup\Group'		=> 'App\Policies\Tenant\Lookup\GroupPolicy',
		'App\Models\Tenant\Lookup\Item'			=> 'App\Policies\Tenant\Lookup\ItemPolicy',
		'App\Models\Tenant\Lookup\Oem'			=> 'App\Policies\Tenant\Lookup\OemPolicy',

		'App\Models\Tenant\Lookup\Rate'			=> 'App\Policies\Tenant\Lookup\RatePolicy',
		'App\Models\Tenant\Lookup\Supplier'		=> 'App\Policies\Tenant\Lookup\SupplierPolicy',
		'App\Models\Tenant\Lookup\Uom'			=> 'App\Policies\Tenant\Lookup\UomPolicy',
		'App\Models\Tenant\Lookup\UploadItem'	=> 'App\Policies\Tenant\Lookup\UploadItemPolicy',
		'App\Models\Tenant\Lookup\Warehouse'	=> 'App\Policies\Tenant\Lookup\WarehousePolicy',
		'App\Models\Tenant\Lookup\BankAccount'	=> 'App\Policies\Tenant\Lookup\BankAccountPolicy',
		'App\Models\Tenant\Lookup\Project'		=> 'App\Policies\Tenant\Lookup\ProjectPolicy',

		'App\Models\Tenant\Manage\Cp'			=> 'App\Policies\Tenant\Manage\CpPolicy',
		'App\Models\Tenant\Manage\Entity'		=> 'App\Policies\Tenant\Manage\EntityPolicy',
		'App\Models\Tenant\Manage\Status' 		=> 'App\Policies\Tenant\Manage\StatusPolicy',
		'App\Models\Tenant\Manage\Menu'			=> 'App\Policies\Tenant\Manage\MenuPolicy',
		'App\Models\Tenant\Manage\Table'		=> 'App\Policies\Tenant\Manage\TablePolicy',
		'App\Models\Tenant\Manage\CustomError'	=> 'App\Policies\Tenant\Manage\CustomErrorPolicy',

		'App\Models\Tenant\Workflow\Hierarchy'	=> 'App\Policies\Tenant\Workflow\HierarchyPolicy',
		'App\Models\Tenant\Workflow\Hierarchyl'	=> 'App\Policies\Tenant\Workflow\HierarchylPolicy',
		'App\Models\Tenant\Workflow\Wf'			=> 'App\Policies\Tenant\Workflow\WfPolicy',
		'App\Models\Tenant\Workflow\Wfl'		=> 'App\Policies\Tenant\Workflow\WflPolicy',

		'App\Models\Tenant\Ae\Aeh' 				=> 'App\Policies\Tenant\Ae\AehPolicy',
		'App\Models\Tenant\Ae\Ael' 				=> 'App\Policies\Tenant\Ae\AelPolicy',

		'App\Models\Tenant\Support\Ticket' 		=> 'App\Policies\Tenant\Support\TicketPolicy',

		'App\Models\Tenant\Attachment' 			=> 'App\Policies\Tenant\AttachmentPolicy',
		'App\Models\Tenant\Budget'				=> 'App\Policies\Tenant\BudgetPolicy',
		'App\Models\Tenant\DeptBudget'			=> 'App\Policies\Tenant\DeptBudgetPolicy',
		'App\Models\Tenant\Dbu'					=> 'App\Policies\Tenant\DbuPolicy',
		'App\Models\Tenant\Notification'		=> 'App\Policies\Tenant\NotificationPolicy',

		'App\Models\Tenant\Po'					=> 'App\Policies\Tenant\PoPolicy',
		'App\Models\Tenant\Pol'					=> 'App\Policies\Tenant\PolPolicy',
		'App\Models\Tenant\Pr'					=> 'App\Policies\Tenant\PrPolicy',
		'App\Models\Tenant\Prl'					=> 'App\Policies\Tenant\PrlPolicy',
		'App\Models\Tenant\Invoice'				=> 'App\Policies\Tenant\InvoicePolicy',
		'App\Models\Tenant\InvoiceLine'			=> 'App\Policies\Tenant\InvoiceLinePolicy',
		'App\Models\Tenant\Payment'				=> 'App\Policies\Tenant\PaymentPolicy',
		'App\Models\Tenant\Receipt' 			=> 'App\Policies\Tenant\ReceiptPolicy',
		'App\Models\Tenant\Report' 				=> 'App\Policies\Tenant\ReportPolicy',
        'App\Models\Tenant\Export' 				=> 'App\Policies\Tenant\ExportPolicy',

		// 'App\Models\Tenant' => 'App\Policies\TenantPolicy',
		// 'App\Models\User' => 'App\Policies\UserPolicy',

	];

	/**
	 * Register any authentication / authorization services.
	 */
	public function boot(): void
	{
		//
	}
}
