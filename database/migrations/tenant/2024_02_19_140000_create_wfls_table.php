<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enum\Tenant\WflActionEnum;


return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('wfls', function (Blueprint $table) {
			$table->id()->startingValue(1001);
			$table->foreignId('wf_id')->constrained('wfs');
			$table->integer('sequence')->default(10);	// TODO P2
			$table->uuid('performer_id');
			$table->dateTime('assign_date',)->useCurrent(); // TODO make sure it is not nullable
			$table->dateTime('action_date',)->nullable();
			/** ENUM */
			$table->string('action')->default(WflActionEnum::PENDING->value);
			/** end ENUM */
			$table->text('notes')->nullable();
			$table->string('error_code',15)->nullable();
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
		Schema::dropIfExists('wfls');
	}
};
