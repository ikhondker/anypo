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
		Schema::create('item_categories', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('name')->unique();
			$table->decimal('tax_pc', 19, 2)->default(0);				// Future user
			$table->decimal('gst_pc', 19, 2)->default(7.5);				// Future user
			//$table->integer('group_id')->nullable()->default(1001);
			$table->foreignId('group_id')->default(1001)->constrained('groups');
			$table->string('text_color')->nullable();
			$table->string('bg_color')->default('primary');
			$table->string('icon')->nullable();
			$table->boolean('enable')->default(true);
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
		Schema::dropIfExists('item_categories');
	}
};
