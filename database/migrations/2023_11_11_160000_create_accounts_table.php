<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\Landlord\AccountStatusEnum;
use App\Enum\Landlord\RankEnum;

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
			$table->string('tenant_id')->nullable();
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
			$table->foreignUuid('owner_id')->nullable()->constrained('users');
			$table->foreignId('primary_product_id')->nullable()->constrained('products');
			$table->string('logo')->nullable()->default('logo.png');
			// base columns
			$table->integer('base_mnth')->default(0);
			$table->integer('base_user')->default(1);
			$table->integer('base_gb')->default(10);
			$table->decimal('base_price', 19, 2)->default(0);
			// current columns
			$table->integer('mnth')->default(0);
			$table->integer('user')->default(1);
			$table->integer('gb')->default(10);
			$table->decimal('monthly_fee', 19, 2)->default(0);		// added later
			$table->decimal('monthly_addon', 19, 2)->default(0);	// added later
			$table->decimal('price', 19, 2)->default(0);
			$table->integer('discount')->default(0);				// lifetime iem discount
			$table->date('discount_date')->nullable();
			$table->uuid('discount_by')->nullable();
			$table->date('start_date');
			$table->date('end_date');
            // its date column but it checkout its boolean
            $table->date('setup')->nullable();
            $table->date('setup_date')->nullable();
			// billing columns
			// there will be only one unpaid invoice. updated when a subscription is generated
			$table->boolean('next_bill_generated')->default(false);
			$table->integer('next_invoice_no')->nullable();
			$table->date('last_bill_date')->nullable();
			$table->date('expired_at')->nullable();
			// maintenance columns
			$table->boolean('banner_show')->default(false);	// Show account specific message from landlord
			$table->text('banner_message')->nullable();		// Show account specific message from landlord
			$table->boolean('maintenance')->default(false);
			$table->text('notes_internal')->nullable();		// Internal use only
			// analytic column
			$table->decimal('landlord_total_paid', 19, 2)->default(0);
			$table->integer('landlord_count_user')->default(1);
			$table->integer('landlord_count_product')->default(0);
			$table->integer('tenant_count_user')->default(1);
			$table->integer('tenant_used_gb')->default(0);
			$table->integer('tenant_count_pr')->default(0);		// only approved
			$table->integer('tenant_count_po')->default(0); 	// only approved
			$table->integer('tenant_count_grs')->default(0);
			$table->integer('tenant_count_inv')->default(0); 	// only posted
			$table->integer('tenant_count_pay')->default(0);
			$table->boolean('tenant_enable')->default(true);
			$table->string('rank')->default(RankEnum::C->value);
			/** ENUM */
			//$table->string('status')->default(AccountStatusEnum::ACTIVE->value);
			/** end ENUM */
			/** ENUM */
			$table->string('status_code')->default(AccountStatusEnum::ACTIVE->value);
			$table->foreign('status_code')->references('code')->on('statuses');
			/** end ENUM */
			//$table->boolean('enable')->default(true);
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
		Schema::dropIfExists('accounts');
	}
};
