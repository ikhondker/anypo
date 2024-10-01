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
        User::where('id','<>',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
        Setup::where('id','<>',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
        Entity::where('id','<>',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
        Status::where('id','<>',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
        CustomError::where('id','<>',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
        Menu::where('id','<>',NULL)->update(['created_by' => $system->id,'updated_by' => $system->id]);
	}
}
