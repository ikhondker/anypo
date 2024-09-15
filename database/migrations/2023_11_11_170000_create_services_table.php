<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\LandlordAddonTypeEnum;
use App\Enum\LandlordServiceStatusEnum;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('services', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('name');
			$table->foreignId('account_id')->nullable()->constrained('accounts');
			$table->foreignId('product_id')->nullable()->constrained('products');
			$table->foreignUuid('owner_id')->nullable()->constrained('users');
			$table->boolean('addon')->default(false); 
			/** ENUM */
			$table->string('addon_type')->default(LandlordAddonTypeEnum::NA->value);
			/** end ENUM */
			$table->integer('mnth')->default(0);
			$table->integer('user')->default(1);
			$table->integer('gb')->default(10);
			$table->decimal('price', 19, 4)->default(0);
			$table->decimal('subtotal',19, 4)->default(0);
			$table->decimal('tax',19, 4)->default(0);
			$table->decimal('vat',19, 4)->default(0);
			$table->decimal('amount',19, 4)->default(0);
			$table->date('start_date')->default(DB::raw('(CURDATE())'));
			$table->date('end_date')->nullable();
			/** ENUM */
			$table->string('status_code')->default(LandlordServiceStatusEnum::DRAFT->value); 
			$table->foreign('status_code')->references('code')->on('statuses');
			//$table->foreignId('status_id')->default(LandlordInvoiceStatusEnum::DUE->value)->constrained('statuses');
			/** end ENUM */
			$table->boolean('enable')->default(true); 
			$table->text('notes')->default(0);
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
		Schema::dropIfExists('services');
	}
};
