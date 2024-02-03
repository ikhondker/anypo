<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\EventEnum;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('dept_budget_usages', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->foreignId('dept_budget_id')->constrained('dept_budgets');
			$table->string('entity',15); 
			$table->biginteger('article_id')->default(0);
			/** ENUM */
			$table->string('event')->default(EventEnum::BOOK->value);;
			/** end ENUM */
			$table->float('amount', 15, 2)->default(0);
			$table->float('amount_pr_booked', 15, 2)->default(0);
			$table->float('amount_pr_issued', 15, 2)->default(0);
			$table->float('amount_po_booked', 15, 2)->default(0);
			$table->float('amount_po_issued', 15, 2)->default(0);
			$table->float('amount_grs', 15, 2)->default(0);
			$table->float('amount_payment', 15, 2)->default(0);
			$table->text('notes')->nullable();
			$table->softDeletes();
			$table->biginteger('created_by')->default(1001);
			$table->timestamp('created_at')->useCurrent();
			$table->biginteger('updated_by')->default(1001);
			$table->timestamp('updated_at')->useCurrent();
			$table->foreign('entity')->references('entity')->on('entities');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('dept_budget_usages');
	}
};
