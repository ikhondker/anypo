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
		Schema::create('exports', function (Blueprint $table) {
			$table->string('entity', 15);	// model: protected $primaryKey = 'code';
			$table->string('name');
			$table->string('access')->default('all');
			$table->string('article_id')->default(false);
			$table->boolean('article_id_required')->default(false);
			$table->boolean('start_date')->default(true);
			//$table->boolean('start_date_required')->default(false);
			$table->boolean('end_date')->default(true);
			//$table->boolean('end_date_required')->default(false);
			$table->boolean('currency')->default(true);
			$table->boolean('supplier_id')->default(true);
			$table->boolean('supplier_id_required')->default(false);
			$table->boolean('project_id')->default(true);
			$table->boolean('project_id_required')->default(false);
			$table->boolean('dept_id')->default(true);
			$table->boolean('dept_id_required')->default(false);
			$table->boolean('user_id')->default(true);
			$table->boolean('user_id_required')->default(false);
			$table->boolean('warehouse_id')->default(false);
			$table->boolean('warehouse_id_required')->default(false);
			$table->boolean('bank_account_id')->default(false);
			$table->boolean('bank_account_id_required')->default(false);
			$table->boolean('category_id')->default(false);
			$table->boolean('category_id_required')->default(false);
			$table->boolean('item_id')->default(false);
			$table->boolean('item_id_required')->default(false);
			$table->integer('order_by1')->default(0);
			$table->integer('order_by2')->default(0);
			$table->unsignedinteger('run_count')->default(0);
			$table->boolean('enable')->default(true);
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
		Schema::dropIfExists('exports');
	}
};
