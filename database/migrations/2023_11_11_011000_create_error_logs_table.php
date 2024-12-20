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
		Schema::create('error_logs', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('tenant')->nullable();
			$table->string('url')->nullable();
			$table->integer('user_id')->nullable()->default('0000');
			$table->string('role')->nullable();
			$table->string('e_class')->nullable();
			$table->longText('message')->nullable();
			$table->enum('status', ['new', 'review', 'ignore', 'fixed'])->default('new');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('error_logs');
	}
};
