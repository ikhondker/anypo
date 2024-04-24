<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\UserRoleEnum;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('name');
			$table->string('email')->unique();
			$table->biginteger('designation_id')->nullable()->default(1001); 	// No foreign key to avoid circular FK dependency
			$table->biginteger('dept_id')->nullable()->default(1001);	 		// No foreign key to avoid circular FK dependency
			$table->biginteger('unit_id')->nullable()->default(1001);			// Future Use
			/** ENUM */
			$table->string('role')->default(UserRoleEnum::USER->value);
			/** end ENUM */
			$table->string('password');
			$table->timestamp('email_verified_at')->nullable();
			$table->string('cell')->unique()->nullable();
			$table->string('address1')->nullable();
			$table->string('address2')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('zip')->nullable();
			$table->string('country',2)->default('US');
			$table->string('facebook')->nullable();
			$table->string('linkedin')->nullable();
			$table->string('avatar')->nullable()->default('avatar.png');
			$table->text('notes')->nullable();
			$table->string('timezone', 255)->default('UTC');
			$table->boolean('seeded')->default(false);
			$table->boolean('enable')->default(false);  // only make first admin true
			$table->boolean('ban')->default(true);
			$table->datetime('last_login_at')->nullable();
			$table->string('last_login_ip')->nullable();
			$table->biginteger('created_by')->default(1001);
			$table->timestamp('created_at')->useCurrent();
			$table->biginteger('updated_by')->default(1001);
			$table->timestamp('updated_at')->useCurrent();
			$table->rememberToken();

		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('users');
	}
};
