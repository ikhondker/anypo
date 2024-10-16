<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\Tenant\InterfaceStatusEnum;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('upload_items', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->integer('owner_id')->default(1);
			$table->string('item_code')->nullable();
			$table->string('item_name')->nullable();
			$table->string('category_name')->nullable();
			$table->string('oem_name')->nullable();
			$table->string('uom_name')->nullable();
			$table->string('gl_type_name')->nullable();
			$table->string('ac_expense')->nullable();
			$table->decimal('price', 15, 4)->default(0);
			 /** ENUM */
			 $table->string('status')->default(InterfaceStatusEnum::DRAFT->value);
			 /** end ENUM */
			$table->text('notes')->nullable();
			$table->integer('category_id')->nullable();
			$table->integer('oem_id')->nullable();
			$table->string('uom_class_id')->nullable();
			$table->integer('uom_id')->nullable();
			$table->string('gl_type')->nullable();
			$table->string('error_code',15)->nullable();
			//$table->enum('gl_type', ['E','A','I'])->nullable();
			$table->softDeletes();
			$table->uuid('created_by')->nullable();
			$table->timestamp('created_at')->useCurrent();
			$table->uuid('updated_by')->nullable();
			$table->timestamp('updated_at')->useCurrent();
			$table->foreign('error_code')->references('code')->on('custom_errors');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('upload_items');
	}
};
