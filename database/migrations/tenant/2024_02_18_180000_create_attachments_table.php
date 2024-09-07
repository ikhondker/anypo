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
		Schema::create('attachments', function (Blueprint $table) {
			//$table->id()->startingValue(1001);
			$table->uuid('id')->primary();
			$table->string('entity',15); 
			$table->biginteger('article_id')->default(0);
			$table->string('file_entity',15); 
			//$table->foreignId('attachment_entity')->constrained('entities');
			$table->foreignId('owner_id')->constrained('users');
			$table->string('summary')->nullable();
			$table->string('file_name');
			$table->string('file_type')->nullable();
			$table->biginteger('file_size')->nullable();
			$table->string('org_file_name')->nullable();
			$table->dateTime('upload_date')->useCurrent();
			$table->biginteger('view_count')->default(0);
			$table->enum('status', ['public','private','restricted','other'])->default('private');
			$table->softDeletes();
			$table->biginteger('created_by')->default(1001);
			$table->timestamp('created_at')->useCurrent();
			$table->biginteger('updated_by')->default(1001);
			$table->timestamp('updated_at')->useCurrent();
			$table->foreign('entity')->references('entity')->on('entities');
			$table->foreign('file_entity')->references('entity')->on('entities');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('attachments');
	}
};
