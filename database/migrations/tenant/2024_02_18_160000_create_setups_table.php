<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('setups', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('name');
			$table->string('tagline')->nullable();
			$table->string('currency',3)->default('USD');
			$table->boolean('freezed')->default(false);
			$table->float('tax', 8, 2)->default(0);
			$table->float('gst', 8, 2)->default(0);
			$table->string('address1')->nullable();
			$table->string('address2')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('zip')->nullable();
			$table->string('country',2)->default('US');
			$table->string('email')->nullable();
			$table->string('cell')->nullable();
			$table->string('website')->nullable();
			$table->string('facebook')->nullable();
			$table->string('linkedin')->nullable();
			$table->float('tolerance_invoice', 15, 2)->default(1);		// Future
			$table->float('tolerance_receipt', 15, 2)->default(1);		// Future
			$table->float('tolerance_payment', 15, 2)->default(1);		// Future
			$table->boolean('user_master_data_entry')->default(false); 		// Future. Allow user to create master data
			$table->string('ac_liability')->default('200001');
			$table->string('ac_accrual')->default('200002');
			$table->string('ac_clearing')->default('200003');
			$table->string('logo')->nullable()->default('logo.png');
			$table->boolean('banner_show')->default(false); 
			$table->text('banner_message')->nullable();
			$table->string('version')->nullable()->default('1.0');
			$table->string('build')->nullable()->default('1001');
			//$table->boolean('show_notice')->default(false);
			//$table->text('notice')->nullable();
			$table->biginteger('admin_id')->nullable(); 				// No foreign key intentional TODO
			$table->biginteger('landlord_account_id')->nullable();
			$table->dateTime('last_rate_date')->nullable();
			$table->boolean('maintenance')->default(false); 
			$table->boolean('debug')->default(false); 
			$table->boolean('readonly')->default(false);
			$table->boolean('enable')->default(true);
			//$table->boolean('purge')->default(true);
			$table->biginteger('created_by')->default(1001);
			$table->timestamp('created_at')->useCurrent();
			$table->biginteger('updated_by')->default(1001);
			$table->timestamp('updated_at')->useCurrent();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('setups');
	}
};
