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
		Schema::create('contacts', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->enum('type', ['general', 'bug','feature','other'])->default('general');
			$table->string('first_name');
			$table->string('last_name')->nullable();
			$table->string('email');
			$table->string('cell')->nullable();
			$table->string('subject')->nullable();
			$table->text('notes');
			$table->dateTime('contact_date')->useCurrent();
			$table->string('tenant')->nullable();
			$table->boolean('demo_requested')->default(true);
			$table->dateTime('demo_preferred_date')->useCurrent();
			$table->boolean('demo_performed')->default(false);
			$table->dateTime('demo_date')->nullable();
			$table->foreignUuid('demo_performed_by')->nullable();
			$table->text('demo_feedback')->nullable();
			$table->foreignUuid('user_id')->nullable();
			$table->foreignUuid('attachment_id')->nullable()->constrained('attachments');
			$table->string('ip')->nullable();
			$table->string('country',2)->default('us');
//			$table->foreignId('user_id')->nullable()->constrained('users');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('contacts');
	}
};
