<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('receipts', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->dateTime('receive_date', $precision = 0)->nullable()->useCurrent();
			$table->string('summary');
			$table->foreignId('pol_id')->constrained('pols');
			$table->foreignId('item_id')->constrained('items');
			$table->foreignId('user_id')->constrained('users');
			//$table->foreignId('supplier_id')->nullable()->constrained('organizations');
			$table->unsignedinteger('qty')->default(1);
			$table->float('price', 15, 2)->default(1);
			$table->float('amount', 15, 2)->default(1);
			$table->string('base_currency',3)->default('USD');
			$table->float('base_exchange_rate')->default(1);
			$table->float('base_amount')->default(0);
			//$table->string('attachment')->nullable();
			$table->enum('type', ['RECEIVE','ADJUSTMENT','MISCELLANEOUS'])->default('receive'); 
			$table->enum('status', ['RECEIVED','CANCELED','RETURNED'])->default('RECEIVED'); 
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
