<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\LandlordCheckoutStatusEnum;

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
			$table->boolean('addon')->default(false); 
			$table->string('session_id');
			$table->string('site');
			$table->string('email');
			$table->string('account_name');
			$table->boolean('existing_user')->default(false);
			$table->foreignId('owner_id')->nullable()->constrained('users');
			$table->integer('account_id')->nullable();
			$table->integer('invoice_id')->nullable();
			$table->date('start_date');
			$table->date('end_date');
			$table->foreignId('product_id')->constrained('products');
			$table->string('product_name');
			$table->float('tax', 15, 2)->default(0);
			$table->float('vat', 15, 2)->default(0);
			$table->float('price', 15, 2)->default(0);
			$table->integer('mnth')->default(1);
			$table->integer('user')->default(3);
			$table->integer('gb')->default(5);
			/** ENUM */
			$table->string('status_code')->default(LandlordCheckoutStatusEnum::DRAFT->value); 
			$table->foreign('status_code')->references('code')->on('statuses');
			/** end ENUM */
			$table->string('ip')->nullable();
			$table->string('address1')->nullable();
			$table->string('address2')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('zip')->nullable();
			$table->string('country',2)->default('us');
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
		Schema::dropIfExists('checkouts');
	}
};
