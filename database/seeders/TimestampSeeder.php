<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

use App\Models\Tenant\Admin\Setup;
use App\Models\Tenant\Manage\Entity;
use App\Models\Tenant\Manage\Status;
use App\Models\Tenant\Manage\CustomError;
use App\Models\Tenant\Manage\Menu;
use App\Models\Tenant\Manage\UomClass;

//use App\Models\Tenant\Manage\Template;


use App\Models\Tenant\Lookup\BankAccount;
use App\Models\Tenant\Lookup\Category;
use App\Models\Tenant\Lookup\ItemCategory;
use App\Models\Tenant\Lookup\Country;
use App\Models\Tenant\Lookup\Currency;
use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Lookup\Designation;
use App\Models\Tenant\Lookup\GlType;
use App\Models\Tenant\Lookup\Group;
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\Oem;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Lookup\Rate;
use App\Models\Tenant\Lookup\Supplier;
use App\Models\Tenant\Lookup\Uom;
use App\Models\Tenant\Lookup\Warehouse;

use App\Models\Tenant\Workflow\Hierarchy;
use App\Models\Tenant\Workflow\Hierarchyl;
//use App\Models\Tenant\Manage\Menu;


use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;
use App\Models\Tenant\Report;

// TODO Remove
use App\Models\Tenant\Pr;
use App\Models\Tenant\Prl;
use App\Models\Tenant\Po;
use App\Models\Tenant\Pol;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class TimestampSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		// get admin user id, if not found get system user

		try {
			$admin = User::where('role', 'admin')->firstOrFail();
	 	} catch (ModelNotFoundException $exception) {
			Log::error("message");('tenant.TimestampSeeder.run admin not found!');
			$admin = User::where('email', config('akk.ANONYMOUS_EMAIL_ID'))->firstOrFail();
	 	}

		User::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		Setup::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		Entity::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		Status::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		CustomError::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		Menu::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);

		//Template::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		Group::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		Category::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		ItemCategory::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		Country::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		Currency::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		Hierarchy::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		Hierarchyl::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		Dept::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		Designation::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);

		GlType::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		Oem::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		Project::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		Supplier::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		UomClass::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		Uom::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		Warehouse::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		BankAccount::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		Item::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);

		Budget::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		DeptBudget::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
		Report::where('created_by',NULL)->update(['created_by' => $admin->id,'updated_by' => $admin->id]);
	}
}
