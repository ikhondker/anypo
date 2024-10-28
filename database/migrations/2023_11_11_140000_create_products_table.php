<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\Landlord\AddonTypeEnum;


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
			$table->string('addon_type')->default(AddonTypeEnum::NA->value);
			/** end ENUM */
			$table->decimal('list_price', 19, 2)->default(0);
			$table->decimal('base_price', 19, 2)->default(0);
			$table->decimal('tax', 19, 2)->default(0);
			$table->decimal('vat', 19, 2)->default(0);
			$table->decimal('price', 19, 2)->default(0);
			$table->integer('mnth')->default(1);
			$table->integer('user')->default(3);
			$table->integer('gb')->default(5);
			$table->text('notes')->nullable();
			$table->biginteger('sold_qty')->default(0);
			$table->boolean('enable')->default(true);
			$table->string('photo')->nullable();
			$table->uuid('created_by')->nullable();
			$table->timestamp('created_at')->useCurrent();
			$table->uuid('updated_by')->nullable();
			$table->timestamp('updated_at')->useCurrent();
			//$table->decimal('price_3', 19, 2)->default(0);
			//$table->decimal('price_6', 19, 2)->default(0);
			//$table->decimal('price_12', 19, 2)->default(0);
			//$table->decimal('price_24', 19, 2)->default(0);
			//$table->boolean('taxable')->default(false);
			//$table->decimal('tax_pc', 19, 2)->default(0);
			//$table->decimal('vat_pc', 19, 2)->default(0);
			//$table->decimal('subtotal', 19, 2)->default(0);
			//$table->decimal('amount', 19, 2)->default(0);
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
