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
		Schema::create('pay_methods', function (Blueprint $table) {
			//$table->integer('id')->autoIncrement()->from(1001);
			$table->increments('id')->from(1001);
			$table->string('name');
			$table->string('pay_method_number');
			$table->string('bank_name')->nullable();
			$table->string('branch_name')->nullable();
			//$table->string('contact_person')->nullable();
			//$table->string('bank_ac_name');
			$table->dateTime('start_date', $precision = 0)->useCurrent();
			$table->dateTime('end_date', $precision = 0)->nullable();
			$table->string('currency',3)->default('USD'); 
			$table->text('notes')->nullable();
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
		Schema::dropIfExists('pay_methods');
	}
};
