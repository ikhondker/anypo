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
		Schema::create('budgets', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('fy')->index();
			$table->string('name');
			//$table->string('fy')->unique()->index();
			//$table->string('name')->unique();
			$table->dateTime('start_date', $precision = 0)->nullable()->useCurrent();
			$table->dateTime('end_date', $precision = 0)->nullable()->useCurrent();
			//$table->string('currency',3)->default('USD');
			$table->float('amount', 15, 2)->default(0);
			$table->float('amount_pr_booked', 15, 2)->default(0);
			$table->float('amount_pr', 15, 2)->default(0);
			$table->float('amount_po_booked', 15, 2)->default(0);
			$table->float('amount_po', 15, 2)->default(0);
			$table->float('amount_grs', 15, 2)->default(0);
			$table->float('amount_invoice', 15, 2)->default(0);
			$table->float('amount_payment', 15, 2)->default(0);
			$table->biginteger('count_pr_booked')->default(0);
			$table->biginteger('count_pr')->default(0);
			$table->biginteger('count_po_booked')->default(0);
			$table->biginteger('count_po')->default(0);
			$table->biginteger('count_grs')->default(0);
			$table->biginteger('count_invoice')->default(0);
			$table->biginteger('count_payment')->default(0);
			$table->text('notes')->nullable();
			$table->boolean('revision')->default(false);
			$table->biginteger('parent_id')->default(0);
			$table->biginteger('revision_dept_budget_id')->default(0);
			$table->string('text_color')->nullable();
			$table->string('bg_color')->nullable();
			$table->string('icon')->nullable();
			//$table->boolean('first_time')->default(true); 
			$table->boolean('closed')->default(false); 
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
		Schema::dropIfExists('budgets');
	}
};
