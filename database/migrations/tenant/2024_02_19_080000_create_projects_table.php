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
			$table->foreignUuid('pm_id')->constrained('users')->nullable();
			$table->date('start_date')->default(DB::raw('(CURDATE())'));
			$table->date('end_date')->nullable();
			$table->boolean('budget_control')->default(true);
			$table->decimal('amount', 19, 4)->default(0);
			$table->decimal('amount_pr_booked', 19, 4)->default(0);
			$table->decimal('amount_pr', 19, 4)->default(0);
			$table->decimal('amount_po_booked', 19, 4)->default(0);
			$table->decimal('amount_po', 19, 4)->default(0);
			$table->decimal('amount_grs', 19, 4)->default(0);
			$table->decimal('amount_invoice', 19, 4)->default(0);
			$table->decimal('amount_payment', 19, 4)->default(0);
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
		Schema::dropIfExists('projects');
	}
};
