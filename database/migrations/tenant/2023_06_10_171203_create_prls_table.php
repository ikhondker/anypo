<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\PrStatusEnum;


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
			$table->text('notes')->nullable();
			$table->float('qty')->default(1);
			//$table->foreignId('uom_id')->constrained('uoms');
			$table->float('price')->default(0);
			$table->float('sub_total')->default(0);
			$table->float('tax')->default(0);
			$table->float('vat')->default(0);
			$table->float('amount')->default(0);
			$table->float('received_qty')->default(0);
			/** ENUM */
			$table->string('status')->default(PrStatusEnum::OPEN->value);;
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
