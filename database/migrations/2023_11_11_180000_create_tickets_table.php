<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\Landlord\TicketStatusEnum;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('tickets', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->string('title');
			//$table->string('ticket_number');
			$table->longText('content');
			$table->dateTime('ticket_date')->useCurrent();
			$table->foreignUuid('owner_id')->nullable()->constrained('users');
			$table->foreignId('account_id')->nullable()->constrained('accounts');
			$table->foreignId('dept_id')->constrained('depts')->default(1001);
			$table->foreignId('priority_id')->constrained('priorities')->default(1001);
			$table->foreignId('rating_id')->nullable()->constrained('ratings');
			$table->foreignUuid('agent_id')->nullable()->constrained('users');
			$table->foreignUuid('attachment_id')->nullable()->constrained('attachments');
			$table->foreignId('category_id')->nullable()->constrained('categories')->default(1001);
			/** ENUM */
			$table->string('status_code')->default(TicketStatusEnum::NEW->value);
			$table->foreign('status_code')->references('code')->on('statuses');
			//$table->foreignId('status_id')->default(TicketStatusEnum::NEW->value)->constrained('statuses');
			/** end ENUM */
			//$table->boolean('is_answered')->default(false);
			$table->integer('sla')->nullable()->index('sla');
			$table->dateTime('first_response_at')->nullable();
			$table->dateTime('last_message_at')->nullable();
			$table->dateTime('last_response_at')->nullable();
			$table->dateTime('due_date')->nullable();
			$table->boolean('is_overdue')->default(false);
			$table->boolean('closed')->default(false);
			$table->dateTime('closed_at')->nullable();
			$table->boolean('is_deleted')->default(false);
			$table->boolean('reopened')->default(false);
			$table->dateTime('reopened_at')->nullable();
			$table->boolean('follow_up')->default(false);
			$table->dateTime('reviewed_at')->nullable();
			$table->foreignUuid('reviewed_by')->nullable()->constrained('users');
			$table->boolean('cr_needed')->default(false);
			$table->biginteger('link_ticket_id')->nullable();
			$table->string('ip')->default('127.0.0.1');
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
		Schema::dropIfExists('tickets');
	}
};
