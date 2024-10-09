<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\ClosureStatusEnum;
use App\Enum\AuthStatusEnum;
use App\Enum\PaymentStatusEnum;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('pos', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('summary');
			$table->foreignUuid('buyer_id')->constrained('users');
			$table->date('po_date')->default(DB::raw('(CURDATE())'));
			$table->date('need_by_date')->nullable();
			$table->foreignUuid('requestor_id')->constrained('users');
			$table->foreignId('dept_id')->constrained('depts');
			$table->biginteger('unit_id')->nullable()->default(1001);				// Future Use
			$table->foreignId('project_id')->nullable()->constrained('projects');
			$table->biginteger('dept_budget_id')->nullable();	// Intentional kept null to allow user save draft PO before budget upload
			//$table->foreignId('dept_budget_id')->constrained('dept_budgets')->nullable();
			$table->foreignId('supplier_id')->constrained('suppliers');
			$table->text('notes')->nullable();
			$table->string('currency',3);
			$table->decimal('sub_total', 19, 4)->default(0);
			$table->decimal('tax',19,4)->default(0);
			$table->decimal('gst',19, 4)->default(0);
			$table->decimal('amount', 19, 4)->default(0);
			$table->boolean('tc')->default(true);
			$table->dateTime('submission_date')->nullable();
			$table->string('fc_currency',3);							// Functional Currency
			$table->double('fc_exchange_rate', 15, 10)->default(1);		// Functional Currency
			$table->decimal('fc_sub_total', 19, 4)->default(0);			// Functional Currency
			$table->decimal('fc_tax',19, 4)->default(0);					// Functional Currency
			$table->decimal('fc_gst',19, 4)->default(0);					// Functional Currency
			$table->decimal('fc_amount', 19, 4)->default(0);				// Functional Currency
			$table->decimal('amount_grs',19, 4)->default(0);
			$table->decimal('fc_amount_grs',19, 4)->default(0);
			$table->decimal('amount_invoice',19, 4)->default(0);
			$table->decimal('fc_amount_invoice',19, 4)->default(0);
			$table->decimal('amount_paid',19, 4)->default(0);
			$table->decimal('fc_amount_paid',19, 4)->default(0);
			/** ENUM */
			$table->string('status')->default(ClosureStatusEnum::OPEN->value);;
			$table->foreign('status')->references('code')->on('statuses');
			/** end ENUM */
			/** ENUM */
			$table->string('payment_status')->default(PaymentStatusEnum::DUE->value);;
			$table->foreign('payment_status')->references('code')->on('statuses');
			/** end ENUM */
			/** ENUM */
			$table->string('auth_status')->default(AuthStatusEnum::DRAFT->value);
			/** end ENUM */
			$table->dateTime('auth_date',)->nullable();
			$table->uuid('auth_user_id')->nullable();
			$table->string('error_code',15)->nullable();
			$table->string('wf_key',10)->default('WFPR');
			$table->integer('hierarchy_id')->default(0);
			$table->integer('pr_id')->default(0);
			$table->integer('wf_id')->default(0);
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
		Schema::dropIfExists('pos');
	}
};
