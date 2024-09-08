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
		Schema::create('reports', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('name');
			$table->string('title')->nullable();
			$table->string('access')->default('all'); 
			$table->string('article_id')->default(false); 
			$table->boolean('start_date')->default(true); 
			$table->boolean('end_date')->default(true); 
			$table->boolean('account_id')->default(false); 
			$table->boolean('service_id')->default(true); 
			$table->boolean('user_id')->default(true); 
			$table->boolean('item_id')->default(false); 
			$table->boolean('enable')->default(true); 
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
		Schema::dropIfExists('reports');
	}
};
