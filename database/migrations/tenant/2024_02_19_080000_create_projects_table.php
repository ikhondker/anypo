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
		Schema::create('projects', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('code')->unique();
			$table->string('name')->unique();
			$table->foreignId('pm_id')->constrained('users')->nullable();
			$table->dateTime('start_date', $precision = 0)->nullable()->useCurrent();
			$table->dateTime('end_date', $precision = 0)->nullable()->useCurrent();
			$table->boolean('budget_control')->default(true);
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
			$table->string('text_color')->nullable();
			$table->string('bg_color')->nullable();
			$table->string('icon')->nullable();
			$table->boolean('closed')->default(false); 
			$table->softDeletes();
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
		Schema::dropIfExists('projects');
	}
};
