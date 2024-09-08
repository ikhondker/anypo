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
		Schema::create('warehouses', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('name')->unique();
			$table->string('contact_person')->nullable();
			$table->string('cell')->nullable();
			$table->string('address1');
			$table->string('address2')->nullable();
			$table->string('city')->nullable();
			$table->string('zip')->nullable();
			$table->string('state')->nullable();
			$table->string('country',2)->default('US');
			$table->string('website')->nullable();
			$table->string('email')->nullable();
			$table->boolean('enable')->default(true); 
			$table->string('ac_receiving')->default('A200001');
			$table->string('ac_clearing')->default('A200003');			// Future user
			$table->softDeletes();
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
		Schema::dropIfExists('warehouses');
	}
};
