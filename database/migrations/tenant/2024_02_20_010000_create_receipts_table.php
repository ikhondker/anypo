<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\ReceiptStatusEnum;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('receipts', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->dateTime('receive_date')->nullable()->useCurrent();
			$table->enum('rcv_type', ['RECEIVE','ADJUSTMENT','MISCELLANEOUS'])->default('RECEIVE'); 
			//$table->string('summary')->nullable();
			$table->foreignId('pol_id')->constrained('pols');
			$table->foreignId('warehouse_id')->constrained('warehouses');
			//$table->foreignId('item_id')->constrained('items');
			$table->foreignId('receiver_id')->constrained('users');
			//$table->foreignId('supplier_id')->nullable()->constrained('organizations');
			$table->unsignedinteger('qty')->default(1);
			$table->float('price', 15, 2)->default(0);					// This is grs_price from pol
			$table->float('amount', 15, 2)->default(0);
			$table->double('fc_exchange_rate', 15, 10)->default(1);		// Functional Currency
			$table->float('fc_amount', 15, 2)->default(0);
			$table->string('dr_account')->default('100001')->nullable();
			$table->string('cr_account')->default('100001')->nullable();
			// $table->float('price', 15, 2)->default(1);
			// $table->float('amount', 15, 2)->default(1);
			// $table->string('base_currency',3)->default('USD');
			// $table->float('base_exchange_rate')->default(1);
			// $table->float('base_amount')->default(0);
			//$table->string('attachment')->nullable();
			$table->text('notes')->nullable();
			/** ENUM */
			$table->string('status')->default(ReceiptStatusEnum::RECEIVED->value);;
			$table->foreign('status')->references('code')->on('statuses');
			/** end ENUM */
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
		Schema::dropIfExists('receipts');
	}
};
