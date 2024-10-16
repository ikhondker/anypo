<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\Tenant\EntityEnum;
use App\Enum\Tenant\PaymentStatusEnum;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('payments', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->foreignId('invoice_id')->constrained('invoices');
			// added to simplify coding
			$table->foreignId('po_id')->constrained('pos');
			$table->date('pay_date')->default(DB::raw('(CURDATE())'));
			$table->foreignUuid('payee_id')->constrained('users');
			$table->string('summary')->nullable();
			$table->foreignId('bank_account_id')->constrained('bank_accounts')->nullable();
			$table->string('cheque_no');
			$table->string('currency',3);
			$table->decimal('amount', 19, 4)->default(0);
			$table->double('fc_exchange_rate', 19, 8)->default(1);
			$table->decimal('fc_amount', 19, 4)->default(0);
			$table->string('dr_account')->default('100001')->nullable();
			$table->string('cr_account')->default('100001')->nullable();
			//$table->foreignId('organization_id')->constrained('organizations');
			//$table->biginteger('for_doc_type_id')->constrained('doc_types');
			$table->string('for_entity',15)->default(EntityEnum::PO->value);
			$table->text('notes')->nullable();
			$table->string('error_code',15)->nullable();
			$table->boolean('accounted')->default(false);
			/** ENUM */
			$table->string('status')->default(PaymentStatusEnum::PAID->value);
			/** end ENUM */
			$table->uuid('created_by')->nullable();
			$table->timestamp('created_at')->useCurrent();
			$table->uuid('updated_by')->nullable();
			$table->timestamp('updated_at')->useCurrent();
			$table->foreign('for_entity')->references('entity')->on('entities');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('payments');
	}
};
