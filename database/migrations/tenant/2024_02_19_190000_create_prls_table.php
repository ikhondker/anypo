<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\ClosureStatusEnum;


return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('prls', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->foreignId('pr_id')->constrained('prs');
			$table->biginteger('line_num')->default(0);
			//$table->foreignId('project_id')->nullable()->constrained('projects');
			$table->foreignId('item_id')->constrained('items');
			$table->string('item_description');
			$table->foreignId('uom_id')->constrained('uoms');
			$table->decimal('qty', 19, 4)->default(1);
			$table->decimal('price', 19, 4)->default(0);
			$table->decimal('sub_total', 19, 4)->default(0);
			$table->decimal('tax_pc',19, 4)->default(0);				// Future user
			$table->decimal('gst_pc',19, 4)->default(7.5);				// Future user
			$table->decimal('tax',19, 4)->default(0);
			$table->decimal('gst',19, 4)->default(0);
			$table->decimal('amount', 19, 4)->default(0);
			//$table->string('fc_currency',3)->default('USD');			// Functional Currency
			//$table->double('fc_exchange_rate', 15, 10)->default(1);
			$table->decimal('fc_sub_total', 19, 4)->default(0);			// Functional Currency
			$table->decimal('fc_tax',19, 4)->default(0);					// Functional Currency
			$table->decimal('fc_gst',19, 4)->default(0);					// Functional Currency
			$table->decimal('fc_amount', 19, 4)->default(0);				// Functional Currency
			$table->text('notes')->nullable();
			$table->string('error_code',15)->nullable();
			/** ENUM */
			$table->string('closure_status')->default(ClosureStatusEnum::OPEN->value);;
			$table->foreign('closure_status')->references('code')->on('statuses');
			/** end ENUM */
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
		Schema::dropIfExists('prls');
	}
};
