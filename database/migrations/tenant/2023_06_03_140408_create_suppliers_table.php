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
		Schema::create('suppliers', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('name');
			$table->string('address1');
			$table->string('address2')->nullable();
			$table->string('contact_person')->nullable();
			
			$table->string('cell')->nullable();
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
		Schema::dropIfExists('suppliers');
	}
};
