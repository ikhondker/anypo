<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\InvoiceStatusEnum;
use App\Enum\PaymentStatusEnum;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('invoices', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->enum('invoice_type', ['STANDARD','ADVANCE'])->default('STANDARD');
			$table->string('invoice_no');
			$table->dateTime('invoice_date')->useCurrent();
			$table->foreignId('po_id')->constrained('pos');
			$table->foreignId('supplier_id')->constrained('suppliers');
			$table->string('summary');
			$table->foreignId('poc_id')->constrained('users');
			$table->string('currency',3);
			$table->float('sub_total', 15, 2)->default(0);
			$table->float('tax',15,2)->default(0);
			$table->float('gst',15,2)->default(0);
			$table->float('amount', 15, 2)->default(0);
			$table->float('amount_paid', 15, 2)->default(0);
			//$table->string('fc_currency',3);							// Functional Currency
			$table->double('fc_exchange_rate', 15, 10)->default(1);		// Functional Currency
			$table->float('fc_sub_total', 15, 2)->default(0);			// Functional Currency
			$table->float('fc_tax',15,2)->default(0);					// Functional Currency
			$table->float('fc_gst',15,2)->default(0);					// Functional Currency
			$table->float('fc_amount', 15, 2)->default(0);				// Functional Currency
			$table->float('fc_amount_paid', 15, 2)->default(0);			// Functional Currency
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
			$table->string('payment_status')->default(PaymentStatusEnum::DUE->value);;
			$table->foreign('payment_status')->references('code')->on('statuses');
			/** end ENUM */
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
		Schema::dropIfExists('invoices');
	}
};
