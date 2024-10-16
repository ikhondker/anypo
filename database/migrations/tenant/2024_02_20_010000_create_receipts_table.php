<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\Tenant\ReceiptStatusEnum;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('receipts', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->date('receive_date')->default(DB::raw('(CURDATE())'));
			$table->enum('rcv_type', ['RECEIVE','ADJUSTMENT','MISCELLANEOUS'])->default('RECEIVE');
			//$table->string('summary')->nullable();
			$table->foreignId('pol_id')->constrained('pols');
			$table->foreignId('warehouse_id')->constrained('warehouses');
			//$table->foreignId('item_id')->constrained('items');
			$table->foreignUuid('receiver_id')->constrained('users');
			//$table->foreignId('supplier_id')->nullable()->constrained('organizations');
			$table->decimal('qty', 19, 4)->default(1);
			$table->decimal('price', 19, 4)->default(0);					// This is grs_price from pol
			$table->decimal('amount', 19, 4)->default(0);
			$table->double('fc_exchange_rate', 15, 10)->default(1);		// Functional Currency
			$table->decimal('fc_amount', 19, 4)->default(0);
			$table->string('dr_account')->default('100001')->nullable();
			$table->string('cr_account')->default('100001')->nullable();
			// $table->decimal('price', 19, 4)->default(1);
			// $table->decimal('amount', 19, 4)->default(1);
			// $table->string('base_currency',3)->default('USD');
			// $table->decimal('base_exchange_rate')->default(1);
			// $table->decimal('base_amount')->default(0);
			//$table->string('attachment')->nullable();
			$table->text('notes')->nullable();
			$table->string('error_code',15)->nullable();
			$table->boolean('accounted')->default(false);
			/** ENUM */
			$table->string('status')->default(ReceiptStatusEnum::RECEIVED->value);
			$table->foreign('status')->references('code')->on('statuses');
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
		Schema::dropIfExists('receipts');
	}
};
