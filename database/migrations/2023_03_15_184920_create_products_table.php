<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\LandlordAddonTypeEnum;


return new class () extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('products', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('name');
			$table->string('summary')->nullable();
			$table->string('sku')->unique();
			$table->boolean('addon')->default(false);
			/** ENUM */
			$table->string('addon_type')->default(LandlordAddonTypeEnum::NA->value);
			/** end ENUM */
			$table->float('list_price', 15, 2)->default(0);
			$table->float('base_price', 15, 2)->default(0);
			$table->float('tax', 15, 2)->default(0);
			$table->float('vat', 15, 2)->default(0);
			$table->float('price', 15, 2)->default(0);
			$table->integer('mnth')->default(1);
			$table->integer('user')->default(3);
			$table->integer('gb')->default(5);
			$table->text('notes')->nullable();
			$table->biginteger('sold_qty')->default(0);
			$table->boolean('enable')->default(true);
			$table->string('photo')->nullable();
			$table->biginteger('created_by')->default(1001);
			$table->timestamp('created_at')->useCurrent();
			$table->biginteger('updated_by')->default(1001);
			$table->timestamp('updated_at')->useCurrent();
			//$table->float('price_3', 15, 2)->default(0);
			//$table->float('price_6', 15, 2)->default(0);
			//$table->float('price_12', 15, 2)->default(0);
			//$table->float('price_24', 15, 2)->default(0);
			//$table->boolean('taxable')->default(false);
			//$table->float('tax_pc', 15, 2)->default(0);
			//$table->float('vat_pc', 15, 2)->default(0);
			//$table->float('subtotal', 15, 2)->default(0);
			//$table->float('amount', 15, 2)->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('products');
	}
};
