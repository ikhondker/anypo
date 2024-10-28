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
		Schema::create('aels', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->foreignId('aeh_id')->constrained('aehs');
			$table->biginteger('line_num')->default(0);
			$table->date('accounting_date')->default(DB::raw('(CURDATE())'));
			$table->string('ac_code');
			$table->string('line_description');
			$table->string('fc_currency', 3);							// Functional Currency
			$table->decimal('fc_dr_amount', 19, 2)->default(0);
			$table->decimal('fc_cr_amount', 19, 2)->default(0);
			// $table->biginteger('po_id')->default(0);
			// $table->biginteger('article_id')->index()->default(0);
			$table->string('reference_no')->nullable();
			$table->softDeletes();
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
		Schema::dropIfExists('aels');
	}
};
