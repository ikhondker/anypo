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
			$table->string('summary');
			$table->foreignId('item_id')->constrained('items');
			$table->foreignId('uom_id')->constrained('uoms');
			$table->float('qty')->default(1);
			$table->float('price', 15, 2)->default(0);
			$table->float('sub_total', 15, 2)->default(0);
			$table->float('tax',15,2)->default(0);
			$table->float('gst',15,2)->default(0);
			$table->float('amount', 15, 2)->default(0);
			//$table->string('fc_currency',3)->default('USD');			// Functional Currency
			//$table->double('fc_exchange_rate', 15, 10)->default(1);
			$table->float('fc_sub_total', 15, 2)->default(0);			// Functional Currency
			$table->float('fc_tax',15,2)->default(0);					// Functional Currency
			$table->float('fc_gst',15,2)->default(0);					// Functional Currency
			$table->float('fc_amount', 15, 2)->default(0);				// Functional Currency
			$table->text('notes')->nullable();
			/** ENUM */
			$table->string('closure_status')->default(ClosureStatusEnum::OPEN->value);;
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
		Schema::dropIfExists('prls');
	}
};
