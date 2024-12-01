<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\Tenant\EntityEnum;
use App\Enum\Tenant\EventEnum;


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
			$table->uuid('user_id')->nullable();
			$table->foreignId('dept_id')->nullable()->constrained('depts');
			$table->biginteger('unit_id')->nullable()->default(1001);	// Future Use
			$table->foreignId('project_id')->nullable()->constrained('projects');
			$table->foreignId('supplier_id')->nullable()->constrained('suppliers');	// NEW
			$table->decimal('amount', 19, 2)->default(0);			// used for front end display
			$table->decimal('amount_pr_booked', 19, 2)->default(0);
			$table->decimal('amount_pr', 19, 2)->default(0);
			$table->decimal('amount_po_booked', 19, 2)->default(0);
			$table->decimal('amount_po', 19, 2)->default(0);
			$table->decimal('amount_grs', 19, 2)->default(0);
			$table->decimal('amount_invoice', 19, 2)->default(0);
			$table->decimal('amount_payment', 19, 2)->default(0);
			//$table->text('notes')->nullable();
			$table->softDeletes();
			$table->uuid('created_by')->nullable();
			$table->timestamp('created_at')->useCurrent();
			$table->uuid('updated_by')->nullable();
			$table->timestamp('updated_at')->useCurrent();
			$table->foreign('entity')->references('entity')->on('entities');
            $table->foreign('user_id')->references('id')->on('users');

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
