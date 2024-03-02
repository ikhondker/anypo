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
		Schema::create('items', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('name')->unique();
			$table->text('notes')->nullable();
			$table->string('code')->unique()->nullable();
			$table->string('sku')->unique()->nullable();
			$table->foreignId('category_id')->constrained('categories');
			$table->foreignId('oem_id')->constrained('oems');
			$table->foreignId('uom_class_id')->constrained('uom_classes');
			$table->foreignId('uom_id')->constrained('uoms');
			$table->string('gl_type',1)->default('E'); 
			$table->string('dr_account')->default('100001')->nullable();
			$table->string('cr_account')->default('100001')->nullable();
			//$table->foreignId('uom')->constrained('uoms')->references('uom');
			$table->float('price', 15, 2)->default(0);
			$table->unsignedinteger('stock')->default(0);
			$table->unsignedinteger('reorder')->default(5);
			//$table->enum('account_type', ['E','A','I'])->default('E');
			$table->string('photo')->nullable();
			$table->boolean('enable')->default(true); 
			$table->biginteger('created_by')->default(1001);
			$table->timestamp('created_at')->useCurrent();
			$table->biginteger('updated_by')->default(1001);
			$table->timestamp('updated_at')->useCurrent(); 
			$table->foreign('gl_type')->references('gl_type')->on('gl_types');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('items');
	}
};
