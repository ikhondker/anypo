<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\LandlordAccountStatusEnum;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('accounts', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('site');
			$table->string('name');
			$table->string('currency',3)->default('USD');
			$table->string('tagline')->nullable();
			$table->string('address1')->nullable();
			$table->string('address2')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('zip')->nullable();
			$table->string('country',2)->default('US');
			$table->string('website')->nullable();
			$table->string('facebook')->nullable();
			$table->string('linkedin')->nullable();
			$table->string('email')->nullable();
			$table->string('cell')->nullable();
			$table->foreignId('owner_id')->nullable()->constrained('users');
			$table->foreignId('primary_product_id')->nullable()->constrained('products');
			$table->integer('base_mnth')->default(0);
			$table->integer('base_user')->default(1);
			$table->integer('base_gb')->default(10);
			$table->float('base_price', 15, 2)->default(0);
			$table->integer('mnth')->default(0);
			$table->integer('user')->default(1);
			$table->integer('gb')->default(10);
			$table->float('price', 15, 2)->default(0);
			$table->date('start_date');
			$table->date('end_date');
			// there will be only one unpaid invoice. updated when a subscription is generated
			$table->boolean('next_bill_generated')->default(false);
			$table->integer('next_invoice_no')->nullable();
			$table->date('last_bill_date')->nullable();
			//$table->date('next_bill_gen_date')->nullable();
			//$table->date('last_bill_from_date')->nullable();
			//$table->date('last_bill_to_date')->nullable();
			$table->date('expired_at')->nullable();
			$table->boolean('banner_show')->default(false);	// Show account specific message from landlord
			$table->text('banner_message')->nullable();		// Show account specific message from landlord

			$table->integer('count_user')->default(1);
			$table->integer('count_product')->default(0);
			$table->integer('used_gb')->default(0);
			$table->boolean('maintenance')->default(false); 
			/** ENUM */
			//$table->string('status')->default(LandlordAccountStatusEnum::ACTIVE->value);
			/** end ENUM */
			/** ENUM */
			$table->string('status_code',4)->default(LandlordAccountStatusEnum::ACTIVE->value); 
			$table->foreign('status_code')->references('code')->on('statuses');
			//$table->foreignId('status_id')->default(LandlordAccountStatusEnum::ACTIVE->value)->constrained('statuses');
			/** end ENUM */
			//$table->boolean('enable')->default(true); 
			$table->string('logo')->nullable()->default('logo.png');
			$table->biginteger('created_by')->default(1);
			$table->timestamp('created_at')->useCurrent();
			$table->biginteger('updated_by')->default(1);
			$table->timestamp('updated_at')->useCurrent();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('accounts');
	}
};
