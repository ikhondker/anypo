<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//use DB;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('bank_accounts', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('ac_name')->unique();
			$table->string('ac_number')->unique();
			$table->string('routing_number')->nullable();
			$table->string('bank_name')->nullable();
			$table->string('branch_name')->nullable();
			$table->date('start_date')->default(DB::raw('(CURDATE())'));
			$table->date('end_date')->nullable();
			$table->string('currency',3)->default('USD');
			$table->string('ac_bank')->default('A100401');
			$table->string('contact_person')->nullable();
			$table->string('cell')->nullable();
			$table->string('address1')->nullable();
			$table->string('address2')->nullable();
			$table->string('city')->nullable();
			$table->string('zip')->nullable();
			$table->string('state')->nullable();
			$table->string('country',2)->default('US');
			$table->string('website')->nullable();
			$table->string('email')->nullable();
			$table->boolean('enable')->default(true);
			$table->softDeletes();
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
		Schema::dropIfExists('bank_accounts');
	}
};
