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
		Schema::create('uom_classes', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('name');
			$table->boolean('enable')->default(true);
			$table->string('text_color')->nullable();
			$table->string('bg_color')->nullable();
			$table->string('icon')->nullable();
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
		Schema::dropIfExists('uom_classes');
	}
};
