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
		Schema::create('uoms', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('name')->unique();
			$table->foreignId('uom_class_id')->nullable();
			$table->float('conversion', 15, 4)->default(1);
			//$table->enum('base', ['length','mass','temperature','time'])->default('length');	
			$table->string('text_color')->nullable();
			$table->string('bg_color')->nullable();
			$table->string('icon')->nullable();
			$table->boolean('default')->default(false); 
			$table->boolean('enable')->default(true); 
			$table->biginteger('created_by')->default(1001);
			$table->timestamp('created_at')->useCurrent();
			$table->biginteger('updated_by')->default(1001);
			$table->timestamp('updated_at')->useCurrent();
			$table->foreign('uom_class_id')->references('id')->on('uom_classes');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('uoms');
	}
};