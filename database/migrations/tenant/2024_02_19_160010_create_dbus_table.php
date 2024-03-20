<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\EntityEnum;
use App\Enum\EventEnum;


return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('dbus', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->foreignId('dept_budget_id')->constrained('dept_budgets');
			/** ENUM */
			$table->string('entity')->default(EntityEnum::PR->value);
			/** end ENUM */
			$table->biginteger('article_id')->default(0);
			/** ENUM */
			$table->string('event')->default(EventEnum::BOOK->value);
			/** end ENUM */
			$table->foreignId('user_id')->nullable()->constrained('users');
			$table->foreignId('dept_id')->nullable()->constrained('depts');
			$table->biginteger('unit_id')->nullable()->default(1001);	// Future Use
			$table->foreignId('project_id')->nullable()->constrained('projects');
			$table->foreignId('supplier_id')->nullable()->constrained('suppliers');	// NEW
			$table->float('amount_pr_booked', 15, 2)->default(0);
			$table->float('amount_pr', 15, 2)->default(0);
			$table->float('amount_po_booked', 15, 2)->default(0);
			$table->float('amount_po', 15, 2)->default(0);
			$table->float('amount_grs', 15, 2)->default(0);
			$table->float('amount_invoice', 15, 2)->default(0);
			$table->float('amount_payment', 15, 2)->default(0);
			//$table->text('notes')->nullable();
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
		Schema::dropIfExists('dbus');
	}
};
