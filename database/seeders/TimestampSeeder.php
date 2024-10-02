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

//use App\Models\Tenant\Manage\Template;
use App\Models\Tenant\Manage\Group;
use App\Models\Tenant\Manage\Menu;
use App\Models\Tenant\Manage\Menu;


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
        User::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
        Setup::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
        Entity::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
        Status::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
        CustomError::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
        Menu::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);


        $this->call(\Database\Seeders\Share\TemplateSeeder::class);
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
        Warehouse::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
        BankAccount::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
        Item::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);

        Budget::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
        DeptBudget::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
        Report::where('created_by',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);




	}
}
