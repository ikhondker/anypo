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
			$table->enum('type', ['contact','bug', 'feature', 'demo', 'quote', 'other'])->default('contact');
			$table->string('first_name');
			$table->string('last_name')->nullable();
			$table->string('email');
			$table->string('cell')->nullable();
			$table->string('subject')->nullable();
			$table->text('notes');
			$table->dateTime('contact_date')->useCurrent();
			$table->foreignUuid('attachment_id')->nullable()->constrained('attachments');
			$table->foreignUuid('user_id')->nullable();
			$table->foreignUuid('owner_id')->nullable();    // bug/demo/feedback
            $table->string('tenant')->nullable();
			$table->dateTime('demo_preferred_date')->nullable();
			$table->boolean('demo_performed')->default(false);
			$table->dateTime('demo_date')->nullable();
            $table->text('notes_internal')->nullable();
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
