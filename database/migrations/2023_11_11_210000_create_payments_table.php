<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\Landlord\PaymentStatusEnum;
use App\Enum\Landlord\PaymentMethodEnum;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */

	public function up(): void
	{
		Schema::create('payments', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('summary');
			$table->string('session_id')->nullable();
			$table->date('pay_date')->default(DB::raw('(CURDATE())'));
			$table->foreignId('invoice_id')->constrained('invoices');
			$table->foreignId('account_id')->nullable()->constrained('accounts');
			$table->foreignUuid('owner_id')->nullable()->constrained('users');
			$table->decimal('amount',19, 2)->default(0);
			$table->string('currency')->default('USD');
			$table->string('cheque_no')->nullable();
			$table->string('payment_token')->nullable();
			$table->string('reference_id')->nullable();
			$table->text('notes')->nullable();
			$table->string('ip')->nullable();
            /** ENUM */
			//$table->foreignId('payment_method_id')->constrained('payment_methods');
			$table->string('payment_method_code')->default(PaymentMethodEnum::CARD->value);
			//TODO
            //$table->foreign('payment_method_code')->references('code')->on('payment_methods');
			/** end ENUM */
			/** ENUM */
			//$table->string('status')->default(PaymentStatusEnum::DRAFT->value);
			$table->string('status_code')->default(PaymentStatusEnum::DRAFT->value);
			$table->foreign('status_code')->references('code')->on('statuses');
			//$table->foreignId('status_id')->default(PaymentStatusEnum::NEW->value)->constrained('statuses');
			/** end ENUM */
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
		Schema::dropIfExists('payments');
	}
};
