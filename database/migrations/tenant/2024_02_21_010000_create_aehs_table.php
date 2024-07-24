<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\EntityEnum;
use App\Enum\AehEventEnum;
use App\Enum\AehStatusEnum;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('aehs', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->dateTime('accounting_date')->useCurrent(); 
			$table->string('source_app')->default('ANYPO.NET');
			//$table->string('source_entity', 15); 
			//$table->string('source_event', 15); 
			//$table->string('source_entity')->default(EntityEnum::INVOICE->value);
			$table->string('source_entity');
			$table->string('event')->default(AehEventEnum::POST->value);
			$table->biginteger('article_id')->index()->default(0);
			$table->biginteger('po_id')->default(0);
			$table->string('description');
			$table->string('fc_currency',3);							// Functional Currency
			$table->float('fc_dr_amount', 15, 2)->default(0);
			$table->float('fc_cr_amount', 15, 2)->default(0);
			$table->string('reference_no')->nullable();
			/** ENUM */
			$table->string('status')->default(AehStatusEnum::DRAFT->value);
			$table->foreign('status')->references('code')->on('statuses');
			/** end ENUM */
			$table->softDeletes();
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
		Schema::dropIfExists('aehs');
	}
};
