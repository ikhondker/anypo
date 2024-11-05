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
		Schema::create('dept_budgets', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->foreignId('budget_id')->constrained('budgets');
			$table->foreignId('dept_id')->constrained('depts');
			$table->decimal('amount', 19, 2)->default(0);
			$table->decimal('amount_pr_booked', 19, 2)->default(0);
			$table->decimal('amount_pr', 19, 2)->default(0);
			$table->decimal('amount_po_booked', 19, 2)->default(0);
			$table->decimal('amount_po_tax', 19, 2)->default(0);	// only for approved po
			$table->decimal('amount_po_gst', 19, 2)->default(0);	// only for approved po
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
			$table->date('start_date')->nullable();
			$table->date('end_date')->nullable();
			$table->text('notes')->nullable();
			$table->boolean('revision')->default(false);
			$table->biginteger('parent_id')->default(0);
			$table->boolean('closed')->default(false);
			$table->uuid('created_by')->nullable();
			$table->timestamp('created_at')->useCurrent();
			$table->uuid('updated_by')->nullable();
			$table->timestamp('updated_at')->useCurrent();
			///$table->unique(['budget_id','dept_id','revision']);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('dept_budgets');
	}
};
