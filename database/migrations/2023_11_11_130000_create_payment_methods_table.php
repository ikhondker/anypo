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
		Schema::create('payment_methods', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('name');
			$table->string('text_color')->nullable();
			$table->string('bg_color')->nullable();
			$table->string('icon')->nullable();
			$table->boolean('enable')->default(true); 
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
		Schema::dropIfExists('payment_methods');
	}
};
