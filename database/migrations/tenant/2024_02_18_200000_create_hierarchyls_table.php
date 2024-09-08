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
		Schema::create('hierarchyls', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->foreignId('hid')->constrained('hierarchies');
			$table->integer('sequence')->default(10);	// TODO P2
			$table->foreignUuid('approver_id')->constrained('users');
			$table->boolean('enable')->default(true); 	// Not Used
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
		Schema::dropIfExists('hierarchyls');
	}
};
