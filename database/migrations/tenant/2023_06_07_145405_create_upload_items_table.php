<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\InterfaceStatusEnum;

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
			$table->string('name')->nullable();
			$table->string('code')->nullable();
			$table->string('category')->nullable();
			$table->string('oem')->nullable();
			$table->string('uom')->nullable();
			$table->string('gl_type_name')->nullable();
			$table->float('price', 8, 2)->default(0);
			 /** ENUM */
			 $table->string('status')->default(InterfaceStatusEnum::DRAFT->value);
			 /** end ENUM */
			$table->text('notes')->nullable();
			$table->integer('category_id')->nullable();
			$table->integer('oem_id')->nullable();
			$table->integer('uom_id')->nullable();
			$table->enum('gl_type', ['E','A','I'])->nullable();
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
		Schema::dropIfExists('upload_items');
	}
};
