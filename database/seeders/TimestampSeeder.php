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

class TimestampSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		// get system user id
		$system = User::where('email', config('akk.SYSTEM_EMAIL_ID'))->firstOrFail();

		//Post::where('id',3)->update(['title'=>'Updated title']);
		//User::where('id',3)->update(['created_by' => $system->id]);
		// User::query()->update(['created_by' => $system->id,'updated_by' => $system->id]);
		User::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		Setup::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		Entity::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		Status::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		CustomError::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		Menu::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);

		//Template::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		Group::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		Category::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		Country::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		Currency::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		Hierarchy::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		Hierarchyl::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		Dept::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		Designation::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);

		GlType::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		Oem::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		Project::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		Supplier::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		UomClass::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		Uom::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		Warehouse::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		BankAccount::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		Item::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);

		Budget::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		DeptBudget::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
		Report::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
	}
}
