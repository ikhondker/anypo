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
		Schema::create('menus', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('raw_route_name');
			$table->string('route_name')->nullable();
			$table->string('node_name')->nullable();
			//$table->string('access')->default(MenuAccessEnum::FRONT->value);
			//$table->enum('access', ['front','system','back','support','other'])->default('front');
			//$table->enum('access', ['F','C','B','S','X'])->default('F');
			//$table->string('node_name')->nullable();
			$table->boolean('enable')->default(true);
			$table->uuid('created_by')->nullable();
			$table->timestamp('created_at')->useCurrent();
			$table->uuid('updated_by')->nullable();
			$table->timestamp('updated_at')->useCurrent();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('menus');
	}
};
