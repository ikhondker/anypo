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
		Schema::create('countries', function (Blueprint $table) {
			$table->string('country',2);
			$table->string('name');
			$table->boolean('enable')->default(true);
			$table->uuid('created_by')->nullable();
			$table->timestamp('created_at')->useCurrent();
			$table->uuid('updated_by')->nullable();
			$table->timestamp('updated_at')->useCurrent();
			$table->primary('country');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('countries');
	}
};
