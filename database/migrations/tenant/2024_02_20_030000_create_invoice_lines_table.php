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
		Schema::create('invoice_lines', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->foreignId('inv_id')->constrained('invoices');
			$table->biginteger('line_num')->default(0);
			$table->string('summary');
			$table->foreignId('item_id')->constrained('items');
			$table->foreignId('uom_id')->constrained('uoms');
			$table->float('qty')->default(1);
			$table->float('price')->default(0);
			$table->float('sub_total', 15, 2)->default(0);
			$table->float('tax',15,2)->default(0);
			$table->float('gst',15,2)->default(0);
			$table->float('amount', 15, 2)->default(0);
			$table->float('fc_sub_total', 15, 2)->default(0);			// Functional Currency
			$table->float('fc_tax',15,2)->default(0);					// Functional Currency
			$table->float('fc_gst',15,2)->default(0);					// Functional Currency
			$table->float('fc_amount', 15, 2)->default(0);				// Functional Currency
			$table->text('notes')->nullable();
			$table->string('error_code',15)->nullable();
			/** ENUM */
			$table->string('closure_status')->default(ClosureStatusEnum::OPEN->value);
			$table->foreign('closure_status')->references('code')->on('statuses');
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
		Schema::dropIfExists('invoice_lines');
	}
};
