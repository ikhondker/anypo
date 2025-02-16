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
		Schema::create('configs', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('name');
			$table->string('tagline')->nullable();
			$table->string('currency',3)->default('USD');
			//$table->decimal('tax', 19, 2)->default(0);
			//$table->decimal('gst', 19, 2)->default(0);
			$table->string('address1')->nullable();
			$table->string('address2')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('zip')->nullable();
			$table->string('country',2)->default('NL');
			$table->string('email')->nullable();
			$table->string('cell')->nullable();
			$table->string('website')->nullable();
			$table->string('facebook')->nullable();
			$table->string('linkedin')->nullable();
			$table->string('logo')->nullable();
			$table->boolean('banner')->default(false);
			$table->text('banner_message')->nullable();
			$table->boolean('maintenance')->default(false);
			$table->string('timezone', 255)->default('UTC');
			$table->dateTime('maintenance_start_time')->nullable()->useCurrent();
			$table->dateTime('maintenance_end_time')->nullable()->useCurrent();
			$table->boolean('debug')->default(false);
			$table->boolean('disable_payments')->default(false);
			$table->string('version')->nullable()->default('1.0.0');
			$table->string('build')->nullable()->default('1001');
			$table->integer('days_gen_bill')->default(5);		// days bill generate before expire
			$table->integer('days_due')->default(7);
			$table->integer('days_past_due')->default(14);
			$table->integer('days_archive')->default(60);
			$table->integer('days_addon_free')->default(15);		// used during addon purchase
			$table->decimal('discount_pc_3', 19, 2)->default(5);
			$table->decimal('discount_pc_6', 19, 2)->default(10);
			$table->decimal('discount_pc_12', 19, 2)->default(15);
			$table->decimal('discount_pc_24', 19, 2)->default(20);
			$table->uuid('sys_user_id')->nullable();					// No foreign key intentional
			$table->uuid('support_manager_id')->nullable();				// No foreign key intentional
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
		Schema::dropIfExists('configs');
	}
};
