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
		Schema::create('pols', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->foreignId('po_id')->constrained('pos');
			$table->biginteger('line_num')->default(0)->index();
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
			$table->foreignId('requestor_id')->constrained('users')->nullable();
			$table->foreignId('dept_id')->constrained('depts')->nullable();			// Future User. Covert to PO
			$table->biginteger('unit_id')->nullable()->default(1001);				// Future User. Covert to PO
			$table->foreignId('project_id')->nullable()->constrained('projects');	// Future User. Covert to PO
			$table->biginteger('prl_id')->default(0);								// // PR that converted to PO
			$table->float('received_qty')->default(0);
			/** ENUM */
			$table->string('closure_status')->default(ClosureStatusEnum::OPEN->value);;
			/** end ENUM */
			$table->boolean('asset_created')->default(false); 
			$table->date('asset_date')->nullable();
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
		Schema::dropIfExists('pols');
	}
};
