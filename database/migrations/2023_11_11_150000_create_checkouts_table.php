<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\Landlord\InvoiceTypeEnum;
use App\Enum\Landlord\CheckoutStatusEnum;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('checkouts', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->dateTime('checkout_date')->useCurrent();
			/** ENUM */
			$table->string('invoice_type')->default(InvoiceTypeEnum::CHECKOUT->value);
			/** end ENUM */
			/** ENUM */
			$table->string('status_code')->default(CheckoutStatusEnum::DRAFT->value);
			$table->foreign('status_code')->references('code')->on('statuses');
			/** end ENUM */
			$table->string('session_id');
			$table->string('site');
			$table->string('email');
			$table->string('account_name');
			$table->boolean('existing_user')->default(false);
			$table->foreignUuid('owner_id')->nullable()->constrained('users');
			$table->integer('account_id')->nullable();
			$table->integer('invoice_id')->nullable();
			$table->date('start_date');
			$table->date('end_date');
			$table->foreignId('product_id')->constrained('products');
			$table->string('product_name');
			$table->decimal('tax', 19, 2)->default(0);
			$table->decimal('vat', 19, 2)->default(0);
			$table->decimal('price', 19, 2)->default(0);
			$table->integer('mnth')->default(1);
			$table->integer('user')->default(3);
			$table->integer('gb')->default(5);
			$table->string('ip')->nullable();
			$table->string('address1')->nullable();
			$table->string('address2')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('zip')->nullable();
			$table->string('country',2)->default('us');
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
		Schema::dropIfExists('checkouts');
	}
};
