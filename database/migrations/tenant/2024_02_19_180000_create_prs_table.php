<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\ClosureStatusEnum;
use App\Enum\AuthStatusEnum;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('prs', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('summary');
			$table->date('pr_date')->useCurrent();
			$table->date('need_by_date')->useCurrent();
			$table->foreignId('requestor_id')->constrained('users');
			$table->foreignId('dept_id')->constrained('depts')->index();
			$table->biginteger('unit_id')->nullable()->default(1001);	// Future Use
			$table->foreignId('project_id')->nullable()->constrained('projects');
			$table->biginteger('dept_budget_id')->nullable();	// Intentional kept null to allow user save draft PR before budget upload
			//$table->foreignId('dept_budget_id')->constrained('dept_budgets')->nullable();
			$table->foreignId('supplier_id')->constrained('suppliers');
			$table->text('notes')->nullable();
			$table->string('currency',3);
			$table->float('sub_total', 15, 2)->default(0);
			$table->float('tax',15,2)->default(0);
			$table->float('gst',15,2)->default(0);
			$table->float('amount', 15, 2)->default(0);
			$table->string('fc_currency',3);							// Functional Currency
			$table->double('fc_exchange_rate', 15, 10)->default(1);		// Functional Currency
			$table->float('fc_sub_total', 15, 2)->default(0);			// Functional Currency
			$table->float('fc_tax',15,2)->default(0);					// Functional Currency
			$table->float('fc_gst',15,2)->default(0);					// Functional Currency
			$table->float('fc_amount', 15, 2)->default(0);				// Functional Currency
			$table->dateTime('submission_date')->nullable();
			$table->integer('po_id')->default(0);
			/** ENUM */
			$table->string('status')->default(ClosureStatusEnum::OPEN->value);
			$table->foreign('status')->references('code')->on('statuses');
			/** end ENUM */
			/** ENUM */
			$table->string('auth_status')->default(AuthStatusEnum::DRAFT->value);
			$table->foreign('auth_status')->references('code')->on('statuses');
			/** end ENUM */
			$table->dateTime('auth_date',)->nullable();
			$table->integer('auth_user_id')->nullable();
			//$table->enum('status', ['OPEN','CANCELED','CLOSED'])->default('OPEN');
			//$table->enum('auth_status', ['DRAFT','SUBMITTED','IN-PROCESS','APPROVED','REJECTED','ERROR'])->default('DRAFT');
			$table->string('error_code',15)->nullable();
			$table->string('wf_key',10)->default('WFPR');
			$table->integer('hierarchy_id')->default(0);
			
			$table->integer('wf_id')->default(0);
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
		Schema::dropIfExists('prs');
	}
};
