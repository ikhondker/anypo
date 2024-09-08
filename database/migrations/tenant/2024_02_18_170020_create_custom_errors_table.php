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
		Schema::create('custom_errors', function (Blueprint $table) {
			$table->string('code', 15);	// model: protected $primaryKey = 'code'; 
			$table->string('entity',15); 
			/** ENUM */
			//$table->string('entity')->default(EntityEnum::PR->value);
			/** end ENUM */
			$table->string('message')->nullable();
			$table->boolean('enable')->default(true); 
			$table->softDeletes();
			$table->uuid('created_by')->nullable();
			$table->timestamp('created_at')->useCurrent();
			$table->uuid('updated_by')->nullable();
			$table->timestamp('updated_at')->useCurrent();
			$table->primary('code');
			$table->foreign('entity')->references('entity')->on('entities');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('custom_errors');
	}
};
