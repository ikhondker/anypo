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
		Schema::create('bank_accounts', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('ac_name')->unique();
			$table->string('ac_number')->unique();
			$table->string('bank_name')->nullable();
			$table->string('branch_name')->nullable();
			$table->dateTime('start_date', $precision = 0)->useCurrent();
			$table->dateTime('end_date', $precision = 0)->nullable();
			$table->string('currency',3)->default('USD'); 
			$table->string('contact_person')->nullable();
			$table->string('cell')->nullable();
			$table->string('address1')->nullable();
			$table->string('address2')->nullable();
			$table->string('city')->nullable();
			$table->string('zip')->nullable();
			$table->string('state')->nullable();
			$table->string('country',2)->default('US');
			$table->string('website')->nullable();
			$table->string('email')->nullable();
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
		Schema::dropIfExists('bank_accounts');
	}
};
