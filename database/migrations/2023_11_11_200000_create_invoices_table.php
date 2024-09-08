<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\LandlordInvoiceStatusEnum;
use App\Enum\LandlordInvoiceTypeEnum;


return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('invoices', function (Blueprint $table) {
			$table->id()->startingValue(100001);
			$table->string('summary');
			$table->string('invoice_no')->unique();
			$table->string('invoice_type')->default(LandlordInvoiceTypeEnum::SUBSCRIPTION->value);
			$table->foreignId('account_id')->constrained('accounts');
			$table->foreignUuid('owner_id')->nullable()->constrained('users');
			$table->date('invoice_date')->default(DB::raw('(CURDATE())'));
			$table->date('from_date');
			$table->date('to_date');
			$table->date('org_from_date')->nullable();
			$table->date('due_date')->nullable()->useCurrent();
			$table->string('currency')->default('USD');
			$table->decimal('price', 19, 4)->default(0);
			$table->decimal('discount',19, 4)->default(0);
			$table->decimal('subtotal',19, 4)->default(0);
			$table->decimal('tax',19, 4)->default(0);
			$table->decimal('vat',19, 4)->default(0);
			$table->decimal('amount',19, 4)->default(0);
			$table->decimal('amount_paid',15,2)->default(0);
			$table->date('pay_date')->nullable()->useCurrent();
			$table->text('notes')->nullable();
			$table->boolean('adjusted')->default(false); // in case addon added for 3/6/12 month advance payment
			$table->date('adjustment_date')->nullable();
			$table->string('adjustment_ref')->nullable();
			/** ENUM */
			//$table->string('status')->default(LandlordInvoiceStatusEnum::DUE->value);
			/** end ENUM */
			/** ENUM */
			$table->string('status_code')->default(LandlordInvoiceStatusEnum::DUE->value);
			$table->foreign('status_code')->references('code')->on('statuses');
			$table->biginteger('process_id')->nullable();
			//$table->foreignId('status_id')->default(LandlordInvoiceStatusEnum::DUE->value)->constrained('statuses');
			/** end ENUM */
			//$table->boolean('enable')->default(true);
			//$table->string('attachment')->nullable();
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
