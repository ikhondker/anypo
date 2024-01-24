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
		Schema::create('comments', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->dateTime('comment_date')->useCurrent();
			$table->longText('content');
			$table->foreignId('ticket_id')->constrained('tickets');
			$table->foreignId('owner_id')->constrained('users');
			$table->boolean('is_internal')->default(false); 
			$table->boolean('by_backoffice')->default(false); 
			$table->foreignId('attachment_id')->nullable()->constrained('attachments');
			$table->string('ip')->default('127.0.0.1');
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
		Schema::dropIfExists('comments');
	}
};
