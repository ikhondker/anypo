<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\Tenant\InvoiceStatusEnum;
use App\Enum\Tenant\PaymentStatusEnum;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('invoices', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->enum('invoice_type', ['STANDARD','ADVANCE','DEBIT-MEMO','CREDIT-MEMO'])->default('STANDARD');
			$table->string('invoice_no');
			$table->date('invoice_date')->default(DB::raw('(CURDATE())'));
			$table->foreignId('po_id')->constrained('pos');
			$table->foreignId('supplier_id')->constrained('suppliers');
			$table->string('summary');
			$table->foreignUuid('poc_id')->constrained('users');
			$table->string('currency',3);
			$table->decimal('sub_total', 19, 2)->default(0);
			$table->decimal('tax', 19, 2)->default(0);
			$table->decimal('gst', 19, 2)->default(0);
			$table->decimal('amount', 19, 2)->default(0);
			$table->decimal('amount_paid', 19, 2)->default(0);
			$table->string('fc_currency',3);							// Functional Currency
			$table->double('fc_exchange_rate', 19, 8)->default(1);		// Functional Currency
			$table->decimal('fc_sub_total', 19, 2)->default(0);			// Functional Currency
			$table->decimal('fc_tax', 19, 2)->default(0);					// Functional Currency
			$table->decimal('fc_gst', 19, 2)->default(0);					// Functional Currency
			$table->decimal('fc_amount', 19, 2)->default(0);				// Functional Currency
			$table->decimal('fc_amount_paid', 19, 2)->default(0);			// Functional Currency
			$table->string('dr_account')->default('100001')->nullable();
			$table->string('cr_account')->default('100001')->nullable();
			$table->text('notes')->nullable();
			$table->string('error_code',15)->nullable();
			$table->boolean('accounted')->default(false);
			/** ENUM */
			$table->string('status')->default(InvoiceStatusEnum::DRAFT->value);
			$table->foreign('status')->references('code')->on('statuses');
			/** end ENUM */
			/** ENUM */
			$table->string('payment_status')->default(PaymentStatusEnum::DUE->value);
			$table->foreign('payment_status')->references('code')->on('statuses');
			/** end ENUM */
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
		Schema::dropIfExists('invoices');
	}
};
