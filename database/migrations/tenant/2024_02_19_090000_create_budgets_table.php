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
			$table->date('start_date');
			$table->date('end_date');
			//$table->string('currency',3)->default('USD');
			$table->decimal('amount', 19, 2)->default(0);
			$table->decimal('amount_pr_booked', 19, 2)->default(0);
			$table->decimal('amount_pr', 19, 2)->default(0);
			$table->decimal('amount_po_booked', 19, 2)->default(0);
			$table->decimal('amount_po_tax', 19, 2)->default(0);    // only for approved po
			$table->decimal('amount_po_gst', 19, 2)->default(0);    // only for approved po
			$table->decimal('amount_po', 19, 2)->default(0);
			$table->decimal('amount_grs', 19, 2)->default(0);
			$table->decimal('amount_invoice', 19, 2)->default(0);
			$table->decimal('amount_payment', 19, 2)->default(0);
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
		Schema::dropIfExists('budgets');
	}
};
