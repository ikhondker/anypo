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
			$table->id();
			$table->foreignId('hid')->constrained('hierarchies');
			$table->integer('sequence')->default(10);   // TODO P2
			$table->foreignId('approver_id')->constrained('users');
			$table->boolean('enable')->default(true); // Not Used
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
		Schema::dropIfExists('hierarchyls');
	}
};
