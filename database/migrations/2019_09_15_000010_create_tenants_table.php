<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void
	{
		Schema::create('tenants', function (Blueprint $table) {
			$table->string('id')->primary();
			// your custom columns may go here
			$table->date('start_date')->nullable()->useCurrent();
			$table->date('end_date')->nullable();
			// $table->integer('initial_owner_id')->nullable();
			// $table->string('initial_name')->nullable();
			// $table->string('initial_email')->nullable();
			// $table->string('initial_password')->nullable();
			$table->integer('user')->default(3);
            $table->integer('gb')->default(5);
			$table->integer('count_user')->default(0);
			$table->integer('count_gb')->default(0);
			$table->integer('count_pr')->default(0);
			$table->integer('count_po')->default(0);
			$table->enum('rank', ['1', '2','3','4','5'])->default('3'); 
			$table->enum('status', ['active', 'pastdue','locked','readonly','deleted','demo'])->default('active'); 
			$table->timestamps();
			$table->json('data')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void
	{
		Schema::dropIfExists('tenants');
	}
}
