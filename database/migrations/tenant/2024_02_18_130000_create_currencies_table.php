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
		Schema::create('currencies', function (Blueprint $table) {
			$table->string('currency',3);
			$table->string('name');					// Don't put unique
			$table->string('country')->nullable();
			$table->string('symbol')->nullable();
			$table->boolean('enable')->default(false);
			$table->boolean('rates')->default(true);
			$table->boolean('never')->default(true);
			$table->uuid('created_by')->nullable();
			$table->timestamp('created_at')->useCurrent();
			$table->uuid('updated_by')->nullable();
			$table->timestamp('updated_at')->useCurrent();
			$table->primary('currency');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('currencies');
	}
};
