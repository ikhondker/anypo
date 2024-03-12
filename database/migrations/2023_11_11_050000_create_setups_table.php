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
			//$table->float('tax', 15, 2)->default(0);
			//$table->float('gst', 15, 2)->default(0);
			$table->string('address1')->nullable();
			$table->string('address2')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('zip')->nullable();
			$table->string('country',2)->default('NL');
			$table->string('email')->nullable();
			$table->string('cell')->nullable();
			$table->string('website')->nullable();
			$table->string('facebook')->nullable();
			$table->string('linkedin')->nullable();
			$table->string('logo')->nullable();
			$table->boolean('banner')->default(false);
			$table->text('banner_message')->nullable();
			$table->boolean('maintenance')->default(false);
			$table->dateTime('maintenance_start_time')->nullable()->useCurrent();
			$table->dateTime('maintenance_end_time')->nullable()->useCurrent();
			$table->boolean('debug')->default(false);
			$table->boolean('disable_payments')->default(false);
			$table->string('version')->nullable()->default('1.0');
			$table->string('build')->nullable()->default('1001');
			$table->biginteger('days_gen_bill')->default(7);
			$table->biginteger('days_due')->default(7);
			$table->biginteger('days_past_due')->default(14);
			$table->biginteger('days_archive')->default(60);
			//$table->biginteger('days_pay_for_addon')->default(35);
			$table->float('discount_pc_3', 15, 2)->default(5);
			$table->float('discount_pc_6', 15, 2)->default(10);
			$table->float('discount_pc_12', 15, 2)->default(15);
			$table->float('discount_pc_24', 15, 2)->default(20);
			$table->boolean('enable')->default(true);
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
