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
		Schema::create('depts', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('name')->unique();
			$table->biginteger('pr_hierarchy_id')->default(1001);
			$table->biginteger('po_hierarchy_id')->default(1001);
			$table->string('text_color')->nullable();
			$table->string('bg_color')->default('primary');
			$table->string('icon')->nullable();
			$table->uuid('hod_id')->nullable();
			$table->boolean('enable')->default(true);
			$table->softDeletes();
			$table->uuid('created_by')->nullable();
			$table->timestamp('created_at')->useCurrent();
			$table->uuid('updated_by')->nullable();
			$table->timestamp('updated_at')->useCurrent();
			$table->foreign('hod_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('depts');
	}
};
