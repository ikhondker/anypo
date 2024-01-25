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
			$table->string('summary')->nullable();
			$table->string('access')->default('all'); 
			$table->string('article_id')->default(false); 
			$table->string('article_id_required')->default(false); 
			$table->boolean('start_date')->default(true); 
			$table->boolean('start_date_required')->default(true); 
			$table->boolean('end_date')->default(true); 
			$table->boolean('end_date_required')->default(true); 
			$table->boolean('user_id')->default(true); 
			$table->boolean('user_id_required')->default(true); 
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
