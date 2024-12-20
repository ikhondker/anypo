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
		Schema::create('entities', function (Blueprint $table) {
			$table->string('entity',15);	// model: protected $primaryKey = 'entity'; // Hardcoded in Workflow Helper only
			$table->string('name');
			$table->string('model');
			$table->string('route')->nullable();
			$table->string('directory');
			$table->boolean('notification')->default(false);
			$table->boolean('enable')->default(true);
			$table->softDeletes();
			$table->uuid('created_by')->nullable();
			$table->timestamp('created_at')->useCurrent();
			$table->uuid('updated_by')->nullable();
			$table->timestamp('updated_at')->useCurrent();
			$table->primary('entity');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('entities');
	}
};
