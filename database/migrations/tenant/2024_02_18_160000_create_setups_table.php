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
			$table->string('prefix')->default('AP/');
			$table->decimal('tax_pc',19, 2)->default(0);				// Future user
			$table->decimal('gst_pc',19, 2)->default(7.5);				// Future user
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
			$table->string('timezone', 255)->default('UTC');
			$table->biginteger('days_payment')->nullable()->default(45);
			$table->biginteger('days_return')->nullable()->default(30);
			$table->decimal('tolerance_invoice', 15, 2)->default(1);		// Future
			$table->decimal('tolerance_receipt', 15, 2)->default(1);		// Future
			$table->decimal('tolerance_payment', 15, 2)->default(1);		// Future
			$table->boolean('user_master_data_entry')->default(false); 	// Future. Allow user to create master data
			$table->string('ac_accrual')->default('A200001');
			$table->string('ac_liability')->default('A200004');
			$table->string('ac_clearing')->default('A200006');			// Future user
			$table->text('tc')->nullable();
			$table->string('logo')->nullable()->default('logo.png');
			$table->boolean('banner_show')->default(false);
			$table->text('banner_message')->nullable();
			$table->string('version')->nullable()->default('1.0.0');
			$table->string('build')->nullable()->default('1001');
			//$table->boolean('show_notice')->default(false);
			//$table->text('notice')->nullable();
			$table->uuid('admin_id')->nullable(); 					// No foreign key intentional
			$table->uuid('system_user_id')->nullable();				// No foreign key intentional
			$table->uuid('kam_id')->nullable(); 					// Future
			$table->biginteger('landlord_account_id')->nullable();
			$table->date('last_rate_date')->nullable();
			$table->boolean('maintenance')->default(false);
			$table->boolean('debug')->default(false);
			$table->boolean('readonly')->default(false);
			$table->boolean('enable')->default(true);
			//$table->boolean('purge')->default(true);
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
		Schema::dropIfExists('setups');
	}
};
