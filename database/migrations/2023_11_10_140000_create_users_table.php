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
			//$table->id()->startingValue(1001);
			$table->uuid('id')->primary();
			$table->string('name');
			$table->string('email')->unique();
			/** ENUM */
			$table->string('role')->default(UserRoleEnum::USER->value);
			/** end ENUM */
			$table->biginteger('account_id')->nullable(); /* no FK */
			$table->string('password');
			$table->timestamp('email_verified_at')->nullable();
			$table->rememberToken();
			$table->string('cell')->unique()->nullable();
			$table->string('title')->nullable();
			$table->string('address1')->nullable();
			$table->string('address2')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('zip')->nullable();
			$table->string('country',2)->default('US');
			$table->string('website')->nullable();
			$table->string('facebook')->nullable();
			$table->string('linkedin')->nullable();
			$table->string('avatar')->nullable()->default('avatar.png');
			$table->text('notes')->nullable();
			$table->string('timezone', 255)->default('UTC');
			$table->boolean('backend')->default(false);
			$table->boolean('enable')->default(true);
			$table->boolean('locked')->default(false);
			$table->datetime('last_login_at')->nullable();
			$table->string('last_login_ip')->nullable();
			$table->uuid('created_by')->nullable();
			$table->timestamp('created_at')->useCurrent();
			$table->uuid('updated_by')->nullable();
			$table->timestamp('updated_at')->useCurrent();
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
