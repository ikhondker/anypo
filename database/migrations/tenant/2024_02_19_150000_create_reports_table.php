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
			$table->string('entity')->nullable();
			$table->string('name');
			$table->string('summary')->nullable();
			$table->string('access')->default('all'); 
			$table->string('article_id')->default(false); 
			$table->string('article_id_required')->default(false); 
			$table->boolean('start_date')->default(false); 
			$table->boolean('start_date_required')->default(false); 
			$table->boolean('end_date')->default(false); 
			$table->boolean('end_date_required')->default(false); 
			$table->boolean('user_id')->default(false); 
			$table->boolean('user_id_required')->default(false); 
			$table->boolean('item_id')->default(false); 
			$table->boolean('item_id_required')->default(false); 
			$table->boolean('supplier_id')->default(false); 
			$table->boolean('supplier_id_required')->default(false); 
			$table->boolean('project_id')->default(false); 
			$table->boolean('project_id_required')->default(false); 
			$table->boolean('category_id')->default(false); 
			$table->boolean('category_id_required')->default(false); 
			$table->boolean('dept_id')->default(false); 
			$table->boolean('dept_id_required')->default(false); 
			$table->boolean('warehouse_id')->default(false); 
			$table->boolean('warehouse_id_required')->default(false); 
			$table->unsignedinteger('run_count')->default(0);
			$table->biginteger('order_by')->default(1001);
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
		Schema::dropIfExists('reports');
	}
};
